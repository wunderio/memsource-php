<?php

namespace Memsource\Tests;

use Memsource\Model\Parameters;
use PHPUnit\Framework\TestCase;

class ParametersTest extends TestCase {

  /** @var Parameters */
  private $parameters;

  public function setUp() {
    $this->parameters = new Parameters();
  }

  /**
   * @test
   */
  public function convertToDateTimeFormatShouldThrowAnExceptionOnInvalidDueDate() {
    $this->expectException(\Exception::class);
    $this->parameters->convertToDateTimeFormat('');

    $this->expectException(\Exception::class);
    $this->parameters->convertToDateTimeFormat(' ');

    $this->expectException(\Exception::class);
    $this->parameters->convertToDateTimeFormat('string');

    $this->expectException(\Exception::class);
    $this->parameters->convertToDateTimeFormat(new \stdClass());

    $this->expectException(\Exception::class);
    $this->parameters->convertToDateTimeFormat(1.1);

    $this->expectException(\Exception::class);
    $this->parameters->convertToDateTimeFormat(TRUE);

    $this->expectException(\Exception::class);
    $this->parameters->convertToDateTimeFormat(FALSE);

    $this->expectException(\Exception::class);
    $this->parameters->convertToDateTimeFormat([]);
  }

  /**
   * @test
   */
  public function convertToDateTimeFormatShouldConvertToCorrectFormat() {
    $now = time();
    $expectedDate = date(Parameters::DATE_TIME_FORMAT, $now);

    $this->assertEquals($expectedDate, $this->parameters->convertToDateTimeFormat($now));
  }
}