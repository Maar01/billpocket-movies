<?php


namespace App\Http\apiTraits;


trait ApiResponse
{
    public $http_status;
    public $http_code;
    public $http_json = array();

    /**
     * @param string $status
     * @param int $http_code
     * @param array[] $arguments
     * @version 30/07/2019
     * @author Mario Avila
     */
    public function setHttpResponse(string $status, int $http_code, array ...$arguments) : void
    {
        $this->http_code = $http_code;
        $this->http_status = $status;
        if (count($arguments) > 0) {
            foreach ($arguments as $argument => $value) {
                $this->http_json[$argument] = $value;
            }
        }
    }

    /**
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     * @version 30/07/2019
     * @author Mario Avila
     */
    public function sendResponse(array $headers = [])
    {
        $this->http_json['status'] = $this->http_status;
        $response = response()->json($this->http_json, $this->http_code);

        return count($headers) > 0 ? $response->withHeaders($headers) : $response;
    }

}
