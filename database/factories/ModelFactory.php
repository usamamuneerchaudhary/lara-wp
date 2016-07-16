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
