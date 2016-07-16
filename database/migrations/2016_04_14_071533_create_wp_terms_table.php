<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("terms", function(Blueprint $table) {
            $table->bigIncrements("term_id");
            $table->string("name", 200);
            $table->string("slug", 200);
            $table->bigInteger("term_group");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("terms");
    }
}
