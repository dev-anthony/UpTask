<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
  protected $table = 'task';
  protected $primaryKey = 'id_task';
  protected $returnType = 'array';
  protected $allowedFields = ['description', 'status', 'end_date', 'user_id'];

  // Control de fechas de auditacion
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
