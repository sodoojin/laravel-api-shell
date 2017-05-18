<?php

namespace Visualplus\LaravelApiShell\Tests;

use PHPUnit\Framework\TestCase;
use Visualplus\LaravelApiShell\AnnotationParser;

class AnnotationParserTest extends TestCase
{
    /** @test */
    public function test_parse_action_test()
    {
        $annotationParser = new AnnotationParser();

        $result = $annotationParser->parse('\Visualplus\LaravelApiShell\Tests\Dummy\DummyClass@testFunction');

        $this->assertEquals($result, [
            ['requestParam' => 'param1'],
            ['requestParam' => 'param2']
        ]);

        $result = $annotationParser->parse('\Visualplus\LaravelApiShell\Tests\Dummy\DummyClass@test2Function');

        $this->assertEquals($result, []);
    }
}
