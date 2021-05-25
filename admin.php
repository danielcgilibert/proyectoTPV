<?php
session_start();
require('head.php');
require_once "./db/database.php";




$mesas = cargar_mesas();
$categorias = cargar_categorias();
$usuarios = cargar_usuarios();
foreach ($categorias as $categoria) {
  $productosCa[$categoria["nombre"]] = cargar_productos($categoria["idCategoria"]);
}

if (isset($_SESSION['user'])) { ?>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" style="color: white;">Aroma Tapas</a>
      <form class="m-4" action="./db/logout.php">
      <button type="submit" class="btn"> <i class="fas fa-sign-out-alt"></i> Sign out</button>
      </form>
     



    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar pt-5" id="mySidebar">
          <div class="sidebar-sticky mt-4">

            <ul class="nav flex-column menuLateral">
              <li class="nav-item menuLink">
                <a class="nav-link active" href="#" id="dashboard-Link">
                  <i class="fas fa-home"></i>
                  Dashboard
                </a>
              </li>
              <li class="nav-item menuLink">
                <a class="nav-link" href="#" id="Empresa-Link">
                  <i class="fas fa-briefcase"></i>
                  Empresa
                </a>
              </li>
              <li class="nav-item menuLink">
                <a class="nav-link" href="#" id="Categorias-Link">
                  <i class="fas fa-list-alt"></i>
                  Categorías
                </a>
              </li>
              <li class="nav-item menuLink">
                <a class="nav-link" href="#" id="Productos-Link">
                  <i class="fas fa-utensils"></i>
                  Productos
                </a>
              </li>

              <li class="nav-item menuLink">
                <a class="nav-link" href="#" id="Pedidos-Link">
                  <i class="fas fa-list"></i>
                  Pedidos Cocina
                </a>
              </li>

              <li class="nav-item menuLink">
                <a class="nav-link " href="#" id="Usuarios-Link">
                  <i class="fas fa-users"></i>
                  Usuarios
                </a>
              </li>

              <li class="nav-item menuLink">
                <a class="nav-link " href="#" id="Ticket-Link">
                  <i class="fas fa-ticket-alt"></i>
                  Ticket
                </a>
              </li>

              <li class="nav-item menuLink">
                <a class="nav-link " href="#" id="Mesas-Link">
                  <i class="fas fa-chair"></i>
                  Mesas
                </a>
              </li>

            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Listados</span>
            </h6>

            <ul class="nav flex-column mb-2">
              <li class="nav-item">

                <a class="nav-link listarTicket" href="#">
                  <i class="fas fa-clipboard-list"></i>
                  Imprimir un ticket
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="far fa-file"></i>
                  Listado Ejemplo
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="far fa-file"></i>
                  Listado Ejemplo
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="far fa-file"></i>
                  Listado Ejemplo
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main id="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div id="dashboard">


            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              <h1 class="h2">Dashboard</h1>

            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">
                      With supporting text below as a natural lead-in to additional content.
                    </p>
                    <button type="button" class="btn btn-info">
                      Ventas <span class="badge badge-light">6</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">
                      With supporting text below as a natural lead-in to additional content.
                    </p>
                    <button type="button" class="btn btn-success">
                      Clientes <span class="badge badge-light">10</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <hr>

            <h2>Listado</h2>
            <div class="table-responsive">
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                    <th>Header</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1,001</td>
                    <td>Lorem</td>
                    <td>ipsum</td>
                    <td>dolor</td>
                    <td>sit</td>
                  </tr>
                  <tr>
                    <td>1,002</td>
                    <td>amet</td>
                    <td>consectetur</td>
                    <td>adipiscing</td>
                    <td>elit</td>
                  </tr>
                  <tr>
                    <td>1,003</td>
                    <td>Integer</td>
                    <td>nec</td>
                    <td>odio</td>
                    <td>Praesent</td>
                  </tr>
                  <tr>
                    <td>1,003</td>
                    <td>libero</td>
                    <td>Sed</td>
                    <td>cursus</td>
                    <td>ante</td>
                  </tr>
                  <tr>
                    <td>1,004</td>
                    <td>dapibus</td>
                    <td>diam</td>
                    <td>Sed</td>
                    <td>nisi</td>
                  </tr>
                  <tr>
                    <td>1,005</td>
                    <td>Nulla</td>
                    <td>quis</td>
                    <td>sem</td>
                    <td>at</td>
                  </tr>
                  <tr>
                    <td>1,006</td>
                    <td>nibh</td>
                    <td>elementum</td>
                    <td>imperdiet</td>
                    <td>Duis</td>
                  </tr>
                  <tr>
                    <td>1,007</td>
                    <td>sagittis</td>
                    <td>ipsum</td>
                    <td>Praesent</td>
                    <td>mauris</td>
                  </tr>
                  <tr>
                    <td>1,008</td>
                    <td>Fusce</td>
                    <td>nec</td>
                    <td>tellus</td>
                    <td>sed</td>
                  </tr>

                </tbody>
              </table>
            </div>


          </div>

          <div id="Empresa">
            <form>
              <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect2">Example multiple select</label>
                <select multiple class="form-control" id="exampleFormControlSelect2">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
            </form>
          </div>

          <div id="Categorias">
            <h1>Categorías</h1>

            <div class="row p-5">
              <div class="col-md-4 mb-3 text-center ">
                <div class="card">
                  <div class="card-body">
                    <h5>Crear categoria</h5>
                    <button type="button" class="btn btn-outline-primary" id="botonCrearCategoria"><i class="fas fa-plus-square"></i></button>
                  </div>
                </div>


              </div>

              <div class="col-md-8 mb-3 text-center">
                <div class="card">
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <p><strong>Ultima categoría actualizada</strong> : Arroces</p>
                      </li>
                      <li class="list-group-item">
                        <p><strong>Cantidad de categorías </strong> : <span class="badge badge-info p-2">9</span></p>
                      </li>
                    </ul>

                  </div>
                </div>

              </div>
            </div>

            <hr>
            <div class="row text-center p-5">


              <?php foreach ($categorias as $categoria) { ?>
                
                <div class="col-md-3 mb-3 text-center categoria ">

                  <div class="card" style="width: 18rem;" idCategoria=<?= $categoria["idCategoria"] ?>>
                    <img class="card-img-top" src=<?= !empty($categoria["imagen"])?'data:image/png;base64,' . $categoria["imagen"]:"https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1200px-No_image_3x4.svg.png" ?> alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title"><?= $categoria["nombre"] ?></h5>
                      <hr>
                    </div>

                    <div class="card-body">
                      <div class="row">

                        <div class="col-sm-6">
                          <button type="button" class="btn btn-outline-info editarCategoria"><i class="fas fa-edit"></i> Editar</button>

                        </div>
                        <div class="col-sm-6">
                          <button type="button" class="btn btn-outline-danger borrarCategoria"><i class="fas fa-trash-alt"></i> Borrar</button>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </div>


            <div class="modal fade" id="modalCrearCategoria" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="far fa-folder-open"></i> Crear Categoría</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form id="formCrearCategoria">
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="inputNombreCategoria"><i class="far fa-edit"></i>Nombre Categoría</label>
                          <input type="text" class="form-control" id="inputNombreCategoria">
                        </div>
                      </div>


                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="inputImagenCategoria">Imagen de la categoría</label>
                          <input type="file" class="form-control-file" id="inputImagenCategoria" name="inputImagenCategoria">
                        </div>
                      </div>


                    </form>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="crearCategoria">Crear</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                  </div>
                </div>

              </div>
            </div>


            <div class="modal fade" id="modalEditarCategoria" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="far fa-folder-open"></i> Editar Categoría</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form id="formEditarCategoria">
                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="inputNombreCategoria"><i class="far fa-edit"></i>Nombre Categoría</label>
                          <input type="text" class="form-control" id="inputEditarNombreCategoria">
                        </div>
                      </div>


                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="inputEditarImagenCategoria">Imagen de la categoría</label>
                          <input type="file" class="form-control-file" id="inputEditarImagenCategoria">
                        </div>
                      </div>


                    </form>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="editarCategoria">Crear</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                  </div>
                </div>

              </div>
            </div>


          </div>



          <div id="Productos">
            <h1 class="mb-5 text-center">Productos</h1>

            <?php foreach ($productosCa as $categoria => $productos) { ?>


              <?php if (count($productos)) {


                echo '<h2>'  . $categoria  . '</h2>';
                echo '<hr/>';
                echo '<button type="button" class="btn btn-light anadirProducto p-2 " idCategoria= ' . $productos[0]["idCategoria"] . '><i class="far fa-plus-square mr-2"></i>  Añadir Producto </button>';
              } else {

                for ($i = 0; $i < count($categorias); $i++) {
                  if ($categorias[$i]["nombre"] === $categoria) {
                    echo '<h2>'  . $categoria  . '</h2>';
                    echo '<hr/>';
                    echo '<button type="button" class="btn btn-light anadirProducto p-2 " idCategoria= ' . $categorias[$i]["idCategoria"] . '><i class="far fa-plus-square mr-2"></i>  Añadir Producto </button>';
                    echo '<div class="alert alert-info" role="alert">No hay ningun producto en esta categoria</div>';
                  }
                }
              } ?>

              <div class="row text-center">

                <?php
                foreach ($productos as $producto) { ?>

                  <div class="col-md-3 mb-2 text-center p-3 producto" idProducto=<?= $producto["idProducto"] ?>>

                    <div class="card" style="width: 18rem;" idCategoria=<?= $producto["idCategoria"] ?>>
                      <img class="card-img-top" src=<?= !empty($producto["imagen"])?'data:image/png;base64,' . $producto["imagen"]:"https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1200px-No_image_3x4.svg.png" ?> alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title nombreProducto"><?= $producto["nombre"] ?></h5>
                        <hr>

                        <p class="descripcionProducto"> <?= $producto["descripcion"] ?> </p>
                        <p class="precioProducto"> <?= $producto["precio"] ?> € </p>

                      </div>

                      <div class="p-5">
                        <div class="row">

                          <div class="col-sm-6">
                            <button type="button" class="btn btn-outline-info editarProducto"><i class="fas fa-edit"></i> Editar</button>

                          </div>
                          <div class="col-sm-6">
                            <button type="button" class="btn btn-outline-danger borrarProducto"><i class="fas fa-trash-alt"></i> Borrar</button>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                <?php } ?>

              </div>



            <?php } ?>



            <div class="modal fade" id="modalProducto" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="far fa-folder-open"></i> Producto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputIdProducto"><i class="far fa-list-alt"></i>ID Producto</label>
                          <input type="number" class="form-control text-center" id="inputIdProducto" disabled=true>
                        </div>

                        <div class="form-group col-md-6">
                          <label for="inputNombreProducto"><i class="far fa-edit"></i>Nombre Producto</label>
                          <input type="text" class="form-control" id="inputNombreProducto">
                        </div>

                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="inputNombreProducto"><i class="far fa-file-alt"></i>Descripción</label>
                          <textarea class="form-control" id="inputDescripcionProducto" rows="3"></textarea>
                        </div>
                      </div>


                      <div class="form-row">
                        <div class="form-group col-md-8">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputPrecioProducto"> <i class="far fa-money-bill-alt"></i>
                            Precio</label>
                          <input type="number" class="form-control text-center" id="inputPrecioProducto">
                        </div>
                      </div>

                    </form>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="updateProducto">Guardar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                  </div>
                </div>

              </div>
            </div>






            <div class="modal fade" id="modalAnadirProducto" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><i class="far fa-folder-open"></i> Producto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <form id="formAnadirProducto">
                      <div class="form-row">


                        <div class="form-group col-md-12">
                          <label for="inputNombreProducto"><i class="far fa-edit"></i>Nombre Producto</label>
                          <input type="text" class="form-control" id="inputAnadirNombreProducto">
                        </div>

                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="inputNombreProducto"><i class="far fa-file-alt"></i>Descripción</label>
                          <textarea class="form-control" id="inputAnadirDescripcionProducto" rows="3"></textarea>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="form-group col-md-12">
                          <label for="inputAnadirImagenProducto">Imagen del producto</label>
                          <input type="file" class="form-control-file" id="inputAnadirImagenProducto">
                        </div>
                      </div>


                      <div class="form-row">
                        <div class="form-group col-md-8">
                        </div>
                        <div class="form-group col-md-4">
                          <label for="inputPrecioProducto"> <i class="far fa-money-bill-alt"></i>
                            Precio</label>
                          <input type="number" class="form-control text-center" id="inputAnadirPrecioProducto">
                        </div>
                      </div>


              

                    </form>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="anadirProducto">Guardar</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                  </div>
                </div>

              </div>
            </div>


          </div>


          <div id="Pedidos">
            <h1>Pedidos</h1>
          </div>

          <div id="Usuarios">
            <h1>Usuarios</h1>
            <hr>
            <div class="row">

              <?php foreach ($usuarios as $usuario) { ?>
                <div class="col-xl-3 col-sm-6 mb-5">
                  <div class="card cardUsuario" style="width: 18rem;" idUsuario=<?= $usuario["idUsuario"] ?> nombreUsuario=<?= $usuario["nombre"] ?> emailUsuario=<?= $usuario["email"] ?> apellidosUsuario='<?= $usuario["apellidos"] ?>' perfilUsuario=<?= $usuario["perfil"] ?>>
                    <div class="bg-white rounded shadow-sm text-center m-2"><img src="https://ambitioustracks.com/wp-content/uploads/2017/01/1.-fundadores.png" alt="" width="100" class="img-fluid rounded-circle  img-thumbnail shadow-sm">
                      <div class="card-body">
                        <h5 class="card-title mb-0"> <?= $usuario["nombre"] ?> </h5>
                        <span class="small text-uppercase text-muted tipoPerfil">
                          <?php if ($usuario["perfil"] == 1) {
                            echo  ' Camarero';
                          } elseif ($usuario["perfil"] == 2) {
                            echo 'Cocinero';
                          } else {
                            echo 'Gerente';
                          } ?>
                        </span>
                        <ul class="social mb-0 list-inline mt-3">
                          <li class="m-2">
                            <div class="emailUsuario"> <?= $usuario["email"] ?> </div>
                          </li>

                          <li>
                            <div class="nombreUsuario"> <?= $usuario["nombre"] ?> </div>
                            <div class="apellidosUsuario"> <?= $usuario["apellidos"] ?> </div>
                          </li>

                          <i class="fas fa-user-edit m-2 pointer botonEditarUsuario"></i>
                          <i class="fas fa-user-minus m-2 pointer botonBorrarUsuario"></i>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              <?php  } ?>





              <div class="modal fade" id="modalEditarUsuario" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title"><i class="far fa-folder-open"></i> Usuario</h4>

                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                      <div class="bg-white rounded shadow-sm text-center  m-auto"><img src="https://ambitioustracks.com/wp-content/uploads/2017/01/1.-fundadores.png" alt="" width="100" class="img-fluid rounded-circle  img-thumbnail shadow-sm">
                      </div>

                      <form id="formEditarUsuario">
                        <div class="form-row mt-5">


                          <div class="form-group col-md-6">
                            <label for="inputNombreProducto"><i class="far fa-user"></i>Nombre</label>
                            <input type="text" class="form-control" id="inputEditNombreUsuario">
                          </div>


                          <div class="form-group col-md-6">
                            <label for="inputNombreProducto"><i class="far fa-user"></i>Apellidos</label>
                            <input type="text" class="form-control" id="inputApellidosUsuario">
                          </div>

                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-12">
                            <label for="inputNombreProducto"><i class="far fa-envelope-open"></i>Email</label>
                            <input type="email" class="form-control" id="inputEmailUsuario">
                          </div>
                        </div>

                        <div class="form-row">

                          <div class="form-group col-md-12">
                            <label for="exampleFormControlSelect1">Tipo</label>
                            <select class="form-control" id="inputEditTipoUsuario">
                              <option value="1" id="camarero">Camarero</option>
                              <option value="2" id="cocinero">Cocinero</option>
                              <option value="3" id="gerente">Gerente</option>
                            </select>
                          </div>
                        </div>

                      </form>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" id="editarUsuario">Guardar</button>

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                    </div>
                  </div>

                </div>
              </div>



            </div>
          </div>



          <div id="Ticket">
            <h1>Ticket</h1>
          </div>


          <div id="Mesas">
            <h1>Mesas</h1>
            <hr>
            <div class="row">

              <?php

              foreach ($mesas as $mesa) { ?>
                <div class="col-sm-4">
                  <div class="mesa" mesaEstado=<?= $mesa["estado"] ?> mesaId=<?= $mesa["idMesa"] ?> ticketId=<?= $mesa["idTicket"] ?>>
                    <?= $mesa["estado"] == 0 ? '<span class="badge badge-success">' : '<span class="badge badge-danger">' ?>
                    <strong>
                      <p>Mesa <?= $mesa["idMesa"] ?></p>
                    </strong><?= $mesa["estado"] == 0 ? "Libre" : "Ocupado" ?></span>
                  </div>
                </div>
              <?php } ?>



              <!-- /.col-sm-4 -->
            </div>


          </div>

        </main>






      </div>


      <div class="modal fade" id="modalMesa" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ticket</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-9">
                      <label type="text"> <i class="fas fa-clipboard-list"></i> <strong> Número de ticket </strong> </label>
                    </div>
                    <div class="col-md-3">
                      <label type="text"> <strong> 4 </strong></label>
                    </div>

                  </div>
                  <hr>
                </div>

                <div class="form-group">
                  <div class="row mb-1">
                    <div class="col-md-7">
                      <label type="text"> <i class="fas fa-chalkboard-teacher"></i> <strong> Atendido por </strong> </label>
                    </div>
                    <div class="col-md-5">
                      <label type="text"> Manuel Sanchez Ortiz</label>
                    </div>
                  </div>
                  <div class="row  mb-1">
                    <div class="col-md-9 ">
                      <label type="text"> <i class="fas fa-chair"></i>
                        <strong> En la mesa </strong> </label>
                    </div>
                    <div class="col-md-3">
                      <label type="text"> 1 </label>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-7">
                      <label type="text"><i class="far fa-clock"></i>
                        <strong> Fecha </strong> </label>
                    </div>
                    <div class="col-md-5 ">
                      <label type="text"> 20/03/2019 : 14:45 </label>
                    </div>
                  </div>

                  <hr>


                  <div class="row">
                    <div class="col-md-8 ">
                      <label type="text"><i class="fas fa-briefcase"></i>
                        <strong> Empresa </strong> </label>
                    </div>

                    <div class="col-md-3 text-center ">
                      <strong>CIF 2452 </strong></label>
                    </div>


                  </div>

                  <div class="row ">
                    <div class="col-md-7 ">
                      <label type="text"> <strong> - Nombre </strong> : </label>
                    </div>
                    <div class="col-md-5 text-center ">
                      <label type="text"> Aroma tapas EP</label>
                    </div>
                  </div>

                  <div class="row ">
                    <div class="col-md-8 ">
                      <label type="text"> <strong> - Telefono</strong> : </label>
                    </div>
                    <div class="col-md-3 text-center">
                      <label type="text"> 242424</label>
                    </div>
                  </div>

                  <hr>
                  <div class="row ">
                    <div class="col-md-12 ">
                      <label type="text"> <i class="fas fa-receipt"></i> <strong>Cuenta </strong></label>
                    </div>
                  </div>

                </div>


              </form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>


      <div class="modal fade" id="modalConsultarTicket" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"> <i class="fas fa-clipboard-list"></i>
                Ticket</h4>

              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

              <form id="formConsultarTicket">
                <div class="form-row ">


                  <div class="form-group col-md-12">
                    <label for="inputNombreProducto">
                      </i>Número del ticket</label>
                    <input type="number" class="form-control" id="inputConsultarNumeroTicket">
                  </div>


                </div>

                <div id="mostrarTicket">
                  <form id="formMostrarTicket">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-9">
                          <label type="text"> <i class="fas fa-clipboard-list"></i> <strong> Número de ticket </strong> </label>
                        </div>
                        <div class="col-md-3">
                          <label type="text"> <strong id="numeroTicket"> 4 </strong></label>
                        </div>

                      </div>
                      <hr>
                    </div>

                    <div class="form-group">
                      <div class="row mb-1">
                        <div class="col-md-7">
                          <label type="text"> <i class="fas fa-chalkboard-teacher"></i> <strong> Atendido por </strong> </label>
                        </div>
                        <div class="col-md-5">
                          <label type="text" id="atendidoPorConsultarTicket"> Manuel Sanchez Ortiz</label>
                        </div>
                      </div>
                      <div class="row  mb-1">
                        <div class="col-md-9 ">
                          <label type="text"> <i class="fas fa-chair"></i>
                            <strong> En la mesa </strong> </label>
                        </div>
                        <div class="col-md-3">
                          <label type="text" id="mesaConsultarTicket"> 1 </label>
                        </div>
                      </div>

                      <div class="row mb-2">
                        <div class="col-md-7">
                          <label type="text"><i class="far fa-clock"></i>
                            <strong> Fecha </strong> </label>
                        </div>
                        <div class="col-md-5 ">
                          <label type="text" id="fechaConsultarTicket"> 20/03/2019 : 14:45 </label>
                        </div>
                      </div>

                      <hr>


                      <div class="row">
                        <div class="col-md-8 ">
                          <label type="text"><i class="fas fa-briefcase"></i>
                            <strong> Empresa </strong> </label>
                        </div>

                        <div class="col-md-3 text-center ">
                          <strong id="empresaCIFConsultarTicket">CIF 2452 </strong></label>
                        </div>


                      </div>

                      <div class="row ">
                        <div class="col-md-7 ">
                          <label type="text"> <strong> - Nombre </strong> : </label>
                        </div>
                        <div class="col-md-5 text-center ">
                          <label type="text" id="empresaNombreConsultarTicket"> Aroma tapas EP</label>
                        </div>
                      </div>

                      <div class="row ">
                        <div class="col-md-8 ">
                          <label type="text"> <strong> - Telefono</strong> : </label>
                        </div>
                        <div class="col-md-3 text-center">
                          <label type="text" id="empresaTelefonoConsultarTicket"> 242424</label>
                        </div>
                      </div>

                      <hr>
                      <div class="row ">
                        <div class="col-md-12 ">
                          <label type="text"> <i class="fas fa-receipt"></i> <strong>Cuenta </strong></label>


                          <div>
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Unidad</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Importe</th>
                                  </tr>
                                </thead>
                                <tbody id="tbodyCuenta">


                                </tbody>
                                <tfoot>
                                  <td colspan="3" class="table-Info"><strong> Total </strong> <i class="fas fa-euro-sign"></i> </td>
                                  <td class="table-Info" id="precioTotal"> 55 €</tr>
                                  <td colspan="3"></td>
                                  <td>
                                    <p class="font-weight-light" style="font-size: small;">IVA INCLUIDO</p>
                                  </td>

                                </tfoot>
                              </table>
                            </div>

                          </div>

                        </div>
                      </div>

                    </div>


                  </form>


                </div>




              </form>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="consultarTicket">Consultar</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
          </div>

        </div>
      </div>

      <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
      <!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
      <!--<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>-->



      <script>
        feather.replace()
      </script>
      <?php
      require('footer.php');

      ?>
      <script src="js/dashboard.js"></script>

  </body>

  </html>
<?php } else {
  header("Location: ./index.php");
}
?>