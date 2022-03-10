<?php

//för hantering av bloggartiklar Tobias Dahlberg 2022. 

class Article
{
    //properties
    private $db;
    private $title;
    private $content;

    function __construct()   //construct. 
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }

    //addera article

    public function addArticle(string $title, string $content): bool
    {
        //kolla sets
        if (!$this->setTitle($title)) return false;
        if (!$this->setContent($content)) return false;

        //sql fråga in i db

        $sql = "INSERT INTO articles(title, content)VALUES('" . $this->title . "','" . $this->content . "');";

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


    //hämta en artikel för undersida exempelvis, get via Id. 
    public function getArticleById(int $id): array
    {
        $id = intval($id);
        $sql = "SELECT * FROM articles WHERE id=$id;";
        $data = mysqli_query($this->db, $sql);
        return $data->fetch_assoc();
    }

    // hämta/get skriv ut

    public function getArticles(): array
    {
        //sqlfråga

        $sql = "SELECT * FROM articles ORDER BY postade DESC;";
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



// SQL-frågan bli liknande ”GET * FROM users WHERE username = username”. Eller user_id om du hellre kör på det.
// Ska du skapa ett inlägg så har du ju då inloggad användare i en Sessions-variabel du kan skicka med till databasen.