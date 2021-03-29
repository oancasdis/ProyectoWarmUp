<HTML>
<HEAD>
<?php
session_start();
if(!isset($_SESSION['TIR'])){
  $_SESSION['a'] = -1;
  $ARR;
}
if(!isset($_SESSION['flag1'])){
 $_SESSION['flag1'] =false;
 $_SESSION['flag2'] =false;
 $_SESSION['flag3'] =false;
 $_SESSION['flag4'] =false;
}


?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">

<nav class="navbar navbar-dark" style="background-color: midnightblue;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">
      Simulador CAE
    </a>
  </div>
</nav>

</HEAD>
<BODY>
<div class="titulo">
<p>Calculadora CAE</p>
</div>

<div class="container">
<div class="row">
<div class="col-sm">
<div class="text">
  <p>Datos</p>
</div>

  <form class="row g-3" action="calculo.php" method="POST">
<div class="col-md-4">
    <label for="validationServer01" class="form-label">Monto Inicial</label>
    <input type="number"  name="monto" value="" required>
  </div>
<div class="col-md-4">
    <label for="validationServer01" class="form-label">Cantidad de cuotas</label>
    <input type="number"  name="cantidad" value="" required>
  </div>
<div class="col-md-4">
    <label for="validationServer01" class="form-label">Valor de la cuota</label>
    <input type="number"  name="valor" value="" required>
  </div>
  <div class="col-md-4">
    <label for="validationServer01" class="form-label">Cobro adicional</label>
    <input type="number"  name="adicional" value="" required>
  </div>
  <?php
  if( $_SESSION['flag1'] ==true ||$_SESSION['flag2'] ==true ||$_SESSION['flag3'] ==true || $_SESSION['flag4'] ==true  )
  {
      
  if( $_SESSION['flag1'] ==true )
  {
      ?> 
      <span>Ingrese un monto mayor a 0.</span>
      <?php
      $_SESSION['flag1'] =false;
  }
  if( $_SESSION['flag2'] ==true )
  {
      ?> 
      <span>Ingrese una cantidad de cuotas mayor a 0.</span>
      <?php
      $_SESSION['flag2'] =false;
  }
  if( $_SESSION['flag3'] ==true )
  {
      ?> 
      <span>Ingrese un valor de la cuota mayor a 0.</span>
      <?php
      $_SESSION['flag3'] =false;
  }
  if( $_SESSION['flag4'] ==true )
  {
      ?> 
      <span>El préstamo no puede ser menor a la cuota.</span>
      <?php
      $_SESSION['flag4'] =false;
  }
}
  

  ?>
  <span>*Si usted no posee cobros adicionales tan solo ponga 0.</span>

<div class="col-12">
    <div class="form-check">
      <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
      <label class="form-check-label" for="invalidCheck3">
      Aceptar términos y condiciones
      </label>
      <div id="invalidCheck3Feedback" class="invalid-feedback">
      </div>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Calcular</button>
  </div>
</form>


<?php
if(isset($_SESSION['TIR'])){
  
  $contador = 1;
  foreach ($_SESSION['cart'] as &$Array) {
  ?>
  <ul class="list-group">
  <div class="text">
  <li class="list-group-item active" aria-current="true">Resultado <?php echo $contador ?></li>
  </div>
  <li class="list-group-item">TIR: <?php echo $Array[0] ?> %</li>
  <li class="list-group-item">Monto incial: $ <?php echo $Array[1] ?></li>
  <li class="list-group-item">Cantidad de cuotas: <?php echo $Array[2] ?> </li>
  <li class="list-group-item">Valor de las cuotas: $ <?php echo $Array[3] ?></li>
  <li class="list-group-item">Total a pagar: $ <?php echo $Array[4] ?> </li>
  <li class="list-group-item">Extra a pagar: $ <?php echo $Array[5] ?> </li>
  <li class="list-group-item">Tasa anual: <?php echo $Array[6] ?> %</li>
  </ul>

  <div class="progress">
<?php 
if(isset($_SESSION['TIR'])){
?>
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
  <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: <?php echo $Array[6] ?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
<?php 
}
else{
?>
  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
  <div class="progress-bar progress-bar-striped bg-danger progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
<?php
}
?>
</div>

<?php
  $contador=$contador+1;
  }
}
else{
?>
  <ul class="list-group">
  <li class="list-group-item active" aria-current="true">Resultados</li>
  <li class="list-group-item">TIR: ...</li>
  <li class="list-group-item">Monto incial:  ...</li>
  <li class="list-group-item">Cantidad de cuotas:  ...</li>
  <li class="list-group-item">Valor de las cuotas:  ...</li>
  <li class="list-group-item">Total a pagar:  ...</li>
  <li class="list-group-item">Extra a pagar:  ...</li>
  <li class="list-group-item">Tasa anual:  ...</li>
  </ul>

<?php  
}
$contador =1;
?>
</div>

<div class="col-sm">

  <div class="img-thumbnail">
    <img src="/empresario.jpg" alt="" width="100%">
  </div>

  <div class="alert alert-primary" role="alert">
  *Al realizar la simulación se generara una barra en la que porda observar dos tonalidades. La azul que es el procentaje del monto inicial mas los cobros adicionales en comparacion con la roja que es el porcentaje de lo extra que usted va a pagar ejemplificando cual es su mejor opcion.
</div>

</div>


  </div>
</div>

</BODY>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span>Matias Araya, Oscar Castro, Valeria Navarrete.</span>
  </div>
</footer>

</HTML>

