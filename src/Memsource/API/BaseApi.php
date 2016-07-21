<?php

namespace Memsource\API;

use Memsource\Memsource;

abstract class BaseApi {

  /** @var Memsource */
  protected $memsource;

  /**
   * @param Memsource $memsource
   */
  public function __construct(Memsource $memsource) {
    $this->memsource = $memsource;
  }
}