<?php

namespace Memsource\Tests;

use Memsource\API\v2\MachineTranslateSettings\MachineTranslateSettings;
use Symfony\Component\HttpFoundation\Response;

class MachineTranslateSettingsTest extends MemsourceTestCase {

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
    $response = $this->machineTranslateSettings->listMachineTranslateSettings();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
