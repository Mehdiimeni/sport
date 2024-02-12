<?php
///controller/financial/recharge.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];

    // Check if file is uploaded successfully

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();
    $dbHandler = new DatabaseHandler($db);



    $orderId = $_SESSION['user_id'] + date('YmdHis');


    $encoded_data = base64_encode(json_encode(array('amount' => $amount, 'user_id' => $_SESSION['user_id'] , 'orderId' =>$orderId , 'for' => 'recharge' )));

    $paymentService = new PaymentService('https://chairblog.ir/payment?data=' . $encoded_data);
    $payResult = json_decode($paymentService->sendPaymentRequest($amount, $orderId), 1);

    if ($payResult['status'] === 0) {


        $paymentService->confirmPayment($payResult['token']);
        $token = $payResult['token'];

        header('Location: https://pna.shaparak.ir/mhui/home/index/' . $token);
        exit;

    }

}


