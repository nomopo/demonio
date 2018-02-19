<?php

/**
* Created by PhpStorm.
* User: informatica
* Date: 15/02/2018
* Time: 11:11
*/

// El fichero test.xml contiene un documento XML con un elemento raíz y, al
// menos, un elemento /[raiz]/titulo.
include_once 'rutas.php';
include_once 'funciones.php';

global $xml;
global $path;
global $pathXml;


$path = 'xml/';
$xml = 'F1-ES0031101303160007HM0F_004E.xml';
$pathXml = $path.$xml;

/*
$empresa = $xml->Cabecera->CodigoREEEmpresaDestino;
$codigoProceso = $xml->Cabecera->CodigoDelProceso;

echo $empresa."<br>";
echo $codigoProceso."<br>";

*/

if(audinfor($pathXml)) {
echo "Archivo $xml copiado con éxito";
}

/*
$zip = new ZipArchive();
$filename = "F1.zip";

if($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
exit ("No se puede abrir el fichero ".$filename);
}
for($i = 0; $i<7;$i++) {
$zip->addFile("$i.xml");
}
for($i = 0; $i<7;$i++) {
copy("$i.xml", "//192.168.0.3/Datos/JUAN/kaka/$i.xml");
}


if($zip->status == 0) {
echo "Fichero creado: ".date("Y-m-d_h-i-sa")."-".$filename;
} else {
echo "Error en la creación del fichero";
};
$zip->close();
*/