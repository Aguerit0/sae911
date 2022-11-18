<?php 
  

    //BOTON GUARDAR->VERMASNOVEDADES->
     if (isset($_POST['guardarNovedad'])) {
      include('conexion.php');
       $fecha=$_POST['fecha'];
       $turno=$_POST['turno'];
       $superior_de_turno=$_POST['superior_de_turno'];
       $oficial_servicio=$_POST['oficial_servicio'];
       $personas_de_guardia=$_POST['personas_de_guardia'];
       $motoristas=$_POST['motoristas'];
       $mov_funcionamiento=$_POST['mov_funcionamiento'];
       $mov_fuera_de_servicio=$_POST['mov_fuera_de_servicio'];
       $detenidos_causa_federal=$_POST['detenidos_causa_federal'];
       $detenidos_justicia_ordinaria=$_POST['detenidos_justicia_ordinaria'];
       $arres_averiguacion_de_hecho=$_POST['arres_averiguacion_de_hecho'];
       $aprehendidos=$_POST['aprehendidos'];
       $arres_averiguacion_actividades=$_POST['arres_averiguacion_actividades'];
       $arres_info_codigo_de_faltas=$_POST['arres_info_codigo_de_faltas'];
       $demorados=$_POST['demorados'];

       //CONSULTA PARA ACTUALIZAR VALORES EN BASE DE DATOS
       $sqlUpdateNovedades = "UPDATE novedades_de_guardia SET fecha='$fecha', turno='$turno', superior_de_turno='$superior_de_turno', oficial_servicio='$oficial_servicio', personas_de_guardia='$personas_de_guardia', motoristas='$motoristas', mov_funcionamiento='$mov_funcionamiento', mov_fuera_de_servicio='$mov_fuera_de_servicio', detenidos_causa_federal='$detenidos_causa_federal', detenidos_justicia_ordinaria='$detenidos_justicia_ordinaria', arres_averiguacion_de_hecho='$arres_averiguacion_de_hecho', arres_averiguacion_actividades='$arres_averiguacion_actividades', arres_info_codigo_de_faltas='$arres_info_codigo_de_faltas', demorados='demorados' WHERE id=$idNovedades ";
       $resultadoUpdateNovedades=mysqli_query($conexion,$sqlUpdateNovedades);
       if (mysqli_errno($conexion)!=0) {
        echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
      }else{
        
        ?>
        <script language='JavaScript' type="text/javascript">
          function B()
                  {     
                  location.href ='novedades-ver-mas.php?id=<?php echo $idNovedades?>';
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
        <button  type="button" class="btn btn-warning float-end mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <i class="bi bi-pencil-square"></i>
          Editar
        </button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Novedades de Guardia</h1>
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
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="turno" class="form-label">Turno</label>
                          <select class="form-select" value="turno" id="turno" name="turno">
                            <option value="<?php echo $turno?>"><?php echo $turno?></option>
                            <option >MATUTINO (06:00 - 14:00)</option>
                            <option>VESPERTINO (14:00 - 22:00)</option>
                            <option>NOCTURNO (22:00 - 06:00)</option>
                          </select>
                        </div>
                      <div class="col-md-6">
                        <label for="superior_de_turno" class="form-label">Superior de Turno</label>
                        <input type="text" class="form-control" id="superior_de_turno" name="superior_de_turno" value="<?php echo $superior_de_turno?>">
                      </div>
                      <div class="col-md-6">
                        <label for="oficial_servicio" class="form-label">Oficial Servicio</label>
                        <input type="text" class="form-control" id="oficial_servicio" name="oficial_servicio" value="<?php echo $oficial_servicio?>">
                      </div>
                      <div class="col-md-6">
                        <label for="personas_de_guardia" class="form-label">Cantidad de personal en guardia</label>
                        <input type="text" class="form-control" id="personas_de_guardia" name="personas_de_guardia" value="<?php echo $personas_de_guardia?>">
                      </div>
                      <div class="col-6">
                        <label for="motoristas" class="form-label">Motoristas</label>
                        <input type="text" class="form-control" id="motoristas" name="motoristas" value="<?php echo $motoristas?>">
                      </div>
                      <div class="col-6">
                          <label for="mov_funcionamiento" class="form-label">Moviles en funcionamiento</label>
                          <input type="text" class="form-control" id="mov_funcionamiento" name="mov_funcionamiento" value="<?php echo $mov_funcionamiento?>">
                        </div>
                      <div class="col-md-6">
                        <label for="mov_fuera_de_servicio" class="form-label">Moviles fuera de servicio</label>
                        <input type="text" class="form-control" id="mov_fuera_de_servicio" name="mov_fuera_de_servicio" value="<?php echo $mov_fuera_de_servicio?>">
                      </div>
                      <div class="col-md-6">
                        <label for="detenidos_causa_federal" class="form-label">Cantidad de detenidos Causa Federal</label>
                        <input type="text" class="form-control" id="detenidos_causa_federal" name="detenidos_causa_federal" value="<?php echo $detenidos_causa_federal?>">
                      </div>
                      <div class="col-md-6">
                        <label for="detenidos_justicia_ordinaria" class="form-label">Cantidad de detenidos Justicia Ordinaria</label>
                        <input type="text" class="form-control" id="detenidos_justicia_ordinaria" name="detenidos_justicia_ordinaria"  value="<?php echo $detenidos_justicia_ordinaria?>">
                      </div>
                      <div class="col-md-6">
                        <label for="arres_averiguacion_de_hecho" class="form-label">Arrestados averiguacion del hecho</label>
                        <input type="text" class="form-control" id="arres_averiguacion_de_hecho" name="arres_averiguacion_de_hecho" value="<?php echo $arres_averiguacion_de_hecho?>">
                      </div>
                      <div class="col-md-6">
                        <label for="aprehendidos" class="form-label">Cantidad de Aprehendidos</label>
                        <input type="text" class="form-control" id="aprehendidos" name="aprehendidos" value="<?php echo $aprehendidos?>">
                      </div>
                      <div class="col-md-6">
                        <label for="arres_averiguacion_actividades" class="form-label">Arrestados averiguacion de activiades</label>
                        <input type="text" class="form-control" id="arres_averiguacion_actividades" name="arres_averiguacion_actividades" value="<?php echo $arres_averiguacion_actividades?>">
                      </div>
                      <div class="col-md-6">
                        <label for="arres_info_codigo_de_faltas" class="form-label">Arrestados Inf. código de faltas</label>
                        <input type="text" class="form-control" id="arres_info_codigo_de_faltas" name="arres_info_codigo_de_faltas" value="<?php echo $arres_info_codigo_de_faltas?>">
                      </div>
                      <div class="col-md-6">
                        <label for="demorados" class="form-label">Demorados</label>
                        <input type="text" class="form-control" id="demorados" name="demorados" value="<?php echo $demorados?>">
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary float-end" name="guardarNovedad" id="guardarNovedad" value="guardarNovedad">Guardar</button>
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