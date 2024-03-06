<?php

namespace RectorMoodle\Tests\Config;

use RectorMoodle\Config\ConfigHelper;
use PHPUnit\Framework\TestCase;

class ConfigHelperTest extends TestCase
{

    /**
     * @covers \RectorMoodle\Config\ConfigHelper::getPhpStanConfig
     */
    public function testGetPhpStanConfig(): void
    {
        self::expectException(\InvalidArgumentException::class);
        $x = new ConfigHelper();
        $x->getPhpStanConfig('/non/existent/dir');
    }
}
