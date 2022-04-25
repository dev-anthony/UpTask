<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
  protected $table = 'category';
  protected $primaryKey = 'id_category';
  protected $returnType = 'array';
  protected $allowedFields = ['name_category', 'description'];

  // Control de fechas de auditacion
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
