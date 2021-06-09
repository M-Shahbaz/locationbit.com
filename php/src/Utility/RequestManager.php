<?php

namespace App\Utility;

class RequestManager
{
    /**
     *  Helper method to send a POST request.
     *
     *  @param string $endpoint The endpoint to send the request to.
     *  @param array  $headers  Array of key-value pairs that form the header.
     *  @param array  $body     Array of key-value pairs that form the body or json string.
     *
     *  @function sendPostRequest
     *  @return   string The raw response returned by the endpoint.
     */
    public static function sendPostRequest($endpoint, $headers = [], $body = [])
    {
        if(is_array($body)){
            $bodyType = 'form_params';
        }else{
            $bodyType = 'json';
            $body = !empty($body) && json_decode($body) == null ? $body : json_decode($body, true);
        }
        
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('POST', $endpoint, array(
                'headers' => $headers,
                $bodyType => $body,
            ));

            $result['status'] = $response->getStatusCode();
            $result['success']  = true;
            $responseBody = $response->getBody()->getContents();
            $result['result']  = !empty($responseBody) && json_decode($responseBody) == null ? $responseBody : json_decode($responseBody, true);
            return $result;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // handle exception or api errors.
            $response = $e->getResponse();
            $result['status'] = $response->getStatusCode();
            $result['success']  = false;
            $responseBody = $response->getBody()->getContents();
            $result['error']  = !empty($responseBody) && json_decode($responseBody) == null ? $responseBody : json_decode($responseBody, true);
            return $result;
        }
    }

    //PATCH REQUEST for Update
    public static function sendPatchRequest($endpoint, $headers = [], $body = [])
    {
        if(is_array($body)){
            $bodyType = 'form_params';
        }else{
            $bodyType = 'json';
            $body = !empty($body) && json_decode($body) == null ? $body : json_decode($body, true);
        }

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('PATCH', $endpoint, array(
                'headers' => $headers,
                $bodyType => $body,
            ));

            $result['status'] = $response->getStatusCode();
            $result['success']  = true;
            $responseBody = $response->getBody()->getContents();
            $result['result']  = !empty($responseBody) && json_decode($responseBody) == null ? $responseBody : json_decode($responseBody, true);
            return $result;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // handle exception or api errors.
            $response = $e->getResponse();
            $result['status'] = $response->getStatusCode();
            $result['success']  = false;
            $responseBody = $response->getBody()->getContents();
            $result['error']  = !empty($responseBody) && json_decode($responseBody) == null ? $responseBody : json_decode($responseBody, true);
            return $result;
        }

    }

    //PATCH REQUEST for Update
    public static function sendDeleteRequest($endpoint, $headers = [], $body = [])
    {
        if(is_array($body)){
            $bodyType = 'form_params';
        }else{
            $bodyType = 'json';
            $body = !empty($body) && json_decode($body) == null ? $body : json_decode($body, true);
        }

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('DELETE', $endpoint, array(
                'headers' => $headers,
                $bodyType => $body,
            ));

            $result['status'] = $response->getStatusCode();
            $result['success']  = true;
            $responseBody = $response->getBody()->getContents();
            $result['result']  = !empty($responseBody) && json_decode($responseBody) == null ? $responseBody : json_decode($responseBody, true);
            return $result;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // handle exception or api errors.
            $response = $e->getResponse();
            $result['status'] = $response->getStatusCode();
            $result['success']  = false;
            $responseBody = $response->getBody()->getContents();
            $result['error']  = !empty($responseBody) && json_decode($responseBody) == null ? $responseBody : json_decode($responseBody, true);
            return $result;
        }

    }

    //Get request
    public static function sendGetRequest($endpoint, $headers = [], $body = [])
    {
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', $endpoint, array(
                'headers' => $headers
            ));

            $result['status'] = $response->getStatusCode();
            $result['success']  = true;
            $responseBody = $response->getBody()->getContents();
            $result['result']  = !empty($responseBody) && json_decode($responseBody) == null ? $responseBody : json_decode($responseBody, true);
            return $result;
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // handle exception or api errors.
            $response = $e->getResponse();
            $result['status'] = $response->getStatusCode();
            $result['success']  = false;
            $responseBody = $response->getBody()->getContents();
            $result['error']  = !empty($responseBody) && json_decode($responseBody) == null ? $responseBody : json_decode($responseBody, true);
            return $result;
        }
    }

    //download file
    public static function downloadFile($path, $url)
    {

        try {
            $file = fopen($url, "rb");
            $newf = null;

            if ($file) {
                $newf = fopen($path, "a"); // to overwrite existing file

                if ($newf)
                    while (!feof($file)) {
                        fwrite($newf, fread($file, 1024 * 8), 1024 * 8);
                    }
            }

            if ($file) {
                fclose($file);
            }

            if ($newf) {
                fclose($newf);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return file_exists($path) ? $path : false;
    }
}
