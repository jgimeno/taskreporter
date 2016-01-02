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
}
