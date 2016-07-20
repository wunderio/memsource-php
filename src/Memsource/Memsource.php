<?php

namespace Memsource;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\RequestOptions;
use Memsource\API\v3\Auth\Auth;
use Memsource\API\v3\Project\Project;
use Memsource\API\v7\Job\Job;
use Memsource\Model\File;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\JsonResponse;

class Memsource implements MemsourceInterface {

  const DEFAULT_BASE_URL = 'https://cloud.memsource.com/';

  /** @var Auth */
  private $auth;

  /** @var string */
  private $baseUrl;

  /** @var Client */
  private $client;

  /** @var Job */
  private $job;

  /** @var Project */
  private $project;

  /**
   * @param string $baseUrl
   */
  public function __construct($baseUrl = self::DEFAULT_BASE_URL) {
    $this->auth = $this->getAuth();
    $this->baseUrl = $baseUrl;
    $this->client = $this->getClient();
    $this->job = $this->getJob();
  }

  /**
   * @inheritdoc
   */
  public function createJob(Parameters $parameters, File $file) {
    return $this->job->create($parameters, $file);
  }

  /**
   * @param string $token
   * @param int $project
   * @return JsonResponse
   */
  public function getProject($token, $project) {
    return $this->project->getProject($token, $project);
  }

  /**
   * @inheritdoc
   */
  public function listProjects($token) {
    return $this->project->listProjects($token);
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
   * @param string $path
   * @param Parameters $parameters
   * @param File|NULL $file
   * @return JsonResponse
   */
  public function post($path, Parameters $parameters, File $file = NULL) {
    $options = $this->buildPostOptions($parameters, $file);

    try {
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

  /**
   * @return Job
   */
  protected function getJob() {
    return new Job($this);
  }

  /**
   * @param Parameters $parameters
   * @param File $file
   * @return array
   */
  private function buildPostOptions(Parameters $parameters, File $file = NULL) {
    if ($file) {
      $formParameters = [];

      $formParameters[] = [
        'name' => 'file',
        'contents' => fopen($file->path, 'r'),
        'filename' => basename($file->path),
      ];

      foreach ($parameters as $key => $value) {
        $formParameters[] = ['name' => $key, 'contents' => $value];
      }

      $options = [RequestOptions::MULTIPART => $formParameters];
    } else {
      $options = [RequestOptions::FORM_PARAMS => $parameters];
    }

    return $options;
  }
}
