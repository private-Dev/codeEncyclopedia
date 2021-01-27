<?php
/**
 * Created by PhpStorm.
 * User: root-home
 * Date: 26/01/2021
 * Time: 22:50
 */

use PHPUnit\Framework\TestCase;
include_once '../include/parseClassDown.php';

class parseTest extends TestCase
{

    public function testMultiplication(){

        $this->assertEquals(4, 2*2);
    }

    public function testMarkdownClass(){
        $p = new ParseClassedown();
        $this->assertInstanceOf(ParseClassedown::class, $p );
    }

}