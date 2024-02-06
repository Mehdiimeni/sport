<?php
///controller/financial/remittance_add.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['remittance_title'];
    $description = $_POST['remittance_description'];

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

    





    $table_set = 'remittance_data';

    $arrData = [
        'remittance_title' => $_POST['remittance_title'],
        'remittance_description' => $_POST['remittance_description'],
        'user_id' => $_SESSION['user_id'],


    ];

    $unique_fields = [
        'remittance_title'
    ];


    $insertResult = $dbHandler->insertData($table_set, $arrData);

    $message = $insertResult['message'];
    $insert_id = $insertResult['insert_id'];
    // add file 

    $table_set = 'file_manage';

    $arrData = [
        'file_name' => $uploadedFile,
        'file_path' => $uploadDir,
        'file_title' => $_POST['remittance_title'],
        'user_id' => $_SESSION['user_id'],
        'part_id' => $insert_id,
        'part_name' => 'remittance'

    ];

    $unique_fields = [
        ''
    ];


    $insertResult = $dbHandler->insertData($table_set, $arrData);
    $message = $insertResult['message'];
    $insert_id = $insertResult['insert_id'];

    echo <<<HTML
    <script>
        alert('$message');
        if ('$message' === 'Data inserted successfully.') {
            window.location.replace('./remittance'); 
        }
    </script>
HTML;

}


/*


$updateData = [
    'name' => 'Updated Name',
    'email' => 'updated@example.com',
    // ... other fields ...
];

$whereCondition = 'id = 1'; // مثالی از شرایط برای انتخاب ردیف‌های مورد نظر

$resultUpdate = $dataHandler->updateData('users', $updateData, $whereCondition);
echo $resultUpdate;

// مثال برای حذف
$whereConditionDelete = 'id = 2'; // مثالی از شرایط برای انتخاب ردیف‌های مورد نظر

$resultDelete = $dataHandler->deleteData('users', $whereConditionDelete);
echo $resultDelete;

*/