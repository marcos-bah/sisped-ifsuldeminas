let controller = 1;

function del(id) {
    bootbox.confirm({
        message: "Excluir os dados dessa criança?",
        buttons: {
                confirm: {
                        label: 'SIM',
                        className: 'btn-success'
                },
                cancel: {
                        label: 'NÃO',
                        className: 'btn-danger'
                }
        },
        callback: function (result) {
                if (result) {

                    $.getJSON("acoes/delete.php",{id: id }, function(data){
                        //redirecionar, caregar pagina inicial
                        $('body').load('consultas.php'); 

                    });         
                }
            }
        });
}

function zerar(){
    $('#form input').val("");
}  

function sexo(s){
    if(s=="f"){
        document.getElementById("masculino").style.display = "none";
        document.getElementById("feminino").style.display = "block";
    }else{
        document.getElementById("feminino").style.display = "none";
        document.getElementById("masculino").style.display = "block";
    }
}

function IdGlobal(id){
    console.log("Sessão atual>>");
    
    console.log(id);
    
    document.getElementById('IdGlobal').value = id;
}

function gerarTable(){
    setTimeout(() => {
        var id = document.getElementById('Bkid').value;
        $.getJSON("acoes/initTable.php",{id: id }, function(data){
        $("div.cc").html(data);
    });
    }, 500);

}

function consulta(id){
    console.log("entrou no modal");
    document.getElementById('modalConsulta').style.display='block';
    document.getElementById('idem').value = id;
    console.log(id);
}

async function configuracao(){
    await jQuery.ajax({
        type: "POST",
        url: "acoes/configInit.php",
        dataType: "json",
        success: function(res)
        {
            console.log(res);
            
            document.getElementsByName("inst")[0].value = res[0][3];
            document.getElementsByName("end")[0].value = res[0][4];
            document.getElementsByName("cnpj")[0].value = res[0][2];
            document.getElementsByName("nomeaux")[0].value = res[0][0];
            document.getElementsByName("cpf")[0].value = res[0][6];
            document.getElementsByName("crm")[0].value = res[0][1];
            document.getElementsByName("user")[0].value = res[0][5];  
        }
    });
    console.log("entrou na config");
    document.getElementById("modalConfig").style.display="block";
}

function habilitar(){
    if(controller){
        document.getElementById('dias').disabled = false;
        document.getElementById('prematuro').innerHTML = "Sim";
        document.getElementById('prematuro').classList.remove("w3-red");
        document.getElementById('prematuro').classList.add("w3-green");
        document.getElementById('dias').value = 1;
        controller = 0;
    }else{
        document.getElementById('dias').disabled = true;
        document.getElementById('prematuro').innerHTML = "Não";
        document.getElementById('prematuro').classList.remove("w3-green");
        document.getElementById('prematuro').classList.add("w3-red");
        document.getElementById('dias').value = 0;
        controller = 1;
    }
}

function update(id,nome,sexo,nasc,dias){
        if(sexo=="m"){
            sexo = 1;
        }else if(sexo=="f"){
            sexo = 2;
        }

        if(dias > 0){
            document.getElementById("prematuro").innerHTML = "Sim"; 
            document.getElementById('dias').disabled = false;  
            document.getElementById('prematuro').classList.add("w3-green");
        }else{
            document.getElementById("prematuro").innerHTML = "Não";  
            document.getElementById('dias').disabled = true;  
            document.getElementById('prematuro').classList.add("w3-red");
        }

        nasc = nasc.split("-");

        document.getElementById("id").value = id;
        document.getElementById("nome").value = nome;
        document.getElementById("sexo").value = sexo;
        document.getElementById("nascimento").value = nasc[0] + '-'+ nasc[1] + '-' + nasc[2];
        document.getElementById("dias").value = dias;

    }

function consultaUp(data, peso, altura, obs, per, id){
    document.getElementById('modalUp').style.display='block';
    document.getElementById("ide").value = id;
    if (altura != "Sem dado referente") {
        document.getElementById("ConAltura").value = altura;
    }else{
        document.getElementById("ConAltura").value = "";
    }
    if (peso != "Sem dado referente") {
        document.getElementById("ConPeso").value = peso;
    }else{
        document.getElementById("ConPeso").value = "";
    }
    if (per != "Sem dado referente") {
        document.getElementById("ConPer").value = per;
    }else{
        document.getElementById("ConPer").value = "";
    }

    data = data.split("-");
    document.getElementById("ConData").value = data[0] + '-'+ data[1] + '-' + data[2];
    document.getElementById("ConObs").value = obs;
}

    // Content Panels Display: "Listar" ; "Adicionar" e "Análise" -->

function openPanel(menuTabName, panelName) {

    //esconde todos os paineis
    $(".contentPanel").hide();

    //limpa a borda inferior vermelha dos paineis
    $(".tablink").removeClass("w3-border-red");

    //exibe o painel passado como parametro
    $("#"+panelName+"").show();

    //adiciona borda vermelha inferior da aba selecionada
    $("#"+menuTabName).addClass("w3-border-red");

    $("#myOverlay").hide();
    // "Você usa tanto uma máscara que, acaba esquecendo de quem você é. V "
    $("#listarTabMenu").attr("data-balloon-visible", "true");

    //Painel Listar, remove a dica em Balloon
    if(panelName == "PainelListar"){
        $("#listarTabMenu").removeAttr("data-balloon-visible");
    };
    //Painel Analise, ajusta a tela
    if(panelName == "PainelAnalise"){
        $("#mySidebar").removeClass("w3-collapse");
        $("#mySidebar").hide();
        $("#myOverlay").removeClass("w3-hide-large");
        $("#sideMenuCollapseButton").removeClass("w3-hide-large");
        $(".w3-main").css("margin-left","0px");
        //w3_close();
    }else{
        $("#mySidebar").addClass("w3-collapse");
        $("#mySidebar").show;
        $("#myOverlay").addClass("w3-hide-large");
        $("#sideMenuCollapseButton").addClass("w3-hide-large");
        $(".w3-main").css("margin-left","300px");
        //w3_open();
        }
    };

    //Redimensiona o grafico - responsividade
    window.onresize = function() {
        myChart.resize();
    };
