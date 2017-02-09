<?php

/*
Este archivo genera la planilla de contralor para el funcionario cuyo id es pasodo como parametro

*/
error_reporting(E_ALL);
include_once 'Classes/PHPExcel.php';
require '../config/database.php';

function Decimal($hora)
{
	$desglose= explode(":", $hora);
	$dec=$desglose[0]+$desglose[1]/60;
	return $dec;
}
/*Esta funcion es para quitar los tildes o caracteres que puedan causar problemas*/
function normaliza($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}

////////////////////////CONEXION//////////////////////////////
	///localhost, nombre del servidor<br />
	///root, nombre de la cuenta de usuario<br />
	/// '' contraseña, sino tiene deje vacio
	///BD, nombre de la base de datos

           $db = new database();
	$mysqli= new mysqli($db->getHost(),$db->getUser(),$db->getPass(),$db->getDB());

	if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
	//mysql_select_db('sgph',$conexion);

/////////////////////////////////////////////////////////////
$objXLS = new PHPExcel();
$objSheet = $objXLS->setActiveSheetIndex(0);
////////////////////TITULOS///////////////////////////

/************* Style arrays *****************************************************/


 $styleArrayAllBorders = array(
      'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      )
  );
$styleArrayTitles = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),


    ));

$styleArrayHoras = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size' => 16,


    ));

$styleArrayDefault = array(
    'font'  => array(

        'color' => array('rgb' => '000000'),
        'size'  => 12,
        'name'  => 'Times New Roman'

    ));

$pintarfindesemana = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'd9d9d9')
        )
    );

$pintarInconsistencia = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'ea9999')
        )
    );

$despintar = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_NONE,
            //'color' => array('rgb' => 'ffffff')
        )
    );
/**************Default Styles ***************************************************/

$objSheet->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objSheet->getDefaultStyle()->applyFromArray($styleArrayDefault);

$objSheet->getColumnDimension('A')->setWidth(5);
$objSheet->getColumnDimension('C')->setWidth(30);
$objSheet->getColumnDimension('D')->setWidth(10);
$objSheet->getColumnDimension('E')->setWidth(10);
$objSheet->getColumnDimension('F')->setWidth(10);
$objSheet->getColumnDimension('G')->setWidth(10);
$objSheet->getColumnDimension('H')->setWidth(15);
//$objSheet->getColumnDimension('')->setRowHeight(150);

/************* Nombre Funcionario ********************************************/
$nombre = normaliza($_POST['nombre']);
$apellido = normaliza($_POST['apellido']);
$nom_completo = normaliza($nombre."-".$apellido);
$objSheet->setCellValue('B1', $nombre." ".$apellido);
$objSheet->mergeCells('B1:D1');
$objSheet->mergeCells('F1:G1');
$objSheet->mergeCells('D2:E2');
$objSheet->mergeCells('F2:G2');

 $objSheet->getRowDimension('1')->setRowHeight(30);
/******************************************************************************/
/***************************** Titulos MES Y ANIO ************************************/

 //strtoupper(strftime("%B",strtotime('2014-09-11')));


$objSheet->getStyle("B1:G1")->applyFromArray($styleArrayTitles);
$objSheet->getStyle("B1:G1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objSheet->getStyle("B1:G1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


$objSheet->getStyle("B2:G2")->applyFromArray($styleArrayTitles);
$objSheet->getStyle("B2:G2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objSheet->getStyle("B2:G2")->getFont()->setBold(false);

/****************************** Titulos Manana y Tarde ****************************************************/


 $objSheet->setCellValue('D2', strtoupper("manana"));
 $objSheet->setCellValue('F2', strtoupper("tarde") );

 $objSheet->getStyle("D2")->applyFromArray($styleArrayAllBorders);
 $objSheet->getStyle("E2")->applyFromArray($styleArrayAllBorders);
 $objSheet->getStyle("F2")->applyFromArray($styleArrayAllBorders);
 $objSheet->getStyle("G2")->applyFromArray($styleArrayAllBorders);

//$objSheet->getStyle("B1:D1")->applyFromArray($styleArrayTitles);
//$objSheet->getStyle("B1:D1")->getFont()->setBold(true);// NEGRITA


/****************************** Titulos: Dia	Observaciones	entra	sale	entra	sale	Total Inconsistencias ***************************************************/

 //$fecha = '2015-09-12';
 $objSheet->setCellValue('B3','Dia');
 $objSheet->setCellValue('C3','Observaciones');
 $objSheet->setCellValue('D3','Entra');
 $objSheet->setCellValue('E3','Sale');
 $objSheet->setCellValue('F3','Entra');
 $objSheet->setCellValue('G3','Sale');
 $objSheet->setCellValue('H3','Total');
 $objSheet->setCellValue('I3','Inconsistencias');
 $objSheet->mergeCells('I3:M3');


 $objSheet->getStyle("B3:H3")->applyFromArray($styleArrayAllBorders);











/*$objSheet->setCellValue('A'.$numero, 'id');
$objSheet->setCellValue('B'.$numero, 'Tipo');
$objSheet->setCellValue('C'.$numero, 'Fecha');
$objSheet->setCellValue('D'.$numero, 'Hora');*/

/***************************ANTERIOR******************************************/
/*$mes = 12;
$año = 2014;

$ultimo_dia = cal_days_in_month(CAL_GREGORIAN, $mes, $año);
$user_code = 2;

$sql = $mysqli->query("SELECT * FROM attendance_record WHERE user_code = $user_code AND datetime BETWEEN '$año-$mes-01' AND '$año-$mes-$ultimo_dia' ORDER BY datetime");
//$sql = $mysqli->query("SELECT * FROM attendance_record WHERE user_code = $user_code ");
/*****************************************************************************************/
	//$sql = $mysqli->query(" SELECT * FROM usuarios");
/*$cont = 1;
    $date = $año'-'$mes'-'.$cont;
	while($dato = $sql->fetch_assoc()){


        $fecha = explode(' ',$dato['datetime'])[0];
        if($date == $fecha){

        }

		$numero++;
		$objSheet->setCellValue('A'.$numero, $dato['user_code']);
        $d = new DateTime($dato['datetime']);
        $fecha = date_format($d, 'd/M/Y');
        $hora = date_format($d, 'H:i:s');

		$objSheet->setCellValue('A'.$numero,$cont );
		$objSheet->setCellValue('B'.$numero, $fecha);
		$objSheet->setCellValue('C'.$numero, $hora);
        $objSheet->getRowDimension($numero)->setRowHeight(30);
		//$objSheet->setCellValue('B'.$numero, $dato['datetime']);
       /* $objSheet->setCellValue('C'.$numero, $fecha);
        $objSheet->setCellValue('D'.$numero, $hora);*/
        //$cont ++;
	//}*/*/
/****************************** Seteo Variables  ********************************/

$numero=3;
$user = $_POST['id'];
$intervalo = 5/60;
$mes = $_POST['mes'];
$año = $_POST['anio'];
$array = array();
$cont =1;
$emptyrow =  array( 0 => ' ',1 => ' ',2 => ' ',3 => ' ' );
$zerorow =  array( 0 => '0',1 => '0',2 => '0',3 => '0' );
$ultimo_dia = cal_days_in_month(CAL_GREGORIAN, $mes, $año);
$firstrow = 4;
$strfecha = $año.'-'.$mes.'-12';
$strMes =strtoupper(strftime("%B",strtotime($strfecha)));
$strAnio = strtoupper(strftime("%Y",strtotime($strfecha)));

$objSheet->setCellValue('F1', $strMes.' '.$strAnio);

/******************************Recorro desde 1 hasta ultimo dia*****************************************************************/
for($cont = 1; $cont <= $ultimo_dia; $cont++){
    //echo 'hola';
        $sql = $mysqli->query("SELECT * FROM attendance_record WHERE user_code = $user  AND DAY(datetime) = '$cont'  AND MONTH(datetime) = '$mes' AND YEAR(datetime) = '$año' ORDER BY datetime");
/************************ Array con valores fijos de las columnas A B C ******************************************/
        $fijo[$cont] = array(0 => $cont, 1 => ''.$cont.'/'.$mes.'/'.$año,  2 => ' ');


/********* Si es Sabado o Domingo los pinto de Gris *****************************************/
        if(date('N', strtotime($año.'-'.$mes.'-'.$cont)) >= 6){

            $objSheet->getStyle('B'.($cont+$firstrow-1))->applyFromArray($pintarfindesemana);
        }

        $cont2 = 0; //Inicializo contador
				$flag = false;
				$objSheet->setCellValue('H'.($ultimo_dia+$firstrow),'0');
/******************* Recorro resultado de consulta sql ****************************************************/
        while($dato = $sql->fetch_assoc()){

//            $marcas[$cont2] = explode(' ',$dato['datetime'])[0];
            $array[$cont] = $zerorow; //Inizializo


            $date = new datetime($dato['datetime']);

            if($cont2 == 0){ // Si es la primera vez

						/*
								La mejor solucion que encontre hasta ahora es preguntar por el tipo de marca e irlos metiendo en el
								array marcas en el orden correspondiente (1er entrada en [0], 2da en [2], 1er salida en [1], 2da salida en [3]),
								y cuando ya esten seteadas los 4 lugares del array,tirar el resto para inconsistencias mostrando
								su respectivo tipo de marca.
								NOTA: hay mas tipos de inconsistencia; si marco dos entradas solamente tambien es inconsistencia, lo mismo
								si marco dos salidas. Y tambien si la salida en menor a la entrada.

								FALTA: marcar inconsitencia si las salidas son anteriores a las entradas o las entradas posteriores a las salidas,
								tener en cuenta todos los casos posibles.

						*/

								if($dato['type_code'] == 0){ // Si es una entrada

										$lastdate = $date; //guardo date como la ultima fecha registrada
		              //  $marcas['e1'] = substr(explode(' ',$dato['datetime'])[1],0,-3).' a '.$dato['type_code']; // Guardo la marca en el arreglo posicio 0
		              //  $marcas['e1'] = substr(explode(' ',$dato['datetime'])[1],0,-3).' a '.$dato['type_code'].' '.$cont2; // Guardo la marca en el arreglo posicio 0
		                $marcas['e1'] = substr(explode(' ',$dato['datetime'])[1],0,-3); // Guardo la marca en el arreglo posicio 0
		               // $marcas[$cont2] = explode(' ',$dato['datetime'])[1];
		                $fijo[$cont][2] = "Solo marco entrada!"; // Lo marco como inconsistencia de antemano y luego lo borro si hay una segunda marca

								}else{

										$lastdate = $date; //guardo date como la ultima fecha registrada
									$marcas['s1'] = substr(explode(' ',$dato['datetime'])[1],0,-3); // Guardo la marca en el arreglo
										//$marcas['s1'] = substr(explode(' ',$dato['datetime'])[1],0,-3).' b '.$dato['type_code'] .' '.$cont2; // Guardo la marca en el arreglo
									 // $marcas[$cont2] = explode(' ',$dato['datetime'])[1];
										$fijo[$cont][2] = "Solo marco salida!"; // Lo marco como inconsistencia de antemano y luego lo borro si hay una segunda marca


								}

                $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);
            }else{// Si no es la primera vez

//                if($cont2 == 5){
//
//                $marcas[$cont2] = 'hola';
//                $cont2++;
//                }

                $fecha = new datetime($dato['datetime']);
                $diff = $lastdate->diff($fecha)->format('%H:%i');

								$diferencia = Decimal($diff);
                //echo $diff;
								//$objSheet->setCellValue('I'.$cont, 'dif = '.$diff);




                if($diferencia > $intervalo){// si la diferencia con la ultima fecha registrada es mayor a intervalo se continua sino se omite la marca
                    if(count($marcas)<4){// si aun no setee las dos entradas y dos salidas, de lo contrario las siguientes marcas seran inconsistencias

											if($dato['type_code'] == 0){ // Si es una entrada

													//$lastdate = $date; //guardo date como la ultima fecha registrada
													if(isset($marcas['e1'])){// si esta seteada la primer entrada

																if(!isset($marcas['e2'])){// y no esta seteada la seguna entrada
																		$marcas['e2'] = substr(explode(' ',$dato['datetime'])[1],0,-3); // Guardo la marca en pos 2
																		//$marcas['e2'] = substr(explode(' ',$dato['datetime'])[1],0,-3).' c '.$dato['type_code'].' '.$cont2.' diff='.$diferencia; // Guardo la marca en pos 2
																		$lastdate = $date; //guardo date como la ultima fecha registrada
																	}else{
																		$inconsistencias[$cont2] = substr(explode(' ',$dato['datetime'])[1],0,-3).' '.$dato['type_code'];
																		//$lastdate = $fecha;
																 		$lastdate = $date;
																		$fijo[$cont][2] = "Demasiadas entradas!";
																		$objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

																	}

												 // $marcas[$cont2] = explode(' ',$dato['datetime'])[1];
													//$fijo[0][2] = "Inconsistencia!"; // Lo marco como inconsistencia de antemano y luego lo borro si hay una segunda marca
												}else{// Si no esta seteada la primera entrada la seteo
													//$marcas['e1'] = substr(explode(' ',$dato['datetime'])[1],0,-3).' d '.$dato['type_code'].' '.$cont2.' diff='.$diferencia; // Guardo la entrada e1
													$marcas['e1'] = substr(explode(' ',$dato['datetime'])[1],0,-3); // Guardo la marca en el arreglo pos 0
															$lastdate = $date; //guardo date como la ultima fecha registrada
												}
											}else{// si no es entrada

												//	if($dato['type_code'] == 'OO'){ // Si es una salida
																if(isset($marcas['s1'])){// si esta seteada la primer salida

																			if(!isset($marcas['s2'])){// y no esta seteada la seguna salida
																					$marcas['s2'] = substr(explode(' ',$dato['datetime'])[1],0,-3); // Guardo la marca en pos 3
																				//	$marcas['s2'] = substr(explode(' ',$dato['datetime'])[1],0,-3).' e '.$dato['type_code'].' '.$cont2.' diff='.$diferencia; // Guardo la marca en pos 3
																							$lastdate = $date; //guardo date como la ultima fecha registrada
																						}else{
																							$inconsistencias[$cont2] = substr(explode(' ',$dato['datetime'])[1],0,-3).' '.$dato['type_code'];
											                        //$lastdate = $fecha;
											                     $lastdate = $date;
											                        $fijo[$cont][2] = " Demasiadas salidas!";
											                        $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

																						}
															 // $marcas[$cont2] = explode(' ',$dato['datetime'])[1];
																//$fijo[0][2] = "Inconsistencia!"; // Lo marco como inconsistencia de antemano y luego lo borro si hay una segunda marca
															}else{// Si no esta seteada la primera salida
																$marcas['s1'] = substr(explode(' ',$dato['datetime'])[1],0,-3); // Guardo la marca en el arreglo pos 0
															//	$marcas['s1'] = substr(explode(' ',$dato['datetime'])[1],0,-3).' f '.$dato['type_code']; // Guardo la marca en el arreglo pos 0
															//	$marcas['s1'] = substr(explode(' ',$dato['datetime'])[1],0,-3).' f '.$dato['type_code'].' '.$cont2.' diff='.$diferencia; // Guardo la marca en el arreglo pos 0
																$lastdate = $date; //guardo date como la ultima fecha registrada
															}
											//	}
											}
										//$marcas[$cont2] = substr(explode(' ',$dato['datetime'])[1],0,-3); // Registro solo la hora y sin los segundos
                    //$marcas[$cont2] = explode(' ',$dato['datetime'])[1];
                    //$lastdate = $fecha;

                        if(count($marcas) == 1 or count($marcas) == 3){
                            $fijo[$cont][2] = " Marcas insuficientes!";
                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

                        }else{
														if(count($marcas) == 2){// si hay 2 marcas seteadas

															if((isset($marcas['e1']) and isset($marcas['e2'])) or (isset($marcas['s1']) and isset($marcas['s2']))){
																$fijo[$cont][2] = $fijo[$cont][2]." Dos marcas del mismo tipo!";
		                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

															}else{/* me despinta con inconsistencia aun falta controlar cuando count($marcas) == 4 que sucede y controlar el resto de las inconsistencias*/

																if(isset($marcas['e1']) and isset($marcas['s1'])){

																	$e1 = new DateTime(explode(' ', $marcas['e1'])[0]);
																	$s1 = new DateTime(explode(' ', $marcas['s1'])[0]);
																		if($e1 > $s1){

																			$fijo[$cont][2] = " Salida anterior a entrada!";
					                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);


																		}else{

																			$fijo[$cont][2] = " ";
					                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($despintar);

																		}

																}

															}
														}else{// si NO hay 1 o 3 ,ni tampoco 2 marcas seteadas, es decir, si hay 4 -> despinto (a priori)


															$fijo[$cont][2] = " ";
	                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($despintar);

														}

														/***********************Pinto los fines de semana***********************************************/

														if(date('N', strtotime($año.'-'.$mes.'-'.$cont)) >= 6){

                                    $objSheet->getStyle('B'.($cont+$firstrow-1))->applyFromArray($pintarfindesemana);
                            }

                        }
                    }else{// si ya setee las 4 marcas tiro las marcas al array inconsistencias


											  $inconsistencias[$cont2] = substr(explode(' ',$dato['datetime'])[1],0,-3).' '.$dato['type_code'];
                        //$lastdate = $fecha;
                     		$lastdate = $date;
                        $fijo[$cont][2] = " Marcas de mas!";// esto hay que sacarlo del while y preguntar si $fijo[$cont][2] esta seteado != ''
                        $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);//// esto hay que sacarlo del while



                    }
                }
            }
						// if($marcas[0] == ' ' and $marcas[1] == ' ' and $marcas[2] == ' ' and $marcas[3] == ' '  ){
						// 	unset($marcas);
						// }

            $cont2++;
        }
/******************* FIN Recorro resultado de consulta sql  ****************************************************/



   // $objXLS->getActiveSheet()->fromArray($total, NULL, 'H'.$firstrow );



    $cont2 = 0;
		// asigno formula a TOTAL del dia correpondiente a esta fila
		$objSheet->setCellValue('H'.($cont+$firstrow-1), '=SUM(G'.($cont+$firstrow-1).'-F'.($cont+$firstrow-1).')+(E'.($cont+$firstrow-1).'-D'.($cont+$firstrow-1).')');

    if(isset($marcas)){


		if(count($marcas) == 4){


					$e1 = new DateTime(explode(' ', $marcas['e1'])[0]);
					$s1 = new DateTime(explode(' ', $marcas['s1'])[0]);
					$e2 = new DateTime(explode(' ', $marcas['e2'])[0]);
					$s2 = new DateTime(explode(' ', $marcas['s2'])[0]);

					if($s2 < $e2 ){

						$fijo[$cont][2] = $fijo[$cont][2]." 2da salida anterior a 2da entrada!";
						$objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

					}

					if( $s2 < $e1 ){

						$fijo[$cont][2] = $fijo[$cont][2]." 2da salida anterior a 1er entrada!";
						$objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

					}

					if($e2 < $s1){

						$fijo[$cont][2] = $fijo[$cont][2]." 2da entrada anterior a 1er salida!";
						$objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

					}

}
			if(isset($marcas['e1'])){
				$marc[0] = $marcas['e1'] ;
			}else{
				$marc[0] = '';
			}

			if(isset($marcas['s1'])){
				$marc[1] =$marcas['s1'];
			}else{
				$marc[1] = '';
			}

			if(isset($marcas['e2'])){
				$marc[2] = $marcas['e2'];
			}else{
				$marc[2] = '';
			}

			if(isset($marcas['s2'])){
				$marc[3] = $marcas['s2'];
			}else{
				$marc[3] = '';
			}


    $array[$cont] = $marc;

    unset($marcas);
    }else{
           // $objSheet->setCellValue('');

       // $fijo[$cont] = array(0 => $cont, 1 => ''.$cont.'/'.$mes.'/'.$año,  2 => 'obs');
       /* $marcas[0] = $cont;
         $marcas[1] = ''.$cont.'/'.$mes.'/'.$año;
         $marcas[2] = ' ';*/
       $array[$cont] = $zerorow;
//       $total[$cont] = array('00:00');
    }
    if(isset($inconsistencias)){
        $array2[$cont] = $inconsistencias;
        unset($inconsistencias);
    }
    else{
        $array2[$cont] = $emptyrow;
    }

    //// Dimension de filas y formato de hora
    $objSheet->getRowDimension($firstrow+$cont-1)->setRowHeight(30);


    }//END FOR ///////////////////////////////////////////////////////////////////


//Mezclando celdas
$objSheet->mergeCells('A'.($ultimo_dia+$firstrow).':D'.($ultimo_dia+$firstrow).'');
$objSheet->mergeCells('A'.($ultimo_dia+$firstrow+1).':D'.($ultimo_dia+$firstrow+1).'');
$objSheet->mergeCells('A'.($ultimo_dia+$firstrow+2).':D'.($ultimo_dia+$firstrow+2).'');
$objSheet->mergeCells('B'.($ultimo_dia+$firstrow+5).':D'.($ultimo_dia+$firstrow+5).'');
$objSheet->mergeCells('B'.($ultimo_dia+$firstrow+6).':D'.($ultimo_dia+$firstrow+6).'');


//Aniadimos valores a celdas

$objSheet->setCellValue('A'.($ultimo_dia+$firstrow),'Art. 15 utilizados');
$objSheet->setCellValue('A'.($ultimo_dia+$firstrow+1),'Hs. entrada / salida sin autorización');
$objSheet->setCellValue('A'.($ultimo_dia+$firstrow+2),'Total de horas registradas en planillas de firmas');
$objSheet->setCellValue('B'.($ultimo_dia+$firstrow+5),'Horas a realizan en el mes');
$objSheet->setCellValue('B'.($ultimo_dia+$firstrow+6),'Saldo horas del mes');

//Dimension de filas

 $objSheet->getRowDimension($ultimo_dia+$firstrow)->setRowHeight(30);
 $objSheet->getRowDimension($ultimo_dia+$firstrow+1)->setRowHeight(30);
 $objSheet->getRowDimension($ultimo_dia+$firstrow+2)->setRowHeight(30);
 $objSheet->getRowDimension($ultimo_dia+$firstrow+5)->setRowHeight(20);
 $objSheet->getRowDimension($ultimo_dia+$firstrow+6)->setRowHeight(20);

//Le damos formato de hora

$objSheet->getStyle('D'.($firstrow).':P'.($ultimo_dia+$firstrow))->getNumberFormat()->setFormatCode('[hh]:mm');

$objSheet->getStyle('H'.($ultimo_dia+$firstrow).':H'.($ultimo_dia+$firstrow+6))->getNumberFormat()->setFormatCode('[hh]:mm');


// FORMULAS

$objSheet->setCellValue('H'.($ultimo_dia+$firstrow+2).'','=SUM(H'.$firstrow.':H'.($ultimo_dia+$firstrow+1).')');
$objSheet->setCellValue('H'.($ultimo_dia+$firstrow+6).'','=H'.($ultimo_dia+$firstrow+2).'-H'.($ultimo_dia+$firstrow+5).')');



//Cargamos los arreglos con los datos
$objSheet->fromArray($fijo, NULL, 'A'.$firstrow );
$objSheet->fromArray($array, NULL, 'D'.$firstrow );
$objSheet->fromArray($array2, NULL, 'I'.$firstrow );


//BORDES A TODO
$objSheet->getStyle("A".$firstrow.":H".($ultimo_dia+$firstrow+2))->applyFromArray($styleArrayAllBorders);


//NEGRITA TOTAL HORAS

$objSheet->getStyle("H".($ultimo_dia+$firstrow+2))->applyFromArray($styleArrayHoras);
$objSheet->getStyle("H".($ultimo_dia+$firstrow+5))->applyFromArray($styleArrayHoras);
$objSheet->getStyle("H".($ultimo_dia+$firstrow+6))->applyFromArray($styleArrayHoras);
/****************************** AUTOSIZE ********************************/
//$objSheet->getColumnDimension("A")->setAutoSize(true);
$objSheet->getColumnDimension("B")->setAutoSize(true);
//$objXLS->getActiveSheet()->getColumnDimension("C")->setAutoSize(true);
//$objXLS->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
/*$objXLS->getActiveSheet()->getColumnDimension("E")->setAutoSize(true);
$objXLS->getActiveSheet()->getColumnDimension("F")->setAutoSize(true);
$objXLS->getActiveSheet()->getColumnDimension("G")->setAutoSize(true);
$objXLS->getActiveSheet()->getColumnDimension("H")->setAutoSize(true);
$objXLS->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
$objXLS->getActiveSheet()->getColumnDimension("J")->setAutoSize(true); */

/************** Formato condicional  ************************************/


$objConditional1 = new PHPExcel_Style_Conditional();
$objConditional1->setConditionType(PHPExcel_Style_Conditional::CONDITION_CELLIS);
$objConditional1->setOperatorType(PHPExcel_Style_Conditional::OPERATOR_LESSTHAN);

$objConditional1->addCondition('0');
 $objConditional1->getStyle()->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_SOFTRED	);
 $objConditional1->getStyle()->getFont()->setSize('16');
 //$objConditional1->getStyle('H'.($ultimo_dia+$firstrow+2))->getFill()->getStartColor()->setRGB('F28A8C');
$objConditional1->getStyle()->applyFromArray(
        array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('argb' => 'FFFF0000')
            )
        )

);

//$objConditional1->getStyle()->getFont()->setBold(true);


$objSheet->getStyle('H'.($ultimo_dia+$firstrow+2))->setConditionalStyles(array($objConditional1));
$objSheet->getStyle('H'.($ultimo_dia+$firstrow+6))->setConditionalStyles(array($objConditional1));




/************** Titulo del Documento ************************************/
$archivo = "Contralor-".str_replace(" ","-",$nom_completo)."-".$strMes."-".$strAnio;

$objSheet->setTitle("Contralor-".$strMes."-".$strAnio);
$objXLS->setActiveSheetIndex(0);
$objXLS->getProperties()->setTitle("Contralor-".$strMes."-".$strAnio);

//header('Content-Type: application/vnd.ms-excel');


/************************* Escribo y descargo Archivo *************************/

$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5');
$objWriter->save( $archivo.".xls"); //Esto lo guarda en el servidor
//exec("unoconv -f ods Usuarios2.xls");
//exec("rm Usuarios2.xls");
//$objWriter->save( "php://output");  //Descarga el archivo
// $cmd = "sudo /usr/bin/unoconv -f ods ".$archivo.".xls";
//
// putenv("PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games");
// putenv("UNO_PATH=/usr/bin/unoconv");
//
// echo $archivo;
// echo exec($cmd);

//var_dump(getenv('PATH'));

$convertir = "sudo /usr/bin/unoconv -f ods ".$archivo.".xls";

putenv("PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games");
putenv("UNO_PATH=/usr/bin/unoconv");

exec($convertir);

header("Content-Type: application/vnd.oasis.opendocument.spreadsheet");
header('Content-Disposition: attachment; filename="'.$archivo.'.ods"');
readfile($archivo.".ods");

$eliminar = "find . -type f -name '".$archivo.".*' -exec rm -f {} \;";
exec($eliminar);
exit();




?>
