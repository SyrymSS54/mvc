<?php
class userview extends view{
    private $config_view = [
        "templates/html/login_template.html",
        "templates/html/register_template.html",
        "templates/html/personal_template.html",
        "templates/html/template.html"
    ];

    function login(array $data)
    {
        view::view("My app",$this->config_view[0],True,$this->config_view[3]);
    }

    function register(array $data)
    {
        view::view("My app",$this->config_view[1],True,$this->config_view[3]);
    }

    function personal(array $data)
    {
        view::view("My app",$this->config_view[2],True,$this->config_view[3],$data);
    }
}
?>