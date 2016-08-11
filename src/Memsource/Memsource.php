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
use Memsource\API\v2\MachineTranslateSettings\MachineTranslateSettings;
use Memsource\API\v2\ProjectTemplate\ProjectTemplate;
use Memsource\API\v2\User\User;
use Memsource\API\v2\Vendor\Vendor;
use Memsource\API\v2\WorkflowStep\WorkflowStep;
use Memsource\API\v3\Auth\Auth;
use Memsource\API\v3\Project\Project;
use Memsource\API\v4\TranslationMemory\TranslationMemory;
use Memsource\API\v7\Job\Job;
use Memsource\Model\Parameters;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;

class Memsource implements MemsourceInterface {

  const DEFAULT_BASE_URL = 'https://cloud.memsource.com/web/api/';

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

  /** @var MachineTranslateSettings */
  private $machineTranslateSettings;

  /** @var Project */
  private $project;

  /** @var ProjectTemplate */
  private $projectTemplate;

  /** @var RequestOptionsBuilder */
  private $requestOptionsBuilder;

  /** @var string */
  private $token;

  /** @var TranslationMemory */
  private $translationMemory;

  /** @var User */
  private $user;

  /** @var Vendor */
  private $vendor;

  /** @var WorkflowStep */
  private $workflowStep;

  /**
   * Automatically tries to authenticate with the given user name and password
   * if token is empty. Skips authentication if the token is not empty.
   *
   * @param string|null $userName Required if token is empty.
   * @param string|null $password Required if token is empty.
   * @param string|null $token Required if both user name and password are empty.
   * @param string|null $baseUrl
   * @param Client $client
   * @throws \Exception if user name, password and token are all empty.
   */
  public function __construct($userName = NULL, $password = NULL, $token = NULL, $baseUrl = self::DEFAULT_BASE_URL, Client $client = NULL) {
    if (empty($userName) && empty($password) && empty($token)) {
      throw new \Exception('User name and password are required when token is empty.');
    }

    $this->analysis = $this->getAnalysisService();
    $this->auth = $this->getAuthService();
    $this->baseUrl = $baseUrl;
    $this->businessUnit = $this->getBusinessUnitService();
    $this->client = isset($client) ? $client : $this->getHttpClient();
    $this->domain = $this->getDomainService();
    $this->job = $this->getJobService();
    $this->jobAsync = $this->getJobAsyncService();
    $this->language = $this->getLanguageService();
    $this->machineTranslateSettings = $this->getMachineTranslateSettingsService();
    $this->project = $this->getProjectService();
    $this->projectTemplate = $this->getProjectTemplateService();
    $this->requestOptionsBuilder = $this->getRequestOptionsBuilder();
    $this->token = empty($token) ? $this->loginAndGetToken($userName, $password) : $token;
    $this->translationMemory = $this->getTranslationMemoryService();
    $this->user = $this->getUserService();
    $this->vendor = $this->getVendorService();
    $this->workflowStep = $this->getWorkflowStepService();
  }

  /**
   * @return null|string
   */
  public function getToken() {
    return $this->token;
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
  public function createProjectFromTemplate($template, $name) {
    return $this->project->createFromTemplate($template, $name);
  }

  /**
   * @inheritdoc
   */
  public function getJob($jobPart) {
    return $this->job->getJob($jobPart);
  }

  /**
   * @inheritdoc
   */
  public function getCompletedFile($jobPart) {
    return $this->job->getCompletedFile($jobPart);
  }

  /**
   * @inheritdoc
   */
  public function getProject($project) {
    return $this->project->getProject($project);
  }

  /**
   * @inheritdoc
   */
  public function listAnalysesByProject($project) {
    return $this->analysis->listByProject($project);
  }

  /**
   * @inheritdoc
   */
  public function listBusinessUnits() {
    return $this->businessUnit->listBusinessUnits();
  }

  /**
   * @inheritdoc
   */
  public function listDomains() {
    return $this->domain->listDomains();
  }

  /**
   * @inheritdoc
   */
  public function listJobs($jobPart) {
    return $this->job->listJobs($jobPart);
  }

  /**
   * @inheritdoc
   */
  public function listJobsByProject($page = NULL, $project, $workflowLevel = NULL, $assignedTo = NULL, $status = NULL) {
    return $this->job->listByProject($page, $project, $workflowLevel, $assignedTo, $status);
  }

  /**
   * @inheritdoc
   */
  public function listMachineTranslateSettings() {
    return $this->machineTranslateSettings->listMachineTranslateSettings();
  }

  /**
   * @inheritdoc
   */
  public function listProjects() {
    return $this->project->listProjects();
  }

  /**
   * @inheritdoc
   */
  public function listProjectTemplates() {
    return $this->projectTemplate->listTemplates();
  }

  /**
   * @inheritdoc
   */
  public function listSupportedLanguages() {
    return $this->language->listSupportedLanguages();
  }

  /**
   * @inheritdoc
   */
  public function listTranslationMemories() {
    return $this->translationMemory->listTranslationMemories();
  }

  /**
   * @inheritdoc
   */
  public function listUsers() {
    return $this->user->listUsers();
  }

  /**
   * @inheritdoc
   */
  public function listVendors() {
    return $this->vendor->listVendors();
  }

  /**
   * @inheritdoc
   */
  public function listWorkflowSteps() {
    return $this->workflowStep->listWorkflowSteps();
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
  public function loginOther($userName) {
    return $this->auth->loginOther($userName);
  }

  /**
   * @inheritdoc
   */
  public function logout() {
    return $this->auth->logout();
  }

  /**
   * @inheritdoc
   */
  public function whoAmI() {
    return $this->auth->whoAmI();
  }

  /**
   * @param string $path
   * @param Parameters|null $parameters
   * @param File|null $file
   * @return JsonResponse
   */
  public function post($path, Parameters $parameters = NULL, File $file = NULL) {
    $parameters = isset($parameters) ? $parameters : new Parameters();
    $parameters->token = $this->token;
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
   * @param File|null $file
   * @return PromiseInterface
   */
  public function postAsync($path, Parameters $parameters = NULL, File $file = NULL) {
    $parameters = isset($parameters) ? $parameters : new Parameters();
    $parameters->token = $this->token;
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
   * @return MachineTranslateSettings
   */
  protected function getMachineTranslateSettingsService() {
    return new MachineTranslateSettings($this);
  }

  /**
   * @return Project
   */
  protected function getProjectService() {
    return new Project($this);
  }

  /**
   * @return ProjectTemplate
   */
  protected function getProjectTemplateService() {
    return new ProjectTemplate($this);
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

  /**
   * @return User
   */
  protected function getUserService() {
    return new User($this);
  }

  /**
   * @return Vendor
   */
  protected function getVendorService() {
    return new Vendor($this);
  }

  /**
   * @return WorkflowStep
   */
  protected function getWorkflowStepService() {
    return new WorkflowStep($this);
  }

  /**
   * @param string $userName
   * @param string $password
   * @throws \Exception if fails to get the token from the response.
   */
  private function loginAndGetToken($userName, $password) {
    $jsonResponse = $this->auth->login($userName, $password);
    $response = json_decode($jsonResponse->getContent());

    if (empty($response->token)) {
      throw new \Exception("Authentication failed: {$jsonResponse->getContent()}");
    }

    return $response->token;
  }
}
