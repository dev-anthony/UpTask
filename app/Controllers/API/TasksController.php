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
      if ($task = $this->model->findAll()) {
        return $$this->respond($task, 200);
      } else {
        return $this->failNotFound('No se encontraron tareas registradas');
      }
    } catch (\Exception $e) {
      return $this->failServerError(
        'Error en el servidor',
        $e->getMessage()
      );
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
      $data = $this->request->getJSON(true);

      if ($this->validate->run($data, 'task_validation') == false) {
        return $this->fail([
          'msg' => 'Error al crear la tarea',
          'Task' => $this->validation->getErrors()
        ]);
      } else {
        $this->model->insert($data);
        return $this->respondCreated([
          'status' => 'created',
          'message' => 'Tarea creada',
          'data' => $data
        ]);
      }
    } catch (\Exception $e) {
      return $this->failServerError('Ocurrio un error en el servidor', $e->getMessage());
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
