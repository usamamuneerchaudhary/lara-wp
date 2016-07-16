<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("wp_users", function(Blueprint $table) {
            $table->bigIncrements("ID");
            $table->string("user_login", 60);
            $table->string("user_pass");
            $table->string("user_nicename", 50);
            $table->string("user_email", 100);
            $table->string("user_url", 100);
            $table->dateTime("user_registered");
            $table->string("user_activation_key");
            $table->integer("user_status");
            $table->string("display_name", 250);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("wp_users");
    }
}
