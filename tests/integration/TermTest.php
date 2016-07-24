<?php

class TermTest extends AbstractIntegrationTest {


    /**
     * @test
     */
    public function it_returns_the_related_taxonomy() {
        $term = factory(\Letscodehu\Larablog\Models\Term::class)->create();
        $taxonomy = new \Letscodehu\Larablog\Models\TermTaxonomy([
            "count" => 666
        ]);
        $term->taxonomy()->associate($taxonomy);
        $term->save();

        $this->assertEquals(666, $term->taxonomy->count);

    }

}
