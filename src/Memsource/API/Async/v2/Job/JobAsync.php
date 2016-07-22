<?php

namespace Memsource\API\Async\v2\Job;

use GuzzleHttp\Promise\PromiseInterface;
use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;

class JobAsync extends BaseApi {

  const PATH_BASE = 'web/api/async/v2/job/';
  const PATH_CREATE = self::PATH_BASE . 'create';

  /**
   * @param Parameters $parameters
   * @param File $file
   * @return PromiseInterface
   */
  public function create(Parameters $parameters, File $file) {
    return $this->memsource->postAsync(self::PATH_CREATE, $parameters, $file);
  }
}
