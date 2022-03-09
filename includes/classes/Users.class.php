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
        $username = $this->db->real_escape_string($username);               //tvätta sql för att minska riskt för injections. 
        $password = $this->db->real_escape_string($password);
        $name = $this->db->real_escape_string($name);

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(username, password, name)VALUES('$username', '$hashed_password', '$name');"; //sql för att skicka in i databas

        $result = $this->db->query($sql);                //skicka frågan 
        return $result;
    }

    // logga in användare som finns 
    function login($username, $password)
    {
        $username = $this->db->real_escape_string($username);               //tvätta sql för att minska riskt för injections. 
        $password = $this->db->real_escape_string($password);

        $sql = "SELECT * FROM users WHERE username='$username';";
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


    // get och set för user/pass och name. kanske id är namn? och då köra namnet finns. skilja på bloggare? 


} //sluttagg
