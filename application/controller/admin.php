<?php
class admin{
    public $action;
    public $viewer;

    function __construct($action)
    {
        $this->action = $action;
        $this->viewer = new adminview();
        $this->page_fork();
    }

    function page_fork()
    {
        if($this->action == "login")
        {
            $this->login_page(); 
        }
        elseif($this->action == "manager")
        {
            $this->manager_page();
        }
        else
        {
            debug_var("action does not exist!");
        }
    }

    function login_page()
    {
        if(isset($_COOKIE['admin']))
        {
            header('Location: http://127.0.0.1/admin/manager');
        }
        else
        {
            if(isset($_POST['Adminname-text']) && isset($_POST['Password-text']))
            {
                
                $model = new adminmodel();
                $adminname = $_POST['Adminname-text'];
                $password = $_POST['Password-text'];
                $result = $model -> admin_account($adminname,$password);
                if(isset($result['adminname']))
                {
                    $_SESSION['admin'] = True;
                    $_SESSION['adminname'] = $result['adminname'];
                    header("Location: http://127.0.0.1/admin/manager");
                }
                else
                {
                    debug_var("Нету такого админа!");
                }
            }
            else
            {
                $this->viewer->login([]);
            }
        }
        // $this->viewer->login([]);
    }

    function manager_page()
    {
        if(isset($_SESSION['admin']))
        {
            // $this->viewer->manager(['name' =>$_SESSION['adminname']]);
            if(isset($_POST['type-text']) && isset($_POST['type-var']))
            {
                $type_var = $_POST['type-var'];
                $search = $_POST['type-text'];

                $model = new managermodel();

                if($type_var == 'id')
                {
                    $result = $model->id_search($search);
                }
                elseif($type_var == 'username')
                {
                    $result = $model->username_search($search);
                }
                elseif($type_var == 'email')
                {
                    $result = $model->email_search($search);
                }
                elseif($type_var == 'tnumber')
                {
                    $result = $model->tnumber_search($search);
                }
                else
                {
                    $result = ['Error' => False];
                }
                
                $this->viewer->manager(['name' =>$_SESSION['adminname'],'result' => $result]);
            }
            else
            {
                $this->viewer->manager(['name' =>$_SESSION['adminname']]);
            }
        }
        else
        {
            header('Location: http://127.0.0.1/admin/login');
        }
        // $this->viewer->manager([]);
    }
}
?>