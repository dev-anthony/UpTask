<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
  //--------------------------------------------------------------------
  // Setup
  //--------------------------------------------------------------------

  /**
   * Stores the classes that contain the
   * rules that are available.
   *
   * @var string[]
   */
  public $ruleSets = [
    Rules::class,
    FormatRules::class,
    FileRules::class,
    CreditCardRules::class,
  ];

  /**
   * Specifies the views that are used to display the
   * errors.
   *
   * @var array<string, string>
   */
  public $templates = [
    'list'   => 'CodeIgniter\Validation\Views\list',
    'single' => 'CodeIgniter\Validation\Views\single',
  ];

  //--------------------------------------------------------------------
  // Rules
  //--------------------------------------------------------------------

  public $rol_validation = [
    // validadcion para rol con errores
    'type_rol' => [ //Aquí tiene que ir el nombre del campo del que tienes en la base de datos
      'label' => 'Rol',
      'rules' => 'required|is_unique[rol.type_rol]',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'is_unique' => 'El {field} ya existe',
      ],
    ],
  ];

  public $user_validation = [
    'name' => [
      'label' => 'Nombre',
      'rules' => 'required|min_length[3]|max_length[50]',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
        'max_length' => 'El campo {field} debe tener como maximo {param} caracteres',
      ],
    ],
    'username' => [
      'label' => 'Usuario',
      'rules' => 'required|is_unique[user.username]|min_length[3]|max_length[50]|trim',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'is_unique' => 'El {field} ya existe',
        'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
        'max_length' => 'El campo {field} debe tener como maximo {param} caracteres',
      ],
    ],
    'password' => [
      'label' => 'Contraseña',
      'rules' => 'required|min_length[3]|max_length[100]|trim',
      'errors' => [
        'required' => 'El campo {field} es requerido',
        'min_length' => 'La {field} debe tener al menos {param} caracteres',
        'max_length' => 'La {field} debe tener como maximo {param} caracteres',
      ],
    ],
  ];
}
