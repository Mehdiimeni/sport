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
    $insert_id = $insertResult['insert_id'];
    // add file 

    echo <<<HTML
    <script>
   
            window.location.replace('./user_panel'); 
   
    </script>
HTML;

}