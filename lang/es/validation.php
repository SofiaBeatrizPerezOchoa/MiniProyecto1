<?php

return [
    'accepted' => 'El campo :attribute debe ser aceptado.',
    'boolean' => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'exists' => 'El valor seleccionado en :attribute no es válido.',
    'integer' => 'El campo :attribute debe ser un número entero.',
    'max' => [
        'array' => 'El campo :attribute no debe tener más de :max elementos.',
        'file' => 'El archivo :attribute no debe superar los :max kilobytes.',
        'numeric' => 'El campo :attribute no debe ser mayor que :max.',
        'string' => 'El campo :attribute no debe superar los :max caracteres.',
    ],
    'min' => [
        'array' => 'El campo :attribute debe tener al menos :min elementos.',
        'file' => 'El archivo :attribute debe pesar al menos :min kilobytes.',
        'numeric' => 'El campo :attribute debe ser al menos :min.',
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'numeric' => 'El campo :attribute debe ser un número.',
    'regex' => 'El formato del campo :attribute no es válido.',
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser una cadena de texto.',
    'unique' => 'El valor del campo :attribute ya está en uso.',

    'custom' => [
        'username' => [
            'unique' => 'El nombre de usuario ya está en uso.',
        ],
    ],

    'attributes' => [
        'activo' => 'estado',
        'name' => 'nombre completo',
        'password' => 'contraseña',
        'password_confirmation' => 'confirmación de contraseña',
        'rol' => 'rol',
        'username' => 'usuario',
    ],
];
