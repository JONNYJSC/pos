<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administrar Usuarios
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar Usuarios</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          Agregar Usuario
        </button>

      </div>

      <!-- Cuerpo de la pagina -->
      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas">
          <!-- Titulos de la tabla -->
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ùltimo login</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <!-- Cuerpo de la tabla -->
          <tbody>

          <?php
          $item = null;
          $valor = null;

          $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
          foreach ($usuarios as $key => $value) {
              echo '
                <tr>
                  <td>'.$value["id"].'</td>
                  <td>'.$value["nombre"].'</td>
                  <td>'.$value["usuario"].'</td>';

              if ($value["foto"] != "") {
                  echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
              } else {
                  echo '<td><img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';
              }
                  
              echo '<td>'.$value["perfil"].'</td>
                  <td><button class="btn btn-success btn-xs">'.$value["estado"].'</button></td>
                  <td>'.$value["ultimo_login"].'</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </div>
                  </td>
                </tr>
              ';
          }
          ?>
            
          </tbody>

        </table>

      </div>

    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modal Agregar Usuario -->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <form rol="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Usuario</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <!-- Entrada para nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre"
                  require>
              </div>
            </div>

            <!-- Entrada para el usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar Usuario"
                  require>
              </div>
            </div>

            <!-- Entrada para el contraseña -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword"
                  placeholder="Ingresar Contraseña" require>
              </div>
            </div>

            <!-- Entrada para seleccionar su perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Seleccionar Perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>

            <!-- Entrada para subir foto -->
            <div class="form-group">
              <div class="panel text-uppercase">Subir Foto</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso màximo de la foto 2MB</p>

              <img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guadar Usuario</button>
        </div>

        <?php
          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();
        ?>

      </form>

    </div>

  </div>
</div>

<!-- Modal Editar Usuario -->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">

      <form rol="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuario</h4>
        </div>

        <div class="modal-body">
          <div class="box-body">

            <!-- Entrada para nombre -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value=""
                  require>
              </div>
            </div>

            <!-- Entrada para el usuario -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value=""
                  require>
              </div>
            </div>

            <!-- Entrada para el contraseña -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword"
                  placeholder="Ingresar nueva Contraseña" require>
                <!-- Oculta -->
                  <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>

            <!-- Entrada para seleccionar su perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>
            </div>

            <!-- Entrada para subir foto -->
            <div class="form-group">
              <div class="panel text-uppercase">Subir Foto</div>
              <input type="file" class="nuevaFoto" name="editarFoto">
              <p class="help-block">Peso màximo de la foto 2MB</p>

              <img src="views/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">
              <!-- Oculta para mantener la misma foto en la bd-->
                  <input type="hidden" id="fotoActual" name="fotoActual">
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Usuario</button>
        </div>

        <?php
          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();
        ?>

      </form> 

    </div>

  </div>
</div>