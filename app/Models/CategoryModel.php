<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
  protected $table = 'category';
  protected $primaryKey = 'id_category';
  protected $returnType = 'array';
  protected $allowedFields = ['title', 'description'];

  // Control de fechas de auditacion
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function deleteTasksByCategory($id_category)
  {
    // $sql = "DELETE FROM task WHERE id_category = ?";
    // $query = $this->db->query($sql, [$id_category]);
    // return $query;

    $this->db->table('task')->delete(['id_category' => $id_category]);
    return $this->db->affectedRows();
  }
}
