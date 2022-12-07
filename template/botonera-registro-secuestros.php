<?php


//BOTON GUARDAR->VERMASNOVEDADES->
if (isset($_POST['guardarRegistroSecuestro'])) {
  include('conexion.php');
  $txtfecha_reg_tabla = $_POST['fecha_reg_tabla'];
  $txtfecha_reg = $_POST['fecha_reg'];
  $txthora_reg = $_POST['hora_reg'];
  $txthecho = $_POST['hecho'];
  $txtelemento_secuestrado = $_POST['elemento_secuestrado'];
  $txteliminado = $_POST['eliminado'];
  $txtid_usuario = $_POST['id_usuario'];
  $txtid_comisaria = $_POST['id_comisaria'];

  //CONSULTA PARA ACTUALIZAR VALORES EN BASE DE DATOS
  $sqlUpdateRegistroSecuestro = "UPDATE registro_secuestro SET fecha_reg_tabla='$txtfecha_reg_tabla', fecha_reg='$txtfecha_reg', hora_reg='$txthora_reg',hecho='$txthecho', elemento_secuestrado='$txtelemento_secuestrado', eliminado='$txteliminado', id_usuario='$txtid_usuario', id_comisaria='$txtid_comisaria' WHERE id=$idRegistroSecuestro ";
  $resultadoUpdateNovedades = mysqli_query($conexion, $sqlUpdateRegistroSecuestro);
  if (mysqli_errno($conexion) != 0) {
    echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
  } else {

?>
    <script language='JavaScript' type="text/javascript">
      function B() {
        location.href = 'novedades-ver-mas.php?mensaje=editado&id=<?php echo $idRegistroSecuestro ?>';
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
                <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha ?>">
                </div>
              </div>

              <div class="col-md-6">
                <label for="detenidos_causa_federal" class="form-label"></label>
                <input type="text" class="form-control" id="detenidos_causa_federal" name="detenidos_causa_federal" value="<?php echo $detenidos_causa_federal ?>">
              </div>

              <div class="col-md-6">
                <label for="detenidos_justicia_ordinaria" class="form-label">Cantidad de detenidos Justicia Ordinaria</label>
                <input type="text" class="form-control" id="detenidos_justicia_ordinaria" name="detenidos_justicia_ordinaria" value="<?php echo $detenidos_justicia_ordinaria ?>">
              </div>

              <div class="col-md-6">
                <label for="arres_averiguacion_de_hecho" class="form-label">Arrestados averiguacion del hecho</label>
                <input type="text" class="form-control" id="arres_averiguacion_de_hecho" name="arres_averiguacion_de_hecho" value="<?php echo $arres_averiguacion_de_hecho ?>">
              </div>

              <div class="col-md-6">
                <label for="aprehendidos" class="form-label">Cantidad de Aprehendidos</label>
                <input type="text" class="form-control" id="aprehendidos" name="aprehendidos" value="<?php echo $aprehendidos ?>">
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