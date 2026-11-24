<?php

namespace App\Tests\Entity;

use App\Entity\Measurement;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MeasurementTest extends TestCase
{
    public static function dataGetFahrenheit(): array
    {
        return [
            ['0', '32'],
            ['-100', '-148'],
            ['100', '212'],
            ['0.5', '32.9'],
            ['-40', '-40'],
            ['20', '68'],
            ['37', '98.6'],
            ['-20', '-4'],
            ['15.5', '59.9'],
            ['25', '77'],
        ];
    }

    #[DataProvider('dataGetFahrenheit')]
    public function testGetFahrenheit(string $celsius, string $expectedFahrenheit): void
    {
        $measurement = new Measurement();
        $measurement->setCelsius((float) $celsius);
        $this->assertEquals($expectedFahrenheit, $measurement->getFahrenheit());
    }
}
