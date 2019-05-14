<?php
namespace App\Services;

use App\HttpRestApiClient\CafafansHttpRestApiClient;

class  ExampleService extends CafafansHttpRestApiClient
{
    /**
     * The baseUri to consume the authors service
     * @var string
     */
    public $baseUri;

    // public;
    /**
     * Creating a new Example instance.
     *
     * @return void
     */
    public function __construct() {
        $this->baseUri = config('services.example.base_uri');
    }

    /**
     * Fetching the list of authors from the Example Service
     * @param void
     * @return string
     */
    public function getExamples() {
        return $this->getServices('/example')->getBody();
    }

    /**
     * creating an author from authors micro service
     * @param array $data
     * @return string
     */
    public function createExample($data) {
        return $this->postService('/example', 'POST', $data)->getBody();
    }

    /**
     * Fetching an author instance from authors micro service
     * @param int $exampleId
     * @return string
     */
    public function getExample($exampleId) {
        return $this->getService('/example', $exampleId)->getBody();
    }

    /**
     * updating an author instance using authors micro service
     * @param array $data
     * @param int $exampleId
     * @return string
     */
    public function editExample($data, $exampleId) {
        return $this->putService('/example', $data, $exampleId)->getBody();
    }

    /**
     * Deleting an author instance from authors micro service
     * @param int $exampleId
     * @return string
     */
    public function deleteExample($exampleId) {
        return $this->deleteService('/example', $exampleId)->getBody();
    }

}
