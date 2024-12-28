<?php
class managermodel{
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
        $result = $stmt -> fetchAll();
        return $result;
    }

    public function id_search($id)
    {
        $stmt = $this->pdo->prepare('SELECT id,username,email,tnumber,color,password FROM user WHERE id = :id');
        $stmt -> execute(['id' => $id]);
        $result = $stmt -> fetchAll();
        return $result;
    }

    public function username_search($username)
    {
        $stmt = $this->pdo->prepare('SELECT id,username,email,tnumber,color,password FROM user WHERE username = :username');
        $stmt -> execute(['username' => $username]);
        $result = $stmt -> fetchAll();
        return $result;
    } 

    public function email_search($email)
    {
        $stmt = $this->pdo->prepare('SELECT id,username,email,tnumber,color,password FROM user WHERE email = :email');
        $stmt -> execute(['email' => $email]);
        $result = $stmt -> fetchAll();
        return $result; 
    }

    public function tnumber_search($tnumber)
    {
        $stmt = $this->pdo->prepare('SELECT id,username,email,tnumber,color,password FROM user WHERE tnumber = :tnumber');
        $stmt -> execute(['tnumber' => $tnumber]);
        $result = $stmt -> fetchAll();
        return $result;
    }

    public function delete_function($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM user WHERE id=:id');
        $stmt -> execute(['id' => $id]);
    }

    public function update_date()
    {

    }
}
?>