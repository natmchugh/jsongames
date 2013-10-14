<?php

namespace Fishtrap\JsongamesBundle\Tests\Entity;

use Fishtrap\JsongamesBundle\Entity\Problem;

class ProblemTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $problem = new Problem();
        $this->assertInstanceOf('Fishtrap\JsongamesBundle\Entity\Problem', $problem);
    }
}