<?php
               
               //header('Content-type: application/json');
               include("../includes/dbconnection.php");
               $aux = $_GET['id'];	
               $sql = "SELECT * FROM dadosconsulta where idCrianca = $aux order by dataConsulta desc";


                $result = $conn->query($sql);

                $txt = "<table id='customers'><tr><th>Dia da Consulta</th><th>Peso</th><th>Altura</th><th>Perimetro Cefalico</th><th>Observações</th></tr>";

                while($row = $result->fetch_array())
                {

                    $row['dataConsulta'] = ($row['dataConsulta'] == 0 || $row['dataConsulta'] == NULL) ? "Sem dado referente" : $row['dataConsulta'] ;
                    $row['peso'] = ($row['peso'] == 0 || $row['peso'] == NULL) ? "Sem dado referente" : $row['peso'] ;
                    $row['altura'] = ($row['altura'] == 0 || $row['altura'] == NULL) ? "Sem dado referente" : $row['altura'] ;
                    $row['perimetroCefalico'] = ($row['perimetroCefalico'] == 0 || $row['perimetroCefalico'] == NULL) ? "Sem dado referente" : $row['perimetroCefalico'] ;
                    
                    $par = "\"".$row['dataConsulta']."\","."\"".$row['peso']."\",\"".$row['altura']."\",\"".$row['obs']."\",\"".$row['perimetroCefalico']."\",".$row['idcon']."";
                    
                   
                    $txt .= "<tr onclick='consultaUp(".$par.")'><td>".$row['dataConsulta']."</td><td>".$row['peso']."</td><td>".$row['altura']."</td><td>".$row['perimetroCefalico']."</td><td >".$row['obs']."</td></tr>";                   
                }
 
                mysqli_close($conn);

                $txt .= "</table></br>";

                echo json_encode($txt);


			?>