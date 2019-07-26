<?php
    include("dbconnection.php");
    $id = $_GET['id'];
    $time = $_GET['time'];
    $pesquisa = $_GET['pesq'];
    $sql = "Select nascimento, dataConsulta, altura, peso, perimetroCefalico, diasPrematuro from dadosconsulta inner join dadoscrianca on idCrianca = idcrian where idcrian = $id order by dataConsulta asc";
    $r = mysqli_query($conn, $sql);

    $dataCrianca = array();
    $aux = array();
    $tempo = 'meses';
    $set = 0;

    function round_half($alt){ //arredontara nas decimais em 00, 50 ou proximo valor
        $aux = strval($alt); //
        $au = explode('.', $aux); //
          if (intval($au[1]) <= 25) {
            $au[1] = '00';
            return floatval($au[0].'.'.$au[1]);
          }elseif (intval($au[1]) <= 50) {
            $au[1] = '50';
            return floatval($au[0].'.'.$au[1]);
          }else{
            return round(floatval($aux));
          }
        }

    function imc($p, $a){
        //IMC (peso em kg dividido pelo quadrado da altura em metro)
        return round(($p/(($a/100)**2)),2);
    }

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

    switch ($time) {

        case 'y20': //it'ś works bertapelli
            $tempo = 'anos';
            for ($l = 0; $l <= 20; $l++){
                if(!array_key_exists($l, $dataCrianca)){
                    $dataCrianca[$l] = Null;
                }
            }
            while($row = $r->fetch_array()){
                $references = new DateTime($row['nascimento']);
                $data = new DateTime($row['dataConsulta']);
                $intervalo = $references->diff($data);
                $dataCrianca[$intervalo->y] = $row[$pesquisa];
                $set = $row['diasPrematuro'];
                }
                $dataCrianca = array_slice($dataCrianca, 3,18);
        break;

        case 'y': 
            $tempo = 'meses';
            for ($l = 0; $l <= 20; $l++){
                if(!array_key_exists($l, $dataCrianca)){
                    $dataCrianca[$l] = Null;
                }
            }
            while($row = $r->fetch_array()){
                $references = new DateTime($row['nascimento']);
                $data = new DateTime($row['dataConsulta']);
                $intervalo = $references->diff($data);
                $dataCrianca[$intervalo->y] = $row[$pesquisa];
                $set = $row['diasPrematuro'];
                }
        break;

        case 'm':
            $tempo = 'meses';
            for ($kk = 0; $kk <= 60; $kk++){
                if(!array_key_exists($kk, $dataCrianca)){
                    $dataCrianca[$kk] = Null;
                }
            }
            while($row = $r->fetch_array()){
                $d1 = new DateTime($row['nascimento']);
                $d2 = new DateTime($row['dataConsulta']);
                $pos = dif($d1,$d2);
                $dataCrianca[$pos] = $row[$pesquisa];
                unset($pos);
                $set = $row['diasPrematuro'];
                }
                $dataCrianca = array_slice($dataCrianca, 0,60);
        break;

        case 'w': //it'ś works
            $tempo = 'semanas';
            for ($e = 0; $e <= 13; $e++){
                if(!array_key_exists($e, $dataCrianca)){
                    $dataCrianca[$e] = Null;
                }
            }
            while($row = $r->fetch_array()){
                $references = new DateTime($row['nascimento']);
                $data = new DateTime($row['dataConsulta']);
                $intervalo = $references->diff($data);
                $dataCrianca[round($intervalo->days/7)] = $row[$pesquisa];
                $set = $row['diasPrematuro'];
                }
                $dataCrianca = array_slice($dataCrianca, 0,14);
        break;

        //BMI it's works

        case 'w2':
            $tempo = 'semanas';
            for ($e = 0; $e <= 13; $e++){
                if(!array_key_exists($e, $dataCrianca)){
                    $dataCrianca[$e] = Null;
                }
            }
            while($row = $r->fetch_array()){
                $references = new DateTime($row['nascimento']);
                $data = new DateTime($row['dataConsulta']);
                $intervalo = $references->diff($data);
                $dataCrianca[round($intervalo->days/7)] = imc($row['peso'],$row['altura']);
                $set = $row['diasPrematuro'];
                }
                $dataCrianca = array_slice($dataCrianca, 0,14);
        break;

        case 'y2':
            $tempo = 'meses';
            for ($e = 0; $e <= 24; $e++){
                if(!array_key_exists($e, $dataCrianca)){
                    $dataCrianca[$e] = Null;
                }
            }
            while($row = $r->fetch_array()){
                $d1 = new DateTime($row['nascimento']);
                $d2 = new DateTime($row['dataConsulta']);
                $pos = dif($d1,$d2);
                $dataCrianca[$pos] = imc($row['peso'],$row['altura']);
                unset($pos);
                $set = $row['diasPrematuro'];
                }
                $dataCrianca = array_slice($dataCrianca, 0, 24);
        break;

        case 'y2-5':
            $tempo = 'meses';
            for ($e = 0; $e <= 60; $e++){
                if(!array_key_exists($e, $dataCrianca)){
                    $dataCrianca[$e] = Null;
                }
            }
            while($row = $r->fetch_array()){
                $d1 = new DateTime($row['nascimento']);
                $d2 = new DateTime($row['dataConsulta']);
                $pos = dif($d1,$d2);
                $dataCrianca[$pos] = imc($row['peso'],$row['altura']);
                unset($pos);
                $set = $row['diasPrematuro'];
                }
                $dataCrianca = array_slice($dataCrianca, 24, 60);
        break;

        //peso por estatura

        case 'y3': //finalizar
            $tempo = 'altura';
            for ($h = 0; $h <= count($meses); $h++){
                if(!array_key_exists($h, $dataCrianca)){
                    $dataCrianca[$h] = Null;
                }
            }
            while($row = $r->fetch_array()){ //idade até dois anos e entre 2 e 5
              $d1 = new DateTime($row['nascimento']);
              $d2 = new DateTime($row['dataConsulta']);
              $pos = dif($d1,$d2);
              if($pos <= 24){
                for ($i=0; $i < count($meses) ; $i++) {
                  if ($meses[$i] == round_half($row['altura'])) {
                      $dataCrianca[$i] = $row['peso'];
                  }
                }
              }
            }
        break;
        
        case 'y4': //finalizar
            $tempo = 'altura';
            for ($h = 0; $h <= count($meses); $h++){
                if(!array_key_exists($h, $dataCrianca)){
                    $dataCrianca[$h] = Null;
                }
            }
            while($row = $r->fetch_array()){ //idade até dois anos e entre 2 e 5
              $d1 = new DateTime($row['nascimento']);
              $d2 = new DateTime($row['dataConsulta']);
              $pos = dif($d1,$d2);
              if($pos <= 60 and $pos >=24){
                for ($i=0; $i < count($meses) ; $i++) {
                  if ($meses[$i] == round_half($row['altura'])) {
                      $dataCrianca[$i] = $row['peso'];
                  }
                }
              }
            }
        break;
    }
    
    mysqli_close($conn);

?>
