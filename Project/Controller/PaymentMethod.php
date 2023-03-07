<?php
require_once 'Action.php'; 
/**
 * 
 */
class PaymentMethod extends Action
{
	public function gridAction()
	{
		require_once 'View\payment_method\grid.phtml';
	}

	public function addAction()
	{
		require_once 'View\payment_method\add.phtml';
	}

	public function editAction()
	{
		require_once 'View\payment_method\edit.phtml';
	}

	public function errorAction($action)
	{
		throw new Exception("Method :{$action} does not exist", 1);	
	}

	public function insertAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $payment_method = $_POST['payment_method'];
		$request = new Request();
		$payment_method = $request->getPost('payment_method');

		date_default_timezone_set('Asia/Kolkata');
		$createdAt = date("Y-m-d h:i:s");

		// if (!isset($payment_method)) {
		// 	throw new Exception("Invalid Request.", 1);
			
		// }
		$request->isPost();

		$sql = "INSERT INTO `payment_method`(`name`,`status`,`created_at`) VALUES ('$payment_method[name]','$payment_method[status]','$createdAt')";

		$result = new Model_Adapter();
		$data = $result->insert($sql);

		header("Location: index.php?c=PaymentMethod&a=grid");
	}

	public function updateAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		$request = new Request();
		$id = $request->getparams('id');
		// $id = $_GET['id'];

		// $payment_method = $_POST['payment_method'];
		$payment_method = $request->getPost('payment_method');

		date_default_timezone_set('Asia/Kolkata');
		$updatedAt = date("Y-m-d h:i:s");

		// if (!isset($payment_method)) {
		// 	throw new Exception("Invalid Request.", 1);
			
		// }
		$request->isPost();

		$sql = "UPDATE `payment_method` SET `name`='$payment_method[name]',`status`='$payment_method[status]', `updated_at`='$updatedAt' WHERE `payment_method_id`=$id";
		$result = new Model_Adapter();
		$data = $result->update($sql);

		header("Location: index.php?c=PaymentMethod&a=grid");
	}

	public function deleteAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		$request = new Request();
		$id = $request->getparams('id');

		$sql =  "DELETE FROM `payment_method` WHERE `payment_method_id`=$id";
		$result = new Model_Adapter();
		$data = $result->delete($sql);

		header("Location: index.php?c=PaymentMethod&a=grid");
	}
}

$con = new PaymentMethod();


?>