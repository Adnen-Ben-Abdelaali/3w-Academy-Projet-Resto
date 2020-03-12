<?php

class OrderModel
{
    public function getAllOrder()
    {
        $db= new Database();
        $sql='SELECT * FROM `order`';

        return $orders = $db->query($sql);
    }

    
}