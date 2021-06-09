<?php

session_start();
require('head.php');
require_once "./db/database.php";
if (isset($_SESSION['user'])) { ?>
    <?php

    $categorias = cargar_categorias();
    $numeroTicket = "";
    $nuevo = 0; //Si es un ticket nuevo o ya crado 0=nuevo 1=creado


    if (!isset($_REQUEST["mesasInputTicketId"])) {
        $nuevo = 0;
        $numeroTicket = ultimo_ticket()==null? 1 :ultimo_ticket() + 1;
        $fecha = getdate();

        $dia = $fecha["mday"];
        $mes = $fecha["mon"];
        $anno = $fecha["year"];
        $hora = $fecha["hours"];
        $minutos = $fecha["minutes"];
        $fecha = $dia . '/' . $mes . '/' . $anno . ' : ' . $hora . ':' . $minutos;
        $medaId = $_REQUEST["mesaId"];
    } else {
        $nuevo = 1;
        $numeroTicket = $_REQUEST["mesasInputTicketId"];
        $ticket = cargar_ticket($numeroTicket);
        $fecha = $ticket[0]["fecha"];
        $medaId = $_REQUEST["mesasInputId"];

        //!Añadir Datos de empresa

        $lineas = cargar_lineas_Ticket($numeroTicket);
        $total = 0;
    }

    ?>

    <body>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0 nombreEmpresa" style="color: white;">Aroma Tapas</a>
            <form class="m-4" action="./admin.php" >
                <button type="submit" class="btn"> <i class="fas fa-sign-out-alt"></i> Volver </button>
            </form>
        </nav>


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="formTicket p-4">

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>

                                    <tr>
                                        <th scope="row"> <label type="text"> <i class="fas fa-clipboard-list"></i> <strong> Número de ticket </strong> </label></th>
                                        <td class="text-center"> <label type="text"> <strong> <span nuevo=<?= $nuevo ?> class="badge badge-pill badge-info px-5 pt-2 text-center numeroTicket" style="border: 3px solid #1985BF;">
                                                        <h4><?= $numeroTicket ?> </h4>
                                                    </span> </strong></label></td>
                                    </tr>

                                    <tr>
                                        <th scope="row"> <label type="text"> <i class="fas fa-chalkboard-teacher"></i> <strong> Atendido por </strong> </label></th>
                                        <td class="text-center"> <label type="text" class="usuario" idUsuario=<?= $_SESSION['user']["id"] ?>> <?= $_SESSION['user']["nombre"]  ?> </label></td>

                                    </tr>


                                    <tr style="border:none !important">
                                        <th scope="row" style="border:none !important">
                                            <label type="text"> <i class="fas fa-chair"></i>
                                                <strong> En la mesa </strong> </label>

                                        </th>
                                        <td class="text-center" style="border:none !important">
                                            <label type="text"> <strong class="mesaId"><?= $medaId ?> </strong></label>

                                        </td>

                                    </tr>


                                    <tr style="border:none !important">
                                        <th scope="row" style="border:none !important">
                                            <label type="text"><i class="far fa-clock"></i>
                                                <strong> Fecha </strong> </label>

                                        </th>
                                        <td class="text-center" style="border:none !important">
                                            <label type="text" class="fecha"><?= $fecha;  ?> </label>
                                        </td>

                                    </tr>

                                    <tr>
                                        <th scope="row">
                                            <label type="text"><i class="fas fa-briefcase"></i>
                                                <strong> Empresa </strong> </label>

                                        </th>
                                        <td class="text-center">
                                            <strong class="cif">CIF 2452 </strong></label>

                                        </td>

                                    </tr>

                                    <tr style="border:none !important">
                                        <th scope="row" style="border:none !important">
                                            <label type="text" class="ml-4"> <strong> - Nombre </strong> : </label>

                                        </th>
                                        <td class="text-center" style="border:none !important">
                                            <label type="text"> Aroma tapas EP</label>

                                        </td>

                                    </tr>

                                    <tr style="border:none !important">
                                        <th scope="row" style="border:none !important">
                                            <label type="text" class="ml-4"> <strong> - Telefono</strong> : </label>

                                        </th>
                                        <td class="text-center" style="border:none !important">
                                            <label type="text" class="telefono"> 242424</label>

                                        </td>

                                    </tr>

                                    <tr>
                                        <th scope="row" colspan="2">
                                            <label type="text"> <i class="fas fa-receipt"></i> <strong>Cuenta </strong> </label>
                                        </th>
                                        
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <?php if (!isset($_REQUEST["mesasInputTicketId"])) { ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Unidad</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Importe</th>
                                            <th scope="col"></th>

                                        </tr>
                                    </thead>
                                    <tbody id="tbodyCuenta">
                                    </tbody>
                                    <tfoot>
                                        <td colspan="3" class="table-Info"><strong> Total </strong> <i class="fas fa-euro-sign"></i> </td>
                                        <td class="table-Info"> <strong id="precioTotal"> € </strong> </td>
                                        </tr>
                                        <td colspan="3"></td>
                                        <td>
                                            <p class="font-weight-light" style="font-size: small;">IVA INCLUIDO</p>

                                        </td>

                                    </tfoot>
                                </table>
                            </div>

                        <?php } else { ?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Unidad</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Importe</th>
                                            <th scope="col"></th>

                                        </tr>
                                        
                                    </thead>
                                    <tbody id="tbodyCuenta">
                                  
                                        <?php foreach ($lineas as $linea) { ?>
                                            <tr idProducto=<?= $linea["idProducto"] ?> idLinea=<?= $linea["idLinea"] ?>>
                                                <th scope="row" class="unidadesPedidas"><?= $linea["unidadesPedidas"] ?></th>
                                                <td><?= $linea["nombre"] ?></td>
                                                <td><?= $linea["precio"] ?> €</td>
                                                <td class="importe"><?= (floatval($linea["precio"] * floatval($linea["unidadesPedidas"])))  ?> €</td>
                                                <?php $total = $total + (floatval($linea["precio"] * floatval($linea["unidadesPedidas"])))  ?>
                                                <td>
                                                    <button type="button" class="btn btn-outline-success anadirTicket"><i class="far fa-plus-square"></i></button>
                                                    <button type="button" class="btn btn-outline-danger eliminarLinea"><i class="far fa-trash-alt"></i></button>
                                                    <button type="button" class="btn btn-outline-info editLinea"><i class="far fa-edit"></i></button>

                                                </td>
                                            </tr>
                                        <?php } ?>


                                    </tbody>
                                    <tfoot>
                                        <td colspan="3" class="table-Info"><strong> Total </strong> <i class="fas fa-euro-sign"></i> </td>
                                        <td class="table-Info" > <strong id="precioTotal"><?= $total ?> € </strong> </td>
                                        </tr>
                                        <td colspan="3"></td>
                                        <td>

                                            <p class="font-weight-light" style="font-size: small;">IVA INCLUIDO</p>
                                        </td>

                                    </tfoot>

                                </table>
                            </div>

                        <?php  } ?>
                        <div class="row mb-2">
                            <div class="col-md-12">

                            <button type="button" class="btn btn-info informacionPOP" style="float: right; width: 150px" data-container="body" data-toggle="popover" data-placement="left">
                            Información <i class="far fa-question-circle"></i></button>

                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-12">

                                <button type="button" style="float: right !important; width: 150px" class="btn btn-primary continuarBoton"> Continuar <i class="fas fa-forward ml-2"></i> </button>
                              
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                            <form action="./generarPdf.php" method="post" target="_blank" id="formCobrar">
                                <button type="submit" style="float: right !important; width: 150px" class="btn btn-success cobrarTicket"> Cobrar <i class="far fa-credit-card ml-2"></i> </button>
                                <input type="hidden" name="idTicket" value=<?= $numeroTicket ?> style="display: none;" />
                                <input type="hidden" name="nombreUsuario" value= <?= $_SESSION['user']["nombre"]  ?> style="display: none;" />
                                <input type="hidden" name="apellidoUsuario" value="<?= $_SESSION['user']["apellidos"] ?>" style="display: none;" />
                                <input type="hidden" name="fecha" value="<?= $fecha ?>" style="display: none;" />

                                <input type="hidden" name="idMesa" value=<?= $medaId ?> style="display: none;" />
                            </form>
                            </div>

                        </div>

                




                    </div>
                </div>




                <div class="col-md-6 p-4">
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header text-center" id="headingOne" style="background-color: white !important;">
                                <h5 class="mb-0">

                                    <button class="btn btn-outline-info btn-lg btn-block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Categorías
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row text-center">


                                        <?php foreach ($categorias as $categoria) { ?>

                                            <div class="col-lg-6 col-xl-3 mb-3 text-center categoria ">

                                                <div class="card" style="width: 12.5rem;" idCategoria=<?= $categoria["idCategoria"] ?>>
                                                    <img class="card-img-top" src=<?= !empty($categoria["imagen"]) ? 'data:image/png;base64,' . $categoria["imagen"] : "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1200px-No_image_3x4.svg.png" ?> alt="Card image cap">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?= $categoria["nombre"] ?></h5>
                                                        <hr>
                                                    </div>

                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col-sm-12">
                                                                <button type="button" class="btn btn-outline-info selecionarCategoria"><i class="far fa-hand-pointer"></i> Selecionar</button>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header text-center" id="headingTwo" style="background-color: white !important;">
                                <h5 class="mb-0">
                                    <button class="btn btn-outline-info btn-lg btn-block" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Productos
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body ">
                                    <div class="row productosCargados">

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingThree" style="background-color: white !important;">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <button class="btn btn-outline-info btn-lg btn-block" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Calculadora
                                        </button>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12 text-center p-5">
                                            <div class="input-group mb-3 text-center w-50 mx-auto">
                                                <div class="input-group">

                                                    <input type="text" class="form-control text-center inputCantidadProductos" aria-label="Amount (to the nearest dollar)" value="0" readonly>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">€</span>
                                                        <span class="input-group-text cantidadProducto">0.00</span>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-lg-12 col-xl-7 text-center m-auto p-5">
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=0>0</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=1>1</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=2>2</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=3>3</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=4>4</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=5>5</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=6>6</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=7>7</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=8>8</button>
                                                    <button type="button" class="btn btn-light p-4  mt-2 botonNumero" style="border: 1px solid black;" valor=9>9</button>

                                                </div>
                                            </div>

                                            <div class="row p-2">
                                                <div class="col-lg-12 text-center">
                                                    <button type="button" class="btn btn-secondary p-4 mt-2 resetCantidad">Clear</button>
                                                    <button type="button" class="btn btn-success p-4  mt-2 anadirCantidadTicket"><i class="fas fa-plus"></i> Añadir</button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

    </body>


    <?php require('footer.php'); ?>
    <script src="js/cuentas.js"></script>
<?php } else {
    header("Location: ./index.php");
}
?>