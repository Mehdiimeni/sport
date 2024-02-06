<?php
///controller/financial/remittance_form1_add.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    // Check if file is uploaded successfully

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();
    $dbHandler = new DatabaseHandler($db);

    // Example usage:
    $uploadDir = './irepository/financial/';
    $fileManager = new FileManager($db,$uploadDir);

    if (isset($_FILES['attach_file'])) {
        $uploadedFile = $fileManager->uploadFile($_FILES['attach_file']);

    }


    $table_set = 'remittance_form1';

    $arrData = [
        'priority' => $_POST['priority'],
        'beneficiary' => $_POST['beneficiary'],
        'addressAndTel' => $_POST['addressAndTel'],
        'ref' => $_POST['ref'],
        'bankName' => $_POST['bankName'],
        'bankAddress' => $_POST['bankAddress'],
        'swift' => $_POST['swift'],
        'iban' => $_POST['iban'],
        'accountNo' => $_POST['accountNo'],
        'amount' => $_POST['amount'],
        'CurrencyType' => $_POST['currency'],
        'remittancePurpose' => $_POST['remittancePurpose'],
        'paymentInstruction' => $_POST['paymentInstruction'],
        'licenseActivity' => $_POST['licenseActivity'],
        'cargoDescription' => $_POST['cargoDescription'],
        'user_id' => $_SESSION['user_id'],

    ];

    $unique_fields = [
        ''
    ];


    $insertResult = $dbHandler->insertData($table_set, $arrData);

    $message = $insertResult['message'];
    $insert_id = $insertResult['insert_id'];
    // add file 

    $table_set = 'file_manage';

    $arrData = [
        'file_name' => $uploadedFile,
        'file_path' => $uploadDir,
        'file_title' => date('Y-m-d H:i:s'),
        'user_id' => $_SESSION['user_id'],
        'part_id' => $insert_id,
        'part_name' => 'remittance_form1'

    ];

    $unique_fields = [
        ''
    ];

    if ($uploadedFile != '')
    $insertResult = $dbHandler->insertData($table_set, $arrData);
    $message = $insertResult['message'];
    $insert_id = $insertResult['insert_id'];

    echo <<<HTML
    <script>
        alert('$message');
        if ('$message' === 'Data inserted successfully.') {
            window.location.replace('./remittance_form1'); 
        }
    </script>
HTML;

}

