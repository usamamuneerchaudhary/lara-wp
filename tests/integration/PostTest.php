<?php
/**
 * Created by PhpStorm.
 * User: tacsiazuma
 * Date: 2016.07.16.
 * Time: 17:21
 */

class PostTest extends Orchestra\Testbench\TestCase {

    /** @var  \Letscodehu\Larablog\Models\Post */
    private $p;

    public function setUp() {
        parent::setUp();
        // we need to set up database connection first


        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__.'/../../database/migrations'),
        ]);

        $this->withFactories(__DIR__.'/../../database/factories');

        $this->p = new \Letscodehu\Larablog\Models\Post();
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
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

}
