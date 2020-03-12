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
       $_SESSION['user'] = [
        'Id' => $userId,
       'FirstName'=>$firstName,
       'LastName'=>$lastName,
       'Email'=>$email,
       'Admin'=>$admin
       
    ];
 
    }

    public function destroy()
    {
        session_destroy();
   
    }

    public function getEmail()
    {
        if($this->isAuthenticated()==true)
        {
           
        return $_SESSION['user']['Email'];
        }
        
    }
    
    public function getAdmin()
    {
        if($this->isAuthenticated()==true)
        {
       
        return $_SESSION['user']['Admin'];
        }
        
    }


    public function getFirstName() 
    {   //echo 'khaled';
        if($this->isAuthenticated()==true)
        {
            
        return $_SESSION['user']['FirstName'];
        }
    }


    public function getFullName() 
    {
        if($this->isAuthenticated()==true)
        {
        
        return $_SESSION['user']['lastName'].$_SESSION['user']['FirstName'];
        }
    }


    public function getLastName() 

    {   if($this->isAuthenticated()==true)
        {
        
        return $_SESSION['user']['lastName'];
        }
    }


    public function getUserId() 
    {   if($this->isAuthenticated()==true)
        {
        
        return $_SESSION['user']['Id'];
        }
    }


    public function isAuthenticated()
    {
        if (array_key_exists('user', $_SESSION) == true)
        {
            return true;

        }
        else return false;
    }
}