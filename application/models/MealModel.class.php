<?php

class MealModel
{
    public function getAllMeal()
    {
        
        $db= new Database();
        $sql='SELECT * FROM `meal`';

        return $meals= $db->query($sql);
    }
  
    public function creatMeal( $name,$photo,$description,$QuantityInStock,$BuyPrice,$salePrice)
    {
       
            $db = new database();
            $sql = ' INSERT INTO `meal` (
            `Name`,
            `Photo`,
            `Description`,
            `QuantityInStock`,
            `BuyPrice`,
            `SalePrice`) 
                VALUES (?,?,?,?,?,?)';
                
        $db->executeSql($sql,array( 
        $name,
        $photo,
        $description,
        $QuantityInStock,
        $BuyPrice,
        $salePrice 
    ));
        $flashbag= new FlashBag();
        $flashbag->add(' repat ajouter !!')  ;

       
        
    }

}