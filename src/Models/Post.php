<?php

namespace Letscodehu\Larablog\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = 'ID';
    const CREATED_AT = 'post_date';
    const UPDATED_AT = 'post_modified';

    const MORE_TAG = "<!--more-->";
    private $categories = [];

    public $post_author, $post_content, $post_title, $post_name;

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


    protected $table = "wp_posts";

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
        return $this->hasMany('\App\Models\Post', "post_parent", "ID")->where("post_type", "attachment");
    }

    public function terms() {
        return $this->belongsToMany('\App\Models\TermTaxonomy', 'wp_term_relationships', "object_id" , "term_taxonomy_id", "ID" );
    }

    public function tags() {
        return $this->terms()
            ->where("taxonomy", "post_tag")->get();
    }


    public function categories() {
        return $this->terms()
            ->where("taxonomy", "category")->get();
    }

    public function getCreateMonth() {
        return date("M", strtotime($this->post_date));
    }

    public function getCreateDay() {
        return date("d", strtotime($this->post_date));
    }



}
