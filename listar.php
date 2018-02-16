<?php

include_once ("funciones.php");

if ($gestor = opendir('xml/')) {
    while (false !== ($entrada = readdir($gestor))) {
        if (substr($entrada, -4) == ".xml" or substr($entrada, -4) == ".XML") {
            $array[] = $entrada;

        }
    }
}
closedir($gestor);
//********************************************************************************************************************//
echo "Hay ".sizeof($array)." elementos en el array";
//********************************************************************************************************************//
echo "<hr>";
//********************************************************************************************************************//
for($i = 0;$i<(sizeof($array));$i++) {
    $fichero = simplexml_load_file("xml/".$array[$i]);

    if ($fichero->Cabecera->CodigoREEEmpresaDestino == "0815") {
        //echo $i." - El fichero $array[$i] es de Home <br>";
        //$datos = $i." - El fichero $array[$i] es de Home \n";
        //historico ($datos);
        //echo $array[$i];

        atos($array[$i]);
    } else if ($fichero->Cabecera->CodigoREEEmpresaDestino == "0980") {
        //echo $i." - El fichero $array[$i] es de Energy <br>";
        //$datos = $i." - El fichero $array[$i] es de Energy \n";
        //historico ($datos);

    }
}

echo "<hr>";

//echo $array[1];
echo "<hr>";


?>

