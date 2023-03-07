<?php 
require_once 'Action.php';
/**
 * 
 */
class ShippingMethod extends Action
{
	public function gridAction()
	{
		require_once 'View\shipping_method\grid.phtml';
	}

	public function addAction()
	{
		require_once 'View\shipping_method\add.phtml';
	}

	public function editAction()
	{
		require_once 'View\shipping_method\edit.phtml';
	}

	public function errorAction($action)
	{
		throw new Exception("Method :{$action} does not exist", 1);
	}

	public function insertAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $shipping_method = $_POST['shipping_method'];
		$request = new Request();
		$shipping_method = $request->getPost('shipping_method');

		date_default_timezone_set('Asia/Kolkata');
		$created_at = date("Y-m-d h:i:s");

		// if (!isset($shipping_method)) {
		// 	throw new Exception("Invalid Request.", 1);
		// }

		$request->isPost();

		$sql = "INSERT INTO `shipping_method`(`name`, `amount`, `status`, `created_at`) VALUES ('$shipping_method[name]','$shipping_method[amount]','$shipping_method[status]','$created_at')";

		$result = new Model_Adapter();
		$data = $result->insert($sql);

		header("Location: index.php?c=ShippingMethod&a=grid");
	}

	public function updateAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		$request = new Request();
		$id = $request->getparams('id');

		// $shipping_method = $_POST['shipping_method'];
		$shipping_method = $request->getPost('shipping_method');

		date_default_timezone_set('Asia/Kolkata');
		$updated_at = date("Y-m-d h:i:s");

		// if (!isset($shipping_method)) {
		// 	throw new Exception("Invalid Request.", 1);
		// }

		$request->isPost();

		$sql = "UPDATE `shipping_method` SET `name`='$shipping_method[name]',`amount`='$shipping_method[amount]',`status`='$shipping_method[status]', `updated_at`='$updated_at' WHERE `shipping_method_id`=$id";
		$result = new Model_Adapter();
		$data = $result->update($sql);

		header("Location: index.php?c=ShippingMethod&a=grid");
	}

	public function deleteAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		$request = new Request();
		$id = $request->getparams('id');

		$sql =  "DELETE FROM `shipping_method` WHERE `shipping_method_id`=$id";
		$result = new Model_Adapter();
		$data = $result->delete($sql);

		header("Location: index.php?c=ShippingMethod&a=grid");
	}
}

$con = new ShippingMethod();


?>