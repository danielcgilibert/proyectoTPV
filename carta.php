<?php require('head.php'); ?>


<?php
require_once "./db/database.php";
$categorias = cargar_categorias();


foreach ($categorias as $categoria) {
    $productosCa[$categoria["nombre"]] = cargar_productos($categoria["idCategoria"]);
}


?>


<body>

    <?php
    require('nav.php');
    ?>

    <div class="container carta">


        <?php foreach ($productosCa as $categoria => $productos) { ?>


            <?php if (count($productos)) {
                    echo '<h2>'  . $categoria  . '</h2>';
                    echo '<hr/>';
                } ?> 

            <div class="row text-center">

                <?php
                foreach ($productos as $producto) { ?>
                    
                    <div class="col-lg-3 col-md-6 mb-4 cardFood">
                        <div class="card h-100">
                      <img class="card-img-top" src=<?= !empty($producto["imagen"]) ? 'data:image/png;base64,' . $producto["imagen"] : "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1200px-No_image_3x4.svg.png" ?> alt="Card image cap">

                        <div class="card-body">
                                <h4 class="card-title"><?= $producto["nombre"]  ?></h4>
                                <p class="card-text"><?= $producto["descripcion"] ?></p>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>



        <?php } ?>









    </div>
    </div>







    <?php
    require('footer.php');
    ?>
</body>