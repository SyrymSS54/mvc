<?php
class adminview extends view{
    private $config_view = [
        "templates/html/login_admin.html",
        "templates/html/manager_admin.html",
        "templates/html/template.html",
        "templates/html/table_main.html",
        "templates/html/table_basic.html"
    ]; 

    function login(array $data)
    {
        view::view("My app",$this->config_view[0],True,$this->config_view[2]);
    }

    function manager(array $data)
    {
        

        if(!isset($data['result']['Error']) && isset($data['result'][0]['id']))
        {
            $result = $data['result'];
            ob_start();
            foreach($result as $arr)
            {
                require $this->config_view[4];
            }
            $table_data = ob_get_clean();

            ob_start();
            require_once $this->config_view[3];
            $table = ob_get_clean();

            $name = $data['name'];
            $view_data = ['name'=>$name,'table' => $table];
            if(true)
            {
                debug_var($_POST);
            }
            else
            {
                debug_var('!');
            }
        }
        else
        {
            $name = $data['name'];
            $view_data = ['name' => $name,'table' => '<pre>Шаблон вввода не правильный или пользователь не найден</pre>'];
        }

        view::view("My app",$this->config_view[1],True,$this->config_view[2],$view_data);
    }
}
?>