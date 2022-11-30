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
       $descripcion=$_POST['txtDescr_Lugar'];
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
                        <label for="fecha_reg" class="col-form-label">Fecha del Hecho</label>
                        <input type="date" class="form-control" id="fecha_reg" name="fecha_reg" value="<?php echo $fecha_reg?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Hora</label>
                        <input type="text" id="txtHora" name="txtHora" class="form-control clockpicker" data-placement="left" data-align="top" data-autoclose="true" readonly="" value="<?php echo $hora_reg?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Tipo</label>
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
                        <label for="inputState" class="form-label">Subtipo</label>
                        <select required id="subtipo" name="subtipo" class="form-select" disabled>
                          <option value="<?php echo $subtipo?>"><?php echo $subtipo?></option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Descripcion del lugar</label>
                        <input required type="text" value="<?php echo $descripcion?>" id="txtDescr_Lugar" name="txtDescr_Lugar" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label for="sindicados" class="form-label">Sindicados (cantidad)</label>
                        <input type="number" class="form-control" id="sindicados" name="sindicados" value="<?php echo $sindicatos?>">
                      </div>
                      <div class="col-md-6">
                        <label for="caracteristicas_hecho" class="form-label">Caracteristicas hecho</label>
                        <input type="text" class="form-control" id="caracteristicas_hecho" name="caracteristicas_hecho" value="<?php echo $caracteristicas_hecho?>">
                      </div>
                      <div class="col-6">
                        <label for="movil" class="form-label">Movil que asistio al lugar</label>
                        <input type="text" class="form-control" id="movil" name="movil" value="<?php echo $movil?>">
                      </div>
                      <div class="col-md-6">
                        <label for="elemento_sustraido" class="form-label">Elemento sustraido</label>
                        <input type="text" class="form-control" id="elemento_sustraido" name="elemento_sustraido" value="<?php echo $elemento_sustraido?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Hecho consumado o intento </label>
                        <select required id="inputState" id="Hecho_Con_Int" name="Hecho_Con_Int" class="form-select">
                            <option value="<?php echo $hecho_consumado?>"><?php echo $hecho_consumado?></option>
                            <option value="Consumado">Consumado</option>
                            <option value="Intento">Intento</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Elemento utilizado (Moto o Pie)</label>
                        <select required id="ElementoUtilizado" name="ElementoUtilizado" class="form-select">
                          <option value="<?php echo $elemento_utilizado?>"><?php echo $elemento_utilizado?></option>
                          <option value="Motocicleta">Motocicleta</option>
                          <option value="Pie">Pie</option>            
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Tipo de motocicleta utilizada </label>
                        <select required id="TipoMotocicleta" name="TipoMotocicleta" class="form-select" disabled>
                          <option value="<?php echo $tipo_motocicleta?>"><?php echo $tipo_motocicleta?></option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="color" class="form-label">Color </label>
                        <input type="text" class="form-control" id="color" name="color"  value="<?php echo $color?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Emitio adelanto de circular</label>
                        <select required id="inputState" id="EmitioAdelanto" name="EmitioAdelanto" class="form-select">
                            <option value="<?php echo $adelanto_circulacion?>"><?php echo $adelanto_circulacion?></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="damnificado" class="form-label">Damnificado</label>
                        <input type="text" class="form-control" id="damnificado" name="damnificado" value="<?php echo $damnificado?>">
                      </div>
                      <div class="col-md-6">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $edad?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Genero</label>
                        <select required id="inputState" id="Sexo" name="Sexo" class="form-select">
                            <option value="<?php echo $sexo?>"><?php echo $sexo?></option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="No Binario">No Binario</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Denuncia </label>
                        <select required id="Denuncia" name="Denuncia" class="form-select">
                            <option value="<?php echo $denuncia?>"><?php echo $denuncia?></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="denunciante" class="form-label">Denunciante</label>
                        <input type="text" class="form-control" id="denunciante" name="denunciante" value="<?php echo $denunciante?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Unidad judicial </label>
                        <select required id="UnidadJudicial" name="UnidadJudicial" class="form-select">
                          <option value="<?php echo $unidad_judicial?>"><?php echo $unidad_judicial?></option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Comision de personal policial en la investigacion</label>
                        <select required id="inputState" id="ComisionPolicialInvestigacion" name="ComisionPolicialInvestigacion" class="form-select">
                            <option value="<?php echo $comision_personal?>"><?php echo $comision_personal?></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Medida tomada </label>
                        <select required id="inputState" id="MedidaTomada" name="MedidaTomada" class="form-select">
                            <option value="<?php echo $medida_tomada?>"><?php echo $medida_tomada?></option>
                            <option value="Fiscalia de instroduccion">Fiscalia de instroduccion</option>
                            <option value="Demora">Demora</option>
                            <option value="A.A.A">A.A.A</option>
                            <option value="A.I.C.F">A.I.C.F</option>
                            <option value="Aprehension">Aprehension</option>
                            <option value="A.A echo">A.A Hecho</option>
                            <option value="Detencion">Detencion</option>
                            <option value="Secuestros">Secuestros</option>
                            <option value="Registros">Registros</option>
                            <option value="Allanamiento">Allanamiento</option>
                        </select>
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
        <!-- Script de reloj -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="clockpicker.js"></script>
        <script type="text/javascript">$('.clockpicker').clockpicker();</script>

        <!-- Script de select -->
        <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="novedades-relevancia-agregar.js"></script>
