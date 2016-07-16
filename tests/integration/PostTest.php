<?php
/**
 * Created by PhpStorm.
 * User: tacsiazuma
 * Date: 2016.07.16.
 * Time: 17:21
 */

class PostTest extends Orchestra\Testbench\TestCase {


    public function setUp() {
        parent::setUp();
        // we need to set up database connection first


        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__.'/../../database/migrations'),
        ]);

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
        $p = new \Letscodehu\Larablog\Models\Post();
        $p->save();
    }


}
