<?php
///controller/financial/remittance_form2_details.php

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$financial = new Financial($db);
$comment = new Comment($db);
$rbac = new RBAC($db);
$structure = new Structure($db);

$id = $_GET['id'];
$part_name = 'remittance_form2';
$comment->part_name = $part_name;
$comment->part_id = $id;

$remittanceDetail = $financial->getRemittanceF2ById($id)->fetch_assoc();
$remittanceAgent = $financial->getRemittanceF4ById($remittanceDetail['agent_id'])->fetch_assoc();
$userProfile = $user->getUserImageById($remittanceDetail['user_id']);

function getValue($fieldName, $remittanceDetail)
{
    return isset($remittanceDetail[$fieldName]) ? $remittanceDetail[$fieldName] : '';
}

$allComments = $comment->getCommentPart();

$uploadDir = './irepository/financial/';
$fileManager = new FileManager($db, $uploadDir);

$dbHandler = new DatabaseHandler($db);

$allFileData = $fileManager->getFileManageByPart($id, $part_name);

$allFileInfo = array();
if ($allFileData && $allFileData->num_rows > 0) {
    while ($fileData = $allFileData->fetch_assoc()) {

        $allFileInfo[] = $fileManager->getFileInfoFromPath($fileData['file_path'] . $fileData['file_name'], $fileData['file_path'], $fileData['file_title']);
    }
}





if (isset($_GET['file']) && !empty($_GET['file'])) {
    $fileManager->fileDownload($_GET['file']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (isset($_FILES['attach_file'])) {
        $uploadedFile = $fileManager->uploadFile(
            
            
        );
        $file_title = $_POST['file_title'];
        $table_set = 'file_manage';
        $arrData = [
            'file_name' => $uploadedFile,
            'file_path' => $uploadDir,
            'file_title' => $file_title,
            'user_id' => $_SESSION['user_id'],
            'part_id' => $remittanceDetail['id'],
            'part_name' => $part_name

        ];

        $unique_fields = [
            ''
        ];

        if ($uploadedFile != '')
            $dbHandler->insertData($table_set, $arrData);


    }


    if (isset($_POST['comment_text']) && !empty($_POST['comment_text'])) {

        $comment_text = $_POST['comment_text'];
        $parent_id = $_POST['parent_id'] ?? null;

        $dbHandler = new DatabaseHandler($db);


        $table_set = 'comments';

        $arrData = [
            'comment_text' => $comment_text,
            'part_name' => $part_name,
            'part_id' => $id,
            'user_id' => $_SESSION['user_id'],
        ];

        if ($parent_id != null)
            $arrData['parent_id'] = $parent_id;

        if (isset($_POST['local']) && !empty($_POST['local']))
            $arrData['company_id'] = $structure->getCompanyByUnitId($_SESSION['unit_id']);

        $unique_fields = [];


        $insertResult = $dbHandler->insertData($table_set, $arrData);

        $message = $insertResult['message'];
        $insert_id = $insertResult['insert_id'];
        echo <<<HTML
    <script>
        alert('$message');
        if ('$message' === 'Data inserted successfully.') {
            window.location.replace('remittance?id='+$id); 
  
        }
    </script>
HTML;
    }

}


