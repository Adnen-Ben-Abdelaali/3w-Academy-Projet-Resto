<?php
class AdminController 

{

    public function httpGetMethod(Http $http)
    {
        $usersession = new UserSession();
        if($usersession->getAdmin()!= 1)
        {
            $http->redirectTo('/user/login');
        }

        $orderModel = new OrderModel();
        $orders=$orderModel->getAllOrder();

        return 

        [
             'orders' => $orders
        ];


    }
}