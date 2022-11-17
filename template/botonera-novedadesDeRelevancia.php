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
                    <form class="row g-4 pt-3" method="post">
                      <div class="col-md-6">
                          <label for="inputDate" class="col-sm-2 col-form-label">Fecha de registro</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $fecha_reg?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <label for="inputDate" class="col-sm-2 col-form-label">Fecha</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?php echo $fecha_reg_tabla?>">
                          </div>
                        </div>

                        <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Hora</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $hora_tabla?>">
                      </div>
                        
                      <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Lugar</label>
                        <input type="text" class="form-control" id="inputEmail5" value="<?php echo $lugar?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Sindicatos</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $sindicatos?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Caracteristicas hecho</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $caracteristicas_hecho?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label"> Elemento utilizado</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $elemento_utlizado?>">
                      </div>
                      
                      <div class="col-6">
                          <label for="inputAddress5" class="form-label">Movil</label>
                          <input type="text" class="form-control" id="inputAddres5s" value="<?php echo $movil?>">
                        </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Elemento sustraido</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $elemento_sustraido?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Hecho consumado</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $hecho_consumado?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Tipo motocicleta</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $tipo_motocicleta?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Color </label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $color?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Adelanto circulacion</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $adelanto_circulacion?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Damnificado</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $damnificado?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Edad</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $edad?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Sexo</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $sexo?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Denunciante</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $denunciante?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Unidad jucial</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $unidad_judicial?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Comision personal</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $comision_personal?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Tipo</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $id_tipo?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Sub Tipo</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $id_subtipo?>">
                      </div>
                     
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary float-end" value="guardarNovedad">Guardar</button>
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