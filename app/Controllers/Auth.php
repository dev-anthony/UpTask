<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Firebase\JWT\JWT;

class Auth extends BaseController
{
  use ResponseTrait;

  public function __construct()
  {
    helper('secure_password');
  }

  public function login()
  {
    try {
      $username = $this->request->getPost('username');
      $password = $this->request->getPost('password');

      $userModel = new UserModel();
      $validateUser = $userModel->where('username', $username)->first();

      if ($validateUser == null)
        return $this->failNotFound('Usuario no encontrado');

      if (verifyHash($password, $validateUser['password'])) :

        // return $this->respond('Usuario encontrado', 200);
        $jwt = $this->generateJWT($validateUser);
        return $this->respond(['token' => $jwt], 201);

      else :
        return $this->failValidationErrors('Contraseña invalida');
      endif;
    } catch (\Exception $e) {
      return $this->failServerError('Error en el servidor', $e->getMessage());
    }
  }

  protected function generateJWT($user)
  {
    $key = Services::getSecretKey();
    $time = time();
    $payload = [
      'aud' => base_url(),
      'iat' => $time,
      'exp' => time() + (60 * 60 * 24 * 7),
      'data' => [
        'name' => $user['name'],
        'username' => $user['username'],
        'role' => $user['rol_id'],
      ],
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
  }
}
