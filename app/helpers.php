<?php

function create_slug($string, $table, $field = 'slug'){
    $slugify = new \Cocur\Slugify\Slugify();
    $slugify->activateRuleset('swedish');

    $slug = $slugify->slugify($string);
    $slugs = \Illuminate\Support\Facades\DB::table($table)->where([
        [$field, "=", $slug]
    ])->get();
    $i = 1;
    if(count($slugs) > 0) {
        while (count($slugs) > 0) {
            $slug = $slugify->slugify($string."-".$i);
            $slugs = \Illuminate\Support\Facades\DB::table($table)->where([
                [$field, "=", $slug]
            ])->get();
            $i++;
        }
    }
    return $slug;
}