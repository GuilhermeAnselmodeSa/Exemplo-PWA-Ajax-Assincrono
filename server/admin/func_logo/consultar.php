<?php
   include "../../conexao.php";
   include "../../funcoes.php";
   
   $retorno = array();
   extract($_POST);


   if (isset($tipo)) {
       if ($tipo == "consultar") {
           $sql = "SELECT * FROM empresas_parceiras WHERE id_empresa = :id_empresa";
           $comando = $conexao->prepare($sql);
           $comando->bindParam(":id_empresa", $id_empresa);
           $comando->execute();
           $dados = $comando->fetch(PDO::FETCH_ASSOC);
           if (!$dados) {
               $retorno["status"] = 0;
               $retorno["mensagem"] = "Item não encontrado";
           } else {
               $retorno["status"] = 1;
               $retorno["dados"] = $dados;
           }
       }
   }
        else{        
            $retorno["status"] = 0;   
            $retorno["mensagem"] = "Tipo de requisição não informado.";     
        }
            

echo json_encode($retorno, JSON_UNESCAPED_UNICODE);  
?>