<?php 
require_once 'Action.php'; 
/**
 * 
 */
class Category extends Action
{
	public function gridAction()
	{
		require_once 'View\category\grid.phtml';
	}

	public function addAction()
	{
		require_once 'View\category\add.phtml';
	}

	public function editAction()
	{
		require_once 'View\category\edit.phtml';
	}

	public function errorAction($action)
	{
		throw new Exception("Method :{$action} does not exist", 1);
	}

	public function insertAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $category = $_POST['category'];
		$request = new Request();
		$category = $request->getPost('category');

		date_default_timezone_set('Asia/Kolkata');
		$created_at = date("Y-m-d h:i:s");

		// if (!isset($category)) {
		// 	throw new Exception("Invalid Request.", 1);	
		// }
		$request->isPost();

		$sql = "INSERT INTO `category`(`parent`,`name`, `status`, `description`, `created_at`) VALUES ('$category[parent]','$category[name]','$category[status]','$category[description]', '$created_at')";

		$result = new Model_Adapter();
		$data = $result->insert($sql);

		header("Location: index.php?c=category&a=grid");
	}

	public function updateAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		// $category = $_POST['category'];
		$request = new Request();
		$id = $request->getparams('id');
		$category = $request->getPost('category');

		date_default_timezone_set('Asia/Kolkata');
		$updatedAt = date("Y-m-d h:i:s");

		// if (!isset($category)) {
		// 	throw new Exception("Invalid Request.", 1);	
		// }
		$request->isPost();

		$sql = "UPDATE `category` SET `name`='$category[name]',`status`='$category[status]',`description`='$category[description]', `updated_at`='$updatedAt' WHERE `category_id`=$id";
		$result = new Model_Adapter();
		$data = $result->update($sql);

		header("Location: index.php?c=category&a=grid");
	}

	public function deleteAction()
	{
		require_once 'Model\Core\Model_Adapter.php';
		require_once 'Model\Core\Request.php';

		// $id = $_GET['id'];
		$request = new Request();
		$id = $request->getparams('id');

		$sql =  "DELETE FROM `category` WHERE `category_id`=$id";
		$result = new Model_Adapter();
		$data = $result->delete($sql);

		header("Location: index.php?c=category&a=grid");
	}
}

// $action = $_GET['a'].'Action';
$con = new Category();

?>