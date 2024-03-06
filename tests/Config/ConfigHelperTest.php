<?php

namespace RectorMoodle\Tests\Config;

use PHPUnit\Framework\Attributes\DependsOnClass;
use RectorMoodle\Config\ConfigHelper;
use PHPUnit\Framework\TestCase;

class ConfigHelperTest extends TestCase
{

    public function testGetPhpStanConfig(): void
    {
        self::expectException(\InvalidArgumentException::class);
        $x = new ConfigHelper();
        $x->getPhpStanConfig('/non/existent/dir');
    }
}
