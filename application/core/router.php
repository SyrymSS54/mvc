<?php
class router{

    public $uri;
    public $config;

    function __construct($uri,$config)
    {
        $this->uri = $uri;
        $this->config = $config;
        $this->fetch($this->uri,$this->config);
    }

    public function connection($controller,$action)
    {
        $con = new $controller($action);
    }

    public function fetch($uri,$config)
    {
        if(!empty($config[$uri])){
            $controller = $config[$uri][0];
            $action = $config[$uri][1];
            $this->connection($controller,$action);
        }else{
            $this->connection('errorcontroller','error_404');
        }
    }
}
?>