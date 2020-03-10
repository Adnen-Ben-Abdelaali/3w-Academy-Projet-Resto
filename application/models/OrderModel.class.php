<?php

  class OrderModel
  {
    
    public function getOrders()
    {
      $dataBase = new Database();
  
      return $dataBase->query('SELECT * FROM `order`');
    }






  }
