<?php 
    include('conexion.php');
    //BOTON GUARDAR->VERMASNOVEDADES->
    if (isset($_POST['guardarIngresoPersonas'])) {
        $tipo= $_POST['tipo'];
        $subtipo= $_POST['subtipo'];
        $dispuesto_por = $_POST['dispuesto_por'];
        $fecha_hora_ingreso = $_POST['fecha_hora_ingreso'];
        $fecha_hora_egreso = $_POST['fecha_hora_egreso'];
        $secuestro = $_POST['secuestro'];
        $elem_secuestrado = $_POST['elem_secuestrado'];

       //CONSULTA PARA ACTUALIZAR VALORES EN BASE DE DATOS
       $sqlUpdateIngresoPersonas = "UPDATE ingreso_persona SET fecha_hora_reg='$fecha_hora_reg', tipo='$tipo', subtipo='$subtipo', dispuesto_por='$dispuesto_por', fecha_hora_ingreso='$fecha_hora_ingreso', fecha_hora_egreso='$fecha_hora_egreso', secuestro='$secuestro', elem_secuestrado='$elem_secuestrado' WHERE id=$idIngresoPersonas ";
       $resultadoUpdateNovedades=mysqli_query($conexion,$sqlUpdateIngresoPersonas);
       if (mysqli_errno($conexion)!=0) {
        echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
      }else{ 
        ?>
        <script language='JavaScript' type="text/javascript">
          function B()
                  {     
                  location.href ='ingreso-personas-ver-mas.php?mensaje=editado&id=<?php echo $idIngresoPersonas?>';
                  }
                  B();
        </script>
        <?php 
     }
    }
  mysqli_close($conexion);
   

 ?>

<!-- BOTON MODAL ELIMINAR -->
<button type="button" class="btn btn-danger float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#eliminarNovedadesGuardia">
          Eliminar
        </button>
        <!-- Modal ELIMINAR -->
        <div class="modal fade" id="eliminarNovedadesGuardia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>¿Esta seguro que desea eliminar este Registro?</p>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Ingreso de Personas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-body">    
                    <!-- FORMULARIO PARA EDITAR NOVEDADES DE RELEVANCIA -->
                    <form class="row g-4 pt-3" method="POST" action="">
                      <div class="col-md-6">
                        <label for="fecha_hora_reg" class="form-label">Fecha y Hora de Registro</label>
                        <input disabled required type="datetime-local" class="form-control" id="fecha_hora_reg" name="fecha_hora_reg" value="<?php echo $fecha_hora_reg?>">
                      </div>
                      <div class="col-md-6">
                      <label for="tipo" class="form-label">Tipo</label>
                      <select required id="tipo" name="tipo" class="form-select">
                        <option value="<?php echo $tipo?>"><?php echo $tipo?></option>
                        <option value="SUSTRACCION DE MOTOCICLETA">SUSTRACCION DE MOTOCICLETA</option>
                        <option value="SUSTRACCION DE AUTOMOVIL">SUSTRACCION DE AUTOMOVIL</option>
                        <option value="ILICITO CONTRA LA PROPIEDAD">ILICITO CONTRA LA PROPIEDAD</option>
                        <option value="ARREBATO">ARREBATO</option>
                        <option value="ILICITO EN LA VIA PUBLICA">ILICITO EN LA VIA PUBLICA</option>
                        <option value="DESORDEN">DESORDEN</option>
                        <option value="ABUSO SEXUAL">ABUSO SEXUAL</option>
                        <option value="ACOSO SEXUAL">ACOSO SEXUAL</option>
                        <option value="AMENAZAS">AMENAZAS</option>
                        <option value="ARMAS">ARMAS</option>
                        <option value="EXHIBICIONES OBSENAS">EXHIBICIONES OBSENAS</option>
                        <option value="VIOLENCIA FAMILIAR Y DE GENERO">VIOLENCIA FAMILIAR Y DE GENERO</option>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <label for="subtipo" class="form-label">Subtipo</label>
                      <select required id="subtipo" name="subtipo" class="form-select" disabled>
                        <option value="<?php echo $subtipo?>"><?php echo $subtipo?></option>
                      </select>
                    </div>
                      <div class="col-md-6">
                        <label for="dispuesto_por" class="form-label">Dispuesto Por</label>
                        <input  required type="text" class="form-control" id="dispuesto_por" name="dispuesto_por" value="<?php echo $dispuesto_por?>">
                      </div>
                      <div class="col-md-6">
                        <label for="fecha_hora_ingreso" class="form-label">Fecha y Hora de Ingreso</label>
                        <input  required type="datetime-local" class="form-control" id="fecha_hora_ingreso" name="fecha_hora_ingreso" value="<?php echo $fecha_hora_ingreso?>">
                      </div>
                      <div class="col-md-6">
                        <label for="fecha_hora_egreso" class="form-label">Fecha y Hora de Egreso</label>
                        <input disabled type="datetime-local" class="form-control" id="fecha_hora_egreso" name="fecha_hora_egreso" value="<?php echo $fecha_hora_egreso?>">
                      </div>
                      <div class="col-md-6">
                        <label readonly for="secuestro" class="form-label">Secuestro</label>
                        <select required name="secuestro" id="secuestro" class="form-select">
                          <option value="<?php echo $secuestro?>"><?php echo $secuestro?></option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="elem_secuestrado" class="form-label">Elemento Secuestrado</label>
                        <input  required type="text" class="form-control" id="elem_secuestrado" name="elem_secuestrado" value="<?php echo $elem_secuestrado?>">
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary float-end" value="guardarIngresoPersonas" id="guardarIngresoPersonas" name="guardarIngresoPersonas">Guardar</button>
                      </div>
                    </form><!-- End Multi Columns Form -->
      
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Understood</button> -->
              </div>
            </div>
          </div>
        </div>