<?php

namespace Memsource\Model;

class Parameters {

  const DATE_TIME_FORMAT = 'Y-m-d H:i';

  /** @var int */
  public $assignedTo;

  /** @var $string */
  public $callbackUrl;

  /** @var string */
  public $dateDue;

  /** @var int */
  public $jobPart;

  /** @var string */
  public $name;

  /** @var string */
  public $note;

  /** @var int */
  public $page;

  /** @var string */
  public $password;

  /** @var int */
  public $project;

  /** @var string */
  public $sourceLang;

  /**
   * @var string
   * @see JobFilter
   */
  public $status;

  /** @var string */
  public $targetLang;

  /** @var int */
  public $template;

  /** @var string */
  public $token;

  /** @var string */
  public $type;

  /** @var int */
  public $user;

  /** @var string */
  public $userName;

  /** @var int */
  public $workflowLevel;

  /** @var int */
  public $workflowStep;

  /**
   * @param int|null $dateDue Unix timestamp in UTC time.
   * @return null|string Date time string in yyyy-MM-dd HH:mm format.
   * @throws \Exception If the value is not a valid integer or null.
   */
  public function convertToDateTimeFormat($dateDue) {
    if (isset($dateDue)) {
      if (is_int($dateDue)) {
        $dateDue = date(Parameters::DATE_TIME_FORMAT, $dateDue);
      } else {
        throw new \Exception("Invalid date due value: $dateDue");
      }
    }

    return $dateDue;
  }
}
