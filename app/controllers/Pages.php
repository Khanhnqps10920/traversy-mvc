<?php

class Pages extends Controller
{

  // public $lang;

  // public function __construct($lang)
  // {
  //   $this->lang = $lang;
  // }

  public function index()
  {


    $data = [
      'title' => 'Welcome',
    ];


    $this->view('pages/index', $data);
  }

  public function about()
  {
    $data = [
      'title' => 'About us'
    ];
    $this->view('pages/about', $data);
  }
}
