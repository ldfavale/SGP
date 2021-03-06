<?php
error_reporting(E_ALL);
include_once 'Classes/PHPExcel.php';

function Decimal($hora)
{
	$desglose= explode(":", $hora);
	$dec=$desglose[0]+$desglose[1]/60;
	return $dec;
}

////////////////////////CONEXION//////////////////////////////
	///localhost, nombre del servidor<br />
	///root, nombre de la cuenta de usuario<br />
	/// '' contraseña, sino tiene deje vacio
	///BD, nombre de la base de datos
	$mysqli= new mysqli('localhost','root','','sgph');

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
$nombre = $_POST['nombre'];
$objSheet->setCellValue('B1', $nombre);
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
$userId = 2;

$sql = $mysqli->query("SELECT * FROM Checkinout WHERE Userid = $userId AND Checktime BETWEEN '$año-$mes-01' AND '$año-$mes-$ultimo_dia' ORDER BY Checktime");
//$sql = $mysqli->query("SELECT * FROM Checkinout WHERE Userid = $userId ");
/*****************************************************************************************/
	//$sql = $mysqli->query(" SELECT * FROM usuarios");
/*$cont = 1;
    $date = $año'-'$mes'-'.$cont;
	while($dato = $sql->fetch_assoc()){


        $fecha = explode(' ',$dato['CheckTime'])[0];
        if($date == $fecha){

        }

		$numero++;
		$objSheet->setCellValue('A'.$numero, $dato['Userid']);
        $d = new DateTime($dato['CheckTime']);
        $fecha = date_format($d, 'd/M/Y');
        $hora = date_format($d, 'H:i:s');

		$objSheet->setCellValue('A'.$numero,$cont );
		$objSheet->setCellValue('B'.$numero, $fecha);
		$objSheet->setCellValue('C'.$numero, $hora);
        $objSheet->getRowDimension($numero)->setRowHeight(30);
		//$objSheet->setCellValue('B'.$numero, $dato['CheckTime']);
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
$emptyrow =  array( 0 => ' ',1 => ' ',2 => ' ',3 => ' ' );;
$ultimo_dia = cal_days_in_month(CAL_GREGORIAN, $mes, $año);
$firstrow = 4;
$strfecha = $año.'-'.$mes.'-12';
$strMes =strtoupper(strftime("%B",strtotime($strfecha)));
$strAnio = strtoupper(strftime(" %Y",strtotime($strfecha)));

$objSheet->setCellValue('F1', $strMes.' '.$strAnio);

/******************************Recorro desde 1 hasta ultimo dia*****************************************************************/
for($cont = 1; $cont <= $ultimo_dia; $cont++){
    //echo 'hola';
        $sql = $mysqli->query("SELECT * FROM Checkinout WHERE Userid = $user  AND DAY(CheckTime) = '$cont'  AND MONTH(Checktime) = '$mes' AND YEAR(CheckTime) = '$año' ORDER BY CheckTime");
/************************ Array con valores fijos de las columnas A B C ******************************************/
        $fijo[$cont] = array(0 => $cont, 1 => ''.$cont.'/'.$mes.'/'.$año,  2 => ' ');

/********* Si es Sabado o Domingo los pinto de Gris *****************************************/
        if(date('N', strtotime($año.'-'.$mes.'-'.$cont)) >= 6){

            $objSheet->getStyle('B'.($cont+$firstrow-1))->applyFromArray($pintarfindesemana);
        }

        $cont2 = 0; //Inicializo contador

/******************* Recorro resultado de consulta sql ****************************************************/
        while($dato = $sql->fetch_assoc()){

//            $marcas[$cont2] = explode(' ',$dato['CheckTime'])[0];
            $array[$cont] = $emptyrow; //Inizializo


            $date = new datetime($dato['CheckTime']);

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

								if($dato['CheckType'] == 'I'){ // Si es una entrada

										$lastdate = $date; //guardo date como la ultima fecha registrada
		              //  $marcas['e1'] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' a '.$dato['CheckType']; // Guardo la marca en el arreglo posicio 0
		                $marcas['e1'] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' a '.$dato['CheckType'].' '.$cont2; // Guardo la marca en el arreglo posicio 0
		                //$marcas[0] = substr(explode(' ',$dato['CheckTime'])[1],0,-3); // Guardo la marca en el arreglo posicio 0
		               // $marcas[$cont2] = explode(' ',$dato['CheckTime'])[1];
		                $fijo[$cont][2] = "Solo marco entrada!"; // Lo marco como inconsistencia de antemano y luego lo borro si hay una segunda marca

								}else{

										$lastdate = $date; //guardo date como la ultima fecha registrada
										//$marcas[1] = substr(explode(' ',$dato['CheckTime'])[1],0,-3); // Guardo la marca en el arreglo
										$marcas['s1'] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' b '.$dato['CheckType'] .' '.$cont2; // Guardo la marca en el arreglo
									 // $marcas[$cont2] = explode(' ',$dato['CheckTime'])[1];
										$fijo[$cont][2] = "Solo marco salida!"; // Lo marco como inconsistencia de antemano y luego lo borro si hay una segunda marca


								}

                $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);
            }else{

//                if($cont2 == 5){
//
//                $marcas[$cont2] = 'hola';
//                $cont2++;
//                }

                $fecha = new datetime($dato['CheckTime']);
                $diff = $lastdate->diff($fecha)->format('%H:%i');

								$diferencia = Decimal($diff);
                //echo $diff;
								//$objSheet->setCellValue('I'.$cont, 'dif = '.$diff);




                if($diferencia > $intervalo){// si la diferencia con la ultima fecha registrada es mayor a intervalo se continua sino se omite la marca
                    if(count($marcas)<4){// si aun no setee las dos entradas y dos salidas, de lo contrario las siguientes marcas seran inconsistencias

											if($dato['CheckType'] == 'I'){ // Si es una entrada

													//$lastdate = $date; //guardo date como la ultima fecha registrada
													if(isset($marcas['e1'])){// si esta seteada la primer entrada

																if(!isset($marcas['e2'])){// y no esta seteada la seguna entrada
																	//	$marcas[2] = substr(explode(' ',$dato['CheckTime'])[1],0,-3); // Guardo la marca en pos 2
																		$marcas['e2'] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' c '.$dato['CheckType'].' '.$cont2.' diff='.$diferencia; // Guardo la marca en pos 2
																		$lastdate = $date; //guardo date como la ultima fecha registrada
																	}
												 // $marcas[$cont2] = explode(' ',$dato['CheckTime'])[1];
													//$fijo[0][2] = "Inconsistencia!"; // Lo marco como inconsistencia de antemano y luego lo borro si hay una segunda marca
												}else{// Si no esta seteada la primera entrada la seteo
													$marcas['e1'] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' d '.$dato['CheckType'].' '.$cont2.' diff='.$diferencia; // Guardo la entrada e1
													//$marcas[0] = substr(explode(' ',$dato['CheckTime'])[1],0,-3); // Guardo la marca en el arreglo pos 0
															$lastdate = $date; //guardo date como la ultima fecha registrada
												}
											}else{// si no es entrada

												//	if($dato['CheckType'] == 'OO'){ // Si es una salida
																if(isset($marcas['s1'])){// si esta seteada la primer salida

																			if(!isset($marcas['s2'])){// y no esta seteada la seguna salida
																				//	$marcas[3] = substr(explode(' ',$dato['CheckTime'])[1],0,-3); // Guardo la marca en pos 3
																					$marcas['s2'] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' e '.$dato['CheckType'].' '.$cont2.' diff='.$diferencia; // Guardo la marca en pos 3
																							$lastdate = $date; //guardo date como la ultima fecha registrada
																							}
															 // $marcas[$cont2] = explode(' ',$dato['CheckTime'])[1];
																//$fijo[0][2] = "Inconsistencia!"; // Lo marco como inconsistencia de antemano y luego lo borro si hay una segunda marca
															}else{// Si no esta seteada la primera salida
																//$marcas[1] = substr(explode(' ',$dato['CheckTime'])[1],0,-3); // Guardo la marca en el arreglo pos 0
																$marcas['s1'] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' f '.$dato['CheckType']; // Guardo la marca en el arreglo pos 0
																$marcas['s1'] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' f '.$dato['CheckType'].' '.$cont2.' diff='.$diferencia; // Guardo la marca en el arreglo pos 0
																$lastdate = $date; //guardo date como la ultima fecha registrada
															}
											//	}
											}
										//$marcas[$cont2] = substr(explode(' ',$dato['CheckTime'])[1],0,-3); // Registro solo la hora y sin los segundos
                    //$marcas[$cont2] = explode(' ',$dato['CheckTime'])[1];
                    //$lastdate = $fecha;

                        if(count($marcas) == 1 or count($marcas) == 3){
                            $fijo[$cont][2] = "Marcas insuficientes!";
                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

                        }else{
														if(count($marcas) == 2){

															if((isset($marcas['e1']) and isset($marcas['e2'])) or (isset($marcas['s1']) and isset($marcas['s2']))){
																$fijo[$cont][2] = "Dos marcas del mismo tipo!";
		                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

															}else{
																$fijo[$cont][2] = " ";
		                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($despintar);

															}
														}else{
															$fijo[$cont][2] = " ";
	                                            $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($despintar);

														}
                            if(date('N', strtotime($año.'-'.$mes.'-'.$cont)) >= 6){

                                    $objSheet->getStyle('B'.($cont+$firstrow-1))->applyFromArray($pintarfindesemana);
                            }

                        }
                    }else{// si ya setee las 4 marcas
                        $inconsistencias[$cont2] = substr(explode(' ',$dato['CheckTime'])[1],0,-3).' '.$dato['CheckType'];
                        $lastdate = $fecha;
                        $fijo[$cont][2] = "Inconsistencia!";
                        $objSheet->getStyle('A'.($cont+$firstrow-1).':N'.($cont+$firstrow-1))->applyFromArray($pintarInconsistencia);

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
       $array[$cont] = $emptyrow;
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

$objSheet->getStyle('D'.($firstrow).':P'.($ultimo_dia+$firstrow))->getNumberFormat()->setFormatCode('hh:mm');

$objSheet->getStyle('H'.($ultimo_dia+$firstrow).':H'.($ultimo_dia+$firstrow+6))->getNumberFormat()->setFormatCode('hh:mm');


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

/************** Titulo del Documento ************************************/
$archivo = "Contralor ".$nombre." ".$strMes." ".$strAnio.".xls";
$objSheet->setTitle('Usuarios');
$objXLS->setActiveSheetIndex(0);
$objXLS->getProperties()->setTitle("Contralor ".$nombre." ".$strMes." ".$strAnio);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="'.$archivo.'"');
header('Cache-control: max-age=0');

/************************* Escribo y descargo Archivo *************************/

$objWriter = PHPExcel_IOFactory::createWriter($objXLS, 'Excel5');
//$objWriter->save( "Usuarios.xls"); //Esto lo guarda en el servidor
$objWriter->save( "php://output");  //Descarga el archivo

exit;
?>
