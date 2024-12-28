<?php
class adminmodel{
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

    public function admin_account($adminname,$password)
    {
        $stmt = $this->pdo->prepare('SELECT adminname FROM admin WHERE adminname = :adminname AND password = :password');
        $stmt-> execute(['adminname' => $adminname,'password' => $password]);
        $result = $stmt -> fetch();
        return $result;
    }    
}

// $model = new adminmodel();
// var_dump($model->admin_account('admin','1234Aa'));
?>