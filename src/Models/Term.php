<?php

namespace Letscodehu\Larablog\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $table = "terms";
    public $timestamps = false;
    protected $fillable = ["name", "slug"];

    public function taxonomies() {
        return $this->hasOne('\App\Models\TermTaxonomy', "term_id", "term_id");
    }

    public function category() {
        return $this->taxonomies()->where("taxonomy", "category")->first();
    }

    public function tag() {
        return $this->taxonomies()->where("taxonomy", "post_tag")->first();
    }

}
