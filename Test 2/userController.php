<?php
require_once 'user.php';

class UserController
{

    public function register()
    {
        require 'index.html';
    }

    public function submitForm($formData)
    {

        header('Content-Type: text/html; charset=UTF-8');

        $userModel = new User();
        $isValid = $this->validateFormData($formData);

        if ($isValid === true) {
            // Insertar usuario en la base de datos
            $result = $userModel->insertUser($formData);

            if ($result) {
                // Redirigir a alguna página de éxito
                echo "Usuario registrado exitosamente.";
                http_response_code(200);
                exit;
            }

            echo $result;
            http_response_code(500);
        } else {
            
            echo $isValid;
            http_response_code(400);
        }
    }

    private function validateFormData($formData)
    {
        // Verifica si la política de privacidad ha sido aceptada
        if (!isset($formData['politica']) || $formData['politica'] !== 'on') {
            return "Debe aceptar las políticas de privacidad.";
        }

        // Realiza validaciones adicionales usando la clase User
        $userModel = new User();
        $result = $userModel->validateUser($formData);

        return $result; 
    }
}
