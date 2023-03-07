<?php 
require_once 'Action.php';
/**
 * 
 */
class Vendor extends Action
{
	public function gridAction()
	{
		require_once 'View\vendor\grid.phtml';
	}
	public function addAction()
	{
		require_once 'View/vendor/add.phtml';
	}
	public function editAction()
	{
		require_once 'View/vendor/edit.phtml';
	}
	public function errorAction($action)
	{
		throw new Exception("Method :{$action} does not exist", 1);
	}
	public function insertAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $vendor = $_POST['vendor'];
		$request = new Request();
		$vendor = $request->getPost('vendor');
		
		date_default_timezone_set('Asia/Kolkata');
		$createdAt = date("Y-m-d h:i:s");

		// if (!isset($vendor)) {
		// 	throw new Exception("Invalid Request.", 1);
		// }
		$request->isPost();

		$sql = "INSERT INTO `vendor`(`first_name`, `last_name`, `email`, `mobile`, `gender`, `status`,`company`, `created_at`) VALUES ('$vendor[first_name]','$vendor[last_name]','$vendor[email]','$vendor[mobile]','$vendor[gender]','$vendor[status]','$vendor[company]','$createdAt')";

		$result = new Model_Adapter();
		$data = $result->insert($sql);

		$sql2 = "INSERT INTO `vendor_address`(`vendor_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES ('$data','$vendor[address]','$vendor[city]','$vendor[state]','$vendor[country]','$vendor[zipcode]')";

		$data = $result->insert($sql2);

		header("Location: index.php?c=vendor&a=grid");
	}

	public function updateAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		// $vendor = $_POST['vendor'];
		$request = new Request();
		$id = $request->getparams('id');
		$vendor = $request->getPost('vendor');

		date_default_timezone_set('Asia/Kolkata');
		$updatedAt = date("Y-m-d h:i:s");

		// if (!isset($vendor)) {
		// 	throw new Exception("Invalid Request.", 1);
		// }
		$request->isPost();

		$sql = "UPDATE `vendor` SET `first_name`='$vendor[first_name]',`last_name`='$vendor[last_name]',`email`='$vendor[email]',`mobile`='$vendor[mobile]',`gender`='$vendor[gender]',`status`='$vendor[status]',`company`='$vendor[company]', `updated_at`='$updatedAt' WHERE `vendor_id`=$id";

		$result = new Model_Adapter();
		$data = $result->update($sql);

		$sql2 = "UPDATE `vendor_address` SET `address`='$vendor[address]',`city`='$vendor[city]',`state`='$vendor[state]',`country`='$vendor[country]',`zipcode`='$vendor[zipcode]' WHERE `vendor_id`=$id";

		$data1 = $result->update($sql2);

		header("Location: index.php?c=vendor&a=grid");
	}

	public function deleteAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		$request = new Request();
		$id = $request->getparams('id');

		$result = new Model_Adapter();

		$sql2 =  "DELETE FROM `vendor_address` WHERE `vendor_id`=$id";
		$data2 = $result->delete($sql2);

		$sql =  "DELETE FROM `vendor` WHERE `vendor_id`=$id";
		$data = $result->delete($sql);


		header("Location: index.php?c=vendor&a=grid");
	}
}

$con = new Vendor();

?>