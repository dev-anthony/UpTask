<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class TasksController extends ResourceController
{
  public function index()
  {
    return view('welcome_message');
  }
}
