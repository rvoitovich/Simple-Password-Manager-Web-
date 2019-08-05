<?php 
function cubeCrypt($input,$decrypt=false) {
    $o = $s1 = $s2 = array();
    $basea = array('?','(','@',';','$','#',"]","&",'*');
    $basea = array_merge($basea, range('a','z'), range('A','Z'), range(0,9), range('а','я'), range('А','Я') );
    $basea = array_merge($basea, array('!',')','_','+','|','%','/','[','.',' ') );
    $dimension=9;
    for($i=0;$i<$dimension;$i++) {
        for($j=0;$j<$dimension;$j++) {
            $s1[$i][$j] = $basea[$i*$dimension+$j];
            $s2[$i][$j] = str_rot13($basea[($dimension*$dimension-1) - ($i*$dimension+$j)]);
        }
    }
    unset($basea);
    $m = floor(strlen($input)/2)*2;
    $symbl = $m==strlen($input) ? '':$input[strlen($input)-1];
    $al = array();
    for ($ii=0; $ii<$m; $ii+=2) {
        $symb1 = $symbn1 = strval($input[$ii]);
        $symb2 = $symbn2 = strval($input[$ii+1]);
        $a1 = $a2 = array();
        for($i=0;$i<$dimension;$i++) {
            for($j=0;$j<$dimension;$j++) {
                if ($decrypt) {
                    if ($symb1===strval($s2[$i][$j]) ) $a1=array($i,$j);
                    if ($symb2===strval($s1[$i][$j]) ) $a2=array($i,$j);
                    if (!empty($symbl) && $symbl===strval($s2[$i][$j])) $al=array($i,$j);
                }
                else {
                    if ($symb1===strval($s1[$i][$j]) ) $a1=array($i,$j);
                    if ($symb2===strval($s2[$i][$j]) ) $a2=array($i,$j);
                    if (!empty($symbl) && $symbl===strval($s1[$i][$j])) $al=array($i,$j);
                }
            }
        }
        if (sizeof($a1) && sizeof($a2)) {
            $symbn1 = $decrypt ? $s1[$a1[0]][$a2[1]] : $s2[$a1[0]][$a2[1]];
            $symbn2 = $decrypt ? $s2[$a2[0]][$a1[1]] : $s1[$a2[0]][$a1[1]];
        }
        $o[] = $symbn1.$symbn2;
    }
    if (!empty($symbl) && sizeof($al))
        $o[] = $decrypt ? $s1[$al[1]][$al[0]] : $s2[$al[1]][$al[0]];
    return implode('',$o);
}

function strcode($str, $passw="")
{
   $salt = "eRP9R4D59ZjCKnszYPWNNMiKGXHWbbkJwj0OYIFD6FA35BkwGCEKY0YBEOQeVLxXOgaFHTEykhTQIF67QNQlTQbw3SrKdeSFD6kMEq6bxvNwhx7jyukn0P5VeVWdoQdbjr92pQr0XpFL3V25NvP4bTAFXrzE633wBgXka9Fyez8b7Tgzno6sRKAcaqhZ6DEmfXQX5Jri1xgH3gUO9PJzr35MutoKlmTIp1puHA5BX2FYyalhVLvo4kbx3RiZvmFK7AdmsDEXVtrbLgBIGmueXXY04CgETDQu7cEVfvFHEm4P9RwPCxjtWyi4ozIcy2ualxc7vPE17HXdPDnp7vtWQjVVcF9IW9Jcck4WPg5lbVEZjqhgtXO7oDLoGBzcKxiXFaWgCGrCBPA56ErlR5AFz5eljhlDxKD5bxFdjRF1yXpF0FOIrCdk0XeGCwXXsfKVA4DpGer6ZXso7rZY5m6jPfL9PyVOIGakHh7xvB5ONaZokPcfWuRSyxVDcYCSDTPmO2beoMEGMTzRzf9HCSMo2kkgvBQCmvNEOLB64iVPYKk6AVNJSlK44PHdxcjvHJ81";
   $len = strlen($str);
   $gamma = '';
   $n = $len>100 ? 8 : 2;
   while( strlen($gamma)<$len )
   {
      $gamma .= substr(pack('H*', sha1($passw.$gamma.$salt)), 0, $n);
   }
   return $str^$gamma;
}

/*
$text = $_POST['text'];

$cry = cubeCrypt($text); #1 Encode
$tdcode = strcode(base64_decode($text), $_POST['key']); #1 Dencode

$encry = base64_decode($tdcode); #2 Dencode
$tecode = base64_encode($cry); #2 Encode

$encode = base64_encode(strcode($tecode, $_POST['key'])); #3 Encode
$decode = cubeCrypt($encry, 1); #3 Dencode

echo $encode; #code
echo $decode; #text */
?>