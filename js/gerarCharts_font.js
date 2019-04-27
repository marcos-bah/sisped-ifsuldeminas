console.log("Chamada gerarCharts_font .done");

function gerarCall(aux,time, pesq){
    var id = document.getElementById('Bkid').value;
    var pesq = pesq;
    nextChart(aux,id,time,pesq);
    console.log("gerarCall .done")
    console.log("Backup .done");
};


function nextChart(nome, id, time, pesq){

    
    document.getElementById('Bkid').value = id;  
    document.getElementById("Bknome").value = nome;
    document.getElementById("Bktime").value = time;
    document.getElementById("Bkpesq").value = pesq;
    
    $.getJSON("includes/gerarCharts_back.php",{name: nome, id : id, time : time, pesq : pesq}, function(data) {
      
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
      ;

        if (option && typeof option === "object") {
           myChart.setOption(option, true);
        };
        window.onresize = function() {
           myChart.resize();
        };


});

  };
  
function chartUpdate(){

    var nome = document.getElementById("Bknome").value;
    var id = document.getElementById("Bkid").value;
    var time = document.getElementById("Bktime").value;
    var pesq = document.getElementById("Bkpesq").value;
    
    $.getJSON("includes/gerarCharts_back.php",{name: nome, id : id, time : time, pesq : pesq}, function(data) {
          console.log("Atualizando");
          var dom = document.getElementById("container"); // gerar o gráfico
          var myChart = echarts.init(dom);
          var app = {};

          option = null;
          option = {
             title: {
                 text: data.grafico_name.slice(10, )
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
          ;

            if (option && typeof option === "object") {
               myChart.setOption(option, true);
            };
            window.onresize = function() {
               myChart.resize();
            };


    });

};
