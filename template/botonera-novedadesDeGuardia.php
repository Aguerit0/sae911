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
        <button disabled type="button" class="btn btn-warning float-end mt-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                    <form class="row g-4 pt-3" method="post">
                      <div class="col-md-6">
                          <label for="inputDate" class="col-sm-2 col-form-label">Fecha</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" value="<?php echo $fecha?>">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="inputState" class="form-label">Turno</label>
                          <select id="inputState" class="form-select" value="turno">
                            <option value="<?php echo $turno?>"><?php echo $turno?></option>
                            <option >MATUTINO (06:00 - 14:00)</option>
                            <option>VESPERTINO (14:00 - 22:00)</option>
                            <option>NOCTURNO (22:00 - 06:00)</option>
                          </select>
                        </div>
                      <div class="col-md-6">
                        <label for="inputEmail5" class="form-label">Superior de Turno</label>
                        <input type="text" class="form-control" id="inputEmail5" value="<?php echo $superior_de_turno?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Oficial Servicio</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $oficial_servicio?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Cantidad de personal en guardia</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $personas_de_guardia?>">
                      </div>
                      <div class="col-6">
                        <label for="inputAddress5" class="form-label">Motoristas</label>
                        <input type="text" class="form-control" id="inputAddres5s" value="<?php echo $motoristas?>">
                      </div>
                      <div class="col-6">
                          <label for="inputAddress5" class="form-label">Moviles en funcionamiento</label>
                          <input type="text" class="form-control" id="inputAddres5s" value="<?php echo $mov_funcionamiento?>">
                        </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Moviles fuera de servicio</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $mov_fuera_de_servicio?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Cantidad de detenidos Causa Federal</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $detenidos_causa_federal?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Cantidad de detenidos Justicia Ordinaria</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $detenidos_justicia_ordinaria?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Arrestados averiguacion del hecho</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $arres_averiguacion_de_hecho?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Cantidad de Aprehendidos</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $aprehendidos?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Arrestados averiguacion de activiades</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $arres_averiguacion_actividades?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Arrestados Inf. código de faltas</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $arres_info_codigo_de_faltas?>">
                      </div>
                      <div class="col-md-6">
                        <label for="inputtext5" class="form-label">Demorados</label>
                        <input type="text" class="form-control" id="inputtext5" value="<?php echo $demorados?>">
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