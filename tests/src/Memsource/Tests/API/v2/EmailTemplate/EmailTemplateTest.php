<?php

namespace Memsource\Tests;

use Memsource\API\v2\EmailTemplate\EmailTemplate;
use Memsource\Model\EmailTemplateType;
use Symfony\Component\HttpFoundation\Response;

class EmailTemplateTest extends MemsourceTestCase {

  const TEMPLATE = 1;

  /** @var EmailTemplate */
  private $emailTemplate;

  public function setUp() {
    parent::setUp();
    $this->emailTemplate = new EmailTemplate($this->memsource);
  }

  /**
   * @test
   */
  public function getEmailTemplateShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->emailTemplate->getEmailTemplate(self::TEMPLATE);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }

  /**
   * @test
   */
  public function listEmailTemplatesShouldReturn401UnauthorizedResponseOnInvalidToken() {
    $response = $this->emailTemplate->listEmailTemplates(EmailTemplateType::JOB_ASSIGNED);

    $this->assertJsonResponse(Response::HTTP_UNAUTHORIZED, $response);
  }
}
