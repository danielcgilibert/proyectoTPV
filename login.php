<?php
require('head.php');

session_start();
?>



<div class="login-form animate__animated animate__backInDown">
    <form action="./db/loginUsuario.php" method="POST">
        <div class="form-icon">
            <span> <i class="fas fa-user icono"> </i> </span>
        </div>


        <div class="form-group">
            <input type="email" class="form-control item" id="emailLogin" placeholder="Email" name="email" required>
        </div>

        <div class="form-group">
            <input type="password" class="form-control item" id="passwordLogin" placeholder="Password" name="password" required>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-block create-account" id="iniciarLogin">Iniciar</button>
            <a class="btn btn-info btn-block create-account-atras" href="./register.php">Registrarse</a>

            <a class="btn btn-info btn-block create-account-atras" href="./index.php">Inicio</a>
            <?php if (isset($_SESSION['errorLogin'])) { ?>
                <div class="alert alert-danger mt-2 text-center" style="border-radius: 25px;" role="alert">
                    Correo o contraseña incorrectos
                </div>
            <?php }
            ?>
        </div>

    </form>

</div>


<?php
require('footer.php');
?>

<script src="js/loginUsuario.js"></script>