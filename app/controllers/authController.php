<?php
require_once './app/models/userModel.php';
require_once './app/views/authView.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function ShowLogin() {
        return $this->view->ShowLogin();
    }

    public function login() {
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showLogin('Usuario invalido');
        }

        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }
    
        $name = $_POST['name'];
        $password = $_POST['password'];
        $userFromDB = $this->model->getUserByName($name);
        
        if($userFromDB && password_verify($password, $userFromDB->contrasena)){
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['USER_NAME'] = $userFromDB->nombre;
    
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Nombre y/o contraseñas incorrectas, porfavor intentar nuevamente');
        }
    }
    
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}