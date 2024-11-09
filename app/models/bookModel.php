<?php
require_once 'model.php';

class bookModel extends model{

    public function getBooksByAuthor($id) {
        $query = $this->db->prepare('SELECT libros.*, autores.Nombre AS AutorNombre FROM libros JOIN autores ON libros.Autor = autores.id WHERE autores.id = ?');
        $query->execute([$id]);
    
        $books = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $books;
    }
 
    public function getBooks($Autor = null, $orderBy = false) {
        $sql = 'SELECT libros.*, autores.Nombre AS AutorNombre FROM libros JOIN autores ON libros.Autor = autores.id';

        if($Autor != null) {
            $sql .= " WHERE Autor = $Autor";
        }

        if($orderBy) {
            switch($orderBy) {
                case 'Titulo':
                    $sql .= ' ORDER BY Titulo';
                    break;
                case 'Genero':
                    $sql .= ' ORDER BY Genero';
                    break;
                case 'Autor':
                    $sql .= ' ORDER BY Autor';
                    break;
                case 'CantidadPaginas':
                    $sql .= ' ORDER BY CantidadPaginas';
                    break;
                case 'Editorial':
                    $sql .= ' ORDER BY Editorial';
                    break;
            }
        }

        $query = $this->db->prepare($sql);
        $query->execute();
    
        $books = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $books;
    }

    public function getInfo($id) {    
        $query = $this->db->prepare('SELECT libros.*, autores.Nombre FROM libros JOIN autores ON libros.Autor = autores.id WHERE libros.id = ?');
        $query->execute([$id]);   
    
        $info = $query->fetch(PDO::FETCH_OBJ);
    
        return $info;
    }

    public function getBook($id) {    
        $query = $this->db->prepare('SELECT * FROM libros WHERE id = ?');
        $query->execute([$id]);   
    
        $book = $query->fetch(PDO::FETCH_OBJ);
    
        return $book;
    }

    public function insertBook($title, $gender, $pages, $publisher, $author) { 
        $query = $this->db->prepare('INSERT INTO libros(Titulo, Genero, CantidadPaginas, Editorial, Autor) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$title, $gender, $pages, $publisher, $author]);
    
        $id = $this->db->lastInsertId();
    
        return $id;
    }
 
    public function eraseBook($id) {
        $query = $this->db->prepare('DELETE FROM libros WHERE id = ?');
        $query->execute([$id]);
    }
    
    public function updateBooks($title, $gender, $pages, $publisher, $author, $id) { 
        $query = $this->db->prepare('UPDATE libros SET Titulo = ?, Genero = ?, CantidadPaginas = ?, Editorial = ?, Autor = ? WHERE id = ?');
        $query->execute([$title, $gender, $pages, $publisher, $author, $id]);
    
        return $id;
    }
}