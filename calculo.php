<?php 
session_start();
print_r($_POST);
$dinero = $_POST["valor"]*$_POST["cantidad"]; 
if($_POST["monto"] > 0 && $_POST["cantidad"] > 0 && $_POST["valor"] > 0 && $dinero >= $_POST["monto"] ){
    $TIRH = ($dinero*100)/$_POST["monto"]; 
    $TIRH = $TIRH - 100;
    //$TIRH = 0;
    ?><br><?php
    print($TIRH);
    ?><br><?php
    //Calculo del TIR hipotetico 
    $VAN = -$_POST["monto"];
    $i = 1;
    while($i <= $_POST["cantidad"]){
        $sumatoria = $_POST["valor"]/pow((1 + $TIRH),$i);
        $VAN = $VAN + ($sumatoria);
        $i = $i + 1;
    }
    print($VAN);
    ?><br><?php
    //Calculo del VAN con el TIR hipotetico
    $VAN2F = 0;
    if($VAN > 0){ //VAN++ = TIR++
        $TIR = $TIRH;
        $VAN2 = -$_POST["monto"];
        while($VAN2F >= 0){
            $i = 1;
            $TIR = $TIR + 0.1;
            $VAN2 = -$_POST["monto"];
            while($i <= $_POST["cantidad"]){
                $sumatoria = $_POST["valor"]/pow((1 + $TIR),$i);
                $VAN2 = $VAN2 + ($sumatoria);
                $i = $i + 0.1;
            }
            $VAN2F = $VAN2;
        }
    }
    else{ //VAN-- = TIR--
        $TIR = $TIRH;
        $VAN2 = -$_POST["monto"];
        while($VAN2F <= 0){
            $i = 1;
            $TIR = $TIR - 0.1;
            $VAN2 = -$_POST["monto"];
            while($i <= $_POST["cantidad"]){
                $sumatoria = $_POST["valor"]/pow((1 + $TIR),$i);
                $VAN2 = $VAN2 + ($sumatoria);
                $i = $i + 0.1;
            }
            $VAN2F = $VAN2;
        }
    }
    print($TIR);
    ?><br><?php
    print($VAN2F);
    ?><br><?php
    //Calculo 2 VAN para el intervalo
    $TIR = $TIR/100;
    $TIRH = $TIRH/100;
    $TIRF = $TIRH + ($TIR - $TIRH)*($VAN/($VAN - $VAN2F));
    print($TIRF);
    ?><br><?php
    //Calculo del TIR con los dos VAN anteriores 
    //if($_POST["cantidad"] >= 12){
    $TASAF = pow((1 + $TIRF),12) - 1;
    print($TASAF);
    //
    ?><br><?php
    //Cambio de tasa de mensual a anual 
    $_SESSION['TIR'] = $TIRF*100;
    $_SESSION['monto'] = $_POST["monto"];
    $_SESSION['cantidad'] = $_POST["cantidad"];
    $_SESSION['valor'] = $_POST["valor"];
    $_SESSION['anual'] = $TASAF*100;
    $_SESSION['a'] = $_SESSION['a'] + 1;
    $_SESSION['adicional'] = $_POST['adicional'];

    $Total = ($_SESSION['valor']*$_SESSION['cantidad'])+$_POST['adicional'];
    $Extra = ($_SESSION['valor']*$_SESSION['cantidad'] - $_SESSION['monto'])+$_POST['adicional'];
    $AR = array($_SESSION['TIR'], $_SESSION['monto'], $_SESSION['cantidad'], $_SESSION['valor'], $Total, $Extra, $_SESSION['anual']);
    $ARR[$_SESSION['a']] =  $AR;

      if(!isset($_SESSION['cart']))
      {
      $_SESSION['cart']=array($AR);
      }
      else
      {
      array_push($_SESSION['cart'], $AR);
      }

    print_r($_SESSION['cart']);

    header("Location: /");
}
else{
    header("Location: /");
}
?>