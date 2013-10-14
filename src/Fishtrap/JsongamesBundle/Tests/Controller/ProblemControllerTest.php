<?php

namespace Fishtrap\JsongamesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProblemControllerTest extends WebTestCase
{
    public function testFinshGetNotSupported()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/problem/two/hash/731e020e361398cb0dc4863880e08f82/answer');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("POST method only supported")')->count()
        );
        $this->assertEquals(
            405,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testFinshWrongAnswer()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/problem/two/hash/731e020e361398cb0dc4863880e08f82/answer');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Sorry wrong answer")')->count()
        );
      
        $this->assertEquals(
            400,
            $client->getResponse()->getStatusCode()
        );
    }

    public function testFinshCorrectAnswer()
    {
        $client = static::createClient();

        $crawler = $client->request(
            'POST',
            '/problem/two/hash/731e020e361398cb0dc4863880e08f82/answer',
            array('answer' => '48591'),
            array(),
            array('CONTENT_TYPE' => 'application/x-www-form-urlencoded')
        );

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("** Congratulations you have completed the event **")')->count()
        );
      
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode()
        );
    }
}