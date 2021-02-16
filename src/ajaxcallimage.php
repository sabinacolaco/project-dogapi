<?php
if($_POST['data-img'] === 'random')
    $url = 'https://dog.ceo/api/breeds/image/random';
else
    $url = 'https://dog.ceo/api/breed/'.$_POST['data-img'].'/images/random';
	
$curl = curl_init($url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$response = curl_exec($curl);
if($response === false) {
    $error = 'Curl error: ' . curl_error($curl);
    echo "";
} else {
    $result = json_decode($response, true);
    echo $result['message'];
}
curl_close($curl);
?>