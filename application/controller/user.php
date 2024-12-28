<?php
class user{
    public $action;
    private $viewer; 

    function __construct($action)
    {
        $this->action = $action;
        $this->viewer = new userview();
        $this->page_fork();
    }

    function page_fork()
    {
        if($this->action == "login")
        {
            $this->login_page();
        } 
        elseif($this->action == "register")
        {
            $this->reg_page();
        }
        elseif($this->action == "personal")
        {
            $this->personal_page();
        }
        else
        {
            debug_var("action does not action!");
        }
    }

    function login_page()
    {
        

        if(isset($_SESSION['username']))
        {
            header("Location: http://127.0.0.1/user/personal");
            // var_dump("i am her");
        }
        else
        {
            if(isset($_POST['Email-text']) && isset($_POST['Password-text']))
            {
                $model = new usermodel();
                $email = $_POST['Email-text'];
                $password = $_POST['Password-text'];
                $result = $model->get_account_data($email,$password);
                if($result)
                {
                    // debug_var($result);
                    $_SESSION['id'] = $result["id"];
                    $_SESSION['username'] = $result["username"];
                    $_SESSION['email'] = $result["email"];
                    $_SESSION['tnumber'] = $result["tnumber"];
                    $_SESSION['color'] = $result["color"];
                    header("Location: http://127.0.0.1/user/personal");
                }
                else
                {
                    debug_var("нет такой аккаунта!");
                }
            }
            else
            {
                $this->viewer->login([]);
            }
            // $this->viewer->login([]);
        }
    }

    function reg_page()
    {
        if(isset($_SESSION['username']))
        {
            header("Location: http://127.0.0.1/user/personal");
        }
        else
        {
            if(isset($_POST['Username-text']) && isset($_POST['Email-text']) && isset($_POST['tel']) && isset($_POST['color']) && isset($_POST['Password-text-first']) && isset($_POST['Password-text-second']))
            {
                debug_var('I am her');
                $username = $_POST['Username-text'];
                $email = $_POST['Email-text'];
                $tnumber = $_POST['tel'];
                $color = $_POST['color'];
                $password_first = $_POST['Password-text-first'];
                $password_second = $_POST['Password-text-second'];
                if($password_first === $password_second)
                {
                    $model = new usermodel();
                    $result = $model->insert_account_data($username,$email,$tnumber,$color,$password_first);
                    if($result){
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        $_SESSION['tnumber'] = $tnumber;
                        $_SESSION['color'] = $color;
                        header("Location: http://127.0.0.1/user/personal");
                    } else {
                        debug_var("Ошибка регистрации!");
                    }
                }
            }
            else
            {
                $this->viewer->register([]);
            }
            // $this->viewer->register([]);
        }
    }

    function personal_page()
    {
        // $this->viewer->personal([]);
        if(isset($_SESSION['username']))
        {
            $data = [
                'username' => $_SESSION['username'],
                'email' => $_SESSION['email'],
                'tnumber' => $_SESSION['tnumber'],
                'color' => $_SESSION['color']
            ];
            $this->viewer->personal($data);
        }
        else
        {
            header("Location: http://127.0.0.1/user/login");
        }
    }
}
?>