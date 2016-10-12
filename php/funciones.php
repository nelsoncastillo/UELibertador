<?php
function f_genera_psw($num=8){ // By Kernellover
    $voc = array ("a","e","i","o","u");
    $con = array ("b","c","d","f","g","h","j","k","l","m","n","ñ","p","q","r","s","t","w","x","y","z");
    $psw = "";                // cadena que contendrá el password.
    $vc  = mt_rand(0,1);    // definde si empieza por vocal o consonante.
    for ($n=0; $n<$num; $n++){
        if ($vc==1){
            $vc=0;
            $psw .= $con[mt_rand(0,count($con)-1)];
        }
        $psw .= $voc[mt_rand(0,count($voc)-1)];
        $psw .= $con[mt_rand(0,count($con)-1)];
    }
    $psw = ereg_replace ("q","qu",$psw);
    $psw = ereg_replace ("quu","que",$psw);
    $psw = ereg_replace ("yi","ya",$psw);
    $psw = ereg_replace ("iy","ay",$psw);
    $psw = substr($psw,0,$num);
    return $psw;
} //se invoca con 
	//echo f_genera_psw(); // imprime el password (8 caracteres por defecto)  
	//echo f_genera_psw(6); // imprime 6 caracteres de password  

?>
