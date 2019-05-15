<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="geo")
 * @ORM\Entity(repositoryClass="App\Repository\GeoRepository")
 */
class Geo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $region;
    }

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $region;

    /**
     * @ORM\Column(type="string")
     */
    private $host;

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host): void
    {
        $this->host = $host;
    }


    public function getSchemeAndHttpHost()
    {
        return 'http://'.$this->host;
    }

    public function __toString()
    {
        return $this->city;
    }

    private $articles;

    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $video_uri;

    /**
     * @return mixed
     */
    public function getVideoUri()
    {
        return $this->video_uri;
    }

    /**
     * @param mixed $video_uri
     */
    public function setVideoUri($video_uri): void
    {
        $this->video_uri = $video_uri;
    }

    public function getEmbedVideo($width = 420, $height = 315)
    {
        return preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"".$width."\" height=\"".$height."\" src=\"//www.youtube.com/embed/$1\"  allowfullscreen></iframe>",$this->getVideoUri());
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $genitive_case;

    /**
     * @return mixed
     */
    public function getGenitiveCase()
    {
        return $this->genitive_case;
    }

    /**
     * @param mixed $genitive_case
     */
    public function setGenitiveCase($genitive_case): void
    {
        $this->genitive_case = $genitive_case;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $phone;

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles): void
    {
        $this->articles = $articles;
    }

    /**
     * @return mixed
     */
    public function getSpecialists()
    {
        return $this->specialists;
    }

    /**
     * @param mixed $specialists
     */
    public function setSpecialists($specialists): void
    {
        $this->specialists = $specialists;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

	/**
     * @ORM\Column(type="text", nullable=true)
     */
	private $email;
	
    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

	
    /**
     * @ORM\OneToMany(targetEntity="Geo", mappedBy="geo")
     */
    private $geos;

    /**
     * @ORM\OneToMany(targetEntity="Robot", mappedBy="geo")
     */
    private $robots;

    /**
     * @return mixed
     */
    public function getSitemaps()
    {
        return $this->sitemaps;
    }

    /**
     * @param mixed $sitemaps
     */
    public function setSitemaps($sitemaps): void
    {
        $this->sitemaps = $sitemaps;
    }

    /**
     * @ORM\OneToMany(targetEntity="TeamMember", mappedBy="geo")
     */
    private $team_members;

    /**
     * @ORM\OneToMany(targetEntity="Sitemap", mappedBy="geo")
     */
    private $sitemaps;

    /**
     * @ORM\OneToMany(targetEntity="Specialist", mappedBy="geo")
     */
    private $specialists;

    /**
     * @return mixed
     */
    public function getRobots()
    {
        return $this->robots;
    }

    /**
     * @param mixed $robots
     */
    public function setRobots($robots): void
    {
        $this->robots = $robots;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Geo", inversedBy="geos")
     * @ORM\JoinColumn(name="geo_id", referencedColumnName="id", onDelete="set null")
     */
    private $geo;

    /**
     * @return mixed
     */
    public function getGeos()
    {
        return $this->geos;
    }

    /**
     * @param mixed $geos
     */
    public function setGeos($geos): void
    {
        $this->geos = $geos;
    }

    /**
     * @return mixed
     */
    public function getGeo()
    {
        return $this->geo;
    }

    /**
     * @param mixed $geo
     */
    public function setGeo($geo): void
    {
        $this->geo = $geo;
    }

    /**
     * @return mixed
     */
    public function getIsVisible()
    {
        return $this->is_visible;
    }

    /**
     * @param mixed $is_visible
     */
    public function setIsVisible($is_visible): void
    {
        $this->is_visible = $is_visible;
    }

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_visible;


    public function __construct()
    {
        $this->specialists = new ArrayCollection();
        $this->geos = new ArrayCollection();
        $this->robots = new ArrayCollection();
        $this->sitemaps = new ArrayCollection();
        $this->team_members = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $prepositional_case;

    /**
     * @return mixed
     */
    public function getPrepositionalCase()
    {
        return $this->prepositional_case;
    }

    /**
     * @param mixed $prepositional_case
     */
    public function setPrepositionalCase($prepositional_case): void
    {
        $this->prepositional_case = $prepositional_case;
    }

    /**
     * @return mixed
     */
    public function getPrepositionalCaseWithPrepositionLow($preposition = 'в')
    {
        if ($this->getPrepositionalCase()) {
            return $preposition.' '.$this->prepositional_case;
        }

        return '';
    }

    /**
     * @return mixed
     */
    public function getPrepositionalCaseWithPrepositionHigh($preposition = 'В')
    {
        if ($this->getPrepositionalCase()) {
            return $preposition.' '.$this->prepositional_case;
        }

        return '';
    }

    /**
     * @return mixed
     */
    public function getJivositeCode()
    {
        return $this->jivosite_code;
    }

    /**
     * @param mixed $jivosite_code
     */
    public function setJivositeCode($jivosite_code): void
    {
        $this->jivosite_code = $jivosite_code;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $jivosite_code;

     /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $vk_link;

    /**
     * @return mixed
     */
    public function getVkLink()
    {
        return $this->vk_link;
    }

    /**
     * @param mixed $vk_link
     */
    public function setVkLink($vk_link): void
    {
        $this->vk_link = $vk_link;
    }

     /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $fb_link;

    /**
     * @return mixed
     */
    public function getFbLink()
    {
        return $this->fb_link;
    }

    /**
     * @param mixed $fb_link
     */
    public function setFbLink($fb_link): void
    {
        $this->fb_link = $fb_link;
    }
	
	     /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $inst_link;

    /**
     * @return mixed
     */
    public function getInstLink()
    {
        return $this->inst_link;
    }

    /**
     * @param mixed $inst_link
     */
    public function setInstLink($inst_link): void
    {
        $this->inst_link = $inst_link;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title;

    /**
     * @return mixed
     */
    public function getHeadTitle()
    {
        return $this->head_title;
    }

    /**
     * @param mixed $head_title
     */
    public function setHeadTitle($head_title): void
    {
        $this->head_title = $head_title;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->meta_description;
    }

    /**
     * @param mixed $meta_description
     */
    public function setMetaDescription($meta_description): void
    {
        $this->meta_description = $meta_description;
    }

    /**
     * @return mixed
     */
    public function getMetaDescriptionSubdomain()
    {
        return $this->meta_description_subdomain;
    }

    /**
     * @param mixed $meta_description_subdomain
     */
    public function setMetaDescriptionSubdomain($meta_description_subdomain): void
    {
        $this->meta_description_subdomain = $meta_description_subdomain;
    }

    /**
     * @return mixed
     */
    public function getHeadTitleSubdomain()
    {
        return $this->head_title_subdomain;
    }

    /**
     * @param mixed $head_title_subdomain
     */
    public function setHeadTitleSubdomain($head_title_subdomain): void
    {
        $this->head_title_subdomain = $head_title_subdomain;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description_subdomain;

    /**
     * @return mixed
     */
    public function getVkMessage()
    {
        return $this->vk_message;
    }

    /**
     * @param mixed $vk_message
     */
    public function setVkMessage($vk_message): void
    {
        $this->vk_message = $vk_message;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title_subdomain;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $vk_message;



    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description_organization;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description_subdomain_organization;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title_subdomain_organization;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title_organization;






    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description_agency;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description_subdomain_agency;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title_subdomain_agency;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title_agency;

    /**
     * @return mixed
     */
    public function getMetaDescriptionOrganization()
    {
        return $this->meta_description_organization;
    }

    /**
     * @param mixed $meta_description_organization
     */
    public function setMetaDescriptionOrganization($meta_description_organization): void
    {
        $this->meta_description_organization = $meta_description_organization;
    }

    /**
     * @return mixed
     */
    public function getMetaDescriptionSubdomainOrganization()
    {
        return $this->meta_description_subdomain_organization;
    }

    /**
     * @param mixed $meta_description_subdomain_organization
     */
    public function setMetaDescriptionSubdomainOrganization($meta_description_subdomain_organization): void
    {
        $this->meta_description_subdomain_organization = $meta_description_subdomain_organization;
    }

    /**
     * @return mixed
     */
    public function getHeadTitleSubdomainOrganization()
    {
        return $this->head_title_subdomain_organization;
    }

    /**
     * @param mixed $head_title_subdomain_organization
     */
    public function setHeadTitleSubdomainOrganization($head_title_subdomain_organization): void
    {
        $this->head_title_subdomain_organization = $head_title_subdomain_organization;
    }

    /**
     * @return mixed
     */
    public function getHeadTitleOrganization()
    {
        return $this->head_title_organization;
    }

    /**
     * @param mixed $head_title_organization
     */
    public function setHeadTitleOrganization($head_title_organization): void
    {
        $this->head_title_organization = $head_title_organization;
    }

    /**
     * @return mixed
     */
    public function getMetaDescriptionAgency()
    {
        return $this->meta_description_agency;
    }

    /**
     * @param mixed $meta_description_agency
     */
    public function setMetaDescriptionAgency($meta_description_agency): void
    {
        $this->meta_description_agency = $meta_description_agency;
    }

    /**
     * @return mixed
     */
    public function getMetaDescriptionSubdomainAgency()
    {
        return $this->meta_description_subdomain_agency;
    }

    /**
     * @param mixed $meta_description_subdomain_agency
     */
    public function setMetaDescriptionSubdomainAgency($meta_description_subdomain_agency): void
    {
        $this->meta_description_subdomain_agency = $meta_description_subdomain_agency;
    }

    /**
     * @return mixed
     */
    public function getHeadTitleSubdomainAgency()
    {
        return $this->head_title_subdomain_agency;
    }

    /**
     * @param mixed $head_title_subdomain_agency
     */
    public function setHeadTitleSubdomainAgency($head_title_subdomain_agency): void
    {
        $this->head_title_subdomain_agency = $head_title_subdomain_agency;
    }

    /**
     * @return mixed
     */
    public function getHeadTitleAgency()
    {
        return $this->head_title_agency;
    }

    /**
     * @param mixed $head_title_agency
     */
    public function setHeadTitleAgency($head_title_agency): void
    {
        $this->head_title_agency = $head_title_agency;
    }



    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact_map_uri;

    /**
     * @return mixed
     */
    public function getTeamMembers()
    {
        return $this->team_members;
    }

    /**
     * @param mixed $team_members
     */
    public function setTeamMembers($team_members): void
    {
        $this->team_members = $team_members;
    }

    /**
     * @return mixed
     */
    public function getContactMapUri()
    {
        return $this->contact_map_uri;
    }

    /**
     * @param mixed $contact_map_uri
     */
    public function setContactMapUri($contact_map_uri): void
    {
        $this->contact_map_uri = $contact_map_uri;
    }

    /**
     * @return mixed
     */
    public function getContactAddress()
    {
        return $this->contact_address;
    }

    /**
     * @param mixed $contact_address
     */
    public function setContactAddress($contact_address): void
    {
        $this->contact_address = $contact_address;
    }

    /**
     * @return mixed
     */
    public function getContact2gisUri()
    {
        return $this->contact_2gis_uri;
    }

    /**
     * @param mixed $contact_2gis_uri
     */
    public function setContact2gisUri($contact_2gis_uri): void
    {
        $this->contact_2gis_uri = $contact_2gis_uri;
    }

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact_address;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contact_2gis_uri;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $meta_description_contacts;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $head_title_contacts;

    /**
     * @return mixed
     */
    public function getMetaDescriptionContacts()
    {
        return $this->meta_description_contacts;
    }

    /**
     * @param mixed $meta_description_contacts
     */
    public function setMetaDescriptionContacts($meta_description_contacts): void
    {
        $this->meta_description_contacts = $meta_description_contacts;
    }

    /**
     * @return mixed
     */
    public function getHeadTitleContacts()
    {
        return $this->head_title_contacts;
    }

    /**
     * @param mixed $head_title_contacts
     */
    public function setHeadTitleContacts($head_title_contacts): void
    {
        $this->head_title_contacts = $head_title_contacts;
    }



}