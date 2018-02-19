<?php


//*******Rutas Audinfor***********************************************************************************************//
$AudinforEnergyF1 = "//192.168.0.3/XML_Audinfor/Energy/F1/";
$AudinforEnergyQ1 = "//192.168.0.3/XML_Audinfor/Energy/Q1/";

$AudinforHomeF1 = "//192.168.0.3/XML_Audinfor/Home/F1/";
$AudinforHomeQ1 = "//192.168.0.3/XML_Audinfor/Home/Q1/";
//********************************************************************************************************************//

//*******Rutas Peajes Control*****************************************************************************************//
$PeajesControl = "//192.168.0.3/Datos/JUAN/Peajes_Control/descargasxml/";
//********************************************************************************************************************//

//*******Rutas Pirámide***********************************************************************************************//
//$PiramideEnergy = "c:/Grupo Castilla/XML/";
//$PiramideHome = "c:/Grupo Castilla/XML-HOME/";
$PiramideEnergy = "temp/Energy/";
$PiramideHome = "temp/HOME/";
//********************************************************************************************************************//

//*******Rutas ATOS***************************************************************************************************//
$ATOS = "temp/";
//********************************************************************************************************************//



if ($gestor = opendir('xml/')) {
    while (false !== ($entrada = readdir($gestor))) {
        if (substr($entrada, -4) == ".xml" or substr($entrada, -4) == ".XML") {
            $array[] = $entrada;

        }
    }
}
closedir($gestor);
//ATOS();
//PEAJES();
PIRAMIDE();
/*
if(ARCHIVAR($array) === 1) {
    BORRAR($array);
}
*/







function ATOS() {

    global $array;
    global $ATOS;
    global $logs;

    for($i=0;$i<sizeof($array);$i++) {
        copy ("xml/".$array[$i], $ATOS.$array[$i]);
        $logs = "El fichero ".$array[$i]." ha sido copiado a ATOS \n";
        LOGS($logs);
    }
    echo "Se han copiado $i archivos a la carpeta ATOS <br>";
}

function PEAJES() {

    global $array;
    global $PeajesControl;
    global $logs;

    for($i=0;$i<sizeof($array);$i++) {
        copy ("xml/".$array[$i], $PeajesControl.$array[$i]);
        $logs = "El fichero ".$array[$i]." ha sido copiado a PEAJES \n";
        LOGS($logs);
    }
    echo "Se han copiado $i archivos a la carpeta PEAJES <br>";
}

function PIRAMIDE() {

    global $array;
    global $PiramideHome;
    global $PiramideEnergy;
    global $logs;

    for($i=0;$i<sizeof($array);$i++) {
        //echo ($i+1)." - Nombre fichero: ".$array[$i]."<br>";
        $fichero = simplexml_load_file("xml/".$array[$i]);

        if (($fichero->Cabecera->CodigoREEEmpresaDestino == "0815") && ($fichero->Cabecera->CodigoDelProceso == "F1")) {
            copy ("xml/".$array[$i], $PiramideHome.$array[$i]);
            $logs = "El fichero ".$array[$i]." ha sido copiado a PIRAMIDE HOME \n";
            LOGS($logs);

        } else if (($fichero->Cabecera->CodigoREEEmpresaDestino == "0980") && ($fichero->Cabecera->CodigoDelProceso == "F1")) {
            copy ("xml/".$array[$i], $PiramideEnergy.$array[$i]);
            $logs = "El fichero ".$array[$i]." ha sido copiado a PIRAMIDE ENERGY \n";
            LOGS($logs);
        }
    }
}

function AUDINFOR($xml) {

    global $array;

    for($i=0;$i<sizeof($array);$i++) {
        echo ($i+1)." - Nombre fichero: ".$array[$i]."<br>";
    }
}

function LOGS($logs) {
    global $logs;
    global $historico;


    $FicheroLog = fopen("log/log-".date('Ymd-Hi').".txt", "a") or die("No se ha podido abrir el archivo");
    $historico = date("Ymd-Hi")." \n".$logs;
    fwrite($FicheroLog, $historico);
    fclose($FicheroLog);

}

function ARCHIVAR() {

    global $array;
    global $logs;
    global $creado;

    $zip = new ZipArchive();
    $filename = date('Ymd-Hi').".zip";

    if($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit ("No se puede abrir el fichero ".$filename);
    }

    for($i=0;$i<sizeof($array);$i++) {
        $zip->addFile("xml/".$array[$i]);
        //echo ($i+1)." - Nombre fichero: ".$array[$i]."<br>";
    }

    if($zip->status != 0) {
        echo "Error en la creación del fichero";
    } else {
        echo "Fichero creado: ".date("Y-m-d_h-i-sa")."-".$filename;
        return $creado = 1;
    };
    $zip->close();
}

function BORRAR() {
    global $array;
    global $logs;

    for($i=0;$i<sizeof($array);$i++) {
        if(unlink("xml/".$array[$i])) {
            $logs = "El fichero ".$array[$i]." ha sido eliminado \n";
            LOGS($logs);
        };
    }
}
