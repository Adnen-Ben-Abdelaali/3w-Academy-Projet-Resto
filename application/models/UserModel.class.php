<?php

class UserModel
{
	
   

    public function signUp($lastName,
                            $firstName,
                            $email,
                            $password,
                            $birthDate,
                            $address,
                            $city,
                            $country,
                            $zipCode,
                            $phone)
     {
        $baseUser = new Database();
        $user = $baseUser->queryOne('SELECT * FROM user WHERE email =?',[$email]);
        if(!empty($user))
        {
            throw new DomainException('un mail existant');

        }

        $sql ="INSERT INTO user (LastName,FirstName,Email,Password,Address,Birthdate,City,
        Country,ZipCode,Phone,CreationTimestamp)
        VALUES(?,?,?,?,?,?,?,?,?,?,NOW())";
        
        $hashed_password = password_hash($password,PASSWORD_BCRYPT);
           
        $baseUser->executeSql($sql,
        [$lastName,
        $firstName,
        $email,
        $hashed_password,
        $address,
        $birthDate,
        $city,
        $country,
        $zipCode,
        $phone]
    );

        $flashBag = new FlashBag();
        $flashBag->add("votre compte a été crée avec succès");
       
        

    }

 
	

}