<?php
#[AllowDynamicProperties]
class Admin
{

	private $adminTable = 'admins';
	private $fileTable = 'file_manage';

	private $userTable = 'users';
	private $activitiesTable = 'activities';
	private $companyTable = 'company_profiles';
	private $unitTable = 'units';
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function login()
	{
		if ($this->email && $this->password) {
			$sqlQuery = "
				SELECT * FROM " . $this->adminTable . " 
				WHERE email = ? AND password = ?";
			$stmt = $this->conn->prepare($sqlQuery);
			$password = md5($this->password);
			$stmt->bind_param("ss", $this->email, $password);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result->num_rows > 0) {
				$user = $result->fetch_assoc();
				$_SESSION["admin_id"] = $user['id'];
				$_SESSION["role"] = $user['role'];
				$_SESSION["mobile"] = $user['mobile'];
				$_SESSION["name"] = $user['name'];
				$_SESSION["email"] = $user['email'];
				$_SESSION["unit_id"] = $user['unit_id'];
				$_SESSION["rbac_id"] = $user['rbac_id'];
				// profile image 

				$sqlQuery2 = "SELECT file_name,file_path FROM file_manage WHERE  part_name = 'admin_profile' AND part_id = " . $_SESSION["admin_id"] . " AND  admin_id = " . $_SESSION["admin_id"];

				$stmt2 = $this->conn->prepare($sqlQuery2);
				$stmt2->execute();
				$result2 = $stmt2->get_result();
				if ($result2->num_rows > 0) {
					$imege_profile = $result2->fetch_assoc();
					$_SESSION["profile_image_name"] = $imege_profile['file_name'];
					$_SESSION["profile_image_path"] = $imege_profile['file_path'];
				}else{

					$_SESSION["profile_image_name"] = "avatar-1.jpg";
					$_SESSION["profile_image_path"] = "./itheme/panel/images/users/";

				}
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

	public function isAdmin()
	{
		if ($_SESSION["role"] == 'admin') {
			return 1;
		} else {
			return 0;
		}
	}

	public function loggedIn()
	{
		if (!empty($_SESSION["admin_id"])) {
			return 1;
		} else {
			return 0;
		}
	}


	public function getAdmins()	
	{
		$sqlQuery = "SELECT *
        FROM " . $this->adminTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result ;

	}

	public function getUnitNameById($id)
	{

		$sqlQuery = "SELECT unit_name,company_id FROM " . $this->unitTable . " WHERE id = ?";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
			return null;
		}

	}


	public function getadminImageById($id)
	{
		$sqlQuery = "SELECT admins.name, admins.email, admins.mobile, file_manage.file_name, file_manage.file_path
					 FROM " . $this->adminTable . " AS admins
					 LEFT JOIN " . $this->fileTable . " AS file_manage ON admins.id = file_manage.admin_id
					 WHERE admins.id = ? AND file_manage.part_name = 'admin_profile'";
		
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
	
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		} else {
			return null;
		}
	}


	


}
?>