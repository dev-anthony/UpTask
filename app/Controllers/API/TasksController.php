<?php

namespace App\Controllers\API;

use App\Models\TaskModel;
use CodeIgniter\RESTful\ResourceController;

class TasksController extends ResourceController
{
  public function __construct()
  {
    $this->model = $this->setModel(new TaskModel());
    $this->validation = \Config\Services::validation();
  }
  public function index()
  {
    try {

      if ($data = $this->model->findAll()) {
        return $this->respond($data, 200);
      } else {
        return $this->failNotFound('No se encontraron tareas');
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function show($id = null)
  {
    try {
      //code...
      if ($$id = $this->model->find($id)) {
        return $this->respond([
          'msg' => 'La tarea se encontro correctamente',
          'Task' => $id
        ]);
      } else {
        return $this->respond([
          'error' => 'No se pudo encontrar la tarea'
        ]);
      }
    } catch (\Exception $e) {
      return $this->failServerError(
        'Error en el servidor',
        $e->getMessage()
      );
    }
  }

  public function create()
  {
    try {
      //  estaa paarte lo que hace es guardar los datos validados y haseha el password
      $data = $this->request->getJSON(true);

      if ($this->validation->run($data, 'task_validation') == false) {
        return $this->fail($this->validation->getErrors());
      } else {

        $this->model->insert($data);
        return $this->respondCreated([
          'status' => 'created',
          'message' => 'Categoria creada',
          'data' => $data,
        ], 201);
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }


  public function edit($id = null)
  {
    try {
      //code...
      if ($id == null) {
        return $this->respond([
          'error' => 'No se pudo editar la tarea'
        ]);
      }
    } catch (\Exception $e) {
      //Exception $e;
    }
  }
  public function delete($id = null)
  {
    try {
      //code...
      if ($id == null) {
        return $this->respond(
          ['error' => 'No se puede eliminar la nota'],
          500
        );
      } else {
        $data = $this->model->find($id);
        if ($data) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'La nota se elimino correctamente',
                'Task' => $data
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar la nota'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'La nota no existe!!'],
            500
          );
        }
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }
}
