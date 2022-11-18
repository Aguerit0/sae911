<?php 
  

    //BOTON GUARDAR->VERMASNOVEDADES->
     if (isset($_POST['guardarNovedadRelevancia'])) {
      include('conexion.php');
       $fecha_reg=$_POST['fecha_reg'];
       $fecha_reg_tabla=$_POST['fecha_reg_tabla'];
       $hora_reg=$_POST['hora_reg'];
       $sindicatos=$_POST['sindicados'];
       $caracteristicas_hecho=$_POST['caracteristicas_hecho'];
       $elemento_utilizado=$_POST['elemento_utilizado'];
       $movil=$_POST['movil'];
       $elemento_sustraido=$_POST['elemento_sustraido'];
       $hecho_consumado=$_POST['hecho_consumado'];
       $tipo_motocicleta=$_POST['tipo_motocicleta'];
       $color=$_POST['color'];
       $adelanto_circulacion=$_POST['adelanto_circulacion'];
       $damnificado=$_POST['damnificado'];
       $edad=$_POST['edad'];
       $sexo=$_POST['sexo'];

       $denunciante=$_POST['denunciante'];
       $denuncia=$_POST['denuncia'];
       $unidad_judicial=$_POST['unidad_judicial'];
       $comision_personal=$_POST['comision_personal'];
       $medida_tomada=$_POST['medida_tomada'];
       $tipo=$_POST['tipo'];
       $subtipo=$_POST['subtipo'];
       $eliminado = $_POST['eliminado'];

       //CONSULTA PARA ACTUALIZAR VALORES EN BASE DE DATOS
       $sqlUpdateNovedades = "UPDATE novedades_de_relevancia SET fecha_reg='$fecha_reg', fecha_reg_tabla='$fecha_reg_tabla', hora_reg='$hora_reg', sindicados='$sindicatos', caracteristicas_hecho='$caracteristicas_hecho', elemento_utilizado='$elemento_utilizado', movil='$movil', elemento_sustraido='$elemento_sustraido', hecho_consumado='$hecho_consumado', tipo_motocicleta='$tipo_motocicleta', color='$color', adelanto_circulacion='$adelanto_circulacion', damnificado='$damnificado', edad='$edad', sexo='$sexo', denunciante='$denunciante', denuncia='$denuncia', unidad_judicial='$unidad_judicial', comision_personal='$comision_personal', medida_tomada='$medida_tomada', tipo='$tipo', subtipo='$subtipo', eliminado='$eliminado' WHERE id=$idNovedadesRelevancia ";
       $resultadoUpdateNovedades=mysqli_query($conexion,$sqlUpdateNovedades);
       if (mysqli_errno($conexion)!=0) {
        echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
      }else{
        
        ?>
        <script language='JavaScript' type="text/javascript">
          function B()
                  {     
                  location.href ='novedades-relevancia-vermas.php?id=<?php echo $idNovedadesRelevancia?>';
                  }
                  B();
        </script>
        <?php 
     }
     mysqli_close($conexion);
   }

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

        <!-- BOTON MODAL DESHABILITAR -->
        <!-- <button type="button" class="btn btn-secondary float-end mt-3 ms-2" data-bs-toggle="modal" data-bs-target="#deshabilitarNovedadesGuardia">
          Deshabilitar
        </button> -->
        <!-- Modal DEHABILITAR -->
        <div class="modal fade" id="deshabilitarNovedadesGuardia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Deshabilitar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>¿Esta seguro que desea deshabilitar este archivo?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Deshabilitar</button>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Novedades de Relevancia</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
              </div>
              <div class="modal-body">
                <div class="card">
                  <div class="card-body">    
                    <!-- FORMULARIO PARA EDITAR NOVEDADES DE RELEVANCIA -->
                    <form class="row g-4 pt-3" method="POST" action="">
                      <div class="col-md-6">
                          <label for="fecha_reg_tabla" class="col-sm-2 col-form-label">Fecha de registro</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="fecha_reg_tabla" name="fecha_reg_tabla" value="<?php echo $fecha_reg_tabla?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="fecha_reg" class="col-sm-2 col-form-label">Fecha del Hecho</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="fecha_reg" name="fecha_reg" value="<?php echo $fecha_reg?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                        <label for="hora_reg" class="form-label">Hora del Hecho</label>
                        <input type="text" class="form-control" id="hora_reg" name="hora_reg" value="<?php echo $hora_reg?>">
                      </div>
                      <div class="col-md-6">
                        <label for="sindicados" class="form-label">Sindicatos</label>
                        <input type="text" class="form-control" id="sindicados" name="sindicados" value="<?php echo $sindicatos?>">
                      </div>
                      <div class="col-md-6">
                        <label for="caracteristicas_hecho" class="form-label">Caracteristicas hecho</label>
                        <input type="text" class="form-control" id="caracteristicas_hecho" name="caracteristicas_hecho" value="<?php echo $caracteristicas_hecho?>">
                      </div>
                      <div class="col-md-6">
                        <label for="elemento_utilizado" class="form-label"> Elemento utilizado</label>
                        <input type="text" class="form-control" id="elemento_utilizado" name="elemento_utilizado" value="<?php echo $elemento_utilizado?>">
                      </div>
                      <div class="col-6">
                          <label for="movil" class="form-label">Movil</label>
                          <input type="text" class="form-control" id="movil" name="movil" value="<?php echo $movil?>">
                        </div>
                      <div class="col-md-6">
                        <label for="elemento_sustraido" class="form-label">Elemento sustraido</label>
                        <input type="text" class="form-control" id="elemento_sustraido" name="elemento_sustraido" value="<?php echo $elemento_sustraido?>">
                      </div>
                      <div class="col-md-6">
                        <label for="hecho_consumado" class="form-label">Hecho consumado</label>
                        <input type="text" class="form-control" id="hecho_consumado" name="hecho_consumado" value="<?php echo $hecho_consumado?>">
                      </div>
                      <div class="col-md-6">
                        <label for="tipo_motocicleta" class="form-label">Tipo motocicleta</label>
                        <input type="text" class="form-control" id="tipo_motocicleta" name="tipo_motocicleta" value="<?php echo $tipo_motocicleta?>">
                      </div>
                      <div class="col-md-6">
                        <label for="color" class="form-label">Color </label>
                        <input type="text" class="form-control" id="color" name="color"  value="<?php echo $color?>">
                      </div>
                      <div class="col-md-6">
                        <label for="adelanto_circulacion" class="form-label">Adelanto circulacion</label>
                        <input type="text" class="form-control" id="adelanto_circulacion" name="adelanto_circulacion" value="<?php echo $adelanto_circulacion?>">
                      </div>
                      <div class="col-md-6">
                        <label for="damnificado" class="form-label">Damnificado</label>
                        <input type="text" class="form-control" id="damnificado" name="damnificado" value="<?php echo $damnificado?>">
                      </div>
                      <div class="col-md-6">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="text" class="form-control" id="edad" name="edad" value="<?php echo $edad?>">
                      </div>
                      <div class="col-md-6">
                        <label for="sexo" class="form-label">Sexo</label>
                        <input type="text" class="form-control" id="sexo" name="sexo" value="<?php echo $sexo?>">
                      </div>
                      <div class="col-md-6">
                        <label for="denunciante" class="form-label">Denunciante</label>
                        <input type="text" class="form-control" id="denunciante" name="denunciante" value="<?php echo $denunciante?>">
                      </div>
                      <div class="col-md-6">
                        <label for="unidad_judicial" class="form-label">Unidad jucial</label>
                        <input type="text" class="form-control" id="unidad_judicial" name="unidad_judicial" value="<?php echo $unidad_judicial?>">
                      </div>
                      <div class="col-md-6">
                        <label for="comision_personal" class="form-label">Comision personal</label>
                        <input type="text" class="form-control" id="comision_personal" name="comision_personal" value="<?php echo $comision_personal?>">
                      </div>
                      <div class="col-md-6">
                        <label for="tipo" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $tipo?>">
                      </div>
                      <div class="col-md-6">
                        <label for="subtipo" class="form-label">Sub Tipo</label>
                        <input type="text" class="form-control" id="subtipo" name="subtipo" value="<?php echo $subtipo?>">
                      </div>
                     
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary float-end" value="guardarNovedadRelevancia" id="guardarNovedadRelevancia" name="guardarNovedadRelevancia">Guardar</button>
                      </div>
                    </form><!-- End Multi Columns Form -->
      
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