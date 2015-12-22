<?php
namespace monodesigns\Test;

use monodesigns\Randomstring;

use PHPUnit_Framework_TestCase as TestCase;

class RandomstringTest extends TestCase
{
	public function testDefaultUse()
	{
		$randomstring = Randomstring::generate();
		$this->assertRegExp("/((?:[a-zA-Z0-9]{6}))$/i", $randomstring);
	}
	public function testHexUse()
	{
		$randomstring = Randomstring::generate(['hex' => true]);
		$this->assertRegExp("/((?:[a-f0-9]{6}))$/i", $randomstring);
	}
	public function test9DigitsUse()
	{
		$randomstring = Randomstring::generate(['length' => 9]);
		$this->assertRegExp("/((?:[a-zA-Z0-9]{9}))$/i", $randomstring);
	}
	public function testUpperUse()
	{
		$randomstring = Randomstring::generate(['types' => 'upper']);
		$this->assertRegExp("/((?:[A-Z]{6}))$/i", $randomstring);
	}
	public function testLowerUse()
	{
		$randomstring = Randomstring::generate(['types' => 'lower']);
		$this->assertRegExp("/((?:[a-z]{6}))$/i", $randomstring);
	}
	public function testNumberUse()
	{
		$randomstring = Randomstring::generate(['types' => 'number']);
		$this->assertRegExp("/((?:[0-9]{6}))$/i", $randomstring);
	}
	public function testCustomUse()
	{
		$randomstring = Randomstring::generate(['custom' => '!']);
		$this->assertRegExp("/((?:[a-zA-Z0-9!]{6}))$/i", $randomstring);
	}
	public function testAllUse()
	{
		$randomstring = Randomstring::generate(['types' => 'all']);
		$this->assertRegExp("/((?:[\s\S]{6}))$/i", $randomstring);
	}
	public function testWontReturnSameForSubsequentCalls()
    {
        $randomstring1 = Randomstring::generate();
        $randomstring2 = Randomstring::generate();
        $this->assertNotEquals($randomstring1, $randomstring2);
    }
}