<?php
$usuario = "epiz_30387083";
$senha = "uYRtPOxVswql";
$servidor = "sql311.epizy.com";
$bd = "epiz_30387083_empresas";
$conexao = new PDO("mysql:host=".$servidor.";dbname=".$bd,
            $usuario,
            $senha,		
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "
                SET NAMES utf8"));
?>