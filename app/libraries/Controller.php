<?php

/* base controller
 * loads the model and views
 */

class Controller
{

  public $lang;

  public function __construct($lang)
  {
    $this->lang = $lang;
  }

  //load model
  public function model($model)
  {

    require_once '../app/models/' . $model . '.php';


    return new $model();
  }

  // load vew
  public function view($view, $data = [])
  {
    // check for view file

    if (file_exists('../app/views/' . $view . '.php')) {


      // check for lang file
      if (file_exists('../app/lang/' . $this->lang . '.php')) {
        require_once '../app/lang/' . $this->lang . '.php';
      } else {
        die($view  . ' lang doesnt exist');
      }

      require_once '../app/views/' . $view . '.php';
    } else {
      die($view  . ' view doesnt exist');
    }
  }
}
