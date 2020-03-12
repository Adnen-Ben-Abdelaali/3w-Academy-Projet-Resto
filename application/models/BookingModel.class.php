<?php
class BookingModel
{
    public function getAllBooking()
    {
        $db = new Database();
        $sql = 'SELECT `Id`,`BookingDate`,`BookingTime`,`NumberOfSeats`,`CreationTimestamp`, FROM `booking` ';
        
        return $orders = $db->query($sql);
    }

    public function creat( $BookingDate, $BookingTime, $NumberOfSeats,$userId)
    {
        $db = new Database();
        $sql ='INSERT INTO `booking`( 
          `BookingDate`, 
          `BookingTime`,
         `NumberOfSeats`,
          `User_Id`,
         `CreationTimestamp`)
        VALUES (?,?,?,?,NOW())';

        $db->executeSql($sql,array(
            
            $BookingDate,
            $BookingTime,
            $NumberOfSeats,
            $userId
        ));

        $flashbag= new FlashBag();
        $flashbag->add('votre commande a été envoyer avec succès');
    }
}