<?php
//suppression
if(isset($_POST['supp'])){
    
    $img = $_POST['img'];
    $chm_img = './upload/'.$img;
    if(file_exists($chm_img)){
        unlink('./upload/'.$img); 
    }
} 
//Envoi des photos
/* Tableau des extensions de fichier autorisées */
$extensions_ok[] = "image/jpg";      
$extensions_ok[] = "image/gif";
$extensions_ok[] = "image/png"; 
$extensions_ok[] = "image/jpeg";     

if (isset($_FILES['fichier']['name'])) {
    for($i = 0; $i < count($_FILES['fichier']['name']); $i++) {

        $nom_fichier = $_FILES['fichier']['name'][$i];					
        $ext         = explode('.', $nom_fichier);
        $ext         = strtolower($ext[count($ext) - 1]);
        $nom_md5     = md5($nom_fichier);
        $taille      = $_FILES['fichier']['size'][$i];
        $type        = $_FILES['fichier']['type'][$i];
        $tmp         = $_FILES['fichier']['tmp_name'][$i];
        $error       = $_FILES['fichier']['error'][$i];
        $chemin      = utf8_encode(stripslashes($nom_fichier));
        //On teste l'extension du fichier
        if(!in_array(strtolower($type), $extensions_ok)){
            $msg_type = "Le fichier :<span class='text_rouge'> ".$nom_fichier." </span> ne posséde pas une extension valide et n'a pas pu être envoyé.<br />";					
        }elseif($taille > 1000000){
            $msg_taille = "La taille du fichier :<span class='text_rouge'> ".$nom_fichier." </span> est supéreieur à 1Mo et n'a pas pu être envoyé.<br />";
        }
        else{
            // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
            $dossier="./upload/image".uniqid().".".$ext.""; 
            
            // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur, ça y est, le fichier est uploadé
            if(move_uploaded_file($_FILES['fichier']['tmp_name'][$i], $dossier)){
                $mess = "<br /><span class='text_vert'>Files sent</span><br /><br />";
            }
        }
    }
}
include 'header.php';
include 'form.php';
include 'footer.php';