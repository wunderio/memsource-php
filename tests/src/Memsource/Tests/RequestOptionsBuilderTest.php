<?php

namespace Memsource\Tests;

use GuzzleHttp\RequestOptions;
use Memsource\Model\Parameters;
use Memsource\RequestOptionsBuilder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\File;

class RequestOptionsBuilderTest extends TestCase {

  const OUTPUT_PATH = '/output/path';

  /** @var File */
  private $file;

  /** @var Parameters */
  private $parameters;

  /** @var RequestOptionsBuilder */
  private $requestOptionsBuilder;

  public function setUp() {
    $this->file = new File(__DIR__ . '/test-file.txt');
    $this->parameters = new Parameters();
    $this->requestOptionsBuilder = new RequestOptionsBuilder();
  }

  /**
   * @test
   */
  public function buildPostOptionsShouldUseFormParamsOptionWhenFileIsNotGiven() {
    $options = $this->requestOptionsBuilder->buildPostOptions($this->parameters);

    $this->assertArrayHasKey(RequestOptions::FORM_PARAMS, $options);
    $this->assertEquals($this->parameters, $options[RequestOptions::FORM_PARAMS]);
  }

  /**
   * @test
   */
  public function buildPostOptionsShouldUseMultipartOptionWhenFileIsGiven() {
    $options = $this->requestOptionsBuilder->buildPostOptions($this->parameters, $this->file);

    $this->assertArrayHasKey(RequestOptions::MULTIPART, $options);

    $multipartOptions = [];

    foreach ($options[RequestOptions::MULTIPART] as $option) {
      $multipartOptions[$option['name']] = $option['contents'];
    }

    foreach ($this->parameters as $parameter => $value) {
      $this->assertEquals($multipartOptions[$parameter], $value);
    }
  }

  /**
   * @test
   */
  public function buildPostOptionsShouldUseSinkOptionWhenOutputPathIsGiven() {
    $options = $this->requestOptionsBuilder->buildPostOptions($this->parameters, $this->file, self::OUTPUT_PATH);

    $this->assertArrayHasKey(RequestOptions::SINK, $options);
  }
}
