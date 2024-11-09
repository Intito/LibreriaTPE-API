<?php
require_once 'model.php';

class AuthorModel extends model{

    public function getAuthors() {
        $query = $this->db->prepare('SELECT * FROM autores');
        $query->execute();
        $authors = $query->fetchAll(PDO::FETCH_OBJ); 
        return $authors;
    }

    function getAuthorById($id) {
        $query = $this->db->prepare('SELECT * FROM autores WHERE id = ?');
        $query->execute([$id]);
        $author = $query->fetch(PDO::FETCH_OBJ);
        return $author;
    }

    function deleteAuthor($id) {
        $query = $this->db->prepare("DELETE FROM autores WHERE id = ?");
        $query->execute([$id]);
    }

    function insertAuthor($name,$gender,$date,$awards) {
        $query = $this->db->prepare("INSERT INTO autores(Nombre, Premiaciones, GeneroDestacado, FechaNacimiento) VALUES (?, ?, ?, ?)");
        $query->execute([$name, $awards, $gender, $date]);
    }

    function updateAuthor($gender,$awards,$id) {
        $query = $this->db->prepare('UPDATE autores SET GeneroDestacado = ?, Premiaciones = ? WHERE id = ?');
        $query->execute([$gender,$awards,$id]);
    }
}