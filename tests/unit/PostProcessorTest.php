<?php
/**
 * Created by PhpStorm.
 * User: tacsiazuma
 * Date: 2016.07.03.
 * Time: 15:32
 */

namespace tests\unit;


use Letscodehu\Larablog\Models\PostProcessor;
use Orchestra\Testbench\TestCase;

class PostProcessorTest extends TestCase {

    private $postProcessor;

    public function setUp() {
        parent::setUp();
        $this->postProcessor = new PostProcessor();
    }


    /**
     * @test
     */
    public function it_turns_newlines_to_br_tag() {
        $this->assertEquals("<br />\n", $this->postProcessor->process("\n"));
    }


    /**
     * @test
     */
    public function it_leaves_newlines_inside_pre_tags() {
        $this->assertEquals("<pre>\n</pre>", $this->postProcessor->process("<pre>\n</pre>"));
    }

    /**
     * @test
     */
    public function it_leaves_newlines_inside_multiple_pre_tags() {
        $this->assertEquals("<pre>\n</pre><br />\n<pre>\n</pre>", $this->postProcessor->process("<pre>\n</pre>\n<pre>\n</pre>"));
    }


    /**
     * @test
     */
    public function it_handles_complex_stuff() {
        $this->assertEquals("lófasz és <br />\n<pre>\n</pre><br />\n<pre>\n</pre> hab<br />\n", $this->postProcessor->process("lófasz és \n<pre>\n</pre>\n<pre>\n</pre> hab\n"));
    }


}
