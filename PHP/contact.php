<?php
    $array = array("firstname" => "", "name" => "", "email" => "", "phone" => "", "choix" => "", "message" => "", "firstnameError" => "", "nameError" => "", "emailError" => "", "phoneError" => "", "choixError"=>"", "messageError" => "", "isSuccess" => false);

    $emailTo = "yeun.lefloch@gmail.com";

    if ($_SERVER['REQUEST_METHOD']=="POST"){
        $array['firstname']= verifyInput($_POST['firstname']);
        $array['name']= verifyInput($_POST['name']);
        $array['email']= verifyInput($_POST['email']);
        $array['phone']= verifyInput($_POST['phone']);
        $array['choix']= verifyInput($_POST['choix']);
        $array['message']= verifyInput($_POST['message']);
        $array['isSuccess'] = true;
        $emailText = "";
        $emailObject="";
        
        
            if(empty($array['firstname'])){
                $array['firstnameError'] = "Merci de laisser votre prénom.";
                $array['isSuccess'] = false;
            }else{
                $emailText.= "Firstname: {$array['firstname']}\n"; //les accollades viennent spécifier que c'est une variable dans une string.
            }
        
            if(empty($array['name'])){
               $array['nameError'] = "Merci de laisser votre nom.";
               $array['isSuccess'] = false;
            }else{
                $emailText.= "Name: {$array['name']}\n";
            }
            if(empty($array['choix'])){
               $array['choixError'] = "Pour quelle raison me contactez-vous ?";
               $array['isSuccess'] = false;
            }else{
                $emailObject = "{$array['choix']}";
            }
        
            if(!isEmail($array['email'])){
                $array['emailError']= "Hoho cela ne ressemble pas une adresse mail!";
                $array['isSuccess'] = false;
            } else{
                $emailText.= "Email {$array['email']}\n";
            }
        
            if(!isPhone($array['phone'])){
              $array['phoneError']="Seul des chiffres et des espaces sont attendus";
              $array['isSuccess'] = false;
            } else{
                $emailText.= "phone: {$array['phone']}\n";
            }
        
              if(empty($array['message'])){
                $array['messageError'] = "Des fleurs ou autre chose ?";
                $array['isSuccess'] = false;
            } else{
                $emailText.= "Message: {$array['message']}\n";
            }
        
        
        
            if($array["isSuccess"]) 
        {
            $headers = "From: {$array['firstname']} {$array['name']} <{$array['email']}>\r\nReply-To: {$array['email']}";
            mail($emailTo, $emailObject, $emailText, $headers);
        }
        
        echo json_encode($array);
        
    }
    function isPhone($phone){
        return preg_match("/^[0-9 ]*$/",$phone); //expression refulière, ici on demande un chiffre entre 0 et 9 soit un espace. * permet que le champ soit vide elle permet que on prennent ce qu'il y a entre crochet de zéro a autant de fois qu'on veut (sinon on met un + pour avoir un carractères minimum) 
    }



    
    function isEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }



    function verifyInput($var){
        $var= trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
                
        return $var;
    }

?>