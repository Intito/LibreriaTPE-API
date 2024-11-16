<?php
require_once './app/models/authorModel.php';
require_once './app/views/JSONView.php';

class AuthorApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new authorModel();
        $this->view = new JSONView();
    }

    function getAll($req, $res) {
        $gender = null;
        if(isset($req->query->GeneroDestacado))
            $gender = $req->query->GeneroDestacado;
        
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $sort = null;
        if (isset($req->query->sort)) 
            $sort = $req->query->sort;

        $authors = $this->model->getAuthors($gender, $orderBy, $sort);
        return $this->view->response($authors);
    }

    function get($req, $res) {
        $id = $req->params->id;

        $author = $this->model->getAuthor($id);
        if(!$author) {
            return $this->view->response("El autor con id : $id no existe", 404);
        }

        return $this->view->response($author);
    }

    function delete($req, $res) {
        $id = $req->params->id;

        $author = $this->model->getAuthor($id);
        if(!$author) {
            return $this->view->response("El autor con id : $id no existe", 404);
        }

        $this->model->deleteAuthor($id);
        $this->view->response("El autor con id : $id se elimino con exito");
    }

    function create($req, $res) {
        if (empty($req->body->GeneroDestacado) || empty($req->body->Nombre) || empty($req->body->FechaNacimiento) || empty($req->body->Premiaciones)){
            return $this->view->response('Faltan datos',400);
        }

        $name = $req->body->Nombre;
        $gender = $req->body->GeneroDestacado;
        $date = $req->body->FechaNacimiento;
        $awards = $req->body->Premiaciones;

        $id = $this->model->insertAuthor($name,$gender,$date,$awards);
        if(!$id)
            return $this->view->response('No se pudo crear el autor',500);
        
        $author = $this->model->getAuthor($id);
        return $this->view->response($author,201);
    }



    function update($req, $res) {
        $id = $req->params->id;

        $author = $this->model->getAuthor($id);
        if(!$author) {
            return $this->view->response("El autor con id : $id no existe", 404);
        }

        if (empty($req->body->GeneroDestacado) || empty($req->body->Premiaciones)){
            return $this->view->response('Faltan datos',400);
        }

        $gender = $req->body->GeneroDestacado;
        $awards = $req->body->Premiaciones;

        $this->model->updateAuthor($gender,$awards,$id);

        $author = $this->model->getAuthor($id);
        return $this->view->response($author);
    }
}