<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create("wp_posts", function(Blueprint $table) {
            $table->bigIncrements("ID");
            $table->bigInteger("post_author");
            $table->dateTime("post_date");
            $table->dateTime("post_date_gmt");
            $table->longText("post_content");
            $table->text("post_title");
            $table->text("post_excerpt");
            $table->string("post_status", 20);
            $table->string("comment_status", 20);
            $table->string("ping_status", 20);
            $table->string("post_password", 20);
            $table->string("post_name", 200);
            $table->text("to_ping");
            $table->text("pinged");
            $table->dateTime("post_modified");
            $table->dateTime("post_modified_gmt");
            $table->longText("post_content_filtered");
            $table->bigInteger("post_parent");
            $table->string("guid");
            $table->integer("menu_order");
            $table->string("post_type", 20);
            $table->string("post_mime_type", 100);
            $table->bigInteger("comment_count");
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("wp_posts");
    }
}
