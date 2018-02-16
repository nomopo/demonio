<?php

include_once("rutas.php");



function audinfor ($xml) {
    global $AudinforEnergyF1;
    global $AudinforEnergyQ1;
    global $AudinforHomeF1;
    global $AudinforHomeQ1;

    global $xml;
    global $path;
    global $pathXml;

    global $Empresa;

    echo $xml."<br>";
    echo $AudinforEnergyF1.$xml."<br>";

    copy($pathXml, $AudinforEnergyF1.$xml);
}

function historico ($datos) {

    global $datos;

    $FicheroLog = fopen("log-".date('Ymd-His').".txt", "a") or die("No se ha podido abrir el archivo");
    fwrite($FicheroLog, date("Y-m-d-H:i:s_").$datos);
    fclose($FicheroLog);
}
?>