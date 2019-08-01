<?php

namespace App\Http\Clients;

use phpDocumentor\Reflection\DocBlock\Tags\Source;

class MdbClient
{
    protected $baseUrl = 'https://api.themoviedb.org/3/movie';
    private $apiToken;
    protected $curl;

    /**
     * MdbClient constructor.
     */
    public function __construct()
    {
        $this->curl = curl_init();
        $this->apiToken = config('services.MDB.token');
    }

    /**
     * @return string
     * @version 31/07/2019
     * @author Mario Avila
     */
    protected function getKeyParamString() {
        return "api_key={$this->apiToken}";
    }

}
