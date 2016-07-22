<?php

namespace Memsource;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\PromiseInterface;
use Memsource\API\Async\v2\Job\JobAsync;
use Memsource\API\v2\Analysis\Analysis;
use Memsource\API\v2\BusinessUnit\BusinessUnit;
use Memsource\API\v2\Domain\Domain;
use Memsource\API\v2\Language\Language;
use Memsource\API\v3\Auth\Auth;
use Memsource\API\v3\Project\Project;
use Memsource\API\v4\TranslationMemory\TranslationMemory;
use Memsource\API\v7\Job\Job;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;

class Memsource implements MemsourceInterface {

  const DEFAULT_BASE_URL = 'https://cloud.memsource.com/';

  /** @var Analysis */
  private $analysis;

  /** @var Auth */
  private $auth;

  /** @var string */
  private $baseUrl;

  /** @var BusinessUnit */
  private $businessUnit;

  /** @var Client */
  private $client;

  /** @var Domain */
  private $domain;

  /** @var Job */
  private $job;

  /** @var JobAsync */
  private $jobAsync;

  /** @var Language */
  private $language;

  /** @var Project */
  private $project;

  /** @var RequestOptionsBuilder */
  private $requestOptionsBuilder;

  /** @var TranslationMemory */
  private $translationMemory;

  /**
   * @param string $baseUrl
   * @param Client $client
   */
  public function __construct($baseUrl = self::DEFAULT_BASE_URL, Client $client = NULL) {
    $this->analysis = $this->getAnalysisService();
    $this->auth = $this->getAuthService();
    $this->baseUrl = $baseUrl;
    $this->businessUnit = $this->getBusinessUnitService();
    $this->client = isset($client) ? $client : $this->getHttpClient();
    $this->domain = $this->getDomainService();
    $this->job = $this->getJobService();
    $this->jobAsync = $this->getJobAsyncService();
    $this->language = $this->getLanguageService();
    $this->project = $this->getProjectService();
    $this->requestOptionsBuilder = $this->getRequestOptionsBuilder();
    $this->translationMemory = $this->getTranslationMemoryService();
  }

  /**
   * @inheritdoc
   */
  public function createJob(Parameters $parameters, File $file) {
    return $this->job->create($parameters, $file);
  }

  /**
   * @inheritdoc
   */
  public function createJobAsync(Parameters $parameters, File $file) {
    return $this->jobAsync->create($parameters, $file);
  }

  /**
   * @inheritdoc
   */
  public function getJob($token, $jobPart) {
    return $this->job->getJob($token, $jobPart);
  }

  /**
   * @inheritdoc
   */
  public function getCompletedFile($token, $jobPart) {
    return $this->job->getCompletedFile($token, $jobPart);
  }

  /**
   * @inheritdoc
   */
  public function getProject($token, $project) {
    return $this->project->getProject($token, $project);
  }

  /**
   * @inheritdoc
   */
  public function listAnalysesByProject($token, $project) {
    return $this->analysis->listByProject($token, $project);
  }

  /**
   * @inheritdoc
   */
  public function listBusinessUnits($token) {
    return $this->businessUnit->listBusinessUnits($token);
  }

  /**
   * @inheritdoc
   */
  public function listDomains($token) {
    return $this->domain->listDomains($token);
  }

  /**
   * @inheritdoc
   */
  public function listJobs($token, $jobPart) {
    return $this->job->listJobs($token, $jobPart);
  }

  /**
   * @inheritdoc
   */
  public function listJobsByProject($token, $page = NULL, $project, $workflowLevel = NULL, $assignedTo = NULL, $status = NULL) {
    return $this->job->listByProject($token, $page, $project, $workflowLevel, $assignedTo, $status);
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
  public function listSupportedLanguages($token) {
    return $this->language->listSupportedLanguages($token);
  }

  /**
   * @inheritdoc
   */
  public function listTranslationMemories($token) {
    return $this->translationMemory->listTranslationMemories($token);
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
    return $this->auth->logout($token);
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
    $options = $this->requestOptionsBuilder->buildPostOptions($parameters, $file);

    try {
      $response = $this->client->post($this->baseUrl . $path, $options);
    } catch (ClientException $e) {
      $response = $e->getResponse();
    }

    return new JsonResponse($response->getBody(), $response->getStatusCode(), $response->getHeaders(), TRUE);
  }

  /**
   * @param string $path
   * @param Parameters $parameters
   * @param File|NULL $file
   * @return PromiseInterface
   */
  public function postAsync($path, Parameters $parameters, File $file = NULL) {
    $options = $this->requestOptionsBuilder->buildPostOptions($parameters, $file);

    return $this->client->postAsync($this->baseUrl . $path, $options);
  }

  /**
   * @return Analysis
   */
  protected function getAnalysisService() {
    return new Analysis($this);
  }

  /**
   * @return Auth
   */
  protected function getAuthService() {
    return new Auth($this);
  }

  /**
   * @return BusinessUnit
   */
  protected function getBusinessUnitService() {
    return new BusinessUnit($this);
  }

  /**
   * @return Domain
   */
  protected function getDomainService() {
    return new Domain($this);
  }

  /**
   * @return Client
   */
  protected function getHttpClient() {
    $config = ['base_uri' => $this->baseUrl];

    return new Client($config);
  }

  /**
   * @return Job
   */
  protected function getJobService() {
    return new Job($this);
  }

  /**
   * @return JobAsync
   */
  protected function getJobAsyncService() {
    return new JobAsync($this);
  }

  /**
   * @return Language
   */
  protected function getLanguageService() {
    return new Language($this);
  }

  /**
   * @return Project
   */
  protected function getProjectService() {
    return new Project($this);
  }

  /**
   * @return RequestOptionsBuilder
   */
  protected function getRequestOptionsBuilder() {
    return new RequestOptionsBuilder();
  }

  /**
   * @return TranslationMemory
   */
  protected function getTranslationMemoryService() {
    return new TranslationMemory($this);
  }
}
