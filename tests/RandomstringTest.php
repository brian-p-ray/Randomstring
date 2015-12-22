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
		$randomstring = Randomstring::generate(array('hex' => true));
		$this->assertRegExp("/((?:[a-f0-9]{6}))$/i", $randomstring);
	}
	public function test9DigitsUse()
	{
		$randomstring = Randomstring::generate(array('length' => 9));
		$this->assertRegExp("/((?:[a-zA-Z0-9]{9}))$/i", $randomstring);
	}
	public function testUpperUse()
	{
		$randomstring = Randomstring::generate();
		$this->assertRegExp("/((?:[A-Z]{6}))$/i", $randomstring);
	}
	public function testLowerUse()
	{
		$randomstring = Randomstring::generate();
		$this->assertRegExp("/((?:[a-z]{6}))$/i", $randomstring);
	}
	public function testNumberUse()
	{
		$randomstring = Randomstring::generate();
		$this->assertRegExp("/((?:[0-9]{6}))$/i", $randomstring);
	}
	public function testCustomUse()
	{
		$randomstring = Randomstring::generate(array('custom' => '!'));
		$this->assertRegExp("/((?:[a-zA-Z0-9!]{6}))$/i", $randomstring);
	}
	public function testAllUse()
	{
		$randomstring = Randomstring::generate(array('types' => 'all'));
		$this->assertRegExp("/((?:[a-zA-Z0-9!#%&()*+,-./~:;<=>?@\[\]^_`{|}]{6}))$/i", $randomstring);
	}
	public function testWontReturnSameForSubsequentCalls()
    {
        $randomstring1 = Randomstring::generate();
        $randomstring2 = Randomstring::generate();
        $this->assertNotEquals($randomstring1, $randomstring2);
    }
    public function testCanBeUsedAsCallable()
    {
    	Randomstring::$upper = 'A';
        $randomstring = new Randomstring(array('types' => 'upper'));
        $this->assertTrue(is_callable($randomstring));
        $params = [ 'types' => 'upper' ];
        $this->assertSame($randomstring($params), Randomstring::haikunate($params));
    }
}