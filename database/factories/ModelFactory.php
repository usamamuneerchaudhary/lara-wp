<?php


$factory->define(\Letscodehu\Larablog\Models\User::class, function(\Faker\Generator $faker) {
    return [
        "user_pass" => $faker->sha1,
        "user_nicename" => $faker->name,
        "user_email" => $faker->email,
        "user_url" => "",
        "user_registered" => $faker->dateTime,
        "user_activation_key" => "",
        "user_status" => "",
        "display_name" => $faker->userName
    ];
});

$factory->define(\Letscodehu\Larablog\Models\PostMeta::class, function(\Faker\Generator $faker) {
   return [
        "meta_key" => $faker->text,
       "meta_value" => $faker->text
   ];
});

$factory->define(\Letscodehu\Larablog\Models\TermTaxonomy::class, function(\Faker\Generator $generator) {
    return [
        "description" => $generator->text,
        "parent" => 0,
        "count" => 0,
        "term_id" => 0,
        "taxonomy" => $generator->randomElement([\Letscodehu\Larablog\Models\Post::CATEGORY, \Letscodehu\Larablog\Models\Post::POST_TAG])
    ];
});

$factory->define(\Letscodehu\Larablog\Models\Term::class, function(Faker\Generator $faker ) {
    return  [
        "name" => $faker->name,
        "slug" => $faker->slug,
        "term_group" => $faker->numberBetween(0,100)
    ];
});


$factory->define(\Letscodehu\Larablog\Models\Post::class, function(Faker\Generator $faker) {
    return [
        'post_title' => $faker->title,
        "post_content" => $faker->text,
        "post_content_filtered" => $faker->text,
        "post_name" => $faker->slug,
        "post_author" => $faker->numberBetween(0,100),
        "post_parent" => 0,
        "guid" => $faker->url,
        "menu_order" => 0,
        "comment_count" => 0,
        "post_mime_type" => $faker->text(20),
        "post_type" => "post",
        "post_date" => $faker->dateTime,
        "post_date_gmt" => $faker->dateTime,
        "post_modified_gmt" => $faker->dateTime,
        "post_excerpt" => $faker->text,
        "post_status" => "publish",
        "comment_status" => $faker->text(20),
        "ping_status" =>$faker->text(20),
        "post_password" =>$faker->text(20),
        "to_ping" =>$faker->text(20),
        "pinged" =>$faker->text(20),
    ];
});
