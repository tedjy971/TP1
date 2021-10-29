<!DOCTYPE html PUBLIC>
<html>
<form action="" method="POST">
    <?php
    spl_autoload_register(function ($name) {
        include $name . '.php';
    });
    $id = $_GET['id'];
    $em = new PersonnageManager((new Connexion())->getConnection());
    $combatant = $em->findById($id);
    $requete = "SELECT * FROM personnage WHERE id != :id";
    $param = array(":id" => $_GET['id']);
    $persos = $em->find($requete, $param);
    // var_dump($persos);
    foreach ($persos as $perso) {
        echo ("<table><tr>");
        if ($combatant->getType() == "Sorcier")
            echo ("<td><input type=\"submit\" name=\"" . $perso['id'] . " \" value=\"Endormir " . $perso['name'] . "\"onclick=\"endormir(" . $perso['id'] . ")\" /></td>");
        echo "<td><input type=\"submit\" name=\"" . $perso['id'] . " \" value=\"Attaquer " . $perso['name'] . "\"onclick=\"attaquer(" . $perso['id'] . ")\" /></td>";
        echo ("</tr></table>");
    }

    function attaquer($id, $id_cible)
    {
        $pdo = (new Connexion())->getConnection();
        $em = new PersonnageManager($pdo);
        $combatant = $em->findById($id);
        $cible = $em->findById($id_cible);
        $combatant->e($cible);

        $em->set($cible);
    }
    function endormir($id, $id_cible)
    {
        $pdo = (new Connexion())->getConnection();
        $em = new PersonnageManager($pdo);
        $combatant = $em->findById($id);
        $cible = $em->findById($id_cible);
        $combatant->sleeping($cible);

        $em->set($cible);
    }
    ?>