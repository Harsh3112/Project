<?php
require_once 'C:\xampp\htdocs\cybercom\Project\Action.php'; 
/**
 * 
 * 
 */
class Product_Media extends Action
{
	public function mediaAction()
	{
		require_once 'View\Product_Media\media.phtml';
	}

	public function addAction()
	{
		require_once 'View\Product_Media\add.phtml';
	}

	public function insertAction()
	{
		require_once 'C:\xampp\htdocs\cybercom\Project\Model\Core\Model_Adapter.php';

		echo "<pre>";
		// print_r($_POST);

		$name = $_POST['name'];
		$status = $_POST['status'];
		$createdAt = date("Y-m-d H:i:s");

		$sql = "INSERT INTO `media`(`name`, `status`, `image`) VALUES ('$name','$status','')";

		$result = new Model_Adapter();
		$mediaId = $result->insert($sql);

		$imgName = explode('.',$_FILES['image']['name']);
		$extension = $imgName[1];
		$fileName = $mediaId.'.'.$extension;

		$destination = './View/Product_Media/images/'.$fileName;
		$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

		$sql2 = "UPDATE `media` SET `image`='{$fileName}' WHERE `media_id` = '{$mediaId}'";

		$result2 = new Model_Adapter();
		$data = $result2->update($sql2);

		header("Location: index.php?c=product_media&a=media");
	}

	public function updateAction()
	{
		require_once 'C:\xampp\htdocs\cybercom\Project\Model\Core\Model_Adapter.php';

		$baseId = $_POST['base'];
		$smallId = $_POST['small'];
		$thumbId = $_POST['thumb'];
		$galleryId = $_POST['gallery'];
		 
		$gallery = implode(', ', $galleryId);
		// print_r($gallery);
		// die();

		$adapter = new Model_Adapter();

		$sql = "UPDATE `media` SET `base`=0,`small`=0,`thumb`=0,`gallery`=0";
		$result = $adapter->update($sql);

		$sql = "UPDATE `media` SET `base`=1 WHERE `media_id`='{$baseId}'";
		$result = $adapter->update($sql);

		$sql = "UPDATE `media` SET `small`=1 WHERE `media_id`='{$smallId}'";
		$result = $adapter->update($sql);

		$sql = "UPDATE `media` SET `thumb`=1 WHERE `media_id`='{$thumbId}'";
		$result = $adapter->update($sql);


		$sql = "UPDATE `media` SET `gallery`=1 WHERE `media_id` IN ({$gallery})";
		$result = $adapter->update($sql);

		echo("update sucessfully..");
?>
		<!DOCTYPE html>
		<html>
		<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		</head>
		<body>
		<h2><a href="Product_media.php?a=view">view selection</a></h2>
		</body>
		</html>

<?php
	}

	public function viewAction()
	{
		require_once 'View\Product_Media\view.phtml';	
	}

}

// $action = $_GET['a'].'Action';
$con = new Product_Media();
// if (method_exists($productMedia, $action) == false){
// 	$productMedia->errorAction($action);
// }
// else{
// 	$productMedia->$action();
// }
?>