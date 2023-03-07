<?php 
require_once 'Action.php';
/**
 * 
 */
class Customer extends Action
{
	public function gridAction()
	{
		require_once 'View\customer\grid.phtml';
	}

	public function addAction()
	{
		require_once 'View\customer\add.phtml';
	}

	public function editAction()
	{
		require_once 'View\customer\edit.phtml';
	}

	public function errorAction($action)
	{
		throw new Exception("Method :{$action} does not exist", 1);
	}

	public function insertAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $customer = $_POST['customer'];
		$request = new Request();
		$customer = $request->getPost('customer');

		date_default_timezone_set('Asia/Kolkata');
		$createdAt = date("Y-m-d h:i:s");

		// if (!isset($customer)) {
		// 	throw new Exception("Invalid Request.", 1);
		// }
		$request->isPost();

		$sql = "INSERT INTO `customer`(`first_name`, `last_name`, `email`, `mobile`, `gender`, `status`, `created_at`) VALUES ('$customer[first_name]','$customer[last_name]','$customer[email]','$customer[mobile]','$customer[gender]','$customer[status]', '$createdAt')";

		$result = new Model_Adapter();
		$data = $result->insert($sql);

		$sql2 = "INSERT INTO `customer_address`(`customer_id`, `address`, `city`, `state`, `country`, `zipcode`) VALUES ('$data','$customer[address]','$customer[city]','$customer[state]','$customer[country]','$customer[zipcode]')";

		$result2 = new Model_Adapter();
		$data = $result2->insert($sql2);

		header("Location: index.php?c=customer&a=grid");
	}

	public function updateAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		// $customer = $_POST['customer'];
		$request = new Request();
		$id = $request->getparams('id');
		$customer = $request->getPost('customer');

		date_default_timezone_set('Asia/Kolkata');
		$updated_at = date("Y-m-d h:i:s");

		// if (!isset($customer)) {
		// 	throw new Exception("Invalid Request.", 1);	
		// }
		$request->isPost();

		$sql = "UPDATE `customer` SET `first_name`='$customer[first_name]',`last_name`='$customer[last_name]',`email`='$customer[email]',`mobile`='$customer[mobile]',`gender`='$customer[gender]',`status`='$customer[status]', `updated_at`='$updated_at' WHERE `customer_id`=$id";
		$result = new Model_Adapter();
		$data = $result->update($sql);

		$sql2 = "UPDATE `customer_address` SET `address`='$customer[address]',`city`='$customer[city]',`state`='$customer[state]',`country`='$customer[country]',`zipcode`='$customer[zipcode]' WHERE `customer_id`=$id";

		$result2 = new Model_Adapter();
		$data1 = $result->update($sql2);

		header("Location: index.php?c=customer&a=grid");
	}

	public function deleteAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';


		// $id = $_GET['id'];
		$request = new Request();
		$id = $request->getparams('id');

		$result = new Model_Adapter();

		$sql2 =  "DELETE FROM `customer_address` WHERE `customer_id`=$id";
		$data2 = $result->delete($sql2);

		$sql =  "DELETE FROM `customer` WHERE `customer_id`=$id";
		$data = $result->delete($sql);
		
		header("Location: index.php?c=customer&a=grid");
	}
}

$con = new Customer();

?>