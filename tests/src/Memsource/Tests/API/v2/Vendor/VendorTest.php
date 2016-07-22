<?php

namespace Memsource\Tests;

use Memsource\API\v2\Vendor\Vendor;
use Symfony\Component\HttpFoundation\Response;

class VendorTest extends MemsourceTestCase {

  const PROJECT = 1;

  /** @var Vendor */
  private $vendor;

  public function setUp() {
    parent::setUp();
    $this->vendor = new Vendor($this->memsource);
  }

  /**
   * @test
   */
  public function listVendorsShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->vendor->listVendors(self::INVALID_TOKEN);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
