<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('filemtime', [$this, 'fileMTimeFilter']),
            new TwigFilter('declension_day', [$this, 'declensionDayFilter']),
            new TwigFilter('geo_prepositon', [$this, 'geoPrepositionFilter'], [
//                'pre_escape' => 'html',
                'is_safe'    => ['html']
            ]),
        ];
    }

    public function declensionDayFilter($count)
    {
        switch ($count % 10) {
            case 0: return 'дней'; break;
            case 1: return 'день';break;
            case 2: return 'дня';break;
            case 3: return 'дня';break;
            case 4: return 'дня';break;
            case 5: return 'дней';break;
            case 6: return 'дней';break;
            case 7: return 'дней';break;
            case 8: return 'дней';break;
            case 9: return 'дней';break;
            default: return 'дней';break;
        }
    }




    public function geoPrepositionFilter($text, $geo_preposition)
    {
        if ($geo_preposition == 'в России' or $geo_preposition == 'В России') {
            return str_replace('{{ geo_preposition_case_with_preposition }}', '', $text);
        }

        return str_replace('{{ geo_preposition_case_with_preposition }}', ' '.$geo_preposition, $text);
    }

    public function fileMTimeFilter($path)
    {
        $path = getcwd().$path;

        if (file_exists($path)) {
            return filemtime($path);
        }

        return '';
    }


}