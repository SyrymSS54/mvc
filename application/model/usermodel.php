<?php
class usermodel{
    protected $config;
    public $defualt_config = [
        'host'      => '127.0.0.1',
        'db'        => 'crm',
        'user'      => 'syrym',
        'pass'      => '1253579Qwerty',
        'charset'   => 'utf8'
    ];
    protected $opt = [
        PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES      => false,
    ];
    protected $dsn;
    protected $pdo;

    function __construct($config = '')
    {
        if(!($config == '')){
            $this->config = $config;
        }
        else
        {
            $this->config = $this->defualt_config;
        }
        
        $this->dsn = $this->get_dsn($this->config['host'],$this->config['db'],$this->config['charset']);
        $this->pdo = $this->connnection_db($this->dsn,$this->config['user'],$this->config['pass'],$this->opt);
    }

    protected function get_dsn($host,$db,$charset)
    {
        return "mysql:host=$host;dbname=$db;charset=$charset";
    }

    protected function connnection_db($dsn, $user, $pass, $opt)
    {
        $pdo = new PDO($dsn,$user,$pass,$opt);
        return $pdo;
    }

    public function check_data($email)
    {
        $stmt = $this->pdo->prepare('SELECT id FROM user WHERE email = :email');
        $stmt -> execute(['email' => $email]);
        $result = $stmt -> fetch();
        return $result;
    }

    public function get_account_data($email,$password)
    {
        $set = $this->check_data($email);
        if($set)
        {
            $stmt = $this -> pdo -> prepare('SELECT id,username,email,tnumber,color FROM user WHERE email = :email AND password = :password');
            $stmt -> execute(['email'=>$email,'password'=>$password]);
            return $stmt->fetch();
        }
        else
        {
            return $set;
        }
    }

    public function insert_account_data($username,$email,$tnumber,$color,$password)
    {
        $set = $this->check_data($email);
        if(!$set)
        {
            $values = [
                'username'  =>  $username,
                'email'     =>  $email,
                'tnumber'   =>  $tnumber,
                'color'     =>  $color,
                'password'  =>  $password
            ];
            $stm = $this->pdo->prepare("INSERT INTO user(username,email,tnumber,color,password) VALUES(:username,:email,:tnumber,:color,:password)");
            $stm->execute($values);
            return True;
        }
        else
        {
            return false;
        }
    }
}

$model = new usermodel();
$email = 'syrym@gmail.com';
var_dump($model->insert_account_data("danial","danial@gmail.com","87078088877","green","qwerty"));
?>