<?php

namespace App\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Dotenv\Dotenv;
use App\Utils\ElmaExport;
use \Google_Service_Sheets;
use \Google_Client;
use App\Utils\Tool;


class ImportPriceListCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:import-price-list')
            ->setDescription('Import data from the google sheet and export it to the local database')
            ->setHelp('Import data from the google sheet and export it to the local database')
        ;
    }

    public function getClientPrice($client, $spreadsheet_id)
    {
        $service  = new Google_Service_Sheets($client);
        $range = 'Прайс!A12:E';
        $response = $service->spreadsheets_values->get($spreadsheet_id, $range);
        $values   = $response->getValues();

        return $values;
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dotenv = new Dotenv();
        $dotenv->load(getcwd().'/.env');
        $google_api_key = getenv('GOOGLE_API_KEY');

        $client = new Google_Client();
        $client->setApplicationName("Client_Library_Examples");
        $client->setDeveloperKey($google_api_key);

        $spreadsheet_id = getenv('GOOGLE_SPREADSHEET_ID');
        $values         = $this->getClientPrice($client, $spreadsheet_id);
        $visas          = [];

        for ($i = 0; $i < count($values); $i ++) {
            if(!isset($values[$i][3])) {

                if(isset($values[$i+1][4])) {
                    $country = mb_strtolower($values[$i][1]);
                    $country = Tool::mb_ucfirst($country);
                    $price   = $values[$i+1][4];
                    $title   = $values[$i+1][1];
                    $is_visa = mb_strripos($title, 'виза') > -1;

                    if ($is_visa) {
                        $visas[$country] = $price;
                    }
                }
            }
        }


        $this->container = $this->getApplication()->getKernel()->getContainer();
        $em = $this->container->get('doctrine')->getManager(); /** @var $em \Doctrine\ORM\EntityManager */



        $visas_all = $em->getRepository('App:Visa')->findAll();
        foreach($visas_all as $visa) {  /** @var $visa \App\Entity\Visa */
            $visa->setPrice(0);
            $em->persist($visa);
        }

        foreach($visas as $title => $price) {
            $visa = $em->getRepository('App:Visa')->findOneBy([
                'title' => $title,
            ]);

            if ($visa) { /** @var $visa \App\Entity\Visa */
                $visa->setPrice($price);
                $em->persist($visa);
            }

        }

        $em->flush();
    }
}