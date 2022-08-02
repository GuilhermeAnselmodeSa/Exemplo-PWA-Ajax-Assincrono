const formulario = document.getElementById("formulario");
const lblAviso = document.getElementById("lblaviso");
const corpoTabela = document.querySelector("table tbody");
const txtFiltrar = document.getElementById("txtfiltrar");


cadastrar = function(retorno){
    	if(retorno.status == 1){
            lblAviso.innerHTML = retorno.mensagem;
            lblAviso.style.color = "black";
            formulario.reset();
            executarListagem();
        }else{
            lblAviso.innerHTML = retorno.mensagem;          
            lblAviso.style.color = "red";  
        }

        setTimeout(()=>{
            lblAviso.innerHTML = ""
        },2000);
}

listar = function(retorno){
    if(retorno.status == 1){
       retorno.lista.forEach(pos => {           
            corpoTabela.innerHTML += `<tr>
            <td>${pos.id_logo}</td>
            <td><img src="http://aula/Trabalho_PAM/server/imagens/logos/${pos.logo}" height="80px" /></td>
            <td>
                <a href="javascript:excluir(${pos.id_logo});">Excluir</a>
  
                <a href="javascript:pegarDados(${pos.id_logo});">Alterar</a>
  
                </tr>`;
       });
    }
}

formulario.addEventListener("submit", function(e){
     e.preventDefault();
     let dados = new FormData(formulario);
    if(isNaN(dados.get("txtid_logo"))){
        dados.append("tipo", "cadastrar");
    } 
    // let dados = new FormData(formulario);
    //         dados.append("tipo", "cadastrar");
           Ajax("POST", URL_WEBSERVICE + "admin/func_logo/cadastrar.php" , dados, cadastrar);

});

txtFiltrar.addEventListener("keyup", ()=>{
    let filtro = txtFiltrar.value;  
    executarListagem(filtro);    
});

executarListagem = function(filtro=""){
    corpoTabela.innerHTML = "";
    let requisicaoListar = new FormData();
    requisicaoListar.append("tipo", "listagem");
    requisicaoListar.append("filtro", "%"+filtro+"%");
    Ajax("POST", URL_WEBSERVICE + "admin/func_logo/listar.php", requisicaoListar, listar);
}


executarListagem();

excluir = function(id_logo){
    if(confirm("Deseja realmente excluir esta logo?")){
        let requisicaoExcluir = new FormData();
        requisicaoExcluir.append("tipo", "excluir");
        requisicaoExcluir.append("id_logo",id_logo);
        Ajax("POST", URL_WEBSERVICE + "admin/func_logo/excluir.php", requisicaoExcluir, posExcluir);
    }
}

posExcluir = function(retorno){

    if(retorno.status == 1){
    alert(retorno.mensagem);
    executarListagem();
        
    }else{
    alert(retorno.mensagem);
    }

}

 pegarDados = function(id_empresa){
 
    let requisicaopegarDados = new FormData();
    requisicaopegarDados.append("tipo", "consultar");
    requisicaopegarDados.append("id_logo",id_logo);
        Ajax("POST", URL_WEBSERVICE + "/admin/func_logo/consultar.php", requisicaopegarDados, preencherFormulario);
}

preencherFormulario = function(retorno){
    if(retorno.status == 1){
        formulario["txtnome_empresa"].value = retorno.dados.nome_empresa;
        formulario["txtcnpj_empresa"].value = retorno.dados.cnpj_empresa;
        formulario["txtcidade_empresa"].value = retorno.dados.cidade_empresa;
        formulario["txtendereco_emprego"].value = retorno.dados.endereco_emprego;
        formulario["txtestado_empresa"].value = retorno.dados.estado_empresa;
        formulario["btncadastrar"].innerHTML = "Salvar";
    }else{
        alert(retorno.mensagem);
    }
}
