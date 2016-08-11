<?php

namespace Memsource\Tests;

use Memsource\API\v2\Vendor\Vendor;
use Symfony\Component\HttpFoundation\Response;

class VendorTest extends MemsourceTestCase {

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
    $response = $this->vendor->listVendors();

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
