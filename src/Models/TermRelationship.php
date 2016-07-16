<?php

namespace Letscodehu\Larablog\Models;

use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{
    protected $table = "term_relationships";

    public function taxonomies() {
        return $this->hasMany('\App\Models\TermTaxonomy', "term_taxonomy_id", "term_taxonomy_id");
    }

    public function term() {

    }


    public $timestamps = false;
    protected $fillable = [
        "object_id",
        "term_taxonomy_id",
        "term_order"
    ];
}
