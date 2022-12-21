<?php
// LLAMANDO A LA BASE DE DATOS
include('conexion.php');
// PREGUNTA SI HAY UN USUARIO REGISTRADO
if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
}

//INICIALIZAMOS DATOS
$idUsuario = $_SESSION['id'];
$idComisaria = $_SESSION['idComisaria'];

//BOTON GUARDAR->VERMASNOVEDADES->
if (isset($_POST['guardarRegistroSecuestro'])) {
  include('conexion.php');
  $fecha_reg = $_POST['fecha_reg'];
  $hora_reg = $_POST['hora_reg'];
  $hecho = $_POST['hecho'];
  $elemento_secuestrado = $_POST['elemento_secuestrado'];

  //CONSULTA PARA ACTUALIZAR VALORES EN BASE DE DATOS
  $sqlUpdateRegistroSecuestros = "UPDATE registro_secuestro SET fecha_reg='$fecha_reg', hora_reg='$hora_reg',hecho='$hecho', elemento_secuestrado='$elemento_secuestrado' WHERE id=$idRegistroSecuestro ";

  $resultadoUpdateRegistroSecuestros = mysqli_query($conexion, $sqlUpdateRegistroSecuestros);
  if (mysqli_errno($conexion) != 0) {
    echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
  } else {

?>
    <script language='JavaScript' type="text/javascript">
      function B() {
        location.href = 'registro-secuestros-vermas.php?mensaje=editado&id=<?php echo $idRegistroSecuestro ?>';
      }
      B();
    </script>
<?php
  }
  mysqli_close($conexion);
}

?>


<!-- BOTON MODAL ELIMINAR -->
<button type="button" class="btn btn-danger float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#eliminarRegistroSecuestro">
  Eliminar
</button>
<!-- Modal ELIMINAR -->
<div class="modal fade" id="eliminarRegistroSecuestro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro que desea eliminar este archivo?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="" method="post">
          <button type="submit" class="btn btn-danger" name="confirmarEliminarRegistro" value="eliminar" data-bs-dismiss="modal">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal EDITAR -->
<button type="button" class="btn btn-warning float-end mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  <i class="bi bi-pencil-square"></i>
  Editar
</button>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Registro de Secuestros</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <!-- FORMULARIO PARA EDITAR NOVEDADES DE GUARDIA -->
            <form class="row g-4 pt-3" method="POST" action="">
              <div class="col-md-6">
                <label for="fecha_reg" class="col-form-label">Fecha de registro</label>
                <input required type="date" id="fecha_reg" name="fecha_reg" class="form-control" value="<?php echo $fecha_reg ?>">
              </div>

              <div class="col-md-6">
                <label for="hora_reg" class="form-label">Hora</label>
                <input type="time" id="hora_reg" name="hora_reg" class="form-control clockpicker" data-placement="center" data-align="top" data-autoclose="true" value="<?php echo $hora_reg ?>">
              </div>

              <div class="col-md-6">
                <label for="hecho" class="form-label">Hecho</label>
                <input required type="text" name="hecho" id="hecho" class="form-control" value="<?php echo $hecho ?>">
              </div>

              <div class="col-md-6">
                <label for="elemento_secuestrado" class="form-label">Elemento secuestrado</label>
                <input required type="text" name="elemento_secuestrado" id="elemento_secuestrado" class="form-control" value="<?php echo $elemento_secuestrado ?>">
              </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary float-end" name="guardarRegistroSecuestro" id="guardarRegistroSecuestro" value="guardarRegistroSecuestro">Guardar</button>
              </div>
            </form>
            <!-- End Multi Columns Form -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Script de reloj -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="clockpicker.js"></script>
<script type="text/javascript">
  $('.clockpicker').clockpicker();
</script>