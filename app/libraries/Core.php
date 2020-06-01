<?php
/* 

* app core class
* create core and load core controller
* url format /controller/method/params

*/

class Core
{

  protected $currentLanguage = 'vie';
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];

  public function __construct()
  {
    // get url (array)
    $url = $this->getUrl();
    // look in language for the first index
    if (file_exists('../app/lang/' . $url[0] . '.php')) {
      // if exist set as language
      $this->currentLanguage = $url[0];

      unset($url[0]);
    }



    // look in controller for second index
    if (isset($url[1])) {
      if (file_exists('../app/controllers/' . ucwords($url[1]) . '.php')) {

        // if exist, set as controller
        $this->currentController = ucwords($url[1]);

        // unset 0 index
        unset($url[1]);
      }
    }


    // require the controller
    require_once '../app/controllers/' . $this->currentController . '.php';

    // instantiate controller class
    $this->currentController = new $this->currentController($this->currentLanguage);

    // check for second part of url
    if (isset($url[2])) {
      // check to see if method exist and control it
      if (method_exists($this->currentController, $url[2])) {
        $this->currentMethod = $url[2];

        // unset 1 index
        unset($url[2]);
      }
    }


    // get params
    $this->params = $url ? array_values($url) : [];

    // call a callback with array of params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }




  public function getUrl()
  {
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');
      $url = filter_var($url, FILTER_SANITIZE_URL);
      $url = explode('/', $url);

      return $url;
    }
  }
}
