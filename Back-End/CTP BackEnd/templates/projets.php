<?php
    session_start();
// Ce fichier permet de tester les fonctions développées dans le fichier malibforms.php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "conversations.php")
{
    header("Location:../index.php?view=conversations");
    die("");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php");// tprint
include_once("libs/maLibForms.php");// mkTable, mkLiens, mkSelect ...
include_once("libs/maLibSQL.pdo.php");



?>

<h1>Projets</h1>

<h2>Liste des projets en cours : </h2>
<!-- Page à faire évoluer pour répondre au mockup "projets"-->

<?php

    $sql = "SELECT*FROM projets";
    $proj = parcoursRs(SQLSelect($sql));

    for($i = 0; $proj[$i] != NULL; $i++){
        echo("<a href=\"index.php?view=contributions&idprojet=".$proj[$i][idProjet]."&projet=".$proj[$i][nomProjet]."\"> ".$proj[$i][idProjet].". ".$proj[$i][nomProjet]."</a><br></br>");
        if($proj[$i+1] == NULL){
            $lastIdProj = $proj[$i][idProjet];
        }
    }
    $sql = "SELECT statut FROM users WHERE idUser = '".$_SESSION['idUser']."'";
    $_SESSION['statut'] = SQLGetChamp($sql);
    if($_SESSION['statut'] == 'P'){
        echo('
        <h3> Ajouter un projet : </h3>
        <form action="index.php?view=projets" method="POST">
            <label for="nomProjet"> Nom Projet : </label>
            <input type="text" name="nomProjet"/>
            <input type="submit" name="button" value="Submit" />
        </form>');
        }

        if($_POST['nomProjet'] != NULL){
            $datejour =  date('Y-m-d');
            $dateanne = date('Y');
            $datemoins = date('m');
            if((int)$datemoins >= 7){
                $anneScolaire = "".$dateanne."-".((int)$dateanne+1)."";
            }else{
                $anneScolaire = "".((int)$dateanne-1)."-".$dateanne."";
            }
            $lastIdProj++;
            $sql = "INSERT INTO `projets` VALUES ('".$lastIdProj."', '".$_POST['nomProjet']."', '".$anneScolaire."', '".$_SESSION['idUser']."')";
            echo($sql);
            SQLInsert($sql);
            $_POST['nomProjet'] = NULL;
            $lastIdProj = NULL;

            header("Location: index.php?view=projets");
            die("");
        }


?>

