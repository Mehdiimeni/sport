<?php
///controller/user/payment.php



$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);


$encoded_data = $_GET['data'];
$decoded_data = base64_decode($encoded_data);
$data = json_decode($decoded_data, true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $amount_str = $_POST['Amount'];
    $amount_int = (int) str_replace(',', '', $amount_str);

    $orderId = (int) $_POST['OrderId'];



    if (($amount_int != $data["amount"]) or ($orderId != $data["orderId"])) {
        exit;
    }



    // Check if file is uploaded successfully

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();
    $dbHandler = new DatabaseHandler($db);


    $table_set = 'payment_data';

    $arrData = [
        'user_id' => $data['user_id'],
        'Amount' => $data['amount'],
        'orderId' => $data['orderId'],
        'forSet' => $data['for'],
        'Token' => $_POST['Token'],
        'TerminalNo' => $_POST['TerminalNo'],
        'RRN' => $_POST['RRN'],
        'status' => $_POST['status'],
        'TspToken' => $_POST['TspToken'],
        'HashCardNumber' => $_POST['HashCardNumber'],
        'SwAmount' => $_POST['SwAmount'],
        'STraceNo' => $_POST['STraceNo'],

    ];

    $unique_fields = [
        'orderId'
    ];


    $insertResult = $dbHandler->insertData($table_set, $arrData);

    $paymentService = new PaymentService();
    $paymentService->confirmPayment($_POST['Token']);


    echo <<<HTML
    <script>
   
            window.location.replace('./user_panel'); 
       
    </script>
HTML;


}

?>