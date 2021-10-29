
<?php
class Connexion
{

    protected $pdo;
    protected $host;
    protected $dbname;
    protected $pswd;
    protected $user;


    function __construct(string $host = "db", string  $dbname = "hetic_backend", string $user = 'root', int $port = 8001, string $pswd = 'TEST')
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->port = $port;
        $this->pswd = $pswd;

        try {
            $this->pdo = new PDO("mysql:host=" . $host . ";dbname=" . $dbname, $user, $pswd);
        } catch (Exception $th) {
            die("error :" . $th->getMessage());
        }
    }
    public function getConnection()
    {

        return $this->pdo;
    }
}

?>