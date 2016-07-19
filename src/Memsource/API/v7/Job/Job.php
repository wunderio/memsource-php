<?php

namespace Memsource\API\v7\Job;

use Memsource\Memsource;
use Memsource\Model\File;
use Memsource\Model\Parameters;

class Job {

  const PATH_BASE = 'web/api/v7/job/';
  const PATH_CREATE = self::PATH_BASE . 'create';

  /** @var Memsource */
  private $memsource;

  public function __construct(Memsource $memsource) {
    $this->memsource = $memsource;
  }

  public function create(Parameters $parameters, File $file) {
    return $this->memsource->post(self::PATH_CREATE, (array) $parameters, $file);
  }
}
