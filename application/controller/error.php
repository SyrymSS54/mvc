<?php
class errorcontroller{
    public $action;

    function __construct($action = 0)
    {
        $this->action = $action;
        $this->page_fork();
    }

    function page_fork()
    {
        if($this->action == 'error_404')
        {
            $this->error_404();
        }
        else
        {
            $this->error_404();
        }
    }

    function error_404()
    {
        debug_var("Error 404");
    }
}
?>