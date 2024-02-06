<?php
///controller/financial/remittance_form4_add.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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


    $table_set = 'remittance_form4';

    $arrData = [
        'name' => $_POST['name'],
        'mobile' => $_POST['mobile'],
        'description' => $_POST['description'],
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
        'part_name' => 'remittance_form4'

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
            window.location.replace('./remittance_form4'); 
        }
    </script>
HTML;

}

