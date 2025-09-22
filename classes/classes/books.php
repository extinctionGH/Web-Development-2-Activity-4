<?php

require_once "database.php";

class Books{
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publication_year = "";

    protected $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function addBook(){
        $sql = "INSERT INTO library (title, author, genre, publication_year) VALUES (:title, :author, :genre, :publication_year)";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);

        return $query->execute();
    }

    public function viewBook($search = "", $genre = ""){
        $sql = "SELECT * FROM library WHERE 1";
        $params = [];

        if(!empty($search)){
            $sql .= " AND title LIKE :search";
            $params[':search'] = "%" . $search . "%";
        }

        if(!empty($genre)){
            $sql .= " AND genre = :genre";
            $params[':genre'] = $genre;
        }

        $sql .= " ORDER BY title ASC";
        
        $query = $this->db->connect()->prepare($sql);

        if($query->execute($params)){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return [];
        }
    }
}