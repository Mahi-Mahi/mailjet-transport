<?php

namespace MahiMahi\MailjetTransport\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Illuminate\Support\Facades\Mail;

use MahiMahi\MailjetTransport\MailjetTransportServiceProvider;
use MahiMahi\MailjetTransport\Tests\Mail\TestMail;

class BasicTest extends OrchestraTestCase {

    public function setUp()
    {
        parent::setUp();
    }
    protected function getPackageProviders($app)
    {
        return [MailjetTransportServiceProvider::class];
    }
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('view.paths', [__DIR__.'/Support/resources/views']);
        
    }
            
    /** @test */
    public function sendTestEmail() {

    	
	    Mail::to('john.doe@mail.com')->send(new TestMail());

		$this->assertTrue(true);
    }

}