<?php
class App
{
	protected $controller = 'index';
	protected $method = 'index';
	protected $params = [];
	
	public function __construct()
	{
        $url=[];
        if(isset($_GET['url'])) {
            $url = $this->parseUrl($_GET['url']);
            if (file_exists('app/controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }
        require_once 'app/controllers/'. $this->controller .'.php';
        $object = new $this->controller;
        if (isset($url[1]))
        {
            if (method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $object->model($this->controller);
        $this->params = $url ? array_values($url) : [];
		call_user_func_array([$object,$this->method],$this->params);
	}
	
	protected function parseUrl($url)
	{
		 return $url = explode('/',filter_var(rtrim($url,'/'),FILTER_SANITIZE_URL));
	}
}  
?>
