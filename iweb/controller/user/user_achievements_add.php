<?php
///controller/user/user_achievements_add.php
$config = Configuration::getInstance();
$database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$allProvince = $user->getProvinceActive();
$allFederations = $user->getFederationActive();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['achievement_title'];
    $description = $_POST['achievement_description'];
    $provinces_id = $_POST['provinces_id'];
    $federations_id = $_POST['federations_id'];

    // Check if file is uploaded successfully

    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();
    $dbHandler = new DatabaseHandler($db);

    // Example usage:
    $uploadDir = './irepository/user/';
    $fileManager = new FileManager($db, $uploadDir);

    if (isset($_FILES['attach_file'])) {
        $uploadedFile = $fileManager->uploadFile($_FILES['attach_file']);

    }


    $table_set = 'user_achievement';

    $arrData = [
        'achievement_title' => $_POST['achievement_title'],
        'achievement_description' => $_POST['achievement_description'],
        'provinces_id' => $_POST['provinces_id'],
        'federations_id' => $_POST['federations_id'],
        'user_id' => $_SESSION['user_id'],


    ];

    $unique_fields = [
        'achievement_title'
    ];


    $insertResult = $dbHandler->insertData($table_set, $arrData);

    $message = $insertResult['message'];
    $insert_id = $insertResult['insert_id'];
    // add file 

    $table_set = 'file_manage';

    $arrData = [
        'file_name' => $uploadedFile,
        'file_path' => $uploadDir,
        'file_title' => $_POST['achievement_title'],
        'user_id' => $_SESSION['user_id'],
        'part_id' => $insert_id,
        'part_name' => 'achievement'

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
            window.location.replace('./user_achievements'); 
        }
    </script>
HTML;

}

