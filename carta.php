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
                            <?php  echo '<img class="card-img-top" src="http://placehold.it/500x325" alt="">';  ?>
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