<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class Home extends ResourceController
{
  public function index()
  {
    return view('welcome_message');
  }

  public function deleteTasksByCategory()
  {
  }
}
