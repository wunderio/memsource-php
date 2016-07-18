<?php

namespace Memsource\API\Async\v2\Job;

use Memsource\Memsource;

class Job {

  const PATH_BASE = 'web/api/async/v2/job/';
  const PATH_CREATE = self::PATH_BASE . 'create';

  /** @var Memsource */
  private $memsource;

  public function __construct(Memsource $memsource) {
    $this->memsource = $memsource;
  }

  public function create(Parameters $parameters) {
    return $this->memsource->post(self::PATH_CREATE, (array) $parameters);
  }
}