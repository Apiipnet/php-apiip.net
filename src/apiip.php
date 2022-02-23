<?php

namespace ApiipClient;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Apiip{
  const API_URL = 'http://apiip.net/api/check';
  const API_URL_SSL = 'https://apiip.net/api/check';
  private $access_key;
  private $http_client;
  private $settings;
  private $url;
  private $options = [
    'output',
    'ip',
    'fields',
    'language',
  ];
  public function __construct(string $access_key = '', $settings = []){  
    try {
      $this->access_key = $access_key;
      $this->settings = $settings;
      if (!$access_key) {
        throw new Exception('Access key is required!');
      }
      $this->url = array_key_exists('ssl', $settings) && $settings['ssl'] === true ? self::API_URL_SSL : self::API_URL;
      $this->url .=  '?accessKey=' . $this->access_key;
      $this->http_client = new Client();
    } catch(Exception $e) {
      throw new Exception($e->getMessage());
    }
  }

 
  public function getLocation($options = []){
      $prepare_url = $this->url . $this->createUrl($options);
      
      try {
        $response = $this->http_client->request('GET', $prepare_url);
      } catch (ClientException $e) {
        $response = $e->getResponse();
        $response_body = $response->getBody();
        throw new Exception($response_body);
      } catch (Exception $e) {
        throw new Exception($e->getMessage());
      }

      $headers = $response->getHeaders();
      if (strpos($headers['Content-Type'][0], 'xml')){
        $raw_details = simplexml_load_string($response->getBody());
        return $raw_details;
      } else {
        $raw_details = json_decode($response->getBody(), true);
        return $raw_details;
      }
  }

  private function createUrl($options = []){
    $url = '';

    foreach($options as $key => $value){
      if (!in_array($key, $this->options)){
        continue;
      }
      $url .= '&' . $key . '=' . $value;
    }
    return $url;
  }
 
}
?>