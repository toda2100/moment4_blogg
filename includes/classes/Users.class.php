<?php
//för inloggningen och nya användare. Tobias Dahlberg 2022. 

class Users
{  //starttagg
    //properties
    private $db;
    private $username;
    private $password;
    public  $name;
    public  $lastname;

    function __construct()   //construct. 
    {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);   //anslut till db

        if ($this->db->connect_errno > 0) {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }

    // ny användare
    public function registerUser($username, $password, $name, $lastname)
    {
        if (!$this->setUsername($username)) return false;                   //hämta från set. 
        if (!$this->setPassword($password)) return false;
        if (!$this->setName($name)) return false;
        if (!$this->setLastName($lastname)) return false;

        $username = $this->db->real_escape_string($username);               //tvätta sql för att minska riskt för injections. 
        $password = $this->db->real_escape_string($password);
        $name = $this->db->real_escape_string($name);
        $lastname = $this->db->real_escape_string($lastname);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);          //hasha passw. 

        $sql = "INSERT INTO users(username, password, name, lastname)VALUES('$username', '$hashed_password', '$name', '$lastname');"; //sql för att skicka in i databas

        $result = $this->db->query($sql);                //skicka frågan 
        return $result;
    }

    // logga in användare som finns 
    function login($username, $password)
    {

        $username = $this->db->real_escape_string($username);               //tvätta sql för att minska riskt för injections. 
        $password = $this->db->real_escape_string($password);

        $sql = "SELECT * FROM users WHERE username='$username';";           //sql-frågan
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {  //får vi någon respons så starta session

            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if (password_verify($password, $stored_password)) {             //verifera lösen. 

                $_SESSION['username'] = $username;          //starta session om ok. 
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

        $sql = "SELECT username FROM users WHERE username= '$username';";  //jämför via frågan. 

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {  //får vi någon respons så finns användarnamnet dvs false
            return true;
        } else {
            return false;
        }
    }

    //Get user  via id
    public function getNameById(int $id): string            
    {
        $sql = "SELECT name FROM users WHERE id=$id;";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row['name'];
    }

    //Get user via username
    public function getNameByUsername($username): string    //
    {
        //$username = $_SESSION['username'];
        $sql = "SELECT name FROM users WHERE username='$username';";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        return $row['name'];
    }

    //Get user via name
    function getUsersByName()
    {
        $sql = "SELECT name, lastname FROM users ORDER BY username ASC";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    //Get alla Users 
    public function getUsers(): array
    {  //alla, SQL med join till artiklar samt i viss ordning 
        $sql = "SELECT users.name, users.id, articles.title, articles.id, articles.content, articles.postade FROM users INNER JOIN articles ON users.username=articles.username ORDER BY name ASC";

        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Sets för user/pass och name. 
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

        if (strlen($name) > 2 && !strrpos($name, ' ')) { //innehåller minst 3 tecken och inga mellanslag!
            $this->name = $name;
            return true;
        }
        return false;
    }

    function setLastName(string $lastname): bool
    {

        if (strlen($lastname) > 4 && !strrpos($lastname, ' ')) { //innehåller minst 5 tecken och inga mellanslag!
            $this->lastname = $lastname;
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
