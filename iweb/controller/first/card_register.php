<?php
///controller/first/card_register.php
$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);


if (!$user->loggedIn()) {
    echo "<script>window.location.replace('./login');</script>";
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $national_id = $_POST['national_id'];
    $identity_card = $_POST['identity_card'];
    $address = $_POST['address'];

    // Check if file is uploaded successfully

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();
    $dbHandler = new DatabaseHandler($db);


    $table_set = 'card_register';
    $amount = 2000000;

    $arrData = [
        'national_id' => $_POST['national_id'],
        'identity_card' => $_POST['identity_card'],
        'address' => $_POST['address'],
        'user_id' => $_SESSION['user_id'],

    ];

    $unique_fields = [
        'national_id'
    ];


    $insertResult = $dbHandler->insertData($table_set, $arrData);



    $message = $insertResult['message'];
    $orderId = $insertResult['insert_id'] + date('YmdHis');


    $encoded_data = base64_encode(json_encode(array('amount' => $amount, 'user_id' => $_SESSION['user_id'] , 'orderId' =>$orderId , 'for' => 'register' )));

    $paymentService = new PaymentService('https://intek.ir/varzesh/payment?data=' . $encoded_data);
    $payResult = json_decode($paymentService->sendPaymentRequest($amount, $orderId), 1);

    if ($payResult['status'] === 0) {


        $paymentService->confirmPayment($payResult['token']);
        $token = $payResult['token'];




        header('Location: https://pna.shaparak.ir/mhui/home/index/' . $token);
        exit;

    }


}