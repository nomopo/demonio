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

function historico ($historico) {

    global $datos;
    global $historico;


    $FicheroLog = fopen("log/log-".date('Ymd-Hi').".txt", "a") or die("No se ha podido abrir el archivo");
    $historico = date("Ymd-Hi_").$historico;
    fwrite($FicheroLog, $historico);
    fclose($FicheroLog);
}

function atos ($xml) {

    global $ATOS;

    global $historico;
    global $datos;

    //copy("xml/".$xml, $ATOS.$xml);


    if(!copy("./xml/".$xml, $ATOS.$xml)) {
        $historico = "Fichero ".$xml." no se ha copiado a Directorio".$ATOS.$xml." \n";
        historico($historico);
    } else {
        $historico = "Fichero ".$xml." se ha copiado a Directorio".$ATOS.$xml." \n";
        historico($historico);
    }

}

function piramide ($xml) {

    global $PiramideEnergy;
    global $PiramideHome;

    global $historico;
    global $datos;

    $carpeta = date("Y-m-d H:i:s")."_";


    if(!copy("./xml/".$xml, $PiramideHome.$xml)) {
        $historico = "Fichero ".$xml." no se ha copiado a Directorio".$ATOS.$xml." \n";
        historico($historico);
    } else {
        $historico = "Fichero ".$xml." se ha copiado a Directorio".$ATOS.$xml." \n";
        historico($historico);
    }

}



?>