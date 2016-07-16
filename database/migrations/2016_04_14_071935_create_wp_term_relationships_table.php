<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWpTermRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("term_relationships", function(Blueprint $table) {
            $table->bigInteger("object_id");
            $table->bigInteger("term_taxonomy_id");
            $table->integer("term_order")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("term_relationships");
    }
}
