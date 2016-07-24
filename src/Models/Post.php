<?php

namespace Letscodehu\Larablog\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Post
 *
 *
 *
 * @package Letscodehu\Larablog\Models
 */
class Post extends Model
{
    protected $primaryKey = 'ID';
    const CREATED_AT = 'post_date';
    const UPDATED_AT = 'post_modified';

    const MORE_TAG = "<!--more-->";

    const POST_TAG = "post_tag";
    const CATEGORY = "category";

    /**
     * Gets the posts date
     *
     * @return string
     */
    public function getPostDate()
    {
        return $this->post_date;
    }

    /**
     * Sets the post's date
     *
     * @param string $post_date
     */
    public function setPostDate($post_date)
    {
        $this->post_date = $post_date;
    }

    /**
     * @return mixed
     */
    public function getPostAuthor()
    {
        return $this->post_author;
    }

    /**
     * @param mixed $post_author
     */
    public function setPostAuthor($post_author)
    {
        $this->post_author = $post_author;
    }

    /**
     * @return mixed
     */
    public function getPostContent()
    {
        return $this->post_content;
    }

    /**
     * @param mixed $post_content
     */
    public function setPostContent($post_content)
    {
        $this->post_content = $post_content;
    }

    /**
     * @return mixed
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * @param mixed $post_title
     */
    public function setPostTitle($post_title)
    {
        $this->post_title = $post_title;
    }

    /**
     * @return mixed
     */
    public function getPostName()
    {
        return $this->post_name;
    }

    /**
     * @param mixed $post_name
     */
    public function setPostName($post_name)
    {
        $this->post_name = $post_name;
    }


    protected $table = "posts";

    protected $fillable = [
        "post_author",
        "post_date",
        "post_date_gmt",
        "post_content",
        "post_title",
        "post_excerpt",
        "post_status",
        "comment_status",
        "ping_status",
        "post_password",
        "post_name",
        "to_ping",
        "pinged",
        "post_modified",
        "post_modified_gmt",
        "post_content_filtered",
        "post_parent",
        "guid",
        "menu_order",
        "post_type",
        "post_mime_type",
        "comment_count"
    ];

    public function getUrl() {
        return date("Y/m/d/", strtotime($this->post_date)).$this->post_name;
    }

    public function setLead($lead) {
        $this->post_excerpt = $lead;
    }

    public function getLead() {
        return ($this->post_excerpt == "" || $this->post_excerpt == null) ? $this->getTrimmedContent()  : $this->post_excerpt;
    }

    public function getTrimmedContent() {
        if (!$this->contentHasMoreTag()) {
            return $this->post_content;
        } else
            return substr($this->post_content, 0, strpos($this->post_content, self::MORE_TAG));
    }

    public function contentHasMoreTag() {
        return strpos($this->post_content, self::MORE_TAG) !== false;
    }


    public function getContent() {
        return $this->post_content;
    }

    public function author() {
        return $this->hasOne('\App\Models\WpUser', "ID", "post_author");
    }

    public function hasAttachment() {
        return ($this->attachments->count() > 0);
    }

    public function getFeaturedImage($default) {
        if ($this->hasAttachment()) {
            return $this->attachments[0]->guid;
        } else {
            return $default;
        }
    }

    public function attachments() {
        return $this->hasMany('\Letscodehu\Larablog\Models\Post', "post_parent", "ID")->where("post_type", "attachment");
    }

    public function terms() {
        return $this->belongsToMany('\Letscodehu\Larablog\Models\TermTaxonomy', 'term_relationships', "object_id" , "term_taxonomy_id", "ID" );
    }

    public function tags() {
        return $this->terms()
            ->where("taxonomy", self::POST_TAG)->get();
    }


    public function categories() {
        return $this->terms()
            ->where("taxonomy", self::CATEGORY)->get();
    }

    public function getCreateMonth() {
        return date("M", strtotime($this->post_date));
    }

    public function metas() {
        return $this->hasMany(PostMeta::class);
    }

    public function getMetas() {
        return $this->metas;
    }

    public function getMetaByKey($key) {
        return $this->metas->where("meta_key", $key)->first();
    }

    public function getCreateDay() {
        return date("d", strtotime($this->post_date));
    }



}
