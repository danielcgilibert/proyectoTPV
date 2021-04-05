<?php 
    require('head.php');
?>

<div class="sidenav">
         <div class="login-main-text">
            <h2>TPV<br> Login Page</h2>
            <p>Login or register from here to access.</p>
         </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12 animate__animated animate__fadeIn">
            <div class="login-form">
               <form>
                  <div class="form-group">
                     <label>Usuario</label>
                     <input type="text" class="form-control" placeholder="escriba aqui su usuario...">
                  </div>
                  <div class="form-group">
                     <label>Contraseña</label>
                     <input type="password" class="form-control" placeholder="escriba aqui su contraseña">
                  </div>
                  <button type="submit" class="btn btn-blue">Login</button>
                  <button type="submit" class="btn btn-secondary">Register</button>
               </form>
            </div>
         </div>
      </div>

<?php 
    require('footer.php');
?>