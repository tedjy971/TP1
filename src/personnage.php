<?php


abstract class  Personnage
{
    protected $id;
    protected $vie;
    protected $force;
    protected $defense;
    protected  dateTime $last_dodo;
    protected $type;
    protected $name;

    function __construct()
    {
        $this->last_dodo = new DateTime("-10 minutes");
    }
    abstract function getLastSpecial();

    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getVie(): int
    {
        return $this->vie;
    }
    public function setVie(int $val)
    {
        $this->vie = $val;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName(string $val)
    {
        $this->name = $val;
    }
    public function getType(): string
    {
        return $this->type;
    }
    public function setType(string $val)
    {
        $this->type = $val;
    }
    public function getDefense(): int
    {
        return  $this->defense;
    }
    public function setDefense(int $val)
    {
        $this->defense = $val;
    }
    public function getForce(): int
    {
        return $this->force;
    }
    public function setForce(int $val)
    {
        $this->force = $val;
    }

    public function getLastDodo()
    {
        return $this->last_dodo->format('Y-m-d H:i:s');
    }
    public function setLastDodo(string $dateTime)
    {
        $this->last_dodo = new DateTime($dateTime);
    }
    public function setLastDodoObject(DateTime $dateTime)
    {
        $this->last_dodo = new DateTime($dateTime);
    }

    public function getLastDodoObject(): DateTime
    {
        return $this->last_dodo;;
    }

    public function attaquer(personnage $cible): void
    {
        if (!$this->isSleeping()) {
            $cible->vie = $cible->getVie() -  ($this->getDefense() - $cible->getForce());
        }
    }
    public function isSleeping()
    {
        return $this->getLastDodoObject() > new DateTime("-15 seconde");
    }
}
