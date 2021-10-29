<?php

class Guerrier extends Personnage
{
    const DEF_MIN = 10;
    const DEF_MAX = 19;
    const FCE_MIN = 20;
    const FCE_MAX = 40;

    function __construct($data)
    {
        if (is_array($data)) {
            $this->hydrate($data);
        } else {
            $this->defense = random_int(Guerrier::DEF_MIN, Guerrier::DEF_MAX);
            $this->force = random_int(Guerrier::FCE_MIN, Guerrier::FCE_MAX);
            $this->vie = 100;
            $this->type = "Guerrier";
            $this->name = $data;
            $this->last_dodo = new DateTime('-10 minutes');
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
    public function getLastSpecial()
    {
        return null;
    }
}
    