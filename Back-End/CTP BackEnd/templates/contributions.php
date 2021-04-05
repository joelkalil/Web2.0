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

<h1>Saisie d'un contribution : </h1>

<!--Page à faire évoluer pour répondre au mockup "contributions"-->

<?php
    $sql = "SELECT*FROM `contributions` WHERE idUser = '".$_SESSION['idUser']."' ";
    $contri = parcoursRs(SQLSelect($sql));
    $sql = "SELECT*FROM `contributions`";
    $contri2 = parcoursRs(SQLSelect($sql));
    $sql = "SELECT*FROM `etapes` WHERE idProjet = '".$_GET['idprojet']."' ";
    $idetapes = parcoursRs(SQLSelect($sql));

    echo("<h3> ".$_GET['projet']." </h3>");
    
    if($_SESSION['statut'] == 'P'){
        $aux2 = 0;
        for($i = 0; $contri2[$i] != NULL; $i++){
            $aux = 0;
            $aux3 = 0;
            for($j = 0; $idetapes[$j] != NULL; $j++){
                if($contri2[$i]['idEtape'] == $idetapes[$j]['idEtape']){
                    $aux = 1;
                    $aux2++;
                    $aux3 = $j;
                }
            }
            if($aux == 1){
                $datejour =  strtotime($idetapes[$aux3]['dateFinEtape']);
                $datedb = strtotime($contri2[$i]['dateContribution']);
                if($datejour < $datedb){
                    echo("<font color='#ff0000'><p> idEtape :".$contri2[$i]['idEtape']." | idUser :".$contri2[$i]['idUser']." | Date :".$contri2[$i]['dateContribution']." | Contribution :".$contri2[$i]['urlContribution']."</a></font>");
                }else{
                    echo("<p> idEtape :".$contri2[$i]['idEtape']." | idUser :".$contri2[$i]['idUser']." | Date :".$contri2[$i]['dateContribution']." | Contribution :".$contri2[$i]['urlContribution']."</p>");
                }
            }
        }
        if($aux2 == 0){
            echo("N'a pas quelque contributions!");
        }

        $sql = "SELECT*FROM `etapes`";
        $toutEtapes = parcoursRs(SQLSelect($sql));

        echo('
        <h3> Etapes : </h3>');

        for($i = 0; $toutEtapes[$i] != NULL; $i++){
            echo("<p> idEtape :".$toutEtapes[$i]['idEtape']." | idProjet :".$toutEtapes[$i]['idProjet']." | Description :".$toutEtapes[$i]['descriptionEtape']." | Fin d'Etape :".$toutEtapes[$i]['dateFinEtape']."</p>");
            if($toutEtapes[$i+1] == NULL){
                $lastIdEtape = $toutEtapes[$i]['idEtape'];
            }
        }

        echo("
        <h3> Ajouter une Etape : </h3>
        <form action='index.php?view=contributions&idprojet=".$_GET['idprojet']."&projet=".$_GET['projet']."' method='POST'>
            <label for=\"nomEtape\"> Description Etape : </label>
            <input type=\"text\" name=\"nomEtape\"/><br></br>
            <label for=\"dateFinEtape\"> Date de fin d'Etape (Y-m-d) : </label>
            <input type=\"text\" name=\"dateFinEtape\"/><br></br>
            <input type=\"submit\" name=\"button\" value=\"Submit\" />
        </form>");

        if($_POST['nomEtape'] != NULL){
            $lastIdEtape++;
            $sql = "INSERT INTO `etapes` VALUES ('".$lastIdEtape."', '".$_GET['idprojet']."', '".$_POST['nomEtape']."', '".$_POST['dateFinEtape']."')";
            echo($sql);
            SQLInsert($sql);
            $_POST['nomEtape'] = NULL;
            $lastIdEtape = NULL;

            header("Location: index.php?view=contributions&idprojet=".$_GET['idprojet']."&projet=".$_GET['projet']."");
            die("");
        }

    }else{
        $aux2 = 0;
        for($i = 0; $contri[$i] != NULL; $i++){
            $aux = 0;
            $aux3 = 0;
            for($j = 0; $idetapes[$j] != NULL; $j++){
                if($contri[$i]['idEtape'] == $idetapes[$j]['idEtape']){
                    $aux = 1;
                    $aux2++;
                    $aux3 = $j;
                }
            }
            if($aux == 1){
                $datejour =  strtotime($idetapes[$aux3]['dateFinEtape']);
                $datedb = strtotime($contri[$i]['dateContribution']);
                if($datejour < $datedb){
                    echo("<font color='#ff0000'><p> idEtape :".$contri[$i]['idEtape']." | Date :".$contri[$i]['dateContribution']." | Contribution :".$contri[$i]['urlContribution']."</a></font>");
                }else{
                    echo("<p> idEtape :".$contri[$i]['idEtape']." | Date :".$contri[$i]['dateContribution']." | Contribution :".$contri[$i]['urlContribution']."</p>");
                }
            }
        }
        if($aux2 == 0){
            echo("N'a pas quelque contributions!");
        }
        
        echo("
        <h3> Ajouter une contribution : </h3>
        <form action=\"index.php?view=contributions&idprojet=".$_GET['idprojet']."&projet=".$_GET['projet']."\" method=\"POST\">
            <label for=\"etape\"> Choisir une étape </label>
            <select name = 'etapeCont'>");

        for($i = 0; $idetapes[$i] != NULL; $i++){
            $aux = 1;
            if($idetapes[$i]['idProjet'] == $_GET['idprojet']){
                for($j = 0; $contri[$j] != NULL; $j++){
                    if($contri[$j]['idEtape'] == $idetapes[$i]['idEtape']){
                        $aux = 0;
                    }
                }
                if($aux == 1){
                    echo("<option value = \"".$idetapes[$i]['idEtape']."\">".$idetapes[$i]['idEtape']."</option>");
                }
            }
        }

        echo('
            </select>
            <br></br>
            <label for="contribution"> Contribution : </label>
            <input type="text" name="contribution"/>
            <br></br>
            <input type="submit" name="button" value="Submit" />
        </form>');

        if($_POST['contribution'] != NULL){
            $datejour =  date('Y-m-d');
            $sql = "INSERT INTO `contributions` VALUES ('".$_POST['etapeCont']."', '".$_SESSION['idUser']."', '".$datejour."', '".$_POST['contribution']."')";
            SQLInsert($sql);
            $_POST['contribution'] = NULL;
            $_POST['etapeCont'] = NULL;

            header("Location: index.php?view=contributions&idprojet=".$_GET['idprojet']."&projet=".$_GET['projet']."");
            die("");
        }
    }
?>
