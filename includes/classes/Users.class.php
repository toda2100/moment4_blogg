<?php
//för inloggningen och nya användare. Tobias Dahlberg 2022. 

class Users {  //starttagg
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



// logga in användare som finns 



// kolla om användarnamn finns 



// get och set för user/pass och name. 



function loginUser($username, $password) {   
    if($username == "skribent" && $password == "letmein1") {
        $_SESSION['username'] = $username;
        return true;
    } else {
        return false;
    } 
} 

} //sluttagg



?>