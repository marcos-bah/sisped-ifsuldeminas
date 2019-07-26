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

function modal(id){
    console.log("entrou no modal");
    document.getElementById('modalConsulta').style.display='block';
    document.getElementById('idem').value = id;
    console.log(id);
}

function habilitar(){
        if (document.getElementById('prematuro').checked){
                            document.getElementById('dias').disabled = false;

        }else {
                            document.getElementById('dias').disabled = true;
                            document.getElementById('dias').value = 0;
                        }
    }

function update(id,nome,sexo,nasc,prematuro,dias){
        if(sexo=="m"){
            sexo = 1;
        }else if(sexo=="f"){
            sexo = 2;
        }

        if(prematuro){
            if(!document.getElementById("prematuro").checked){
                document.getElementById("prematuro").click();
            }
        }

        if(!prematuro){
            if(document.getElementById("prematuro").checked){
                document.getElementById("prematuro").click();
            }
        }


        nasc = nasc.split("-");


        //console.log(a);


        document.getElementById("id").value = id;
        document.getElementById("nome").value = nome;
        document.getElementById("sexo").value = sexo;
        document.getElementById("nascimento").value = nasc[2] + '-'+ nasc[1] + '-' + nasc[0];
        document.getElementById("dias").value = dias;

    }

function consultaUp(data, peso, altura, obs, per, id){
    document.getElementById('modalUp').style.display='block';
    document.getElementById("ide").value = id;
    document.getElementById("ConAltura").value = altura;
    document.getElementById("ConPeso").value = peso;
    document.getElementById("ConPer").value = per;
    data = data.split("-");
    document.getElementById("ConData").value = data[2] + '-'+ data[1] + '-' + data[0];
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
