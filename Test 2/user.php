<?php
// require_once 'Database.php';

class User
{
    // private $db;

    public function __construct()
    {
        // $this->db = new Database();
    }

    public function validateUser($userData)
    {
        // Limpia los datos de entrada para prevenir la inyección de código
        $nombre = $this->cleanInputs($userData['nombre']);
        $apellidos = $this->cleanInputs($userData['apellidos']);
        $email = $this->cleanInputs($userData['email']);
        $telefono = $this->cleanInputs($userData['telefono']);
        $codigoPostal = $this->cleanInputs($userData['codigoPostal']);

        // Verifica la longitud máxima de los campos
        if (strlen($nombre) > 50 || strlen($apellidos) > 50 || strlen($email) > 100 || strlen($telefono) > 11 || strlen($codigoPostal) > 5) {
            return "Se ha excedido la longitud máxima permitida para uno o más campos.";
        }

        // Verifica que el nombre y los apellidos contengan solo letras y un espacio
        if (!preg_match("/^[a-zA-Z]+( [a-zA-Z]+)*$/", $nombre) || !preg_match("/^[a-zA-Z]+( [a-zA-Z]+)*$/", $apellidos)) {
            return "El nombre y los apellidos solo deben contener letras y un espacio.";
        }

        // Verifica si el email ya existe en las últimas 24 horas
        if (!$this->check24h($email)) {
            return "El usuario con este email ya se ha registrado en las últimas 24 horas.";
        }

        // Verifica si todos los campos están llenos
        if (empty($nombre) || empty($apellidos) || empty($email) || empty($telefono) || empty($codigoPostal)) {
            return "Por favor, complete todos los campos.";
        }

        // Verifica el formato de email, teléfono y código postal
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "El formato de email no es válido.";
        }
        if (!preg_match("/^\d{9}$/", $telefono)) {
            return "El formato de teléfono no es válido.";
        }
        if (!preg_match("/^\d{5}$/", $codigoPostal)) {
            return "El formato de código postal no es válido.";
        }

        // Obtiene la provincia asociada al código postal
        $provincia = $this->getProvince(substr($codigoPostal, 0, 2));

        return true; 
    }

    // Función para limpiar inputs y prevenir inyección de código
    private function cleanInputs($input)
{
    $originalInput = $input;
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    
    // Verificar si la entrada original y la entrada limpia son diferentes
    if ($originalInput !== $input) {

        $errorMessage = "Se ha detectado una entrada potencialmente peligrosa.";
        return $errorMessage;
    }

    return $input;
}

    // Simulación de las funciones auxiliares dadas
    public function getProvince($codigoProvincia)
    {
        // Función que retorna la provincia asociada al código postal
    }

    public function check24h($email)
    {
        // Función que verifica si el email ya existe en la base de datos en las últimas 24 horas
    }

    public function insertUser($userData)
    {
        // Inserta los datos del usuario en la base de datos
    }
}