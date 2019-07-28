<?php
    // autor: Marcos init: 18:46 Finados
    include("dbconnection.php");
    $id = $_GET['id'];
    $time = $_GET['time'];

    print_r($time);

    $dataCrianca = array();

    //func
        function dif($data1, $data2){
            $data1 = $data1->format('d-m-Y');
            $data2 = $data2->format('d-m-Y');
            $arr = explode('-',$data1);
            $arr2 = explode('-',$data2);

            $dia1 = $arr[0];
            $mes1 = $arr[1];
            $ano1 = $arr[2];
            $dia2 = $arr2[0];
            $mes2 = $arr2[1];
            $ano2 = $arr2[2];
            $a1 = ($ano2 - $ano1)*12;
            $m1 = ($mes2 - $mes1);
            $m3 = ($m1 + $a1);

            return $m3;
        }

        function imc($p, $a){
            //IMC (peso em kg dividido pelo quadrado da altura em metro)
            return round(($p/(($a/100)**2)),1);
        }
    //end func

    //chamada
        if($_GET['pesq'] == 'bmi'){
            $dataCrianca = BMI();
        }
    //end chamada

    function BMI(){
        $sql = "Select nascimento, dataConsulta, altura, peso from dadosconsultas inner join dadoscrianca on idCrianca = idcrian where idcrian = $id order by dataConsulta asc";
        $r = mysqli_query($conn, $sql);
        

        switch($time){
            case '13':
                //13 semanas
                $data = array();
                for ($kk = 0; $kk <= 13; $kk++){
                    if(!array_key_exists($kk, $data){
                        $data[$kk] = Null;
                    }
                }
                while($row = $r->fetch_array()){
                    $references = new DateTime($row['nascimento']);
                    $data = new DateTime($row['dataConsulta']);
                    $intervalo = $references->diff($data);
                    $data[$intervalo->y] = imc($row['peso'], $row['altura']);
                  }
                  $data = array_slice($data, 0,14);
                  break;
            }
    }

    mysqli_close($conn);

?>