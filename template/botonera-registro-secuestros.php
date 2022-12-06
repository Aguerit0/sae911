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
       $sqlUpdateNovedades = "UPDATE novedades_de_guardia SET fecha='$fecha', turno='$turno', superior_de_turno='$superior_de_turno', oficial_servicio='$oficial_servicio', personas_de_guardia='$personas_de_guardia', motoristas='$motoristas', mov_funcionamiento='$mov_funcionamiento', mov_fuera_de_servicio='$mov_fuera_de_servicio', detenidos_causa_federal='$detenidos_causa_federal', detenidos_justicia_ordinaria='$detenidos_justicia_ordinaria', arres_averiguacion_de_hecho='$arres_averiguacion_de_hecho', arres_averiguacion_actividades='$arres_averiguacion_actividades', arres_info_codigo_de_faltas='$arres_info_codigo_de_faltas', demorados='$demorados', aprehendidos = '$aprehendidos' WHERE id=$idNovedades ";
       $resultadoUpdateNovedades=mysqli_query($conexion,$sqlUpdateNovedades);
       if (mysqli_errno($conexion)!=0) {
        echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
      }else{
        
        ?>
        <script language='JavaScript' type="text/javascript">
          function B()
                  {     
                  location.href ='novedades-ver-mas.php?mensaje=editado&id=<?php echo $idNovedades?>';
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
                            <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha?>">
                          </div>
                        </div>
                       
                      
                   
                      <div class="col-md-6">
                        <label for="detenidos_causa_federal" class="form-label"></label>
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