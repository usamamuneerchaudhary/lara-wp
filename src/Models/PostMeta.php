<?php

namespace Letscodehu\Larablog\Models;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    protected $table = "postmeta";

    public $timestamps = false;
    protected $fillable = ["post_id", "meta_key", "meta_value"];

    public function post() {
        return $this->hasOne(Post::class, "ID", "post_id");
    }

}
