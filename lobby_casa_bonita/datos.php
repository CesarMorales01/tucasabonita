<?php
$hostname_localhost ="localhost";

$database_localhost ="u629086351_mirey";

$username_localhost ="u629086351_cesar";

$password_localhost ="pokemongo";

$url="https://tucasabonita.site/lobby_casa_bonita";


date_default_timezone_set('America/Bogota');
$get_global_fecha_hoy_comis=date("Y-m-d");
$get_global_fecha_hoy="'".$get_global_fecha_hoy_comis."'";

$conexion= new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost) or die ("problemas en la conexion");	

$mysql=new mysqli($hostname_localhost,$username_localhost,$password_localhost,$database_localhost);
if ($mysql->connect_error) die("Problemas con la conexión a la base de datos");

function calc_dias_hastahoy($fecha_prest){
$fecha_prest_comis="'".$fecha_prest."'";
date_default_timezone_set('America/Bogota');
$get_fecha=date("Y-m-d");
$fecha_hoy_comis="'".$get_fecha."'";
global $mysql;
$calc_tiempo=$mysql->query("select datediff($fecha_hoy_comis, $fecha_prest_comis) as obt_fecha") or die ("problemas en restando fecha hasta hoy");
 if($registro=mysqli_fetch_array($calc_tiempo))
$dias_hashoy=$registro['obt_fecha'];

  return $dias_hashoy;
}

function check_periodicidad($period) { 
    if(strcmp($period, "semanales") === 0){
      $p="7.5";
    }
    if(strcmp($period, "quincenales") === 0){
      $p="15.5";
    }
    if(strcmp($period, "mensuales") === 0){
      $p="30.5";
    }
     return $p;
}



function calcular_cuotas_enmora($period, $tiempo_hasta_hoy, $totalabonos, $valor_cuotas, $totalcuotas) {
    $cuotas_hasta_hoy = $tiempo_hasta_hoy / $period;
    $cuotas_abonadas = $totalabonos / $valor_cuotas;
    $check_sivencido= metodo_checksivencido($cuotas_hasta_hoy, $totalcuotas);
    $cuotas_abonadas = $totalabonos / $valor_cuotas;
    $cuotas_enmora = $check_sivencido - $cuotas_abonadas;
        if ($cuotas_enmora<=0){
            $cuotas_enmora =0;
        }
    return $cuotas_enmora;
}



function metodo_checksivencido ($c_hasta_hoy, $tt_cuotas){
        if($c_hasta_hoy>$tt_cuotas){
            $c_hasta_hoy =$tt_cuotas;
            return $c_hasta_hoy;
        }else {
            return $c_hasta_hoy;
        }
}



 function prox_fecha_pago($fecha_prest, $period, $cuotas_en_mora, $cedula){

  

    $get_max_cuota=max_altura_cuotas($cedula);

    $get_period=check_periodicidad($period);

    $fecha_prest_comis="'".$fecha_prest."'";

    global $mysql;

     

       if($get_max_cuota>0){

           $periodxaltura_cuota=$get_period*$get_max_cuota;

           $period_mas_uno=$periodxaltura_cuota+$get_period;

           $calc_tiempo=$mysql->query("select adddate($fecha_prest_comis,interval $period_mas_uno day) as cal_fecha") or die 

             ("problemas calculando fechas...");

             

            if($registro=mysqli_fetch_array($calc_tiempo))

            $prox_fecha_pago=$registro['cal_fecha'];

            return $prox_fecha_pago; 

       

       } else {

            

            $calc_tiempo=$mysql->query("select adddate($fecha_prest_comis,interval $get_period day) as cal_fecha") or die 

             ("problemas en restando fecha hasta hoy");

             

            if($registro=mysqli_fetch_array($calc_tiempo))

            $prox_fecha_pago=$registro['cal_fecha'];

            return $prox_fecha_pago; 

       }

}





function max_altura_cuotas($cedula){

   global $mysql;

    $get_max_cuota=$mysql->query("select max(altura_cuota) from abonos where cedula=$cedula") or die 

    ("problemas al consultar max cuota");

         

    if($registro=mysqli_fetch_array($get_max_cuota)){

    $max_altura_cuota=$registro['max(altura_cuota)'];

   return $max_altura_cuota;

  }

}

function cerrar_sesion(){
$notificacion="";
setcookie("cobrador","",time()+60*60*24*365,"/");
global $url;
header("Location:  $url/Form_login.php?notificacion=$notificacion"); 
}

?>