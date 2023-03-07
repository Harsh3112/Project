<?php 
$request = new Request();
/**
 * 
 */
class Controller_Core_Front
{
	public function init()
    {
        $request = $GLOBALS['request'];
        $c = $request->getParams('c', 'product');
        $action = $request->getParams('a', 'grid').'Action';
        $cont = explode('_', $c);

        if (count($cont)>1) {
            $string = implode("/", $cont);
            $controller = ucwords($string, '/');

            require_once "Controller/{$controller}.php";
            $con->$action();

            if (!method_exists($con, $action)) {
                $con->errorAction($action);
            }
        }
        else{
            require_once "Controller/{$c}.php";
            $con->$action();
            if (!method_exists($con, $action)) {
                $con->errorAction($action);
            }
        }
    }
}

// $front = new Controller_Core_Front();
// $front->init();
?>