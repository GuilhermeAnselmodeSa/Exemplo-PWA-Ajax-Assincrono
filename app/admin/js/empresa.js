const formulario = document.getElementById("formulario");
const lblAviso = document.getElementById("lblaviso");
const corpoTabela = document.querySelector("table tbody");
const txtFiltrar = document.getElementById("txtfiltrar");

cadastrar = function(retorno){
    	if(retorno.status == 1){
            lblAviso.innerHTML = retorno.mensagem;
            lblAviso.style.color = "black";
            formulario["txtid_empresa"].value = "";
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
            <td>${pos.id_empresa}</td>
            <td>${pos.nome_empresa}</td>
            <td>${pos.cnpj_empresa}</td>
            <td>${pos.cidade_empresa}</td>
            <td>${pos.endereco_emprego}</td>
            <td>${pos.estado_empresa}</td>
            <td>
                <a href="javascript:excluir(${pos.id_empresa});">Excluir</a>
  
                <a href="javascript:pegarDados(${pos.id_empresa});">Alterar</a>
  
                </tr>`;
       });
    }
}

formulario.addEventListener("submit", function(e){
     e.preventDefault();
     let dados = new FormData(formulario);
    if(isNaN(dados.get("txtid_empresa"))){
        dados.append("tipo", "cadastrar");
        Ajax("POST", URL_WEBSERVICE + "admin/func_empresa/cadastrar.php", dados, cadastrar);
    }else{
        dados.append("tipo", "alterar");
        Ajax("POST", URL_WEBSERVICE + "admin/func_empresa/alterar.php", dados, alterar);
    }
    // let dados = new FormData(formulario);
    //         dados.append("tipo", "cadastrar");
             
        //    +"func_empresa"
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
    Ajax("POST", URL_WEBSERVICE + "admin/func_empresa/listagem.php", requisicaoListar, listar);
    // +"func_empresa"
}


executarListagem();

excluir = function(id_empresa){
    if(confirm("Deseja realmente excluir esta empresa?")){
        let requisicaoExcluir = new FormData();
        requisicaoExcluir.append("tipo", "excluir");
        requisicaoExcluir.append("id_empresa",id_empresa);
        Ajax("POST", URL_WEBSERVICE + "admin/func_empresa/excluir.php", requisicaoExcluir, posExcluir);
        // +"func_empresa"
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
    requisicaopegarDados.append("id_empresa",id_empresa);
        Ajax("POST", URL_WEBSERVICE + "admin/func_empresa/consultar.php", requisicaopegarDados, preencherFormulario);
        // +"func_empresa"
}

preencherFormulario = function(retorno){
    if(retorno.status == 1){
        formulario["txtid_empresa"].value = retorno.dados.id_empresa;
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
