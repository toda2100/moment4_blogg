<?php

//för hantering av bloggartiklar Tobias Dahlberg 2022. 

class Article
{
    //properties
    private $db;
    private $title;
    private $content;
    //private $username;

    function __construct()   //construct. 
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }

    //addera article

    public function addArticle(string $title, string $content, string $username): bool  
    {

        $username = $_SESSION['username'];  //skicka med vem som är användare. 
        //kolla sets
        if (!$this->setTitle($title)) return false;
        if (!$this->setContent($content)) return false;

        //sql fråga in i db
        
        $sql = "INSERT INTO articles(title, content, username)VALUES('" . $this->title . "','" . $this->content . "','" . $username . "');";

        // skicka med retur

        return mysqli_query($this->db, $sql);
    }

//uppdatera article

    public function updateArticle(int $id, string $title, string $content): bool {
        if (!$this->setTitle($title)) return false;
        if (!$this->setContent($content)) return false;

        $sql = "UPDATE articles SET title='" . $this->title . "' , content= '" . $this->content . "' WHERE id=$id;";

        return mysqli_query($this->db, $sql);
    }

 // hämta/get skriv ut

    //hämta en artikel för undersida exempelvis, get via Id. 
    public function getArticleById(int $id): array
    {
        $id = intval($id);
        $sql = "SELECT * FROM articles WHERE id=$id;";
        $data = mysqli_query($this->db, $sql);
        return $data->fetch_assoc();
    }

    public function getArticleByUser() : array { 
        
        $sql = "SELECT articles.id, articles.title, articles.content, articles.postade, users.name FROM articles INNER JOIN users ON articles.username=users.username WHERE name='" . $_GET['name'] . "' ORDER BY postade DESC;"; 
        $result = $this->db->query($sql);
        
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        
    }   

    public function getArticles(): array
    {
        //sqlfråga
        $sql = "SELECT articles.id, articles.title, articles.content, articles.postade, users.name FROM articles INNER JOIN users ON articles.username=users.username ORDER BY postade DESC;";
        $alldata = mysqli_query($this->db, $sql);

        return mysqli_fetch_all($alldata, MYSQLI_ASSOC);
    }

    public function getArticlebyUsername($username): array  
    {
        $username = $_SESSION['username'];        
        $sql = "SELECT articles.id, articles.title, articles.content, articles.postade FROM articles WHERE username='$username';"; 

        $alldata = mysqli_query($this->db, $sql);

        return mysqli_fetch_all($alldata, MYSQLI_ASSOC);

    }   

    //ta bort article 
    public function deleteArticle(int $id): bool
    {
        $id = intval($id);
        //sqlfråga
        $sql = "DELETE FROM articles WHERE id=$id;";
        //skicka
        return mysqli_query($this->db, $sql);
    }

    //setmetoder

    public function setTitle(string $title): bool
    {
        if ($title != "") {
            $this->title = $title;
            return true;
        } else {
            return false;
        }
    }

    public function setContent(string $content): bool
    {
        if ($content != "") {
            $this->content = $content;
            return true;
        } else {
            return false;
        }
    }

    //destruct
    function __destruct()
    {
        mysqli_close($this->db);
    }
} //slut



