<?php
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



?>

    <h1>Projet : </h1>

    <h2>Liste des étape du projet </h2>
    Page à faire évoluer pour répondre au mockup "etapes"
<?php

?>