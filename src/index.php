<?php
spl_autoload_register(function ($name) {
    include $name . '.php';
});
$pdo = (new connexion())->getConnection();
$em = new PersonnageManager($pdo);
if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['guerrier'])) {
    $name = $_POST['name'];
    $em = new PersonnageManager((new connexion())->getConnection());
    $em->add(new Guerrier($name));
    var_dump($ret);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['sorcier'])) {
    $name = $_POST['name'];
    $em = new PersonnageManager((new connexion())->getConnection());
    $em->add(new Sorcier($name));
}

if ($_SERVER['REQUEST_METHOD'] == "GET" and isset($_POST['sorcier'])) {

    $id = $GET['id'];
    $id_cible = $GET['id_cible'];

    $perso = $em->findById($id);
    $perso_cible = $em->findById($id_cible);
    $perso->attaquer($perso_cible);
    $em->set($perso_cible);


    ////test////


}
$sql = "SELECT * FROM `personnage` WHERE `id`=:id";
$requete = $pdo->prepare($sql);
$requete->execute(array(":id" => 29));
$obj = $requete->fetch(PDO::FETCH_ASSOC);
// var_dump($obj);
$personnage = new Sorcier($obj);
// var_duamp($personnage);


?>
<!-- ////////////////////////////////////////////////////////////////////HTML////////////////////////////////////////////////////////////////////////////////////////// -->
<!DOCTYPE html PUBLIC>
<html>

<body>
    <form action="" method="POST">
        <input type="text" name="name" />
        <input type="submit" name="sorcier" value="Creer un sorcier" onclick="insert()" />
        <input type="submit" name="guerrier" value="Creer un guerrier" onclick="insert()" />

    </form>
    <table>
        <thead>
            <tr>
                <th>Liste de personnage</th>
            </tr>
        </thead>
        <tbody>
            <form action="combat.php" method="post">
                <?php
                $personnages = $em->findAll();
                foreach ($personnages as $personnage) {
                    echo ("<tr><td>" . $personnage['name'] . "<td>" . $personnage['type']);
                    echo ("<td><a href=\"http://localhost:5555/combat.php?id=" . $personnage['id'] . "\">Combatre</a></tr>");
                } ?>

            </form>
        </tbody>

    </table>