<?php

namespace App\Http\Clients;

class PopularRequest extends MdbClient implements MdbClientContract
{
    private $endPoint;
    public $page;
    private $response;
    private $error;

    /**
     * PopularRequest constructor.
     * @param int $page
     * @param string $lang
     */
    public function __construct(int $page = 1, string $lang = 'en-US')
    {
        parent::__construct();
        //url encode?
        $this->endPoint = "$this->baseUrl/popular?" . $this->getKeyParamString()."&page=$page&language=$lang";
        $this->getPopular();
    }

    /**
     * Execute the request and catch the result.
     * @version 31/07/2019
     * @author Mario Avila
     */
    private function getPopular() : void {
        curl_setopt_array($this->curl, $this->getCurlOpts());

        $this->response = curl_exec($this->curl);
        $this->error = curl_error($this->curl);

        curl_close($this->curl);
    }

    /**
     * @param bool $asArray
     * @return mixed
     * @version 31/07/2019
     * @author Mario Avila
     */
    public function getResponse(bool $asArray = false) {
        return json_decode($this->response, $asArray);
    }

    /**
     * @return array
     * @version 31/07/2019
     * @author Mario Avila
     */
    public function getCurlOpts() : array {
        return array(
            CURLOPT_URL => $this->endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
        );
    }

    /** if error is equals to an empty string, means that request was sucessful.
     * @return bool
     * @version 31/07/2019
     * @author Mario Avila
     */
    public function isSucessfull() : bool {
        return $this->error === '';
    }

    /** Return the string error
     * @return mixed
     * @version 31/07/2019
     * @author Mario Avila
     */
    public function getError(bool $asArray = false) {
        return json_decode($this->error, $asArray);
    }
}
