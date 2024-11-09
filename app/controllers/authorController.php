<?php
require_once './app/models/authorModel.php';
require_once './app/views/authorView.php';

class AuthorController {
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new authorModel();
        $this->view = new authorView($res->user);
    }

    function authorList() {
        $authors = $this->model->getAuthors();
        return $this->view->showAuthors($authors);
    }

    function deleteAuthor($id) {
        $this->model->deleteAuthor($id);
        header('Location: ' . BASE_URL . '/listarAutores');
    }

    function addAuthor() {
        return $this->view->addAuthorForm();
    }

    function newAuthor() {
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['gender']) || empty($_POST['gender'])) {
            return $this->view->showError('Falta completar el genero destacado');
        }
        if (!isset($_POST['date']) || empty($_POST['date'])) {
            return $this->view->showError('Falta completar la fecha de nacimiento');
        }
        if (!isset($_POST['awards']) || empty($_POST['awards'])) {
            return $this->view->showError('Falta completar las premiaciones');
        }

        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $date = $_POST['date'];
        $awards = $_POST['awards'];

        $this->model->insertAuthor($name,$gender,$date,$awards);

        header('Location: ' . BASE_URL . '/listarAutores');
    }

    function authorChange($id) {
        $author = $this->model->getAuthorById($id);
        return $this->view->showAuthor($author);
    }

    function updateAuthor($id) {
        if (!isset($_POST['gender']) || empty($_POST['gender'])) {
            return $this->view->showError('Falta completar el genero');
        }
        if (!isset($_POST['awards']) || empty($_POST['awards'])) {
            return $this->view->showError('Falta completar las premiaciones');
        }

        $gender = $_POST['gender'];
        $awards = $_POST['awards'];

        $this->model->updateAuthor($gender,$awards,$id);

        header('Location: ' . BASE_URL . '/listarAutores');
    }

    function showBooksByAutor($id) {
        $author = $this->model->getAuthorById($id);
        $bookModel = new bookModel(); 
        $books = $bookModel->getBooksByAuthor($id);

        return $this->view->showBookList($books, $author);
    }
}