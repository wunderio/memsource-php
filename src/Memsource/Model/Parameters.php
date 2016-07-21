<?php

namespace Memsource\Model;

class Parameters {

  /** @var int */
  public $assignedTo;

  /** @var $string */
  public $callbackUrl;

  /** @var int */
  public $jobPart;

  /** @var int */
  public $page;

  /** @var string */
  public $password;

  /** @var int */
  public $project;

  /**
   * @var string
   * @see JobFilter
   */
  public $status;

  /** @var string */
  public $targetLang;

  /** @var string */
  public $token;

  /** @var string */
  public $userName;

  /** @var int */
  public $workflowLevel;
}
