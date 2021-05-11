<?php
require('head.php');
require_once "./db/database.php";

$mesas = cargar_mesas();
$categorias = cargar_categorias();

foreach ($categorias as $categoria) {
  $productosCa[$categoria["nombre"]] = cargar_productos($categoria["idCategoria"]);
}
?>

<body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="./index.php">Aroma Tapas</a>

    <ul class="navbar-nav px-3">

      <li class="nav-item text-nowrap">
        <a class="nav-link" href="./index.php">
          <i class="fas fa-sign-out-alt"></i>
          Sign out</a>
      </li>
    </ul>

  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar pt-5" id="mySidebar">
        <div class="sidebar-sticky">

          <ul class="nav flex-column menuLateral">
            <li class="nav-item">
              <a class="nav-link active" href="#" id="dashboard-Link">
                <i class="fas fa-home"></i>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="Empresa-Link">
                <i class="fas fa-briefcase"></i>
                Empresa
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="Categorias-Link">
                <i class="fas fa-list-alt"></i>
                Categorías
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="Productos-Link">
                <i class="fas fa-utensils"></i>
                Productos
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="#" id="Pedidos-Link">
                <i class="fas fa-list"></i>
                Pedidos Cocina
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link " href="#" id="Usuarios-Link">
                <i class="fas fa-users"></i>
                Usuarios
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link " href="#" id="Ticket-Link">
                <i class="fas fa-ticket-alt"></i>
                Ticket
              </a>
            </li>

            <li class="nav-item">
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
          <h1>Categorias</h1>

          <div class="row p-5">
            <div class="col-md-4 mb-3 text-center ">
              <div class="card">
                <div class="card-body">
                  <h5>Crear categoria</h5>
                  <button type="button" class="btn btn-outline-primary"><i class="fas fa-plus-square"></i></button>
                </div>
              </div>


            </div>

            <div class="col-md-8 mb-3 text-center">
              <div class="card">
                <div class="card-body">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <p><strong>Ultima categoria actualizada</strong> : Arroces</p>
                    </li>
                    <li class="list-group-item">
                      <p><strong>Cantidad de categorias </strong> : <span class="badge badge-info p-2">9</span></p>
                    </li>
                  </ul>

                </div>
              </div>

            </div>
          </div>

          <hr>
          <div class="row text-center p-5">

            <?php foreach ($categorias as $categoria) { ?>

              <div class="col-md-3 mb-3 text-center ">

                <div class="card" style="width: 18rem;" idCategoria=<?= $categoria["idCategoria"] ?>>
                  <img class="card-img-top" src="https://freepikpsd.com/wp-content/uploads/2019/10/food-salad-image-2962-food-png-picture-of-food-png-428_230.png" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title"><?= $categoria["nombre"] ?></h5>
                    <hr>
                  </div>

                  <div class="card-body">
                    <div class="row">

                      <div class="col-sm-6">
                        <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i> Editar</button>

                      </div>
                      <div class="col-sm-6">
                        <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Borrar</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>





        </div>

        <div id="Productos">
          <h1 class="mb-5 text-center">Productos</h1>
          <?php foreach ($productosCa as $categoria => $productos) { ?>


            <?php if (count($productos)) {
              echo '<h2>'  . $categoria  . '</h2>';
              echo '<hr/>';
            } ?>

            <div class="row text-center">

              <?php
              foreach ($productos as $producto) { ?>

                <div class="col-md-3 mb-2 text-center p-3 producto" idProducto=<?= $producto["idProducto"] ?>>

                  <div class="card" style="width: 18rem;" idCategoria=<?= $producto["idCategoria"] ?>>
                    <img class="card-img-top" src="https://freepikpsd.com/wp-content/uploads/2019/10/food-salad-image-2962-food-png-picture-of-food-png-428_230.png" alt="Card image cap">
                    <div class="card-body">
                      <h5 class="card-title nombreProducto"><?= $producto["nombre"] ?></h5>
                      <hr>

                      <p class="descripcionProducto"> <?= $producto["descripcion"] ?> </p>
                      <p class="precioProducto"> <?= $producto["precio"] ?> € </p>

                    </div>

                    <div class="p-5">
                      <div class="row">

                        <div class="col-sm-6">
                          <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i> Editar</button>

                        </div>
                        <div class="col-sm-6">
                          <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Borrar</button>
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
                <button type="button" class="btn btn-success">Guardar</button>

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

          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script src="js/dashboard.js"></script>

    <script>
      feather.replace()
    </script>
    <?php
    require('footer.php');

    ?>

</body>

</html>