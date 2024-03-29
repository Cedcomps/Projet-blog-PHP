<?php

namespace projet4\Test;

require_once __DIR__.'/../../vendor/autoload.php';

use Silex\WebTestCase;

class AppTest extends WebTestCase
{
    /** 
     * Basic, application-wide functional test inspired by Symfony best practices.
     * Simply checks that all application URLs load successfully.
     * During test execution, this method is called for each URL returned by the provideUrls method.
     *
     * @dataProvider provideUrls 
     */
    public function testPageIsSuccessful($url)
    {
        $client = $this->createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * {@inheritDoc}
     */
    public function createApplication()
    {
        $app = new \Silex\Application();

        require __DIR__.'/../../app/config/dev.php';
        require __DIR__.'/../../app/app.php';
        require __DIR__.'/../../app/routes.php';
        
        // Generate raw exceptions instead of HTML pages if errors occur
        unset($app['exception_handler']);
        // Simulate sessions for testing
        $app['session.test'] = true;
        // Enable anonymous access to admin zone
        $app['security.access_rules'] = array();

        return $app;
    }

    /**
     * Provides all valid application URLs.
     *
     * @return array The list of all valid application URLs.
     */
    public function provideUrls()
    {
        return array(
            array('/'),
            array('/episode/1'),
            array('/episode/2'),
            array('/episode/3'),
            array('/episode/4'),
            array('/episode/5'),
            array('/login'),
            array('/register'),
            array('/admin'),
            array('/admin/episode/add'),
            array('/admin/episode/1/edit'),
            array('/admin/comment/1/edit'),
            array('/admin/episode/2/edit'),
            array('/admin/comment/2/edit'),
            array('/admin/user/add'),
            array('/admin/user/1/edit'),
            array('/api/episodes'),
            array('/api/episode/1'),
            ); 
    }
}
