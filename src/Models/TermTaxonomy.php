<?php

namespace Letscodehu\Larablog\Models;

use Illuminate\Database\Eloquent\Model;

class TermTaxonomy extends Model
{
    protected $table = "term_taxonomy";

    protected $primaryKey = "term_taxonomy_id";

    public $timestamps = false;
    protected $fillable = ["term_id", "taxonomy", "parent", "count"];

    public function term() {
        return $this->hasOne('\Letscodehu\Larablog\Models\Term', "term_id");
    }

    public function getName() {
        return $this->term->name;
    }

    public function getSlug() {
        return $this->term->slug;
    }

    public function related() {
        return $this->belongsToMany('\Letscodehu\Larablog\Models\Post', "term_relationships", "term_taxonomy_id", "object_id")
            ->where("post_status", "publish")
            ->where("post_type", "post");
    }

    public function getCount() {
        return $this->count;
    }

}
