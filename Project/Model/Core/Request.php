<?php 
/**
 * 
 */
class Request
{
	public function getPost($key=null, $value=null)
	{
		if($key == null)
		{
			return $_POST;
		}
		if(array_key_exists($key, $_POST))
		{
			return $_POST[$key];
		}
		return $value;
	}

	public function isPost()
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			return "Post Method";
		}
		else{
			throw new Exception("Error Processing Request", 1);
		}
	}

	public function getParams($key=null, $value=null)
	{
		if($key == null)
		{
			return $_GET;
		}
		if(array_key_exists($key, $_GET))
		{
			return $_GET[$key];
		}
		return $value;
	}
}

?>