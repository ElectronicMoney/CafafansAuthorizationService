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
    public function getExamples($path) {
        return $this->getServices("/{$path}")->getBody();
    }

    /**
     * creating an author from authors micro service
     * @param array $data
     * @return string
     */
    public function createExample($path, $data) {
        return $this->postService("/{$path}", $data)->getBody();
    }

    /**
     * Fetching an author instance from authors micro service
     * @param int $id
     * @return string
     */
    public function getExample($path, $id) {
        return $this->getService("/{$path}", $id)->getBody();
    }

    /**
     * updating an author instance using authors micro service
     * @param array $data
     * @param int $id
     * @return string
     */
    public function editExample($path, $data, $id) {
        return $this->putService("/{$path}", $data, $id)->getBody();
    }

    /**
     * Deleting an author instance from authors micro service
     * @param int $id
     * @return string
     */
    public function deleteExample($path, $id) {
        return $this->deleteService("/{$path}", $id)->getBody();
    }

}
