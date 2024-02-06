<?php
///controller/user/tasks_details.php

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$ticket = new Ticket($db);

if (!empty($_GET['ticket_id']) && $_GET['ticket_id']) {
    $ticket->ticket_id = $_GET['ticket_id'];
}