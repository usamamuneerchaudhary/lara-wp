<?php

class TermRelationshipTest extends AbstractIntegrationTest {


    /**
     * @test
     */
    public function it_returns_the_taxonomy_related() {
        $taxonomy = factory(\Letscodehu\Larablog\Models\TermTaxonomy::class)->create([
            "term_id" => 666
        ]);
        $termRelationShip = new \Letscodehu\Larablog\Models\TermRelationship([
            "object_id" => 1
        ]);

        $termRelationShip->taxonomy()->associate($taxonomy);

        $termRelationShip->save();

        $this->assertEquals(666, $termRelationShip->taxonomy->term_id);

    }

}
