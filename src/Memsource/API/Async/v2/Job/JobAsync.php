<?php

namespace Memsource\API\Async\v2\Job;

use GuzzleHttp\Promise\PromiseInterface;
use Memsource\Memsource;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;

class JobAsync {

  const PATH_BASE = 'web/api/async/v2/job/';
  const PATH_CREATE = self::PATH_BASE . 'create';

  /** @var Memsource */
  private $memsource;

  /**
   * @param Memsource $memsource
   */
  public function __construct(Memsource $memsource) {
    $this->memsource = $memsource;
  }

  /**
   * @param Parameters $parameters
   * @param File $file
   * @return PromiseInterface
   */
  public function create(Parameters $parameters, File $file) {
    return $this->memsource->postAsync(self::PATH_CREATE, $parameters, $file);
  }
}
