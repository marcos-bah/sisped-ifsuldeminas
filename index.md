# SISPED: Sistema de Análises de Dados Pediátricos

SISPED é um sistema simples, fácil e intuitivo.
Criado para ser utilizado em qualquer dispositivo, necessitando apenas de um computador e conhecimentos básicos de informática.

### UPDATES

SISPED Versão 0.1.1

- Geração de Relatórios
- Referencias de Bertapelli (reconhecidas pela SBP)
- Referencias Internacionais (WHO)
- Fácil manuseio
- Em desenvolvimento e ativa

# Instalação

No canto superior esquerdo, é possivel encontrar os links para download, é recomendado em formato ZIP.
Após o download é necessário ter um servidor WEB instalado, como o XAMPP. 

> Caso não tenha, [baixe aqui](https://www.apachefriends.org/pt_br/download.html).   
> Baixe a versão corespondente ao modelo computacional e siga as instruções de instalação.

Cumprindo esses passos, ainda é preciso extrair o arquivo ZIP na pasta **htdocs**.
Ela encontra-se geralmente no seguinte caminho:

> Windows  
> **C:\xampp\htdocs**

Feito isso, basta acessar em seu navegador de preferência a seguinte url: http://localhost/sisped-ifsuldeminas
ou ainda acessar [aqui](http://localhost/sisped-ifsuldeminas).

> Lembrando que localhost pode ser trocado pelo seu ip para acesso em outros computadores:  
`http://SEU-IP-AQUI/sisped-ifsuldeminas`

Pronto, agora você tem em suas mãos uma ferramenta poderosa, brasileira, de fácil aprendizado e alta escabilidade. Lembrando que estamos sempre melhorando e inserindo novas funcionalidades.

# Sobre

Criada para ser simples e robusta, completa mas sem complicações.  
Somos uma ferramenta open source e sempre livre, gostamos de poder ajudar e fazer parte dessa comunidade e ainda mais de facilitar o trabalho pediatrico no Brasil, chegando em todos os locais: remotos ou metropoles, sempre visando um mundo melhor.   
Venha você fazer parte disso.

# Geração dos gráficos

Junto com a poderosa biblioteca *E-charts* construimos um código de alta escabilidade para gerar os gráficos pediátricos, você poderá verificar logo abaixo:

```javascript
 $.getJSON("includes/buildChart.php",{name: nome, id : id, time : time, pesq : pesq}, function(data) {
      
      var dom = document.getElementById("container"); // gerar o gráfico
      var myChart = echarts.init(dom);
      var app = {};

      option = null;
      option = {
         title: {
             text: data.grafico_name.slice(10, ).replace(".csv", " ")
         },
         tooltip: {
             trigger: 'axis'
         },
         grid: {
             left: '3%',
             right: '4%',
             bottom: '3%',
             containLabel: true
         },
         toolbox: {
             feature: {
                 saveAsImage: {
			title: "download"
			},

                dataView: {
			title: 'Dados    ',
			lang: ['Visualização', 'voltar', 'reload']
			},

                 //dataZoom: {title: {zoom: 'Zoom', back: 'Voltar'}},
             }
         },
            calculable : true,
         xAxis: {
             type: 'category',
             boundaryGap: false,
             data: data.meses,
             name: data.tempo,
             nameGap: 30,
             nameLocation : 'middle',

         },
         yAxis: [{
             type: 'value',
             scale: true,
             name: data.tipo,
             nameGap: 30,
             nameLocation : 'middle',
         },
         {
            type: 'value',
            scale: true,
            name: data.tipo,
            nameGap: 25,
            nameLocation : 'middle',
            nameRotate: 1
        }
        ],
         series: [
             {
                 name:'SD0',
                 type:'line',
                 stack: '',
                 color: 'green',
                 data: data.SD0,
                 markPoint : {
                 data : [
                    {type : 'max', name: 'MARK'},
                ]
              },
            animationDelay: function (idx) {
                return idx * 1;
             },
            },
            {
               name:'SD2',
               type:'line',
               stack: '',
               color: '#8B0000',
               data: data.SD2,
               markPoint : {
               data : [
                  {type : 'max', name: 'MARK'},
              ]
             },
            },
             {
                 name:'SD2neg',
                 type:'line',
                 stack: '',
                 color: '#8B0000',
                 data: data.SD2neg,
                 markPoint : {
                 data : [
                    {type : 'max', name: 'MARK'},
                ]
              },

             },
             {
                 name:'SD3',
                 type:'line',
                 stack: '',
                 color: 'black',
                 data: data.SD3,
                 markPoint : {
                 data : [
                    {type : 'max', name: 'MARK'},
                ]
              },

             },
             {
                 name:'SD3neg',
                 type:'line',
                 stack: '',
                 color: 'black',
                 data: data.SD3neg,
                 markPoint : {
                 data : [
                    {type : 'max', name: 'MARK'},
                ]
              },
             },
             {
                name:'Crianca',
                type:'line',
                connectNulls : true,
                stack: '',
                color: 'blue',
                smooth: false,
                data: data.dataCrianca,
                markPoint : {
                data : [
                   {type : 'max', name: 'MARK'},
               ]
             },
            }
           ]
         };

        if (option && typeof option === "object") {
           myChart.setOption(option, true);
        };
        window.onresize = function() {
           myChart.resize();
        };
  });

````
Ah, e sim! Nós usamos ponto e vírgula em js :)  
Existe ainda inúmeras linhas de código, mas isso deixamos no nosso repósitorio, existem centenas de linhas de código, você pode dá uma conferida lá.

# Screenshots

![relatorio](https://github.com/marcos-bah/sisped-ifsuldeminas/blob/master/doc/pdf-P.png)
![relatorio](https://github.com/marcos-bah/sisped-ifsuldeminas/blob/master/doc/pdf-R.png)

# Ajude-nos

Gostaria de fazer parte? 

- Você pode usar  
Nós ficamos muito feliz de saber que tem pessoas incriveis usando nossa ferramenta para o bem e saber que está sendo útil para vocês é muito gratificante, sério, nós **amamos muito** vocês.
- Você pode ajudar-nos fazendo críticas ou sugestões  
Acesse nosso projeto no github ( tem um link no canto superior esquerdo ), lá você poderá fazer issues ( um espaço para relatar erros ou sugerir modificações ) e assim torna ativa essa comunidade.
- Você pode conectar  
Compartilhe com seus colegas de profissões ou hobbystas de T.I. para que juntos possam fazer parte dessa comunidade **linda**.

# Quem somos

Nós somos aqueles que trocam aquele final de semana de churras na casa de amigos por uma maratona de programação com chopps de café.
Esse projeto só foi possivel graças a duas pessoas e uma instituição muito massa. Então vamos lá aos agradecimentos.  
Primeiro, Max Olinto, idealizador e professor do IFSULDEMINAS Campus Av. Carmo de Minas.  
Segundo, Juliete Ramos, orientadora e professora do IFSULDEMINAS Campus Av. Carmo de Minas.  
Ah, e claro, ao IFSULDEMINAS Campus Av. Carmo de Minas, o pessoal de lá é demais. Vale a pena coferir mais [acesse](https://portal.cdm.ifsuldeminas.edu.br/).




