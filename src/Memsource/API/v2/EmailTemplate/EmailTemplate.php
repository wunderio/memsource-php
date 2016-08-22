<?php

namespace Memsource\API\v2\EmailTemplate;

use Memsource\API\BaseApi;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class EmailTemplate extends BaseApi {

  const PATH_BASE = 'v2/emailTemplate/';
  const PATH_GET = self::PATH_BASE . 'get';
  const PATH_LIST = self::PATH_BASE . 'list';

  /**
   * @param int $template
   * @return JsonResponse
   */
  public function getEmailTemplate($template) {
    $parameters = new Parameters();
    $parameters->template = $template;

    return $this->memsource->post(self::PATH_LIST, $parameters);
  }

  /**
   * @param string|null $type See EmailTemplateType.
   * @return JsonResponse
   */
  public function listEmailTemplates($type = NULL) {
    $parameters = new Parameters();
    $parameters->type = $type;

    return $this->memsource->post(self::PATH_LIST);
  }
}
