<?php
/**
 * @file
 * Dotgo Reseller API Class.
 */

/**
 * Class DotgoApi
 */
class DotgoApi {

  /**
   * The API format DOTGO uses
   */
  const API_FORMAT = 'xml';
  /**
   * The API base URL
   */
  public $_apiURL = 'https://dotgo.com/api/1.0/';
  /**
   * The DOTGO APIKey
   *
   * @var string
   */
  private $_apikey;
  /**
   * The DOTGO API password
   *
   * @var string
   */
  private $_apipassword;

  /**
   * Default constructor
   *
   * @param array $config
   * @return void
   */
  public function __construct($config) {
    if(isset($config['apiKey'])){
      $this->setApiKey($config['apiKey']);
      $this->setApiPassword($config['apiPassword']);
    }
    if(isset($config['apiURL'])){
      $this->setApiURL($config['apiURL']);
    }
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#addService
   */
  public function addService($config) {
    $parameters = array(
      'method' => 'addService',
      'service' => isset($config['service']) ? $config['service'] : 'messaging',
      'serviceLevel' => isset($config['serviceLevel']) ? $config['serviceLevel'] : 0,
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['limit']) ? $config['limit'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#addURL
   */
  public function addURL($config) {
    $parameters = array(
      'method' => 'addURL',
      'url' => isset($config['limit']) ? $config['limit'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#broadcastMessage
   */
  public function broadcastMessage($config) {
    $parameters = array(
      'method' => 'broadcastMessage',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['url']) ? $config['url'] : NULL,
      'pathTo' => isset($config['pathTo']) ? $config['pathTo'] : NULL,
      'channel' => isset($config['channel']) ? $config['channel'] : NULL,
      'node' => isset($config['node']) ? $config['node'] : NULL,
      'sendTime' => isset($config['sendTime']) ? $config['sendTime'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#cancelMessage
   */
  public function cancelMessage($config) {
    $parameters = array(
      'method' => 'cancelMessage',
      'message' => isset($config['message']) ? $config['message'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#createSubaccount
   */
  public function createSubaccount($config) {
    $parameters = array(
      'method' => 'createSubaccount',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#deleteService
   */
  public function deleteService($config) {
    $parameters = array(
      'method' => 'deleteService',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['url']) ? $config['url'] : NULL,
      'service' => isset($config['service']) ? $config['service'] : NULL,
      'now' => isset($config['now']) ? $config['now'] : 0,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#deleteURL
   */
  public function deleteURL($config) {
    $parameters = array(
      'method' => 'deleteURL',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['url']) ? $config['url'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#describeFollowedPaths
   */
  public function describeFollowedPaths($config) {
    $parameters = array(
      'method' => 'describeFollowedPaths',
      'subaccounts' => isset($config['subaccounts']) ? $config['subaccounts'] : '*',
      'urls' => isset($config['urls']) ? $config['urls'] : '*',
      'followedPaths' => isset($config['followedPaths']) ? $config['followedPaths'] : '*',
      'limit' => isset($config['limit']) ? $config['limit'] : 100,
      'offset' => isset($config['offset']) ? $config['offset'] : 0,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#describeFollows
   */
  public function describeFollows($config) {
    $parameters = array(
      'method' => 'describeFollows',
      'subaccounts' => isset($config['subaccounts']) ? $config['subaccounts'] : '*',
      'urls' => isset($config['urls']) ? $config['urls'] : '*',
      'followedPaths' => isset($config['followedPaths']) ? $config['followedPaths'] : '*',
      'followerPaths' => isset($config['followerPaths']) ? $config['followerPaths'] : '*',
      'limit' => isset($config['limit']) ? $config['limit'] : 100,
      'offset' => isset($config['offset']) ? $config['offset'] : 0,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#describeMessages
   */
  public function describeMessages($config) {

    $parameters = array(
      'method' => 'describeMessages',
      'subaccounts' => isset($config['subaccounts']) ? $config['subaccounts'] : '*',
      'urls' => isset($config['urls']) ? $config['urls'] : '*',
      'messages' => empty($config['message_ids']) ? '*' : implode(',', $config['message_ids']),
      'limit' => isset($config['limit']) ? $config['limit'] : 100,
      'offset' => isset($config['offset']) ? $config['offset'] : 0,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#describeRegisteredPaths
   */
  public function describeRegisteredPaths($config) {

    $parameters = array(
      'method' => 'describeRegisteredPaths',
      'subaccounts' => isset($config['subaccounts']) ? $config['subaccounts'] : '*',
      'urls' => isset($config['urls']) ? $config['urls'] : '*',
      'registeredPaths' => isset($config['registeredPaths']) ? $config['registeredPaths'] : '*',
      'limit' => isset($config['limit']) ? $config['limit'] : 100,
      'offset' => isset($config['offset']) ? $config['offset'] : 0,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#describeServices
   */
  public function describeServices($config) {

    $parameters = array(
      'method' => 'describeServices',
      'subaccounts' => isset($config['subaccounts']) ? $config['subaccounts'] : '*',
      'urls' => isset($config['urls']) ? $config['urls'] : '*',
      'limit' => isset($config['limit']) ? $config['limit'] : 100,
      'offset' => isset($config['offset']) ? $config['offset'] : 0,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#describeSubaccounts
   */
  public function describeSubaccounts($config) {

    $parameters = array(
      'method' => 'describeSubaccounts',
      'subaccounts' => isset($config['subaccounts']) ? $config['subaccounts'] : '*',
      'limit' => isset($config['limit']) ? $config['limit'] : 100,
      'offset' => isset($config['offset']) ? $config['offset'] : 0,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#describeURLs
   */
  public function describeURLs($config) {

    $parameters = array(
      'method' => 'describeURLs',
      'subaccounts' => isset($config['subaccounts']) ? $config['subaccounts'] : '*',
      'limit' => isset($config['limit']) ? $config['limit'] : 100,
      'offset' => isset($config['offset']) ? $config['offset'] : 0,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#destroySubaccount
   */
  public function destroySubaccount($config) {

    $parameters = array(
      'method' => 'destroySubaccount',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#launchApplication
   */
  public function launchApplication($config) {

    $parameters = array(
      'method' => 'launchApplication',
      'application' => isset($config['application']) ? $config['application'] : 'publisher',
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#modifyService
   */
  public function modifyService($config) {

    $parameters = array(
      'method' => 'modifyService',
      'service' => isset($config['service']) ? $config['service'] : 'messaging',
      'serviceLevel' => isset($config['serviceLevel']) ? $config['serviceLevel'] : 0,
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['limit']) ? $config['limit'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#readCMRL
   */
  public function readCMRL($config) {

    $parameters = array(
      'method' => 'readCMRL',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['limit']) ? $config['limit'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#reloadURL
   */
  public function reloadURL($config) {

    $parameters = array(
      'method' => 'reloadURL',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['limit']) ? $config['limit'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#sendMessage
   */
  public function sendMessage($config) {
    $parameters = array(
      'method' => 'sendMessage',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['url']) ? $config['url'] : NULL,
      'pathTo' => isset($config['pathTo']) ? $config['pathTo'] : NULL,
      'channel' => isset($config['channel']) ? $config['channel'] : NULL,
      'node' => isset($config['node']) ? $config['node'] : NULL,
      'sendTime' => isset($config['sendTime']) ? $config['sendTime'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#unfollow
   */
  public function unfollow($config) {
    $parameters = array(
      'method' => 'unfollow',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['url']) ? $config['url'] : NULL,
      'followedPath' => isset($config['followedPath']) ? $config['followedPath'] : NULL,
      'followerPath' => isset($config['followerPath']) ? $config['followerPath'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#unregister
   */
  public function unregister($config) {
    $parameters = array(
      'method' => 'unregister',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['url']) ? $config['url'] : NULL,
      'registeredPath' => isset($config['registeredPath']) ? $config['registeredPath'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  /**
   * @DOC: http://dotgo.com/Support/Documentation/doc0012.1.0/#writeCMRL
   */
  public function writeCMRL($config) {
    $parameters = array(
      'method' => 'unregister',
      'subaccount' => isset($config['subaccount']) ? $config['subaccount'] : NULL,
      'url' => isset($config['url']) ? $config['url'] : NULL,
      'cmrlContent' => isset($config['cmrlContent']) ? $config['cmrlContent'] : NULL,
    );

    return $this->apiCall($parameters);
  }

  public function apiCall($parameters = array()) {

    $parameters += array(
      'format' => 'xml',
      'apiKey' => $this->getApiKey(),
      'apiPassword' => $this->getApiPassword(),
    );

    // Use drupal_http_request
    if(function_exists('drupal_http_request')){
      $base_url = url($this->getApiURL(), array('query' => $parameters));

      $response = drupal_http_request($base_url);
      // Check if call was successful
      if ($response->code == 200) {
        $jsonData = $response->data;
      }
    }
    // Use CURL.
    else {
      if (is_array($parameters)) {
        $paramString = '?' . http_build_query($parameters);
      } else {
        $paramString = null;
      }

      $apiCall = $this->getApiURL() . ($paramString ? $paramString : NULL);

      // signed header of POST/DELETE requests
      $headerData = array('Accept: application/xml');

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $apiCall);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headerData);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POST, count($parameters));
      curl_setopt($ch, CURLOPT_POSTFIELDS, ltrim($paramString, '&'));

      $jsonData = curl_exec($ch);

      if (false === $jsonData) {
        throw new \Exception("Error: apiCall() - cURL error: " . curl_error($ch));
      }
      curl_close($ch);
    }

    $xml = simplexml_load_string($jsonData) or die ("Unable to load XML!");
    $jsonData = json_encode((array)$xml);
    return json_decode($jsonData, 1);
  }

  /**
   * @return string
   */
  function _designator() {
    $pieces = explode('.', $_SERVER['HTTP_HOST']);
    array_pop($pieces);
    if(count($pieces) > 1){
      array_shift($pieces);
    }
    return implode('.', $pieces);
  }

  /**
   * @return mixed
   */
  function _tld() {
    $pieces = explode('.', $_SERVER['HTTP_HOST']);
    return $pieces[count($pieces) - 1];
  }

  /**
   * @param $key
   * @return mixed
   */
  function _tld_lookup($key) {
    // DOTCOM (368266)—or to one of the phone numbers DOTEDU (368338), DOTGOV (368468), DOTNET (368638), or DOTORG (368674)
    $tlds = array(
      'com' => '368266',
      'edu' => '368338',
      'gov' => '368468',
      'net' => '368638',
      'org' => '368674',
    );

    return isset($tlds[$key]) ? $tlds[$key] : $tlds['com'];
  }

  /**
   * API-URL Setter
   *
   * @param string $apiURL
   * @return void
   */
  public function setApiURL($apiURL) {
    $this->_apiURL = $apiURL;
  }
  /**
   * API URL Getter
   *
   * @return string
   */
  public function getApiURL() {
    return $this->_apiURL;
  }
  /**
   * API-key Setter
   *
   * @param string $apiKey
   * @return void
   */
  public function setApiKey($apiKey) {
    $this->_apikey = $apiKey;
  }
  /**
   * API Key Getter
   *
   * @return string
   */
  public function getApiKey() {
    return $this->_apikey;
  }
  /**
   * API Password Setter
   *
   * @param string $apiPassword
   * @return void
   */
  public function setApiPassword($apiPassword) {
    $this->_apipassword = $apiPassword;
  }
  /**
   * API Password Getter
   *
   * @return string
   */
  public function getApiPassword() {
    return $this->_apipassword;
  }

}