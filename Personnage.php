<?php
class Personnage
{
    private $_id,
        $_degats=0,
        $_nom;

    const CEST_MOI = 1; // Constante renvoyée par la méthode `frapper` si on se frappe soi-même.
    const PERSONNAGE_TUE = 2; // Constante renvoyée par la méthode `frapper` si on a tué le personnage en le frappant.
    const PERSONNAGE_FRAPPE = 3; // Constante renvoyée par la méthode `frapper` si on a bien frappé le personnage.
    
    public function __construct($donnees)
    {
        $this->hydrate($donnees);
    }
        
    public function hydrate($donnees)
    {
        // $this->setId($donnees['id']);
        // $this->setNom($donnees['nom']);
        // $this->setDegats($donnees['degats']);

        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key); // exemple setId
            if (method_exists($this, $method)) //regarde si le setter existe
            {
                $this->$method($value); //si oui, appelle le setter, par exemple $this->setId($donnees[‘id’])
            }
        }
    }
    
    public function degats()
    {
        return $this->_degats;
    }

    public function id()
    {
        return $this->_id;
    }

    public function nom()
    {
        return $this->_nom;
    }

    public function setDegats($degats)
    {
        $degats = (int) $degats;

        if ($degats >= 0 && $degats <= 100) {
            $this->_degats = $degats;
        }
    }

    public function setId($id)
    {
        $id = (int) $id;

        if ($id > 0) {
            $this->_id = $id;
        }
    }

    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }
    
    public function frapper(Personnage $perso)
    {
        // Avant tout : vérifier qu'on ne se frappe pas soi-même.
        // Si c'est le cas, on stoppe tout en renvoyant une valeur signifiant que le personnage ciblé est le personnage qui attaque.
        if ($perso->id() == $this->_id) {
            return self::CEST_MOI;
        }
        // On indique au personnage frappé qu'il doit recevoir des dégâts.
        // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE
        return $perso->recevoirDegats();
    }
    public function recevoirDegats()
    {
        $this->_degats += 5;

        // Si on a 100 de dégâts ou plus, on dit que le personnage a été tué.
        if ($this->_degats >= 100) {
            return self::PERSONNAGE_TUE;
        }
        // Sinon, on se contente de dire que le personnage a bien été frappé.
        return self::PERSONNAGE_FRAPPE;
    }
    public function info(){
        $info = "</br> ************ </br>";
        $info .= "Je suis le personnage avec l'id: ".$this->id()."</br>";
        $info .= "Je m'appelle ".$this->nom()."</br>";
        $info .= "Mes dégats s'élèvent à: ".$this->degats()."</br>";
        $info .= "</br> ************ </br>";
        return $info;
    }
}
