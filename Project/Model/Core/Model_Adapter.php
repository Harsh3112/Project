<?php
class Model_adapter
{
	public $server = "localhost";
	public $username = "root";
	public $password = "";
	public $database = "project";

	public function connect()
	{
		$conn = mysqli_connect($this->server,$this->username,$this->password,$this->database);
		return $conn;
	}

	public function fetchRow($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return $result->fetch_assoc();
	}
	
	public function fetchAll($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return $result->fetch_all(MYSQLI_ASSOC);
	}

	public function insert($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return $connect->insert_id;
	}

	public function update($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return true;
	}

	public function delete($query)
	{
		$connect = $this->connect();
		$result = $connect->query($query);
		if (!$result) {
			return false;
		}
		return true;
	}

}

?>