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
        \Illuminate\Support\Facades\DB::connection()->enableQueryLog();
        $term = factory(\Letscodehu\Larablog\Models\Term::class)->create([
            "name" => "test"
        ]);
        $termtaxonomy = factory(\Letscodehu\Larablog\Models\TermTaxonomy::class)->create();
        $termtaxonomy->term()->save($term);
        $this->assertEquals("test",$termtaxonomy->getName());
    }

}