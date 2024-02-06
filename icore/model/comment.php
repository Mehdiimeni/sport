<?php


#[AllowDynamicProperties]
class Comment
{


    private $userTable = 'users';
    private $fileTable = 'file_manage';
    private $commentTable = 'comments';
    private $replayTable = 'comment_replies';
    private $conn;


    public function __construct($db)
    {
        $this->conn = $db;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

    }


    public function getComment($commentId = null, $userId = null, $partId = null, $unitId = null)
    {
        $whereConditions = [];

        if ($commentId !== null) {
            $whereConditions[] = "comments.id = " . $commentId;
        }

        if ($userId !== null) {
            $whereConditions[] = "comments.user_id = " . $userId;
        }

        if ($partId !== null) {
            $whereConditions[] = "comments.part_id = " . $partId;

        }

        if ($unitId !== null) {
            $whereConditions[] = "comments.unit_id = " . $unitId;

        }

        $whereClause = implode(' AND ', $whereConditions);

        $sqlQuery = "SELECT
    comments.id AS comment_id,
    comments.user_id AS comment_user_id,
    comments.part_id AS comment_part_id,
    comments.unit_id AS comment_unit_id,
    comments.comment_text,
    comments.creation_date AS comment_creation_date,
    comments.last_updated_date AS comment_last_updated_date,
    users.id AS user_id,
    users.name,
    users.email,
    users.mobile
FROM
    comments
JOIN
    users ON comments.user_id = users.id
            WHERE
                $whereClause
            ORDER BY
                comments.id";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getCommentReplay($commentId)
    {


        $sqlQuery = "SELECT
        replies.id AS reply_id,
        replies.comment_id,
        replies.parent_id,
        replies.reply_text,
        replies.creation_date AS reply_creation_date,
        replies.last_updated_date AS reply_last_updated_date,
        users.name AS reply_name
    FROM
        comment_replies AS replies
    JOIN
        users ON replies.user_id = users.id
    WHERE
        replies.comment_id = $commentId
    ORDER BY
        replies.creation_date ASC;";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }


    public function getCommentReplayParent($parent_id)
    {


        $sqlQuery = "SELECT
        replies.id AS reply_id,
        replies.comment_id,
        replies.parent_id,
        replies.reply_text,
        replies.creation_date AS reply_creation_date,
        replies.last_updated_date AS reply_last_updated_date,
        users.name AS reply_name
    FROM
        comment_replies AS replies
    JOIN
        users ON replies.user_id = users.id
    WHERE
        replies.parent_id = $parent_id
    ORDER BY
        replies.creation_date ASC;";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }


    public function getTotalCommentPart()
    {
        $sqlWhere = '';

        $sqlWhere = " part_name = '" . $this->part_name . "' AND part_id = " . $this->part_id;


        $stmt = $this->conn->prepare("SELECT count(*) AS total
            FROM " . $this->commentTable . " 
            WHERE  $sqlWhere");
        $stmt->execute();
        $result = $stmt->get_result();
        $reply = $result->fetch_assoc();
        return $reply['total'];

    }


    public function getCommentPartAndReply()
    {
        $sqlWhere = " part_name = '" . $this->part_name . "' AND part_id = " . $this->part_id;


        $stmt = $this->conn->prepare(" SELECT comments.*, 
        IFNULL(users.name, admins.name) AS name
 FROM comments
 LEFT JOIN users ON comments.user_id = users.id
 LEFT JOIN admins ON comments.admin_id = admins.id
 WHERE $sqlWhere
 ORDER BY 
   CASE WHEN comments.parent_id IS NULL THEN comments.id ELSE comments.parent_id END,
   comments.id; ");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }


    /*
        public function getCommentPart()
        {
            $sqlWhere = "parent_id IS NULL AND part_name = '" . $this->part_name . "' AND part_id = " . $this->part_id;


            $stmt = $this->conn->prepare(" SELECT comments.*, 
            IFNULL(users.name, admins.name) AS name
     FROM comments
     LEFT JOIN users ON comments.user_id = users.id
     LEFT JOIN admins ON comments.admin_id = admins.id
     WHERE $sqlWhere
     ORDER BY comments.id; ");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;

        }
        */

    public function getCommentPart()
    {
        $sqlWhere = "comments.parent_id IS NULL AND comments.part_name = '" . $this->part_name . "' AND comments.part_id = " . $this->part_id;

        $stmt = $this->conn->prepare(" SELECT comments.*, 
        IFNULL(users.name, admins.name) AS name,
        file_manage.file_name,
        file_manage.file_path
     FROM comments
     LEFT JOIN users ON comments.user_id = users.id
     LEFT JOIN admins ON comments.admin_id = admins.id
     LEFT JOIN " . $this->fileTable . " AS file_manage ON
        (comments.admin_id != '' AND comments.admin_id = admins.id AND file_manage.part_name = 'admin_profile') OR
        (comments.user_id != '' AND comments.user_id = users.id AND file_manage.part_name = 'user_profile')
     WHERE $sqlWhere
     ORDER BY comments.id; ");

        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }



    public function getCommentPartByParentId($parent_id)
    {
        $sqlWhere = " comments.parent_id = '" . $parent_id . "' AND  comments.part_name = '" . $this->part_name . "' AND comments.part_id = " . $this->part_id;


        $stmt = $this->conn->prepare("  SELECT comments.*, 
        IFNULL(users.name, admins.name) AS name,
        file_manage.file_name,
        file_manage.file_path
     FROM comments
 LEFT JOIN users ON comments.user_id = users.id
     LEFT JOIN admins ON comments.admin_id = admins.id
     LEFT JOIN " . $this->fileTable . " AS file_manage ON
        (comments.admin_id != '' AND comments.admin_id = admins.id AND file_manage.part_name = 'admin_profile') OR
        (comments.user_id != '' AND comments.user_id = users.id AND file_manage.part_name = 'user_profile')
 WHERE $sqlWhere
 ORDER BY comments.id; ");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;

    }




}
?>