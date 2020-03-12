<?php

class UserModel
{
    public function getAllUser()
    {
        
        $db= new Database();
        $sql='SELECT `FirstName`,`LastName`,`BirthDate`,`Address`,`City`,`ZipCode`,`Country`,`Phone` FROM `user`';

        return $meals= $db->query($sql);


    }

    public function signUp($lastName,$firstName,$email,$password,$birthDate,$address,$city,$country,$zipCode,$phone)
    {
        $db= new Database();

        $user = $db->queryOne
        (
            'SELECT * FROM user WHERE Email = ?',[$email]);

        if(!empty($user))
        {
            throw new DomainException("incorect l'adresse email : ".$email."__   existe deja");
            addFormField($name, $value = null);
            
        }

       

        $sql='INSERT INTO `user`
        ( 
            `FirstName`,
            `LastName`,
            `BirthDate`,
            `Address`,
            `City`,
            `ZipCode`,
            `Country`,
            `Phone`,
            Email,
            `Password`,
            CreationTimestamp )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,?,  NOW())';

        $hashed_password = password_hash( $password, PASSWORD_BCRYPT );
        
        $db->executeSql($sql,array(
            $firstName,
            $lastName,
            $birthDate,
            $address,
            $city,
            $zipCode,
            $country,
            $phone,
            $email,
            $hashed_password,
        ));

        $flashbag= new FlashBag();
        $flashbag->add('votre compte a été crée avec succès')  ;  
    }
    
    public function find($userId)
    {
        $db= new Database();

        $user = $db->queryOne
        (
            'SELECT * FROM user WHERE Id = ?',[$userId]
        );
        return $user;
    }

    private function password_verify($password,$hashed_password)
    {
        return crypt($password,$hashed_password)== $hashed_password;
    }

    public function findWithEmailPassword($email,$password)
    {
        $db= new Database();

        $user = $db->queryOne('SELECT * FROM user WHERE Email = ?',[$email]);

        if(empty($user))
        {
            throw new DomainException(" Email invalid !");

            addFormField($name, $value = null);
        
        }

        if( $this->password_verify( $password, $user['Password'] ) == false )
        
        {
            throw new DomainException(" mot de passe incorect !");
        }
        
        return $user;
    }
    
    function updateLoginTimesLamp($userId)
    {
        $db= new Database();
    }

    
}