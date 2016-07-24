<?php
/**
 * Created by PhpStorm.
 * User: tacsiazuma
 * Date: 2016.07.19.
 * Time: 0:42
 */

class TermTaxonomyTest extends AbstractIntegrationTest {

    /**
     * @test
     */
    public function it_returns_term_name() {
        $term = factory(\Letscodehu\Larablog\Models\Term::class)->create([
            "name" => "test"
        ]);
        $termtaxonomy = factory(\Letscodehu\Larablog\Models\TermTaxonomy::class)->create();
        $termtaxonomy->term()->save($term);
        $this->assertEquals("test",$termtaxonomy->getName());
    }

    /**
     * @test
     */
    public function it_returns_term_slug() {
        $term = factory(\Letscodehu\Larablog\Models\Term::class)->create([
            "slug" => "test"
        ]);
        $termtaxonomy = factory(\Letscodehu\Larablog\Models\TermTaxonomy::class)->create();
        $termtaxonomy->term()->save($term);
        $this->assertEquals("test",$termtaxonomy->getSlug());
    }

    /**
     * @test
     */
    public function it_returns_the_related_posts() {
        $post = factory(\Letscodehu\Larablog\Models\Post::class)->create([
            "post_name" => "test"
        ]);
        $taxonomy = factory(\Letscodehu\Larablog\Models\TermTaxonomy::class)->create();
        \Letscodehu\Larablog\Models\TermRelationship::create([
            "term_taxonomy_id" => $taxonomy->term_taxonomy_id,
            "object_id" => $post->ID
        ]);
        $this->assertEquals("test", $taxonomy->related->first()->post_name);

    }

}