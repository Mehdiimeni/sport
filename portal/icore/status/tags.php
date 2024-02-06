<?php

require_once "../class/mysql.php";
require_once "../class/config.php";

try {
    $config = Configuration::getInstance();
    $database = Database::getInstance($config);
    $db = $database->getConnection();

    $stmt = $db->prepare("SELECT
        tags.tag_name,
        COUNT(ticket_tags.tag_id) AS tag_count
        FROM
        tags
        LEFT JOIN
        ticket_tags ON tags.id = ticket_tags.tag_id
        GROUP BY
        tags.id");

    $stmt->execute();

    $tagNames = [];
    $tagCounts = [];

    $stmt->bind_result($tagName, $tagCount);

    while ($stmt->fetch()) {
        $tagNames[] = $tagName;
        $tagCounts[] = $tagCount;
    }

    $data = array(
        'tagNames' => $tagNames,
        'tagCounts' => $tagCounts
    );

    header('Content-Type: application/json');
    echo json_encode($data);
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => $e->getMessage()]);
}

?>