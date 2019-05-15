<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;
use GeoIp2\Database\Reader;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Geo;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Cookie;
use finfo;
use RuntimeException;
use MaxMind\Exception\IpAddressNotFoundException;
use App\Utils;
use Symfony\Component\HttpFoundation\Session\Session;

class ZDefaultController extends Controller
{
    function sanitize_output($buffer) {
        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s'       // shorten multiple whitespace sequences
        );
        $replace = array(
            '>',
            '<',
            '\\1'
        );
        $buffer = preg_replace($search, $replace, $buffer);
        return $buffer;
    }

    protected function render(string $view, array $parameters = array(), Response $response = null, Request $request = null): Response
    {
        $session = new Session();
        $width = $session->get('width');

        if (!isset($width)) {
            $view = 'detect_screen_size.html.twig';
        }
        //////////////////////////////////////////

        $revision               = exec('git rev-list HEAD | wc -l');
        $parameters['revision'] = $revision;

        if ($this->container->has('templating')) {
            $content = $this->container->get('templating')->render($view, $parameters);
        } elseif ($this->container->has('twig')) {
            $content = $this->container->get('twig')->render($view, $parameters);
        } else {
            throw new \LogicException('You can not use the "render" method if the Templating Component or the Twig Bundle are not available. Try running "composer require symfony/twig-bundle".');
        }

        if (null === $response) {
            $response = new Response();
        }

        if ($_SERVER['APP_ENV'] == 'prod') {
            $content = $this->sanitize_output($content);
        }

        $response->setContent($content);

        return $response;
    }

    protected $geo;

    public function getGeo(Request $request)
    {
        if ($this->geo) {
            return $this->geo;
        }

        $em = $this->container->get('doctrine')->getManager();
        $host = $request->getHost();
        /** @var $geo \App\Entity\Geo */
        $geo = $em->getRepository('App:Geo')->findOneBy([
            'host' => $host,
        ]);

        if (!$geo) {
            $geo = $em->getRepository('App:Geo')->findOneBy(['city' => 'Россия']);
        }

        if (!$geo) {
            return $this->defaultAction($request, $error_404 = true);
        }

        $this->geo = $geo;

        return $geo;
    }

    public function getResponse(Request $request)
    {
        $em          = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $referer     = $request->headers->get('referer');
        $cookies     = $request->cookies;
        $utm_source  = $request->get('utm_source');
        $request_uri = $request->getRequestUri();
        $response    = new Response();

        $exploded_host = explode('.', $request->getHost());
        $domain = array_pop($exploded_host);
        $domain = '.' . array_pop($exploded_host) . '.' . $domain;

        $geo_id = $this->getGeo($request)->getId();

        if ($utm_source and !$cookies->has('geo_id')) {

            //var_dump('111111');
            //var_dump($utm_source);

            $ip = $request->getClientIp();
            if (filter_var(
                $ip,
                FILTER_VALIDATE_IP,
                FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
            )) {
                $reader = new Reader('GeoLite2-City.mmdb');
                $record = $reader->city($ip);

                if (
                    $record
                    and $record->mostSpecificSubdivision->names
                    and $record->city->names
                    and array_key_exists('ru', $record->mostSpecificSubdivision->names)
                    and array_key_exists('ru', $record->city->names)
                ) {
                    $region = $record->mostSpecificSubdivision->names['ru'];
                    $city = $record->city->names['ru'];

                    $geo = $em->getRepository('App:Geo')->findOneBy(['city' => $city, 'region' => $region,]);

                    if (!$geo) {
                        $geo = $em->getRepository('App:Geo')->findOneBy(['region' => $region,]);
                    }

                    if ($geo and !$geo->getIsVisible() and $geo->getGeo()) {
                        $geo = $geo->getGeo();
                    }

                    if (!$geo) {
                        $geo = $em->getRepository('App:Geo')->findOneBy(['city' => 'Россия']);
                    }

                    if ($geo and $request->getHost() != $geo->getHost()) {
                        $response = new RedirectResponse($geo->getSchemeAndHttpHost().$request_uri);
                        $response->setStatusCode(Response::HTTP_OK);

                        return $response;
                    }
                }
            }

            $response->setStatusCode(Response::HTTP_OK);
            return $response;
        }
        elseif ($utm_source and $cookies->has('geo_id')) {
            $geo_cookie_id = $cookies->get('geo_id');

            $geo = $em->getRepository('App:Geo')->find($geo_cookie_id);

            if (!$geo) {
                $geo = $em->getRepository('App:Geo')->findOneBy(['city' => 'Россия']);
            }

            if ($geo_cookie_id != $geo_id) {
                $response = new RedirectResponse($geo->getSchemeAndHttpHost().$request_uri, 302);
                $response->send();
            }
        }
        elseif (strlen($request_uri)>1) {
            $response = new Response();
            $response->setStatusCode(Response::HTTP_OK);
            return $response;
        }

        $response = new Response();
        $response->setStatusCode(Response::HTTP_OK);

        return $response;
    }


    /**
     * @Route("/get-maps", name="get_maps")
     */
    public function getMaps(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $maps = $em->getRepository('App:Map')->createQueryBuilder('m')
            ->getQuery()->getArrayResult()
        ;
        return new Response(json_encode($maps), 200, ['Content-type' => 'text/json']);
    }

    /**
     * @Route("/set-screen-width", name="set_screen_width")
     */
    public function setScreenWidth(Request $request)
    {
        $width = $request->get('width', 0);
        $session = new Session();
        $session->set('width', $width);
        return new Response($width, 200, ['Content-type' => 'text/plain']);
    }

    /**
     * @Route("/get-screen-width", name="get_screen_width")
     */
    public function getScreenWidth(Request $request)
    {
        $session = new Session();
        $width = $session->get('width', 0);
        return new Response($width, 200, ['Content-type' => 'text/plain']);
    }

    public function getScreenWidthType(Request $request)
    {
        $m = $request->get('m');

        if (isset($m)) {
            return 0;
        }

        $n = $request->get('n');

        if (isset($n)) {
            return 480;
        }

        $session = new Session();
        $width = $session->get('width', 0);

        if ($width >= 0) {
            $type = 0;
        }
        if ($width > 480) {
            $type = 480;
        }
        if ($width > 768) {
            $type = 768;
        }

        return $type;
    }

    /**
     * @Route("/agency", name="agency")
     */
    public function agencyAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $geo = $this->getGeo($request);

        return $this->render('agency/default_' . $this->getScreenWidthType($request) . '.html.twig', [
            'regions' => $em->getRepository('App:Region')->createQueryBuilder('r')->leftJoin('r.visas', 'v')->addSelect('v')->getQuery()->getResult(),
            'geos' => $em->getRepository('App:Geo')->findBy(['is_visible' => 'true']),
            'geo' => $geo,
        ],
            $this->getResponse($request));
    }

    /**
     * @Route("/organization", name="organization")
     */
    public function organizationAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $geo = $this->getGeo($request);

        return $this->render('organization/default_' . $this->getScreenWidthType($request) . '.html.twig', [
            'regions' => $em->getRepository('App:Region')->createQueryBuilder('r')->leftJoin('r.visas', 'v')->addSelect('v')->getQuery()->getResult(),
            'geos' => $em->getRepository('App:Geo')->findBy(['is_visible' => 'true']),
            'geo' => $geo,
        ],
            $this->getResponse($request));
    }


    /**
     * @Route("/napravlenie-{slug}/", name="direction", options={"utf8": true})
     */
    public function directionAction(Request $request, $slug)
    {
        $em = $this->container->get('doctrine')->getManager();
        /** @var $em \Doctrine\ORM\EntityManager */
        $region = $em->getRepository('App:Region')->createQueryBuilder('r')
            ->leftJoin('r.visas', 'v')->addSelect('v')
            ->andWhere('r.slug = :slug')->setParameter('slug', $slug)
            ->getQuery()->getOneOrNullResult();
        /** @var $region \App\Entity\Region */

        if (!$region) {
            return $this->defaultAction($request, $error_404 = true);
        }

        $keywords = explode('<h1>', $region->getIntroTitle());

        if (isset($keywords[1])) {
            $keywords = explode('</h1>', $keywords[1]);
        } else {
            $keywords = '';
        }

        if (isset($keywords[0])) {
            $keywords = $keywords[0];
        } else {
            $keywords = '';
        }

        return $this->render('direction/default_' . $this->getScreenWidthType($request) . '.html.twig', [
                'region'       => $region,
                'regions'      => $em->getRepository('App:Region')->createQueryBuilder('r')->leftJoin('r.visas', 'v')->addSelect('v')->getQuery()->getResult(),
                'facts'        => $em->getRepository('App:Fact')->findBy([], ['position' => 'DESC', 'id' => 'DESC']),
                'specialists'  => $em->getRepository('App:Specialist')->findBy(['geo' => $this->getGeo($request)], ['position' => 'DESC', 'id' => 'DESC']),
                'testimonials' => $em->getRepository('App:Testimonial')->findBy([], ['position' => 'DESC', 'id' => 'DESC']),
                'geos'         => $em->getRepository('App:Geo')->findBy(['is_visible' => 'true']),
                'maps'         => $em->getRepository('App:Map')->findAll(),
                'geo'          => $this->getGeo($request),
                'keywords'     => $keywords,
            ],
            $this->getResponse($request)
        );
    }

    /**
     * @Route("/napravlenie-{region_slug}/viza-{slug}/", name="visa", options={"utf8": true})
     */
    public function visaAction(Request $request, $region_slug, $slug)
    {
        $em = $this->container->get('doctrine')->getManager();
        /** @var $em \Doctrine\ORM\EntityManager */
        $visa = $em->getRepository('App:Visa')->createQueryBuilder('v')
            ->leftJoin('v.region', 'r')->addSelect('r')
            ->leftJoin('v.infos', 'i')->addSelect('i')
            ->andWhere('v.slug = :slug')->setParameter('slug', $slug)
            ->getQuery()->getOneOrNullResult();
        /** @var $visa \App\Entity\Visa */

        if (!$visa) {
            return $this->defaultAction($request, $error_404 = true);
        }

        $keywords = explode('<h1>', $visa->getIntroTitle());

        if (isset($keywords[1])) {
            $keywords = explode('</h1>', $keywords[1]);
        } else {
            $keywords = '';
        }

        if (isset($keywords[0])) {
            $keywords = $keywords[0];
        } else {
            $keywords = '';
        }

        return $this->render('visa/default_' . $this->getScreenWidthType($request) . '.html.twig', [
            'visa'        => $visa,
            'region'      => $visa->getRegion(),
            'regions'     => $em->getRepository('App:Region')->createQueryBuilder('r')->leftJoin('r.visas', 'v')->addSelect('v')->getQuery()->getResult(),
            'specialists' => $em->getRepository('App:Specialist')->findBy(['geo' => $this->getGeo($request)], ['position' => 'DESC', 'id' => 'DESC']),
            'geos'        => $em->getRepository('App:Geo')->findBy(['is_visible' => 'true']),
            'geo'         => $this->getGeo($request),
            'keywords'    => $keywords,
        ], $this->getResponse($request));
    }

    /**
     * @Route("/send-consultation-form-email", name="send_consultation_form_email")
     */
    public function sendConsultationFormEmailAction(Request $request, \Swift_Mailer $mailer)
    {
        $file = false;

        if (isset($_FILES['photo'])) {
            $file = Utils\Tool::uploadPhoto();
        }

        $body = '';

        $type = $request->get('type', false);
        $country = $request->get('country', false);
        $name = $request->get('name', false);
        $phone = $request->get('phone', false);
        $commentary = $request->get('commentary', false);
        $geo = $request->get('geo', false);
        $quiz = $request->get('quiz', false);

        switch ($type) {
            case "quiz":
                $subject = "МВЦ " . $geo . ": Заявка на визу. Квиз";
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $quiz['Имя'] . " \r\n"; unset($quiz['Имя']);
                $body .= "    Телефон: " . $quiz['Телефон'] . " \r\n"; unset($quiz['Телефон']);
                $body .= "Ответы на вопросы: \r\n";
                $body .= "    Страна: " . $quiz['Страна'] . " \r\n"; unset($quiz['Страна']);
                $body .= "    Цель поездки: " . $quiz['Цель поездки'] . " \r\n"; unset($quiz['Цель поездки']);
                $body .= "    Кто едет: " . implode(', ', $quiz['Кто едет']) . " \r\n"; unset($quiz['Кто едет']);
                $body .= "    Гражданство: " . $quiz['Гражданство'] . " \r\n"; unset($quiz['Гражданство']);
                $body .= "    Трудовой статус: " . $quiz['Трудовой статус'] . " \r\n"; unset($quiz['Трудовой статус']);
                $body .= "    Дата поездки: " . $quiz['Дата поездки'] . " \r\n"; unset($quiz['Дата поездки']);

                foreach($quiz as $key => $remaining) {
                    if (is_array($remaining)) {
                        $body .= "    ". $key .": ". implode(', ', $remaining) . " \r\n";
                    } else {
                        $body .= "    ". $key .": ". $remaining." \r\n";
                    }
                }

                $body .= "__\r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
                break;
            case "application":
                $subject = "МВЦ " . $geo . ": Заявка на визу. " . $country;
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $name . " \r\n";
                $body .= "    Телефон: " . $phone . " \r\n";
                $body .= "Заказ: \r\n";
                $body .= "    Страна: " . $country . "\r\n";
                $body .= "__\r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
                break;
            case "callback":
                $subject = "МВЦ " . $geo . ": Обратный звонок";
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $name . " \r\n";
                $body .= "    Телефон: " . $phone . " \r\n";
                $body .= "__ \r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
                break;
            case "wish":
                $subject = "МВЦ " . $geo . ": Идеи или пожелания";
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $name . " \r\n";
                $body .= "    Телефон: " . $phone . " \r\n";
                $body .= "Сообщение: " . " \r\n";
                $body .= "    Пожелание: " . $commentary . " \r\n";
                $body .= "__ \r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
                break;
            case "join":
                $subject = "МВЦ " . $geo . ": Заявка присоединиться";
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $name . " \r\n";
                $body .= "    Телефон: " . $phone . " \r\n";
                $body .= "Сообщение: " . " \r\n";
                $body .= "    Комментарий: " . $commentary . " \r\n";
                $body .= "    Файл: " . $file . "\r\n";
                $body .= "__ \r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
                break;
            case "agency":
                $subject = "МВЦ " . $geo . ": Консультация по партнерству";
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $name . " \r\n";
                $body .= "    Телефон: " . $phone . " \r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
                break;
            case "franchise":
                $subject = "МВЦ " . $geo . ": Информация по франшизе";
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $name . " \r\n";
                $body .= "    Телефон: " . $phone . " \r\n";
                $body .= "Сообщение: " . " \r\n";
                $body .= "    Комментарий: Прошу перезвонить мне для уточнения информации по франшизе. \r\n";
                $body .= "__ \r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
                break;
            case "organization":
                $subject = "МВЦ " . $geo . ": Заявка от организации";
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $name . " \r\n";
                $body .= "    Телефон: " . $phone . " \r\n";
                $body .= "Сообщение: " . " \r\n";
                $body .= "    Комментарий: Интересует оформление визы для организации. \r\n";
                $body .= "__ \r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
		break;
            default:
                $subject = "Новое сообщение на сайте ivcg.ru";
                $body .= "Контакт: \r\n";
                $body .= "    Имя: " . $name . " \r\n";
                $body .= "    Телефон: " . $phone . " \r\n";
                $body .= "Сообщение: " . " \r\n";
                $body .= "    Комментарий: " . $commentary . " \r\n";
                if ($file) {
                    $body .= "    Файл: \r\n";
                    $body .= $file . "\r\n";
                }
                $body .= "__ \r\n";
                $body .= "Это сообщение отправлено с сайта ivcg.ru \r\n";
        }

        $message = (new \Swift_Message($subject))
            ->setFrom('noreply@ivcg.ru')
            ->setTo('noreply@ivcg.ru')
            ->setBody($body, 'text/plain');
        $result = $mailer->send($message);

        return new Response(json_encode($result), 200, ['Content-type' => 'text/plain']);
    }

    /**
     * @Route("/send-consultation-form-roistat", name="send_consultation_form_roistat")
     */
    public function sendConsultationFormRoistatAction(Request $request)
    {
        $cookies = $request->cookies;

        $request->get('event') ? $arEventFields['EVENT'] = $request->get('event') : $arEventFields['event'] = 'unknown';
        $request->get('country') ? $arEventFields['VISA_COUNTRY'] = $request->get('country') : '';
        $request->get('name') ? $arEventFields['NAME'] = $request->get('name') : '';
        $request->get('phone') ? $arEventFields['PHONE'] = $request->get('phone') : '';
        $request->get('commentary') ? $arEventFields['COMMENTARY'] = $request->get('commentary') : '';
        $request->get('host') ? $arEventFields['HOST'] = $request->get('host') : '';
        $quiz = $request->get('quiz', false);

        if(!empty($quiz)) {
            $arEventFields['VISA_COUNTRY'] = $quiz['Страна'];
            $arEventFields['NAME'] = $quiz['Имя'];
            $arEventFields['PHONE'] = $quiz['Телефон'];

            $body = "";
            $body .= "Ответы на вопросы: \r\n";
            $body .= "    Страна: " . $quiz['Страна'] . " \r\n"; unset($quiz['Страна']);
            $body .= "    Цель поездки: " . $quiz['Цель поездки'] . " \r\n"; unset($quiz['Цель поездки']);
            $body .= "    Кто едет: " . implode(', ', $quiz['Кто едет']) . " \r\n"; unset($quiz['Кто едет']);
            $body .= "    Гражданство: " . $quiz['Гражданство'] . " \r\n"; unset($quiz['Гражданство']);
            $body .= "    Трудовой статус: " . $quiz['Трудовой статус'] . " \r\n"; unset($quiz['Трудовой статус']);
            $body .= "    Дата поездки: " . $quiz['Дата поездки'] . " \r\n"; unset($quiz['Дата поездки']);

            foreach($quiz as $key => $remaining) {
                if (is_array($remaining)) {
                    $body .= "    ". $key .": ". implode(', ', $remaining) . " \r\n";
                } else {
                    $body .= "    ". $key .": ". $remaining." \r\n";
                }
            }

            $arEventFields['COMMENTARY'] = $body;
        }

        $roistat_visit_id = 0;

        if ($cookies->has('roistat_visit')) {
            $roistat_visit_id = $cookies->get('roistat_visit');
        }

        //id_source = 1000 for tests, 6 for production.
        $data = ["command" => "save_lead", "id_source" => 6, "id_crm" => 3, "roistat_visit" => $roistat_visit_id, "data" => $arEventFields];

        $result = file_get_contents('http://crm-lead.cmain.ru/api.php', false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded' . PHP_EOL,
                'content' => http_build_query($data)
            ]
        ]));

        return new Response($roistat_visit_id, 200, ['Content-type' => 'text/plain']);
    }

    /**
     * @Route("/send-consultation-form-roistat-email", name="send_consultation_form_roistat_email")
     */
    public function sendConsultationFormRoistatEmailAction(Request $request, \Swift_Mailer $mailer)
    {
        $result = $this->sendConsultationFormRoistatAction($request)
        and $this->sendConsultationFormEmailAction($request, $mailer);

        return new Response(json_encode($result), 200, ['Content-type' => 'text/plain']);
    }

    /**
     * @Route("/robots.txt", name="robots.txt", options={"utf8": true})
     */
    public function robotsTxtAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager();           /** @var $em \Doctrine\ORM\EntityManager */
        $robot = $em->getRepository('App:Robot')->createQueryBuilder('r')
            ->leftJoin('r.geo', 'g')
            ->andWhere('g.host = :host')->setParameter('host', $request->getHost())
            ->getQuery()->getOneOrNullResult()                                      /** @var $robot \App\Entity\Robot */
        ;

        if ($robot) {
            return new Response($robot->getText(), 200, ['Content-type' => 'text/plain']);
        }

        return new Response('', 200, ['Content-type' => 'text/plain']);
    }

    /**
     * @Route("/sitemap.xml", name="sitemap.xml", options={"utf8": true})
     */
    public function sitemapXmlAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager();           /** @var $em \Doctrine\ORM\EntityManager */
        $sitemap = $em->getRepository('App:Sitemap')->createQueryBuilder('s')
            ->leftJoin('s.geo', 'g')
            ->andWhere('g.host = :host')->setParameter('host', $request->getHost())
            ->getQuery()->getOneOrNullResult()                                  /** @var $sitemap \App\Entity\Sitemap */
        ;

        if ($sitemap) {
            return new Response($sitemap->getText(), 200, ['Content-type' => 'text/plain']);
        }

        return new Response('', 200, ['Content-type' => 'text/plain']);
    }


    /**
     * @Route("/contacts", name="contacts")
     */
    public function contactsAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $geo = $this->getGeo($request);

        $team_members = $em->getRepository('App:TeamMember')->findBy([
                'geo' => $geo,
            ], [
                'position' => 'desc',
        ]);

        return $this->render('contacts/default_' . $this->getScreenWidthType($request) . '.html.twig', [
            'regions' => $em->getRepository('App:Region')->createQueryBuilder('r')->leftJoin('r.visas', 'v')->addSelect('v')->getQuery()->getResult(),
            'geos' => $em->getRepository('App:Geo')->findBy(['is_visible' => 'true']),
            'geo' => $geo,
            'team_members' => $team_members,
        ],
            $this->getResponse($request));
    }


    /**
     * @Route("/", name="homepage")
     * @Route("/", name="default")
     */
    public function defaultAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $geo = $this->getGeo($request);
        $facts_photo = $em->getRepository('App:Fact')->createQueryBuilder('f')
            ->andWhere('f.photo_uri IS NOT NULL')
            ->getQuery()->getResult();

        $facts_no_photo = $em->getRepository('App:Fact')->createQueryBuilder('f')
            ->andWhere('f.photo_uri IS NULL')
            ->getQuery()->getResult();

        $fact_count = count($facts_photo) + count($facts_no_photo);
        $facts = [];

        for ($i = 0; $i < $fact_count; $i++) {
            $fact_photo = array_pop($facts_photo);
            $fact_no_photo = array_pop($facts_no_photo);

            if ($fact_photo) {
                $facts[] = $fact_photo;
            }

            if ($fact_no_photo) {
                $facts[] = $fact_no_photo;
            }
        }

        $passport_photos = $em->getRepository('App:PassportPhoto')->createQueryBuilder('pp')
            ->getQuery()->getArrayResult();

            return $this->render('default/default_' . $this->getScreenWidthType($request) . '.html.twig', [
                'regions' => $em->getRepository('App:Region')->createQueryBuilder('r')->leftJoin('r.visas', 'v')->addSelect('v')->getQuery()->getResult(),
                'facts' => $facts,
                'specialists' => $em->getRepository('App:Specialist')->findBy(['geo' => $geo], ['position' => 'DESC', 'id' => 'DESC']),
                'testimonials' => $em->getRepository('App:Testimonial')->findBy([], ['position' => 'DESC', 'id' => 'DESC']),
                'geos' => $em->getRepository('App:Geo')->findBy(['is_visible' => 'true']),
                'maps' => $em->getRepository('App:Map')->findAll(),
                'passport_photos' => $passport_photos,
                'geo' => $geo,
            ],
                $this->getResponse($request));
    }

    /**
     * @Route("/qviza/", name="quiz")
     */
    public function quizAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $geo = $this->getGeo($request);

        return $this->render('quiz/default_' . $this->getScreenWidthType($request) . '.html.twig', [
            'quiz_view' => $em->getRepository('App:Setting')->findOneBy(['title' => 'quiz_view']),
            'regions' => $em->getRepository('App:Region')->createQueryBuilder('r')->leftJoin('r.visas', 'v')->addSelect('v')->getQuery()->getResult(),
            'geos' => $em->getRepository('App:Geo')->findBy(['is_visible' => 'true']),
            'geo' => $geo,
            'answers' => $em->getRepository('App:QuizAnswer')->createQueryBuilder('a')
                ->leftJoin('a.quizQuestion', 'q')->addSelect('q')
                ->leftJoin('q.quizType', 't')->addSelect('t')
                ->addOrderBy('a.position', 'DESC')
                ->getQuery()->getResult(),

            'questions' => $em->getRepository('App:QuizQuestion')->createQueryBuilder('q')
                ->leftJoin('q.quizAnswers', 'a')->addSelect('a')
                ->leftJoin('q.quizType', 't')->addSelect('t')
                ->addOrderBy('q.position', 'DESC')
                ->getQuery()->getResult(),

        ],
            $this->getResponse($request));
    }

    /**
     * @Route("/{var1}/{var2}/{var3}/{var4}/",  defaults={"error_404": "true"}, options={"utf8": true}, requirements={"var1"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}]*", "var2"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}]*", "var3"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}]*", "var4"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}]*"})
     * @Route("/{var1}/{var2}/{var3}/",  defaults={"error_404": "true"}, options={"utf8": true}, requirements={"var1"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}]*", "var2"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}]*", "var3"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}]*"})
     * @Route("/{var1}/{var2}/",  defaults={"error_404": "true"}, options={"utf8": true}, requirements={"var1"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}\']*", "var2"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}]*"})
     * @Route("/{var1}/",  defaults={"error_404": "true"}, options={"utf8": true}, requirements={"var1"="[a-zа-я0-9\~\`\!\@\№\#\$\%\^\&\*\(\)\-\_\+\=\*\/\.\,\<\>\\\;\:\[\]\{\}\']*"})
     */
    public function error404Action(Request $request, $error_404 = false)
    {
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */
        $geo = $this->getGeo($request);
        $response = $this->getResponse($request);

        if ($error_404) {
            $response->setStatusCode(Response::HTTP_NOT_FOUND);
        }

        return $this->render('default/error_404_' . $this->getScreenWidthType($request) . '.html.twig', [
            'regions' => $em->getRepository('App:Region')->createQueryBuilder('r')->leftJoin('r.visas', 'v')->addSelect('v')->getQuery()->getResult(),
            'geos' => $em->getRepository('App:Geo')->findBy(['is_visible' => 'true']),
            'geo' => $geo,
            'error_404' => $error_404,
        ],
            $response);
    }








}
