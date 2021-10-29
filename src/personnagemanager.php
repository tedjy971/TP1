<?php
require "personnage.php";
class PersonnageManager
{
    protected $personnage;
    protected PDO $dbo;
    function __construct(PDO $db)
    {
        $this->dbo = $db;
    }

    public function add(personnage $perso)
    {
        $sql = "INSERT INTO personnage (`name`, `type`, `force`, `defense`, `date_last_dodo`, `date_last_special`) VALUES (:name, :type, :force, :defense, :date_last_dodo, :date_last_special);";
        $requete = $this->dbo->prepare($sql);
        $requete->bindValue(':vie', $perso->getVie(), PDO::PARAM_INT);
        $requete->bindValue(':name', $perso->getName(), PDO::PARAM_STR);
        $requete->bindValue(':type', $perso->getType(), PDO::PARAM_STR);
        $requete->bindValue(':force', $perso->getForce(), PDO::PARAM_INT);
        $requete->bindValue(':defense', $perso->getDefense(), PDO::PARAM_INT);
        $requete->bindValue(':date_last_dodo', $perso->getLastDodo(), PDO::PARAM_STR);
        $requete->bindValue(':date_last_special', $perso->getLastSpecial(), PDO::PARAM_STR);
        $requete->execute();
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM `personnage` WHERE `id`=:id";
        $requete = $this->dbo->prepare($sql);
        $result = $requete->execute(array(":id" => $id));
        return $result;
    }

    public function set(personnage $perso)
    {
        $sql = "UPDATE `personnage` 
                        SET `name`=`:name`, `type`=`:type`, `force`=`:force`, `defense`=`:defense`, `data_last_dodo`=`:date_last_dodo` 
                        WHERE `id`=:id";
        $requete = $this->dbo->prepare($sql);

        $requete->bindValue(':name', $perso->getName(), PDO::PARAM_STR);
        $requete->bindValue(':type', $perso->getType(), PDO::PARAM_STR);
        $requete->bindValue(':vie', $perso->getVie(), PDO::PARAM_INT);
        $requete->bindValue(':force', $perso->getForce(), PDO::PARAM_INT);
        $requete->bindValue(':defense', $perso->getDefense(), PDO::PARAM_INT);
        $requete->bindValue(':date_last_dodo', $perso->getLastDodo(), PDO::PARAM_STR);
        $requete->bindValue(':date_last_special', $perso->getLastSpecial(), PDO::PARAM_STR);
        $requete->execute();
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM `personnage` WHERE `id`=:id";
        // echo $id;
        $requete = $this->dbo->prepare($sql);
        $requete->execute(array(":id" => 29));
        $obj = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($obj);
        if ($obj['type'] == "Sorcier")
            $personnage = new Sorcier($obj);
        else
            $personnage = new Guerrier($obj);
        return $personnage;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM `personnage` ";
        $requete = $this->dbo->query($sql);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(string $requete, array $param)
    {
        $requete = $this->dbo->prepare($requete);
        $requete->execute($param);
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}
