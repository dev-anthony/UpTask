<?php

namespace App\Controllers\API;

use App\Models\CategoryModel;
use CodeIgniter\RESTful\ResourceController;

class CategorysController extends ResourceController
{
  public function __construct()
  {
    $this->model = $this->setModel(new CategoryModel());
    // inyeccion de la libreria como servvicio nombrado validation
    $this->validation = \Config\Services::validation();
  }

  public function index()
  {
    try {

      if ($data = $this->model->findAll()) {
        return $this->respond($data, 200);
      } else {
        return $this->failNotFound('No se encontraron categorias');
      }
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function create()
  {
    try {
      //  estaa paarte lo que hace es guardar los datos validados y haseha el password
      $data = $this->request->getJSON(true);

      if ($this->validation->run($data, 'category_validation') == false) {
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

  public function deleteTasksByCategory($id = null)
  {
    try {
      //code...
      if (!$id) {
        return $this->failNotFound('No se encontro el id de la categoria');
      } else {
        $categoryFind = $this->model->find($id);
        if (!$categoryFind) {
          return $this->failNotFound('No se encontro la categoria');
        } else {
          if ($this->model->deleteTasksByCategory($id) === 0) {
            throw new \Exception('No se eliminaron ninguna nota');
          } else {
            if ($this->model->delete($id)) {
              return $this->respondDeleted();
            } else {
              throw new \Exception('No se elimino la categoria');
            }
          }
        }
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError(
        'Error en el servidor',
        $e->getMessage()
      );
    }
  }

  public function edit($id = null)
  {
    try {
      //code...
      if ($id == null) {
        return $this->respond(
          ['error' => 'No se puede editar la categoria'],
          500
        );
      } else {
        $data = $this->model->find($id);
        if ($data) {
          $data = $this->request->getJSON();
          if ($this->model->update($id, $data)) {
            return $this->respond(
              [
                'msg' => 'La categoria se edito correctamente',
                'categoria' => $data
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede editar la categoria'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'La categoria no existe!!'],
            500
          );
        }
      }
    } catch (\Exception $e) {
      //Exception $e;
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  public function delete($id = null)
  {
    try {
      //code...
      if ($id == null) {
        return $this->respond(
          ['error' => 'No se puede eliminar la categoria'],
          500
        );
      } else {
        $data = $this->model->find($id);
        if ($data) {
          if ($this->model->delete($id)) {
            return $this->respond(
              [
                'msg' => 'La categoria se elimino correctamente',
                'categoria' => $data
              ],
              200
            );
          } else {
            return $this->respond(
              ['error' => 'No se puede eliminar la categoria'],
              500
            );
          }
        } else {
          return $this->respond(
            ['error' => 'La categoria no existe!!'],
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
