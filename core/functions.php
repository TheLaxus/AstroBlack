<?php

function Redirect($url, $local = true) {
    ob_start();

    if ($url == 'reload') {
        header('Refresh: 0');
    } else if ($local == true || $local == null) {
        $goto = $url;
        header('Location: ' . $goto);
    } else {
        $goto = ($local) ? URL . $url : $url;
        header('Location: ' . $goto);
    }

    ob_end_flush();
}

function CurrentURLPath($type = null) {
    if ($type == null || $type == '1') {
        $url = parse_url(URL_ATUAL, PHP_URL_PATH);
        $url = str_replace('/', '', $url);
    } else if ($type == '2') {
        $url = parse_url(URL_ATUAL, PHP_URL_PATH);
    }  

    return $url;
}

function str_noaccents($string) {
    $word = $string;
    $word = preg_replace('#Ç#', 'C', $word);
    $word = preg_replace('#ç#', 'c', $word);
    $word = preg_replace('#è|é|ê|ë#', 'e', $word);
    $word = preg_replace('#È|É|Ê|Ë#', 'E', $word);
    $word = preg_replace('#à|á|â|ã|ä|å#', 'a', $word);
    $word = preg_replace('#@|À|Á|Â|Ã|Ä|Å#', 'A', $word);
    $word = preg_replace('#ì|í|î|ï#', 'i', $word);
    $word = preg_replace('#Ì|Í|Î|Ï#', 'I', $word);
    $word = preg_replace('#ð|ò|ó|ô|õ|ö#', 'o', $word);
    $word = preg_replace('#Ò|Ó|Ô|Õ|Ö#', 'O', $word);
    $word = preg_replace('#ù|ú|û|ü#', 'u', $word);
    $word = preg_replace('#Ù|Ú|Û|Ü#', 'U', $word);
    $word = preg_replace('#ý|ÿ#', 'y', $word);
    $word = preg_replace('#Ý#', 'Y', $word);

    return $word;
}

function startsWith ($string, $startString) { 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}

?>