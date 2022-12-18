<?php
 
 
    //BOTON GUARDAR->VERMASNOVEDADES->
     if (isset($_POST['guardarNovedadRelevancia'])) {
      include('conexion.php');
      // print_r($_POST);

      if (strlen(trim($_POST['txtHora'])) >= 1 && strlen(trim($_POST['txtDescr_Lugar'])) >= 1 && strlen(trim($_POST['txtSindicados'])) >= 1 && strlen(trim($_POST['txtCaractDeHecho'])) >= 1 && strlen(trim($_POST['txtMovil'])) >= 1 && strlen(trim($_POST['txtElementoSustraido'])) >= 1)
      {
        // echo "Todo Okey";

        $txtFecha = trim($_POST['txtFecha']);
        $txtHora = trim($_POST['txtHora']);

        $tipo = $_POST['tipo'];
        
        if (empty($_POST['subtipo']))
        {
          $subtipo = $_POST['subtipo2'];
        }
        else
        {
          $subtipo = $_POST['subtipo'];
        }
        

        $txtDescr_Lugar = trim($_POST['txtDescr_Lugar']);

        $txtSindicados = trim($_POST['txtSindicados']);
        if ($txtSindicados >= 0)
        {
          $txtSindicados = trim($_POST['txtSindicados']);
        }
        else
        {
          header('Location: novedades-relevancia-agregar.php');
          exit();
        } 


        $txtCaractDeHechos = trim($_POST['txtCaractDeHecho']);
        $txtMovil = trim($_POST['txtMovil']);
        $txtElementoSustraido = trim($_POST['txtElementoSustraido']);

        $Hecho_Con_Int = $_POST['Hecho_Con_Int'];

        $ElementoUtilizado = $_POST['ElementoUtilizado'];
        if ($ElementoUtilizado != 'Motocicleta')
        {
          $TipoMotocicleta = "null";
          $txtColor = "null";
        }
        else
        {
          if (empty($_POST['txtColor']) || empty($_POST['TipoMotocicleta']))
          {
            if (strlen(trim($_POST['txtColor2'])) >= 1)
            {
              $TipoMotocicleta = $_POST['TipoMotocicleta2'];
              $txtColor = trim($_POST['txtColor2']);
            }
            else
            {
              header('Location: novedades-relevancia-agregar.php');
              exit();
            }
          }
          else
          {
            if (strlen(trim($_POST['txtColor'])) >= 1)
            {
              $TipoMotocicleta = $_POST['TipoMotocicleta'];
              $txtColor = trim($_POST['txtColor']);
            }
            else
            {
              header('Location: novedades-relevancia-agregar.php');
              exit();
            }
          }
        }

        $EmitioAdelanto = $_POST['EmitioAdelanto'];

        if(strlen(trim($_POST['txtDamnificado']))>= 1)
        {
          $txtDamnificado = trim($_POST['txtDamnificado']);
        }
        else
        {
          $txtDamnificado = "No especifica";
        }
        
        if (strlen(trim($_POST['txtEdad'])) >= 1)
        {
          if ($_POST['txtEdad'] > 0)
          {
              $txtEdad = trim($_POST['txtEdad']);
          }
          else
          {
            header('Location: novedades-relevancia-agregar.php');
            exit();
          }
        }
        else
        {
          $txtEdad = "No especifica";
        }
        
        $Sexo = $_POST['Sexo'];
        $Denuncia = $_POST['Denuncia'];

        if ($Denuncia != 'Si')
        {
          $txtDenunciante = "null";
          $UnidadJudicial = "null";
        }
        else
        {
          if (empty($_POST['UnidadJudicial']) || empty($_POST['txtDenunciante']))
          {
            if (strlen(trim($_POST['txtDenunciante2'])) >= 1)
            {
              $txtDenunciante = trim($_POST['txtDenunciante2']);
              $UnidadJudicial = $_POST['UnidadJudicial2'];
            }
            else
            {
              header('Location: novedades-relevancia-agregar.php');
              exit();
            }
          }
          else
          {
            if (strlen(trim($_POST['txtDenunciante'])) >= 1)
            {
              $txtDenunciante = trim($_POST['txtDenunciante']);
              $UnidadJudicial = $_POST['UnidadJudicial'];
            }
            else
            {
              header('Location: novedades-relevancia-agregar.php');
              exit();
            }
          }
        }

        $ComisionPolicialInvestigacion = $_POST['ComisionPolicialInvestigacion'];

        $MedidaTomadaArray = $_REQUEST['MedidaTomada'];
        if(count($MedidaTomadaArray) > count(array_unique($MedidaTomadaArray)))
        {
          // echo "¡Hay repetidos!";
          header('Location: novedades-relevancia-agregar.php?mensaje=error');
          exit();
        }
        else
        {
          // echo "No hay repetidos";
          $MedidaTomada = implode(" - ",$MedidaTomadaArray);
        }

        $idRelevancia = $_GET['id'];

        // echo $txtFecha, $txtHora, $tipo, $subtipo, $txtDescr_Lugar, $txtSindicados, $txtCaractDeHechos, $txtMovil, $txtElementoSustraido, $Hecho_Con_Int, $ElementoUtilizado, $TipoMotocicleta, $txtColor, $EmitioAdelanto, "damni:", $txtDamnificado, "edad:", $txtEdad, $Sexo, $Denuncia, $txtDenunciante, $UnidadJudicial, $ComisionPolicialInvestigacion, $MedidaTomada, $eliminado, $idComisaria, $idUsuario;

        $sqlUpdateNovedades = "UPDATE `novedades_de_relevancia` SET `fecha_reg`='$txtFecha',`hora_reg`='$txtHora',`tipo`='$tipo',`subtipo`='$subtipo',`descripcion_lugar`='$txtDescr_Lugar',`sindicados`='$txtSindicados',`caracteristicas_hecho`='$txtCaractDeHechos',`movil`='$txtMovil',`elemento_sustraido`='$txtElementoSustraido',`hecho_consumado`='$Hecho_Con_Int',`elemento_utilizado`='$ElementoUtilizado',`tipo_motocicleta`='$TipoMotocicleta',`color`='$txtColor',`adelanto_circulacion`='$EmitioAdelanto',`damnificado`='$txtDamnificado',`edad`='$txtEdad',`sexo`='$Sexo',`denuncia`='$Denuncia',`denunciante`='$txtDenunciante',`unidad_judicial`='$UnidadJudicial',`comision_personal`='$ComisionPolicialInvestigacion',`medida_tomada`='$MedidaTomada' WHERE id = '$idRelevancia'";
        $resultadoUpdateNovedades=mysqli_query($conexion,$sqlUpdateNovedades);

        // Comprobar si se registro novedades de relevancia
        if ($resultado_novedades_relevancia)
        {
          // echo "funciona editar novedades relevancia";
          header("Location: novedades-relevancia-vermas.php?id=$idRelevancia&mensaje=editado");
          exit();
        }
        else
        {
          // echo "no funciona editar novedades relevancia";
          header("Location: novedades-relevancia-vermas.php?id=$idRelevancia&mensaje=error");
          exit();
        }
    } 
    else 
    {
      // echo "datos mal ingresados";
      header("Location: novedades-relevancia-vermas.php?id=$idRelevancia&mensaje=error");
      exit();
    } 


    if (mysqli_errno($conexion)!=0) 
    {
      echo '<script>alert("ERROR AL EDITAR REGISTRO")</script>';
    }
    else
    {
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
                    <form class="row g-3 pt-3" method="POST" action="">
                      <div class="col-md-6">
                        <label for="fecha_reg" class="col-form-label">Fecha del Suceso</label>
                        <input required type="date" id="txtFecha" name="txtFecha" class="form-control" value="<?php echo $fecha_reg?>">
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
                        <input type="hidden" name="subtipo2" value="<?php echo $subtipo; ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Descripcion del lugar</label>
                        <input required type="text" id="txtDescr_Lugar" name="txtDescr_Lugar" class="form-control" id="inputEmail5" value="<?php echo $descripcion?>">
                      </div>
                      <div class="col-md-6">
                        <label for="sindicados" class="form-label">Sindicados (cantidad)</label>
                        <input required type="number" id="txtSindicados" name="txtSindicados" class="form-control" value="<?php echo $sindicatos?>">
                      </div>
                      <div class="col-md-6">
                        <label for="caracteristicas_hecho" class="form-label">Caracteristicas del hecho</label>
                        <input required type="text" id="txtCaractDeHecho" name="txtCaractDeHecho" class="form-control" value="<?php echo $caracteristicas_hecho?>">
                      </div>
                      <div class="col-6">
                        <label for="movil" class="form-label">Movil que asistio al lugar</label>
                        <input required type="text" id="txtMovil" name="txtMovil" class="form-control" value="<?php echo $movil?>">
                      </div>
                      <div class="col-md-6">
                        <label for="elemento_sustraido" class="form-label">Elemento sustraido</label>
                        <input required type="text" id="txtElementoSustraido" name="txtElementoSustraido" class="form-control" value="<?php echo $elemento_sustraido?>">
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
                          <option value="<?php echo $tipo_motocicleta?>"><?php if ($tipo_motocicleta == "null"){echo "";}else{echo $tipo_motocicleta;} ?></option>
                        </select>
                        <input type="hidden" name="TipoMotocicleta2" value="<?php echo $tipo_motocicleta; ?>">
                      </div>

                      <div class="col-md-6">
                        <label for="color" class="form-label">Color </label>
                        <input required type="text" id="txtColor" name="txtColor" class="form-control" value="<?php if ($color == "null"){echo "";}else{echo $color;} ?>" disabled>
                        <input type="hidden" name="txtColor2" value="<?php echo $color; ?>">
                      </div>




                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Emitio adelanto de circular</label>
                        <select required id="inputState" id="EmitioAdelanto" name="EmitioAdelanto" class="form-select">
                          <option value="<?php echo $adelanto_circulacion?>"><?php echo $adelanto_circulacion?></option>
                          <option value="Si">Si</option>
                          <option value="No">No</option>
                          <option value="No especifica">No especifica</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="damnificado" class="form-label">Damnificado</label>
                        <input type="text" id="txtDamnificado" name="txtDamnificado" class="form-control" value="<?php echo $damnificado?>">
                      </div>

                      
                      <div class="col-md-6">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" id="txtEdad" name="txtEdad" class="form-control" value="<?php if ($edad == "No especifica"){echo "";}else{echo $edad;} ?>">
                      </div>

                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Genero</label>
                        <select required id="inputState" id="Sexo" name="Sexo" class="form-select">
                            <option value="<?php echo $sexo?>"><?php echo $sexo?></option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                            <option value="No Binario">No Binario</option>
                            <option value="No especifica">No especifica</option>
                        </select>
                      </div>




                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Denuncia </label>
                        <select required id="Denuncia" name="Denuncia" class="form-select">
                            <option value="<?php echo $denuncia?>"><?php echo $denuncia?></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                            <option value="No especifica">No especifica</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="denunciante" class="form-label">Denunciante</label>
                        <input required type="text" id="txtDenunciante" name="txtDenunciante" class="form-control" value="<?php if ($denunciante == "null"){echo "";}else{echo $denunciante;} ?>" disabled>
                        <input type="hidden" name="txtDenunciante2" value="<?php echo $denunciante; ?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Unidad judicial </label>
                        <select required id="UnidadJudicial" name="UnidadJudicial" class="form-select" disabled>
                          <option value="<?php echo $unidad_judicial?>"><?php if ($unidad_judicial == "null"){echo "";}else{echo $unidad_judicial;} ?></option>
                        </select>
                        <input type="hidden" name="UnidadJudicial2" value="<?php echo $unidad_judicial; ?>">
                      </div>




                      <div class="col-md-6">
                        <label for="inputState" class="form-label">Comision de personal policial</label>
                        <select required id="inputState" id="ComisionPolicialInvestigacion" name="ComisionPolicialInvestigacion" class="form-select">
                            <option value="<?php echo $comision_personal?>"><?php echo $comision_personal?></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                            <option value="No especifica">No especifica</option>
                        </select>
                      </div>




                      <?php 
                      $medida_tomada_array = explode(" - ", $medida_tomada);

                      for ($i=0; $i < count($medida_tomada_array); $i++) 
                      { 
                        if($i == 0)
                        { ?>
                          <div class="col-md-5">
                          <label for="inputState" class="form-label">Medida tomada </label>
                          <select required id="inputState" name="MedidaTomada[]" class="form-select">
                            <option value="<?php echo $medida_tomada_array[$i]?>"><?php echo $medida_tomada_array[$i] ?></option>
                            <option value="Demora">Demora</option>
                            <option value="A.A.A">A.A.A</option>
                            <option value="A.I.C.F">A.I.C.F</option>
                            <option value="Aprehension">Aprehension</option>
                            <option value="A.A Hecho">A.A Hecho</option>
                            <option value="Detencion">Detencion</option>
                            <option value="Secuestros">Secuestros</option>
                            <option value="Registros">Registros</option>
                            <option value="Allanamiento">Allanamiento</option>
                          </select>
                          </div>

                          <div class="col-md-1 mt-5">
                            <button class="btn btn-success add-btn"><i class="bi bi-plus-circle-fill"></i></button>
                          </div>
                          <?php
                        }
                        else
                        {
                          ?>
                          <div id="newRow<?php echo $i ?>" class="col-md-6">
                            <div class="row g-3">
                              <div class="col-md-10">
                                <label for="inputState" class="form-label">Medida tomada </label>
                                <select required id="inputState" name="MedidaTomada[]" class="form-select">
                                <option value="<?php echo $medida_tomada_array[$i]?>"><?php echo $medida_tomada_array[$i] ?></option>
                                  <option value="Demora">Demora</option>
                                  <option value="A.A.A">A.A.A</option>
                                  <option value="A.I.C.F">A.I.C.F</option>
                                  <option value="Aprehension">Aprehension</option>
                                  <option value="A.A Hecho">A.A Hecho</option>
                                  <option value="Detencion">Detencion</option>
                                  <option value="Secuestros">Secuestros</option>
                                  <option value="Registros">Registros</option>
                                  <option value="Allanamiento">Allanamiento</option>
                                </select>
                              </div>

                              <div class="col-md-2 mt-5">
                                <a href="#" class="btn btn-danger remove-lnk" id="<?php echo $i ?>"><i class="bi bi-trash3"></i></a>
                              </div>
                            </div>
                          </div>

                        <?php 
                        }
                      } 
                      ?>

                      <!-- <div class="col-md-6">
                        <div class="row newData2 g-2">
                        </div>
                      </div> -->

                      <div class="row newData g-2 ms-0">
                      </div>
                    
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary float-end" value="guardarNovedadRelevancia" id="guardarNovedadRelevancia" name="guardarNovedadRelevancia">Guardar</button>
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


        <!-- Script de reloj -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="clockpicker.js"></script>
        <script type="text/javascript">$('.clockpicker').clockpicker();</script>

        <!-- Script de select -->
        <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="novedades-relevancia-agregar.js"></script>

        <!-- Script de medidas tomadas -->
        <script type="text/javascript">
          $(function () { 
            var i = <?php echo count($medida_tomada_array) ?>-1;
            $('.add-btn').click(function (e) {
              e.preventDefault();
              // if (i == 1)
              // {
              //   i++;
                
              //   $('.newData2').append('<div id="newRow'+i+'" class="col-md-12">'

              //     +'<div class="row g-3">'
              //       +'<div class="col-md-10">'
                  
              //         +'<label>Medida tomada</label>'

              //         +'<select required id="inputState" name="MedidaTomada[]" class="form-control">'
              //           +'<option value="">Seleccionar</option>'
              //           +'<option value="Demora">Demora</option>'
              //           +'<option value="A.A.A">A.A.A</option>'
              //           +'<option value="A.I.C.F">A.I.C.F</option>'
              //           +'<option value="Aprehension">Aprehension</option>'
              //           +'<option value="A.A echo">A.A Hecho</option>'
              //           +'<option value="Detencion">Detencion</option>'
              //           +'<option value="Secuestros">Secuestros</option>'
              //           +'<option value="Registros">Registros</option>'
              //           +'<option value="Allanamiento">Allanamiento</option>'
              //         +'</select>'

              //       +'</div>'
                    
              //       +'<div class="col-md-2 mt-5">'
              //         +'<a href="#" class="btn btn-danger remove-lnk" id="'+i+'"><i class="bi bi-trash3"></i></a>'
              //       +'</div>'
                  
              //     +'</div>'
              //   +'</div>'
              //   ); 
              // } 
              // else
              // {
                i++;
                
                $('.newData').append('<div id="newRow'+i+'" class="col-md-6">'

                  +'<div class="row g-3 p-1">'
                    +'<div class="col-md-10">'
                  
                      +'<label>Medida tomada</label>'

                      +'<select required id="inputState" name="MedidaTomada[]" class="form-control">'
                        +'<option value="">Seleccionar</option>'
                        +'<option value="Demora">Demora</option>'
                        +'<option value="A.A.A">A.A.A</option>'
                        +'<option value="A.I.C.F">A.I.C.F</option>'
                        +'<option value="Aprehension">Aprehension</option>'
                        +'<option value="A.A echo">A.A Hecho</option>'
                        +'<option value="Detencion">Detencion</option>'
                        +'<option value="Secuestros">Secuestros</option>'
                        +'<option value="Registros">Registros</option>'
                        +'<option value="Allanamiento">Allanamiento</option>'
                      +'</select>'

                    +'</div>'
                    
                    +'<div class="col-md-2 mt-5">'
                      +'<a href="#" class="btn btn-danger remove-lnk" id="'+i+'"><i class="bi bi-trash3"></i></a>'
                    +'</div>'
                  
                  +'</div>'
                +'</div>'
                ); 
              // }
            });


            $(document).on('click', '.remove-lnk', function(e) 
            {
              e.preventDefault();

              var id = $(this).attr("id");
              $('#newRow'+id+'').remove();
            });

          });
        </script>