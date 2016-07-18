<?php

namespace Memsource\API\Async\v2\Job;

class Parameters {

  /** @var string */
  public $token;

  /** @var Project */
  public $project;

  /** @var object */
  public $file;

  /** @var string[] */
  public $targetLang = [];
}
