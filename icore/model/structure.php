<?php
#[AllowDynamicProperties]
class Structure
{

	private $activitiesTable = 'activities';
	private $rolesTable = 'roles';
	private $rbacTable = 'rbac';
	private $operationsTable = 'operations';
	private $companyTable = 'company_profiles';
	private $organizationCompanyTable = 'organization_company';
	private $organizationProvincesTable = 'organization_provinces';
	private $organizationFederationsTable = 'organization_federations';
	private $organizationBankTable = 'organization_bank';
	private $organizationBalanceTable = 'organization_balance';
	private $userPartsTable = 'users_parts';
	private $userGroupsTable = 'users_groups';
	private $userSubPartsTable = 'users_subparts';
	private $unitTable = 'units';
	private $tagTable = 'tags';
	private $conn;

	public function __construct($db)
	{
		$this->conn = $db;
	}


	public function getActivities()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->activitiesTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}


	public function getActivityById($id)
	{

		$sqlQuery = "SELECT * FROM " . $this->activitiesTable . " WHERE id = ?";
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



	public function getRoles()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->rolesTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function getRBAC()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->rbacTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function getRBACById($id)
	{

		$sqlQuery = "SELECT * FROM " . $this->rbacTable . " WHERE id = ?";
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


	public function getUserOperation()
	{
		$sqlQuery = "SELECT
		permissions_operation.rbac_id,
		rbac.rbac_name,
		permissions_operation.last_updated_date,
		permissions_operation.id

	FROM
		permissions_operation
	JOIN
		rbac ON permissions_operation.rbac_id = rbac.id WHERE rbac.all_rbac = 0";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function getUserStracture()
	{
		$sqlQuery = "SELECT
		permissions_stracture.rbac_id,
		rbac.rbac_name,
		permissions_stracture.last_updated_date,
		permissions_stracture.id
	FROM
		permissions_stracture
	JOIN
		rbac ON permissions_stracture.rbac_id = rbac.id";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function getOperations()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->operationsTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}


	public function getCompanyById($id)
	{
		$sqlQuery = "SELECT * FROM " . $this->companyTable . " WHERE id = ?";
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

	public function getUserGroups()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->userGroupsTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function getUserGroupById($id)
	{

		$sqlQuery = "SELECT * FROM " . $this->userGroupsTable . " WHERE id = ?";
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



	public function getUserParts()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->userPartsTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function getUserPartsById($id)
	{

		$sqlQuery = "SELECT * FROM " . $this->userPartsTable . " WHERE id = ?";
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

	public function getPartByGroups($id)
	{
		$sqlQuery = "SELECT *
        FROM " . $this->userPartsTable . " WHERE users_groups_id = " . $id;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function getUserSubParts()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->userSubPartsTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}

	public function getSubPartsByPart($id)
	{
		$sqlQuery = "SELECT *
        FROM " . $this->userSubPartsTable . " WHERE users_parts_id = " . $id;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}



	public function getCompanies()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->companyTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}


	public function getOrganizationCompanies()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->organizationCompanyTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}


	public function getOrganizationProvinces()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->organizationProvincesTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}

	public function getOrganizationFederations()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->organizationFederationsTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}


	

	public function getOrganizationBanks()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->organizationBankTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}


	public function getOrganizationBalances()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->organizationBalanceTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}

	
	public function getCompanyNameById($id)
	{


		$sqlQuery = "SELECT company_name,id FROM " . $this->organizationCompanyTable . " WHERE id = ?";
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


	public function getBankNameById($id)
	{


		$sqlQuery = "SELECT bank_name,id FROM " . $this->organizationBankTable . " WHERE id = ?";
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

	public function getCompaniesByActivity($id)
	{
		$sqlQuery = "SELECT *
        FROM " . $this->companyTable . " WHERE activity_id = " . $id;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}


	public function getCompanyByUnitId($unit_id)
	{
		$sqlQuery = "SELECT company_id
        FROM " . $this->unitTable . " WHERE id = ?";

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bind_param("i", $unit_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$reply = $result->fetch_assoc();
        return $reply['company_id'];

	}



	public function getUnits()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->unitTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}

	public function getUnitsByCompany($id)
	{
		$sqlQuery = "SELECT *
        FROM " . $this->unitTable . " WHERE company_id = " . $id;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;

	}

	public function getTags()
	{
		$sqlQuery = "SELECT *
        FROM " . $this->tagTable;

		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		$result = $stmt->get_result();
		return $result;
	}










}
?>