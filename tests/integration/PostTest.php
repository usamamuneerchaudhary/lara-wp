<?php

class PostTest extends AbstractIntegrationTest {

    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    /** @var  \Letscodehu\Larablog\Models\Post */
    private $p;

    public function setUp() {
        parent::setUp();
        $this->p = new \Letscodehu\Larablog\Models\Post();
    }



    /**
     * @test
     * @expectedException \Illuminate\Database\QueryException
     */
    public function posts_cannot_be_saved_without_author() {
        $this->p->save();
    }

    /**
     * @test
     */
    public function it_generates_the_url() {
        $this->p->post_name = "teszt";
        $this->p->post_date = "2016-05-17 10:11:11";
        $this->assertEquals("2016/05/17/teszt", $this->p->getUrl());
    }

    /**
     * @test
     */
    public function getlead_returns_the_trimmed_content_if_null_or_empty() {
        $this->p->setPostContent("trolo");
        $this->assertEquals("trolo", $this->p->getLead());
        $this->p->setLead("");
        $this->assertEquals("trolo", $this->p->getLead());
    }

    /**
     * @test
     */
    public function trimmedcontent_trims_at_the_more_tag() {
        $this->p->setPostContent("content" . \Letscodehu\Larablog\Models\Post::MORE_TAG."aftermore_tag");
        $this->assertEquals("content",$this->p->getTrimmedContent());
    }

    /**
     * @test
     */
    public function it_returns_false_if_no_more_tag_presents() {
        $this->p->setPostContent("status");
        $this->assertFalse($this->p->contentHasMoreTag());
    }

    /**
     * @test
     */
    public function it_returns_true_if_more_tag_presents() {
        $this->p->setPostContent("status".\Letscodehu\Larablog\Models\Post::MORE_TAG);
        $this->assertTrue($this->p->contentHasMoreTag());
    }

    /**
     * @test
     */
    public function it_returns_the_day_from_post_date() {
        $this->p->setPostDate("2015-10-23");
        $this->assertEquals("23",$this->p->getCreateDay());
    }

    /**
     * @test
     */
    public function it_returns_the_month_from_post_date() {
        $this->p->setPostDate("2015-10-23");
        $this->assertEquals("Oct",$this->p->getCreateMonth());
    }

    /**
     * @test
     */
    public function it_returns_false_when_no_attachment_presents() {
        $this->assertFalse($this->p->hasAttachment());
    }

    /**
     * @test
     */
    public function it_returns_tags_related_to_post() {
        $tag = factory(Letscodehu\Larablog\Models\TermTaxonomy::class)->create([
            "taxonomy" => \Letscodehu\Larablog\Models\Post::POST_TAG,
        ]);
        $category = factory(Letscodehu\Larablog\Models\TermTaxonomy::class)->create([
            "taxonomy" => \Letscodehu\Larablog\Models\Post::CATEGORY,
        ]);
        $this->p = factory(\Letscodehu\Larablog\Models\Post::class)->create();
        $this->p->terms()->saveMany([$tag, $category]);
        $this->assertCount(1,$this->p->tags());
    }

    /**
     * @test
     */
    public function it_returns_categories_related_to_post() {
        $tag = factory(Letscodehu\Larablog\Models\TermTaxonomy::class)->create([
            "taxonomy" => \Letscodehu\Larablog\Models\Post::POST_TAG,
        ]);
        $category = factory(Letscodehu\Larablog\Models\TermTaxonomy::class)->create([
            "taxonomy" => \Letscodehu\Larablog\Models\Post::CATEGORY,
        ]);
        $this->p = factory(\Letscodehu\Larablog\Models\Post::class)->create();
        $this->p->terms()->saveMany([$tag, $category]);
        $this->assertCount(1,$this->p->categories());

    }

    /**
     * @test
     */
    public function it_returns_the_metadata_as_collection() {
        $this->assertTrue($this->p->getMetas() instanceof \Illuminate\Database\Eloquent\Collection);
    }

    /**
     * @test
     */
    public function it_returns_the_metadatas() {
        $this->p = factory(\Letscodehu\Larablog\Models\Post::class)->create();
        $meta = new \Letscodehu\Larablog\Models\PostMeta();
        $meta->meta_key = "test";
        $meta->meta_value = "test_value";
        $this->p->metas()->save($meta);
        $this->assertTrue($this->p->getMetas() instanceof \Illuminate\Database\Eloquent\Collection);
        $this->assertEquals("test", $this->p->getMetas()->first()->meta_key);
    }

    /**
     * @test
     */
    public function it_returns_the_metadata_with_key() {
        $this->p = factory(\Letscodehu\Larablog\Models\Post::class)->create();
        $meta = new \Letscodehu\Larablog\Models\PostMeta();
        $meta->meta_key = "test";
        $meta->meta_value = "test_value";
        $meta2 = new \Letscodehu\Larablog\Models\PostMeta();
        $meta2->meta_key = "test2";
        $meta2->meta_value = "test_value";
        $this->p->metas()->saveMany([$meta, $meta2]);
        $metaQueried = $this->p->getMetaByKey("test");
        $this->assertTrue( $metaQueried instanceof \Letscodehu\Larablog\Models\PostMeta);
        $this->assertEquals("test", $metaQueried->meta_key);
    }

}
