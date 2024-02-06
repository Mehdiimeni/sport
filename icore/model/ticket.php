<?php


#[AllowDynamicProperties]
class Ticket
{

	private $ticketsTable = 'tickets';
	private $tagsTable = 'tags';
	private $ticketTagsTable = 'ticket_tags';
	private $ticketReplyTable = 'ticket_replies';
	private $companyTable = 'company_profiles';
	private $unitTable = 'units';
	private $userTable = 'users';
	private $conn;


	public function __construct($db)
	{
		$this->conn = $db;

		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

	}

	public function insert()
	{

		if ($this->subject && $this->message) {

			$stmt = $this->conn->prepare("
			INSERT INTO " . $this->ticketsTable . "(`title`, `message`, `user_id`, `unit_id`)
			VALUES(?,?,?,?)");

			$this->subject = htmlspecialchars(strip_tags($this->subject));
			$this->message = htmlspecialchars(strip_tags($this->message));
			$this->unit_id = htmlspecialchars(strip_tags($this->unit_id));

			$stmt->bind_param("ssii", $this->subject, $this->message, $_SESSION["user_id"], $this->unit_id);

			if ($stmt->execute()) {
				return true;
			}
		}
	}

	public function getTicket()
	{
		$sqlWhere = '';


		$status = 'open';
		$order = ' ORDER BY id ASC';
		if (!empty($this->status) && $this->status == 'closed') {
			$status = 'closed';
		} elseif (!empty($this->order) && $this->order == 'oldest') {
			$order = ' ORDER BY id ASC';
		}

		if (!empty($this->mentioned) && $this->mentioned) {
			$sqlWhere .= " AND ticket.mentioned like '%" . $this->mentioned . "%'";
		} else if (!empty($this->user_id)) {


			$sqlWhere = " AND ticket.user_id = '" . $this->user_id . "'";
		}


		if ($_SESSION["role"] != 'admin') {


			$unit_id = $_SESSION["unit_id"];
			$user_id = $_SESSION["user_id"];
			$sqlWhere .= " AND ( ticket.user_id = '" . $user_id . "' OR  ticket.unit_id = '$unit_id' )";
		}

		if (!empty($this->status) && $this->status == 'answer') {

			$sqlQuery = "SELECT
			ticket.id,
			ticket.title,
			ticket.message,
			ticket.unit_id,
			ticket.created,
			ticket.status,
			user.name,
			MAX(replies.last_updated_date) AS last_reply_date
		FROM
			tickets ticket
		LEFT JOIN
			users user ON user.id = ticket.user_id
		LEFT JOIN
			units unit ON unit.id = ticket.unit_id
		LEFT JOIN
			ticket_replies replies ON replies.ticket_id = ticket.id
		WHERE
		ticket.status = 'open' " . $sqlWhere . "
		GROUP BY
			ticket.id
		HAVING
			last_reply_date IS NOT NULL 
		ORDER BY
			last_reply_date DESC;
		";


		} elseif(!empty($this->status) && $this->status == 'answer') {


			$sqlQuery = "SELECT
			ticket.id,
			ticket.title,
			ticket.message,
			ticket.unit_id,
			ticket.created,
			ticket.status,
			user.name,
			MAX(replies.last_updated_date) AS last_reply_date
		FROM
			tickets ticket
		LEFT JOIN
			users user ON user.id = ticket.user_id
		LEFT JOIN
			units unit ON unit.id = ticket.unit_id
		LEFT JOIN
			ticket_replies replies ON replies.ticket_id = ticket.id
		WHERE
		ticket.status = 'open' " . $sqlWhere . "
		GROUP BY
			ticket.id
		HAVING
			last_reply_date IS  NULL 
		ORDER BY
			last_reply_date DESC;
		"; 
		}else{

			$sqlQuery = "
			SELECT ticket.id, ticket.title, ticket.message, ticket.unit_id, ticket.created, ticket.status, user.name
			FROM " . $this->ticketsTable . " ticket
			LEFT JOIN " . $this->userTable . " user ON user.id = ticket.user_id
			LEFT JOIN " . $this->unitTable . " unit ON unit.id = ticket.unit_id
			WHERE ticket.status = '" . $status . "' $sqlWhere $order";

		}

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}


	public function getTicketDetail()
	{
		if ($_SESSION["user_id"] && $this->ticket_id) {
			$sqlQuery = "
    SELECT 
        ticket.id, 
        ticket.title, 
        ticket.message, 
        ticket.user_id, 
        ticket.mentioned, 
        ticket.created, 
        reply.created_by, 
        ticket.status, 
        user.name AS ticket_creator_name, 
        reply.comments, 
        reply.created AS reply_date,
        reply.id AS reply_id,
        reply_user.name AS reply_creator_name
    FROM " . $this->ticketsTable . " ticket
    LEFT JOIN " . $this->ticketReplyTable . " reply ON ticket.id = reply.ticket_id
    LEFT JOIN " . $this->userTable . " user ON user.id = ticket.user_id
    LEFT JOIN " . $this->userTable . " reply_user ON reply_user.id = reply.created_by
    WHERE ticket.id = '" . $this->ticket_id . "' ORDER BY reply_date DESC";

			$stmt = $this->conn->prepare($sqlQuery);
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
	}

	public function getTicketTags($reply_id)
	{
		if (!$reply_id) {
			return false;
		}
	
		$query = "SELECT tags.tag_name FROM ticket_tags
				  INNER JOIN tags ON ticket_tags.tag_id = tags.id
				  WHERE ticket_tags.ticket_id = ?";
	
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $reply_id);
		$stmt->execute();
		$result = $stmt->get_result();
	
		$tags = [];
	
		while ($row = $result->fetch_assoc()) {
			$tags[] = $row['tag_name'];
		}
	
		return $tags;
	}
	
	


	function getTicketCountWithStatus($status)
	{
		$sqlWhere = '';


		if ($_SESSION["role"] != 'admin') {


			$unit_id = $_SESSION["unit_id"];
			$user_id = $_SESSION["user_id"];
			$sqlWhere .= " AND ( user_id = '" . $user_id . "' OR  unit_id = '$unit_id' )";
		}

		$stmt = $this->conn->prepare("SELECT count(*) AS total
		FROM " . $this->ticketsTable . " 
		WHERE status = ? $sqlWhere");
		$stmt->bind_param("s", $status);
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();
		return $reply['total'];

	}


	function getTicketCountWithAnswer()
	{
		$sqlWhere = '';


		if ($_SESSION["role"] != 'admin') {


			$unit_id = $_SESSION["unit_id"];
			$user_id = $_SESSION["user_id"];
			$sqlWhere .= " And ( user_id = '" . $user_id . "' OR  unit_id = '$unit_id' )";
		}



		$stmt = $this->conn->prepare("SELECT COUNT(DISTINCT t.id) AS total
		FROM tickets t
		LEFT JOIN ticket_replies tr ON t.id = tr.ticket_id
		WHERE tr.ticket_id IS NOT NULL and t.status = 'open' " . $sqlWhere);
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();
		return $reply['total'];

	}

	function getTicketCountWithOutAnswer()
	{
		$sqlWhere = '';


		if ($_SESSION["role"] != 'admin') {


			$unit_id = $_SESSION["unit_id"];
			$user_id = $_SESSION["user_id"];
			$sqlWhere .= " And ( user_id = '" . $user_id . "' OR  unit_id = '$unit_id' )";
		}



		$stmt = $this->conn->prepare("SELECT COUNT(DISTINCT t.id) AS total
		FROM tickets t
		LEFT JOIN ticket_replies tr ON t.id = tr.ticket_id
		WHERE tr.ticket_id IS NULL and t.status = 'open' " . $sqlWhere);
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();
		return $reply['total'];

	}


	public function getReplyCount()
	{
		if ($this->id) {
			$stmt = $this->conn->prepare("SELECT count(*) AS total
			FROM " . $this->ticketReplyTable . " 
			WHERE ticket_id = ?");
			$stmt->bind_param("i", $this->ticket_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$reply = $result->fetch_assoc();
			return $reply['total'];
		}
	}


	function saveTicketReply()
	{

		if ($_SESSION["user_id"] && $this->ticketId && $this->replyMessage) {

			$stmt = $this->conn->prepare("
			INSERT INTO " . $this->ticketReplyTable . "(`ticket_id`, `comments`, `created_by`)
			VALUES(?,?,?)");

			$this->replyMessage = htmlspecialchars(strip_tags($this->replyMessage));
			$this->ticketId = htmlspecialchars(strip_tags($this->ticketId));

			$stmt->bind_param("iss", $this->ticketId, $this->replyMessage, $_SESSION["user_id"]);

			if ($stmt->execute()) {
				$insertedId = $this->conn->insert_id;
				foreach ($this->replyTags as $tag) {
					$stmt = $this->conn->prepare("
			INSERT INTO " . $this->ticketTagsTable . "(`ticket_id`, `tag_id`)
			VALUES(?,?)");

					$stmt->bind_param("ii", $insertedId, $tag);

					$stmt->execute();
				}
				return true;
			}
		}

	}


	function openTicket()
	{
		if ($_SESSION["user_id"] && $this->ticketId) {

			$stmt = $this->conn->prepare("
			UPDATE " . $this->ticketsTable . " 
			SET status = 'open' 
			WHERE id = ?");

			$this->ticketId = htmlspecialchars(strip_tags($this->ticketId));

			$stmt->bind_param("i", $this->ticketId);

			if ($stmt->execute()) {
				return true;
			}
		}
	}

	function closeTicket()
	{
		if ($_SESSION["user_id"] && $this->ticketId) {

			$stmt = $this->conn->prepare("
			UPDATE " . $this->ticketsTable . " 
			SET status = 'closed' 
			WHERE id = ?");

			$this->ticketId = htmlspecialchars(strip_tags($this->ticketId));

			$stmt->bind_param("i", $this->ticketId);

			if ($stmt->execute()) {
				return true;
			}
		}
	}

	function mentionUser()
	{
		if ($_SESSION["user_id"] && $this->mentionUser) {

			$stmt = $this->conn->prepare("
			UPDATE " . $this->ticketsTable . " 
			SET mentioned = CONCAT(mentioned,',$this->mentionUser')
			WHERE id = ?");

			$this->mentionTicketId = htmlspecialchars(strip_tags($this->mentionTicketId));

			$stmt->bind_param("i", $this->mentionTicketId);

			if ($stmt->execute()) {
				return true;
			}
		}
	}

	function removeMentionEmail()
	{
		if ($_SESSION["user_id"] && $this->mentionTicketId && $this->mentionEmail) {

			$stmt = $this->conn->prepare("
			UPDATE " . $this->ticketsTable . " 
			SET mentioned = REPLACE(mentioned, '" . $this->mentionEmail . "', '')
			WHERE id = ?");

			$this->mentionTicketId = htmlspecialchars(strip_tags($this->mentionTicketId));

			$stmt->bind_param("i", $this->mentionTicketId);

			if ($stmt->execute()) {
				return true;
			}
		}
	}


	function getTags()
	{
		$sqlQuery = "
				SELECT id,tag_name 
				FROM " . $this->tagsTable;
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}


	function getMentionUser()
	{
		if ($this->ticket_id) {
			$sqlQuery = "
				SELECT mentioned 
				FROM " . $this->ticketsTable . " 
				WHERE id = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$this->ticket_id = htmlspecialchars(strip_tags($this->ticket_id));
			$stmt->bind_param("i", $this->ticket_id);
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
	}

	function getTicketCount()
	{

		$sqlWhere = '';


		if ($_SESSION["role"] != 'admin') {


			$unit_id = $_SESSION["unit_id"];
			$user_id = $_SESSION["user_id"];
			$sqlWhere .= " AND ( 
				user_id = '" . $user_id . "' OR  unit_id = '$unit_id' )";
		}

		$sqlQuery = "
		SELECT * FROM " . $this->ticketsTable . " 
		WHERE status = 'open' $sqlWhere";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows;
	}

	function getTicketAllCount()
	{

		$stmt = $this->conn->prepare("SELECT count(*) AS total
		FROM " . $this->ticketsTable . " WHERE 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();
		return $reply['total'];
	}

	function getTicketOpenCount()
	{

		$stmt = $this->conn->prepare("SELECT count(*) AS total
		FROM " . $this->ticketsTable . " WHERE status = 'open'");
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();
		return $reply['total'];
	}

	function getTicketCloseCount()
	{

		$stmt = $this->conn->prepare("SELECT count(*) AS total
		FROM " . $this->ticketsTable . " WHERE status = 'closed'");
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();
		return $reply['total'];
	}

	function getTicketReplyCount()
	{

		$stmt = $this->conn->prepare("SELECT count(*) AS total
		FROM " . $this->ticketReplyTable . " WHERE 1");
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();
		return $reply['total'];
	}

	function getTopPerforming()
	{

		$sqlQuery = "
		SELECT u.id, u.name, units.unit_name, cp.company_name, MAX(tc.ticket_count) AS max_ticket_count, MAX(tr.reply_count) AS max_reply_count
		FROM users u
		LEFT JOIN (
			SELECT user_id, COUNT(*) AS ticket_count
			FROM tickets
			GROUP BY user_id
		) tc ON u.id = tc.user_id
		LEFT JOIN (
			SELECT created_by as user_id, COUNT(*) AS reply_count
			FROM ticket_replies
			GROUP BY created_by
		) tr ON u.id = tr.user_id
		LEFT JOIN units ON u.unit_id = units.id
		LEFT JOIN company_profiles cp ON units.company_id = cp.id
		WHERE units.id IS NOT NULL
		GROUP BY u.id, u.name, units.id, units.unit_name
		ORDER BY max_ticket_count DESC, max_reply_count DESC limit 6";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}

	function getLastOpenTickets()
	{
		$sqlQuery = "
		SELECT users.id, users.name, units.unit_name, company_profiles.company_name, tickets.message, tickets.id AS ticket_id
FROM tickets
JOIN users ON tickets.user_id = users.id
JOIN units ON users.unit_id = units.id
JOIN company_profiles ON units.company_id = company_profiles.id order by tickets.id DESC limit 7";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	function getUsersTicket()
	{
		$sqlQuery = "
		SELECT * FROM " . $this->ticketsTable . " 
		WHERE status = 'open' AND user_id = ?";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bind_param("i", $_SESSION["user_id"]);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows;
	}

	function getMentionedTicket()
	{
		$sqlQuery = "
		SELECT * FROM " . $this->ticketReplyTable . " 
		WHERE created_by = " . $_SESSION["user_id"];
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows;
	}


	function getAnsweredTicket()
	{
		$sqlQuery = "
		SELECT * FROM " . $this->ticketsTable . " 
		WHERE mentioned like '%" . $_SESSION["email"] . "%'";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result->num_rows;
	}




	/*************** unit list ************/

	function unitList()
	{
		$stmt = $this->conn->prepare("SELECT id, unit, status 
		FROM " . $this->unitTable);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	function timeElapsedString($datetime, $full = true)
	{
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);


		$string = array(
			'y' => _lang['year'],
			'm' => _lang['month'],
			'd' => _lang['day'],
			'h' => _lang['hour'],
			'i' => _lang['minute'],
			's' => _lang['second'],
		);

		foreach ($string as $key => &$value) {
			if ($diff->$key) {
				$value = $diff->$key . ' ' . $value;
				if ($diff->$key > 1) {
					$value .= ' ';
				}
			} else {
				unset($string[$key]);
			}
		}

		if (!$full) {
			$string = array_slice($string, 0, 1);
		}

		if (empty($string)) {
			return _lang['just_now'];
		} else {
			$output = implode(' و ', $string) . _lang['ago'];
			return $output;
		}

	}


	public function getCompanyUnit()
	{
		$sqlQuery = "
				SELECT unit.id as id , unit.unit_name as unit_name, company.company_name as company_name 
				FROM " . $this->unitTable . " unit
				LEFT JOIN " . $this->companyTable . " company ON unit.company_id = company.id where company.id = 2
				";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();

		$companies = array();
		while ($row = $result->fetch_object()) {
			$companies[] = $row;
		}

		return $companies;
	}
}
?>