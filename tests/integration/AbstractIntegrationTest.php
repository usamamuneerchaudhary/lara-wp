<?php

abstract class AbstractIntegrationTest extends \Orchestra\Testbench\TestCase {
    public function setUp() {
        parent::setUp();
        // we need to set up database connection first


        $this->artisan('migrate', [
            '--database' => 'testbench',
            '--realpath' => realpath(__DIR__.'/../../database/migrations'),
        ]);

        $this->withFactories(__DIR__.'/../../database/factories');

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
            'prefix'   => 'wp_',
        ]);
    }
}
