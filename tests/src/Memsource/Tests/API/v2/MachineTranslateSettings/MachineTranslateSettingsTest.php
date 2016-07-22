<?php

namespace Memsource\Tests;

use Memsource\API\v2\MachineTranslateSettings\MachineTranslateSettings;
use Symfony\Component\HttpFoundation\Response;

class MachineTranslateSettingsTest extends MemsourceTestCase {

  const PROJECT = 1;

  /** @var MachineTranslateSettings */
  private $machineTranslateSettings;

  public function setUp() {
    parent::setUp();
    $this->machineTranslateSettings = new MachineTranslateSettings($this->memsource);
  }

  /**
   * @test
   */
  public function listMachineTranslateSettingsShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->machineTranslateSettings->listMachineTranslateSettings(self::INVALID_TOKEN);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
