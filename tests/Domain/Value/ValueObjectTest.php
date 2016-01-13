<?php

namespace JGimeno\TaskReporter\Tests\Domain\Value;

use JGimeno\TaskReporter\Domain\Value\ValueObject;

class ValueObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider emptyValues
     */
    public function testIsEmptyReturnsTrueWhenItsCreatedWithNoValue($value)
    {
        $value = new ValueObject($value);
        $this->assertTrue($value->isEmpty());
    }

    public function emptyValues()
    {
        $set = [];

        $set['null'] = [
            'value' => null
        ];

        $set['empty String'] = [
            'value' => ''
        ];

        return $set;
    }

    /**
     * @dataProvider someValues
     */
    public function testIsEmptyReturnsFalseWhenSetWithSomeValue($value)
    {
        $value = new ValueObject($value);
        $this->assertFalse($value->isEmpty());
    }

    public function someValues()
    {
        $set = [];

        $set['some text value'] = [
            'value' => 'abc'
        ];

        $set['zero'] = [
            'value' => 0
        ];

        return $set;
    }

    public function testTheValueIsConvertedToStringWhenCasted()
    {
        $value = new ValueObject('hola');
        $this->assertEquals("hola", $value);
    }

    public function testTwoValuesAreEqualWhenValueIsTheSame()
    {
        $value1 = new ValueObject("Hola");
        $value2 = new ValueObject("Hola");
        $valueNotEqual = new ValueObject("Adios");

        $this->assertTrue($value1->equals($value2));
        $this->assertFalse($value1->equals($valueNotEqual));
    }
}
