<?php
require('head.php');
?>

<body>



    <div class="registration-form animate__animated animate__backInDown">
        <form>
            <div class="form-icon">
                <span> <i class="fas fa-user icono"> </i> </span>
            </div>

            <div class="form-group">
                <input type="text" class="form-control item" id="email" placeholder="Email">
            </div>

            <div class="form-group">
                <input type="password" class="form-control item" id="password" placeholder="Password">
            </div>

            <div class="form-group">
                <input type="password" class="form-control item" id="password2" placeholder="Password">
            </div>

            <div class="form-group">
                <input type="text" class="form-control item" id="apellidos" placeholder="apellidos">
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Tipo</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>Camarero</option>
                    <option>Cocinero</option>
                    <option>Gerente</option>
                </select>
            </div>




            <div class="form-group">
                <button type="button" class="btn btn-block create-account">Crear cuenta</button>
                <a class="btn btn-info btn-block create-account-atras" href="./login.php">Login</a>

            </div>
        </form>

    </div>



    <?php
    require('footer.php');
    ?>

</body>