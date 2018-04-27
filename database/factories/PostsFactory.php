<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $title = $faker->sentence();
    $slug = create_slug($title, 'posts');
    return [
        'title' => $title,
        'slug' => $slug,
        'body' => $faker->text,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
