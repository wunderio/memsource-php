<?php

namespace Memsource;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Memsource\API\Async\v2\Job\Job;
use Memsource\API\Async\v2\Job\Parameters;
use Memsource\API\v3\Auth\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class Memsource implements MemsourceInterface {

  /** @var Auth */
  private $auth;

  /** @var string */
  private $baseUrl;

  /** @var Client */
  private $client;

  /** @var Job */
  private $job;

  public function __construct($baseUrl) {
    $this->auth = $this->getAuth();
    $this->baseUrl = $baseUrl;
    $this->client = $this->getClient();
    $this->job = $this->getJob();
  }

  /**
   * @param $parameters Parameters Job parameters.
   * @return JsonResponse
   */
  public function createJob(Parameters $parameters) {
    $this->job;
  }

  /**
   * @inheritdoc
   */
  public function login($userName, $password) {
    return $this->auth->login($userName, $password);
  }

  /**
   * @inheritdoc
   */
  public function loginOther($token, $userName) {
    return $this->auth->loginOther($token, $userName);
  }

  /**
   * @inheritdoc
   */
  public function logout($token) {
    $this->auth->logout($token);
  }

  /**
   * @inheritdoc
   */
  public function whoAmI($token) {
    return $this->auth->whoAmI($token);
  }

  /**
   * @param $path string Path.
   * @param $formParameters array Form parameters as a key-value array.
   * @return JsonResponse
   */
  public function post($path, $formParameters) {
    try {
      $options = [RequestOptions::FORM_PARAMS => $formParameters];
      $response = $this->client->post($this->baseUrl . $path, $options);
    } catch (ClientException $e) {
      $response = $e->getResponse();
    }

    return new JsonResponse($response->getBody(), $response->getStatusCode(), $response->getHeaders());
  }

  /**
   * @return Auth
   */
  protected function getAuth() {
    return new Auth($this);
  }

  /**
   * @return Client
   */
  protected function getClient() {
    $config = ['base_uri' => $this->baseUrl];

    return new Client($config);
  }

  protected function getJob() {
    return new Job($this);
  }
}
