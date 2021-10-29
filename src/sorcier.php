<?php
class Sorcier extends Personnage
{
    const DEF = 0;
    const VIE = 100;
    const FCE_MIN = 5;
    const FCE_MAX = 10;
    protected DateTime $last_special;

    function __construct($data)
    {
        if (is_array($data)) {

            $this->hydrate($data);
        } else {
            $this->defense = Sorcier::DEF;
            $this->force = random_int(Sorcier::FCE_MIN, Sorcier::FCE_MAX);
            $this->vie = Sorcier::VIE;
            $this->type = "Sorcier";
            $this->name = $data;
            $this->last_dodo = new DateTime("-10 minutes");
            $this->last_special = new DateTime("-10 minutes");
        }
    }
    public function hydrate($data)
    {
        foreach ($data as $attribut => $value) {

            $method = 'set' . str_replace(' ', '', ucfirst(str_replace('_', ' ', $attribut)));
            if (is_callable(array($this, $method))) {
                $this->$method($value);
            }
        }
    }


    public function setLastSpecial(DateTime $dateTime)
    {
        $this->last_dodo = $dateTime;
    }
    public function getLastSpecial()
    {

        return $this->last_special->format('Y-m-d H:i:s');
    }

    public function getLastSpecialObject()
    {
        return $this->last_special;
    }

    public function isPossible()
    {
        return $this->getLastSpecialObject() > new DateTime('-15 secondes');
    }
    public function sleeping(personnage $cible)
    {

        if ($this->isSleeping() && $this->isPossible()) {
            $cible->setLastDodoObject(new DateTime());
            $this->setLastSpecial(new DateTime());
        } // ta special est pas encore dispo
    }
}
