<?php

namespace Memsource\API\v2\TermBase;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class TermBase extends BaseApi {

  const PATH_BASE = 'v2/termBase/';
  const PATH_GET = self::PATH_BASE . 'get';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param int $termBase
   * @return JsonResponse
   */
  public function getTermBase($termBase) {
    $parameters = new Parameters();
    $parameters->termBase = $termBase;

    return $this->memsource->post(self::PATH_GET, $parameters);
  }

  /**
   * @return JsonResponse
   */
  public function listTermBases() {
    return $this->memsource->post(self::PATH_LIST);
  }
}
