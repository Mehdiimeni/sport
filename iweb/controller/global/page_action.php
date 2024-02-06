<?php
///controller/global/page_action.php

include "../../../icore/class/mysql.php";
include "../../../icore/model/user.php";
include "../../../icore/model/ticket.php";

$config = Configuration::getInstance();
    $database = Database::getInstance($config);
$db = $database->getConnection();

$user = new User($db);
$ticket = new Ticket($db);

if (!$user->loggedIn()) {
	echo "<script>window.location.replace('./login');</script>";

}


if(!empty($_POST['action']) && $_POST['action'] == 'createTicket') {

	$ticket->subject = $_POST["subject"];
	$ticket->unit_id = $_POST["unit_id"];
    $ticket->message = $_POST["message"];    
	$ticket->insert();

}


if(!empty($_POST['action']) && $_POST['action'] == 'replyTicket') {
	$ticket->ticketId = $_POST["ticketId"];
	$ticket->replyMessage = $_POST["message"];
	$ticket->replyTags = $_POST["tags"];
	$ticket->saveTicketReply();
} 

if(!empty($_POST['action']) && $_POST['action'] == 'mentionUser') {
	$ticket->mentionTicketId = $_POST["mentionTicketId"];
	$ticket->mentionUser = $_POST["mentionUser"];
	$ticket->mentionUser();
}

if(!empty($_POST['action']) && $_POST['action'] == 'removeMentionEmail') {
	$ticket->mentionTicketId = $_POST["mentionTicketId"];
	$ticket->mentionEmail = $_POST["mentionEmail"];
	$ticket->removeMentionEmail();
}

if(!empty($_POST['action']) && $_POST['action'] == 'openTicket') {
	$ticket->ticketId = $_POST["ticketId"];
	$ticket->openTicket();
}

if(!empty($_POST['action']) && $_POST['action'] == 'closeTicket') {
	$ticket->ticketId = $_POST["ticketId"];
	$ticket->closeTicket();
}

?>
