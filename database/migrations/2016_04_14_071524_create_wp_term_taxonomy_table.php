<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpTermTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("term_taxonomy", function(Blueprint $table) {
            $table->bigIncrements("term_taxonomy_id");
            $table->bigInteger("term_id");
            $table->string("taxonomy", 32);
            $table->longText("description");
            $table->bigInteger("parent");
            $table->bigInteger("count");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("term_taxonomy");
    }
}
