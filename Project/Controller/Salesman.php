<?php
require_once 'Action.php';  
/**
 * 
 */
class Salesman extends Action
{
	public function gridAction()
	{
		require_once 'View\salesman\grid.phtml';
	}

	public function addAction()
	{
		require_once 'View\salesman\add.phtml';
	}

	public function editAction()
	{
		require_once 'View\salesman\edit.phtml';
	}

	public function salesman_price_gridAction()
	{
		require_once 'View\salesman\salesman_price_grid.phtml';
	}

	public function salesman_price_insertAction()
	{
		echo "this code is not completed yet....";
	}

	public function errorAction($action)
	{
		throw new Exception("Method :{$action} does not exist", 1);
	}

	public function insertAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $salesman = $_POST['salesman'];
		$request = new Request();
		$salesman = $request->getPost('salesman');

		date_default_timezone_set('Asia/Kolkata');
		$createdAt = date("Y-m-d h:i:s");

		// if (!isset($salesman)) {
		// 	throw new Exception("Invalid Request.", 1);
		// }
		$request->isPost();

		$sql = "INSERT INTO `salesman`(`first_name`, `last_name`, `email`, `mobile`, `gender`, `status`,`company`, `created_at`) VALUES ('$salesman[first_name]','$salesman[last_name]','$salesman[email]','$salesman[mobile]','$salesman[gender]','$salesman[status]','$salesman[company]','$createdAt')";

		$result = new Model_Adapter();
		$data = $result->insert($sql);

		$sql2 = "INSERT INTO `salesman_address`(`salesman_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES ('$data','$salesman[address]','$salesman[city]','$salesman[state]','$salesman[country]','$salesman[zipcode]')";

		$data = $result->insert($sql2);

		header("Location: index.php?c=salesman&a=grid");
	}

	public function updateAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		// $salesman = $_POST['salesman'];
		$request = new Request();
		$id = $request->getparams('id');
		$salesman = $request->getPost('salesman');

		date_default_timezone_set('Asia/Kolkata');
		$updatedAt = date("Y-m-d h:i:s");

		// if (!isset($salesman)) {
		// 	throw new Exception("Invalid Request.", 1);
		// }
		$request->isPost();

		$sql = "UPDATE `salesman` SET `first_name`='$salesman[first_name]',`last_name`='$salesman[last_name]',`email`='$salesman[email]',`mobile`='$salesman[mobile]',`gender`='$salesman[gender]',`status`='$salesman[status]',`company`='$salesman[company]',`updated_at`='$updatedAt' WHERE `salesman_id`=$id";
		$result = new Model_Adapter();
		$data = $result->update($sql);

		$sql2 = "UPDATE `salesman_address` SET `address`='$salesman[address]',`city`='$salesman[city]',`state`='$salesman[state]',`country`='$salesman[country]',`zipcode`='$salesman[zipcode]' WHERE `salesman_id`=$id";

		$data1 = $result->update($sql2);


		header("Location: index.php?c=salesman&a=grid");
	}

	public function deleteAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		$request = new Request();
		$id = $request->getparams('id');

		$result = new Model_Adapter();

		$sql2 =  "DELETE FROM `salesman_address` WHERE `salesman_id`=$id";
		$data2 = $result->delete($sql2);

		$sql =  "DELETE FROM `salesman` WHERE `salesman_id`=$id";
		$data = $result->delete($sql);

		header("Location: index.php?c=salesman&a=grid");
	}
}

$con = new Salesman();

?>