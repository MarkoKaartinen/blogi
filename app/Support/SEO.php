<?php

namespace App\Support;

class SEO
{
    public static function set($title = '', $description = '', $image = '', $url = '', $type = 'article', $titleSuffix = false)
    {
        if($title == ''){
            $title = 'Marko Kaartinen - Nörtti, koodari, yrittäjä';
        }
        if($description == ''){
            $description = 'MarkoKaartinen.net on yhden nörtin projekti ja sisältää sekalaista settiä niin tekniikasta kuin muusta nörtteilystä.';
        }
        if($image == ''){
            $image = route('page.og', ['home']);
        }
        if($url == ''){
            $url = route('home');
        }

        if($titleSuffix){
            $title .= ' - MarkoKaartinen.net';
        }

        seo()
            ->title($title)
            ->description($description)
            ->image($image)
            ->url($url)
            ->type($type)
            ->twitter()
            ->locale('fi_FI');
    }
}
