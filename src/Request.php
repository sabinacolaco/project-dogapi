<?php
class Request {
    public function allBreeds()
    {
        $curl = curl_init();
        $url = 'https://dog.ceo/api/breeds/list/all';
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);	
        
        if($response === false) {
            $error = 'Curl error: ' . curl_error($curl);
            $result = '';
        }
        else {
            $result = json_decode($response, true);
        }
        curl_close($curl);
        return $result;
    }
}