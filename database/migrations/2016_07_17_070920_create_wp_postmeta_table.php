<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpPostMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("postmeta", function(Blueprint $table) {
            $table->bigIncrements("meta_id");
            $table->bigInteger("post_id");
            $table->string("meta_key");
            $table->longText("meta_value");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("postmeta");
    }
}
