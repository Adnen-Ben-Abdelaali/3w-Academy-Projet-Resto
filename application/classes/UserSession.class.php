<?php

class UserSession
{
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            // Démarrage du module PHP de gestion des sessions.
            session_start();
        }
    }

    public function create($userId, $firstName, $lastName, $email, $admin)
    {
        // Construction de la session utilisateur.
        
        $_SESSION["user"] = [
            "id" => $userId,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" =>  $email,
            "admin" =>  $admin
        ];
    }

    public function destroy()
    {
        // Destruction de l'ensemble de la session.

        if($this->isAuthenticated())
        {

            session_destroy();
        }
   
    }

    public function getEmail()
    {

        if( $this->isAuthenticated() ) 
        {
        
            return $_SESSION["user"]["email"]; 
        } 

        return "ddddd";
    }
    
    public function getAdmin()
    {

        if($this->isAuthenticated())
        {

            return $_SESSION["user"]["admin"];
        }
    }


    public function getFirstName() 
    {
        
        if($this->isAuthenticated())
        {

            return $_SESSION["user"]["firstName"];
        }
    }


    public function getFullName() 
    {
        
        if($this->isAuthenticated())
        {

            return $_SESSION["user"]["firstName"] ." " .$_SESSION["user"]["lastName"];
        }
    }


    public function getLastName() 
    {
        if($this->isAuthenticated())
        {

            return $_SESSION["user"]["lastName"];
        }
    }


    public function getUserId() 
    {
        
        if($this->isAuthenticated())
        {

            return $_SESSION["user"]["id"];
        }
    }


    public function isAuthenticated()
    {
        
        if( isset($_SESSION["user"]) ) 
        {

            return true;
        }

        return false;
    }
}