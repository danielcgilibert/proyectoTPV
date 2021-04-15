<?php 
    require('head.php');
?>


<div class="login-form animate__animated animate__backInDown">
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
                <button type="button" class="btn btn-block create-account">Iniciar</button>
                <a class="btn btn-info btn-block create-account-atras" href="./register.php">Registrarse</a>

                <a class="btn btn-info btn-block create-account-atras" href="./index.php">Inicio</a>

            </div>

        </form>

    </div>

<?php 
    require('footer.php');
?>