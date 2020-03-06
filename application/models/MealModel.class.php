<?php
  
  /*
 

  */


  class MealModel
  {

    public function listAll()
    {
      $database = new Database();

      $sql = "SELECT Photo, Name, Description, SalePrice FROM meal"; //requete sql
    
      return  $database->query($sql);
    

    }

  }