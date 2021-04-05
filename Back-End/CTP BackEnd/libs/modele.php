<?php

/*
Dans ce fichier, on définit diverses fonctions permettant de récupérer des données utiles pour notre TP d'identification. Deux parties sont à compléter, en suivant les indications données dans le support de TP
*/


/********* EXERCICE 2 : prise en main de la base de données *********/


// inclure ici la librairie faciliant les requêtes SQL (en veillant à interdire les inclusions multiples)


function listerUtilisateurs($classe = "both")
{
	// Cette fonction liste les utilisateurs de la base de données 
	// et renvoie un tableau d'enregistrements. 
	// Chaque enregistrement est un tableau associatif contenant les champs 
	// id,pseudo,statut

	// Lorsque la variable $classe vaut "both", elle renvoie tous les utilisateurs
	// Lorsqu'elle vaut "P", elle ne renvoie que les utilisateurs enseignants
	// Lorsqu'elle vaut "E", elle ne renvoie que les utilisateurs étudiants

	//$SQL = "select * from users";
	//return parcoursRs(SQLSelect($SQL));

}

function verifUserBdd($login,$passe)
{
    $SQL = "SELECT idUser from users where pseudo='".$login."' AND passe='".$passe."';";
    return SQLGetChamp($SQL);
}

function isProf($idUser)
{
	// vérifie si l'utilisateur est un enseignant
}
function listerProjets($selection)
{

}
function getInfosProjet($idProjet)
{

}
function creerContribution($idEtape,$idUser,$dateContribution, $urlContribution)
{

}
function listerEtapes($idProjet,$idUser,$option="toutes")
{
    if ($option=="toutes") {
        $SQL = "SELECT * from etapes where idProjet = " . $idProjet;
    }
    else
    {
        $SQL = "SELECT etapes.* from etapes WHERE idProjet=$idProjet AND idEtape NOT IN (SELECT idEtape from contributions where idUser=$idUser)";
    }
    return parcoursRs(SQLSelect($SQL));
}
function listeContributions($idProjet,$idUser)
{

}
?>
