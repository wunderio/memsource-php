<?php

namespace Memsource\API\v2\Vendor;

use Memsource\API\BaseApi;
use Symfony\Component\HttpFoundation\JsonResponse;

class Vendor extends BaseApi {

  const PATH_BASE = 'v2/vendor/';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @return JsonResponse
   */
  public function listVendors() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
