<?php
require('head.php');
?>

<body>



    <div class="registration-form animate__animated animate__backInDown">
        <form id="formCrearUsuario" action="db/crearUsuario.php" method="POST">
            <div class="form-icon">
                <span> <i class="fas fa-user icono"> </i> </span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="nombreRegistro" placeholder="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control item " id="apellidosRegistro" placeholder="apellidos" name="apellidos" required>
            </div>

            <div class="form-group">
                <input type="email" class="form-control item" id="emailRegistro" placeholder="Email" name="email" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-control item" id="passwordRegistro" placeholder="Contraseña" name="password1" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-control item" id="passwordRegistro2" placeholder="Repite la contraseña" name="password2" required>
            </div>


  

            <div class="form-group">
                <label for="tipoRegistro">Tipo</label>
                <select class="form-control" id="tipoRegistro" name="tipo" required>
                    <option value="1">Camarero</option>
                    <option value="2">Cocinero</option>
                    <option value="3">Gerente</option>
                </select>
            </div>




            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Crear cuenta</button>
                <a class="btn btn-info btn-block create-account-atras" href="./login.php">Login</a>

            </div>
        </form>

    </div>



    <?php
    require('footer.php');
    ?>
    <script src="js/crearUsuario.js"></script>

</body>