<?php
require_once './app/models/bookModel.php';
require_once './app/views/jsonView.php';

class BookApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new bookModel();
        $this->view = new JSONView();
    }


    public function getAll($req, $res) {
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $sort = 'asc';
        if (isset($req->query->sort)) 
            $sort = $req->query->sort;

        $autor = null;
        if(isset($req->query->Autor))
            $autor = $req->query->Autor;

        $books = $this->model->getBooks($orderBy, $sort, $autor);
        
        return $this->view->response($books);
    }


    public function get($req, $res) {
        $id = $req->params->id;
      
        $book = $this->model->getBook($id);

        if(!$book) {
            return $this->view->response("El libro con el id=$id no existe", 404);
        }

        return $this->view->response($book);
    }


    public function delete($req, $res) {
        $id = $req->params->id;

        $book = $this->model->getBook($id);

        if (!$book) {
            return $this->view->response("El libro con el id=$id no existe", 404);
        }

        $this->model->eraseBook($id);
        $this->view->response("El libro con el id=$id se elimino con exito");
    }


    public function create($req, $res) {
        if (empty($req->body->title) || empty($req->body->gender) || empty($req->body->pages) || empty($req->body->publisher) || empty($req->body->author)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $title = $req->body->title;       
        $gender = $req->body->gender;       
        $pages = $req->body->pages;    
        $publisher = $req->body->publisher; 
        $author = $req->body->author;    

        $id = $this->model->insertBook($title, $gender, $pages, $publisher, $author);

        if (!$id) {
            return $this->view->response("Error al insertar el libro", 500);
        }

        $task = $this->model->getBook($id);
        return $this->view->response($task, 201);
    }


    public function update($req, $res) {
        $id = $req->params->id;

        $book = $this->model->getBook($id);
        if (!$book) {
            return $this->view->response("El libro con el id=$id no existe", 404);
        }

        if (empty($req->body->title) || empty($req->body->gender) || empty($req->body->pages) || empty($req->body->publisher) || empty($req->body->author)) {
            return $this->view->response('Faltan completar datos', 400);
        }

        $title = $req->body->title;       
        $gender = $req->body->gender;       
        $pages = $req->body->pages;    
        $publisher = $req->body->publisher; 
        $author = $req->body->author;  

        $this->model->updateBooks($title, $gender, $pages, $publisher, $author, $id);

        $book = $this->model->getBook($id);
        $this->view->response($book, 200);
    }
}