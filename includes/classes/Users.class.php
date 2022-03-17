<?php
//för inloggningen och nya användare. Tobias Dahlberg 2022. 

class Users
{  //starttagg
    //properties
    private $db;
    private $username;
    private $password;
    public  $name;

    function __construct()   //construct. 
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);   //anslut till db

        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }

    // ny användare
    public function registerUser($username, $password, $name)
    {
        if (!$this->setUsername($username)) return false;
        if (!$this->setPassword($password)) return false;
        if (!$this->setName($name)) return false;

        $username = $this->db->real_escape_string($username);               //tvätta sql för att minska riskt för injections. 
        $password = $this->db->real_escape_string($password);
        $name = $this->db->real_escape_string($name);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);          //hasha passw. 

        $sql = "INSERT INTO users(username, password, name)VALUES('$username', '$hashed_password', '$name');"; //sql för att skicka in i databas

        $result = $this->db->query($sql);                //skicka frågan 
        return $result;
    }

    // logga in användare som finns 
    function login($username, $password)  
    {

        $username = $this->db->real_escape_string($username);               //tvätta sql för att minska riskt för injections. 
        $password = $this->db->real_escape_string($password);

        $sql = "SELECT * FROM users WHERE username='$username';";           //hämta även namn?? lägg till upptill och sen är session lika med namn?
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {  //får vi någon respons så starta session

            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if (password_verify($password, $stored_password)) {

                $_SESSION['username'] = $username;  
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //kolla om användarnamnet finns 
    public function usernameExists($username)
    {
        $username = $this->db->real_escape_string($username);

        $sql = "SELECT username FROM users WHERE username= '$username';";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {  //får vi någon respons så finns användarnamnet 
            return true;
        } else {
            return false;
        }
    }

       /* public function getNameById(int $id): array
    {
        $id = intval($id);
        $sql = "SELECT * FROM articles WHERE id=$id;";
        $data = mysqli_query($this->db, $sql);
        return $data->fetch_assoc();
    } */

   //Get user by id
    public function getNameById(int $id): string
    {
        $sql = "SELECT name FROM users WHERE id=$id;";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row['name'];
    }

   public function getNameByUsername($username): string    //KÖR DEN OCH SKRIV UT SESSION? IF OSV 
    {
        $username = $_SESSION['username'];
        //$sql = "SELECT name FROM users WHERE ['username']=$username;";
        $sql ="SELECT name FROM users WHERE username='$username';"; 
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row['name']; 
    }    

    function getUsersByName(){
        $sql = "SELECT name FROM users ORDER BY username ASC";
        $result = $this->db->query($sql);
        
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
        
    }

   /*  public function getName(): string
    {    //vid behov
        return $this->name;
    } */

    public function getUsers(): array   
    {  //alla 
        //$sql = "SELECT * FROM users ORDER BY name ASC";   //vad händer om de inte har skrivit artikel? 
        $sql = "SELECT users.name, users.id, articles.title, articles.id, articles.content, articles.postade FROM users INNER JOIN articles ON users.username=articles.username ORDER BY name ASC"; 

        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC); 
    }

    // set för user/pass och name. 
    function setUsername(string $username): bool
    {

        if (strlen($username) > 4) { //innehåller tecken
            $this->username = $username;
            return true;
        }
        return false;
    }

    function setPassword(string $password): bool
    {

        if (strlen($password) > 4) { //innehåller minst 5 tecken
            $this->password = $password;
            return true;
        }
        return false;
    }

    function setName(string $name): bool
    {

        if (strlen($name) > 4) { //innehåller minst 5 tecken
            $this->name = $name;
            return true;
        }
        return false;
    }

    //destruct
    function __destruct()
    {
        mysqli_close($this->db);
    }
} //sluttagg
