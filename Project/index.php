<?php 
require_once 'Action.php';
require_once 'Controller/Core/Front.php';
$request = new Request();
/**
 * 
 */
class Ccc extends Action
{
	static public function init()
	{
		$front = new Controller_Core_Front();
		$front->init();
	}
}

Ccc :: init();
?>