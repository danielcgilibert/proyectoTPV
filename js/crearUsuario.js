$(document).ready(function () {
  $("#formCrearUsuario").submit(function (e) {

    let validado = true;

    let nombre = $("#nombreRegistro").val().trim();
    let apellidos = $("#apellidosRegistro").val().trim();
    let email = $("#emailRegistro").val().trim();
    let password1 = $("#passwordRegistro").val().trim();
    let password2 = $("#passwordRegistro2").val().trim();
    let tipo = $("#tipoRegistro").val().trim();

    let error = "";

    if (nombre.length < 3) {
      error +=
        '<i class="fas fa-times"></i>' +
        " El nombre debe ser mayor a tres caracteres <br/>";
      $("#nombreRegistro").addClass("errorCreacion");
      $("#nombreRegistro").focus();
      validado = false;
    } else {
      $("#nombreRegistro").removeClass("errorCreacion");
    }

    if (apellidos.length < 3) {
      error +=
        '<i class="fas fa-times"></i>' +
        " Los apellidos debe ser mayor a tres caracteres <br/>";
      $("#apellidosRegistro").addClass("errorCreacion");
      $("#apellidosRegistro").focus();
      validado = false;
    } else {
      $("#apellidosRegistro").removeClass("errorCreacion");
    }

    if (email.length < 3) {
      error += '<i class="fas fa-times"></i>  El correo es invalido <br/>';
      $("#emailRegistro").addClass("errorCreacion");
      $("#emailRegistro").focus();
      validado = false;
    } else {
      $("#emailRegistro").removeClass("errorCreacion");
    }

    var regexPassword = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/;

    if (
      password2.length < 3 ||
      password2.localeCompare(password1) != 0 ||
      !regexPassword.test(password2)
    ) {
      error += `<i class="fas fa-times"></i> Las contraseñas deben ser iguales <br/>`;
      $("#passwordRegistro2").addClass("errorCreacion");
      $("#passwordRegistro2").focus();
      validado = false;
    } else {
      $("#passwordRegistro2").removeClass("errorCreacion");
    }

    if (password1.length < 3 || !regexPassword.test(password1)) {
      error += `<i class="fas fa-times"></i> Contraseña invalida :
        <a class="pointer" style="border-bottom: 1px solid blue;" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Información </a>
   
    <div class="collapse" id="collapseExample">
      <div class="card card-body">
      <ul class='text-left'>
      <li>Mínimo ocho caracteres</li>
      <li>Debe contener al menos una mayúscula</li>
      <li>Debe contener al menos una minúscula</li>
      <li>Debe contener al menos un dígito</li>
  </ul>      
  </div>
  <br/>
      
        `;
      $("#passwordRegistro").addClass("errorCreacion");
      $("#passwordRegistro").focus();
      validado = false;
    } else {
      $("#passwordRegistro").removeClass("errorCreacion");
    }

    if (!validado) {
      Swal.fire({
        icon: "info",
        title: "Fallos en la validación",
        html: `<div class='m-3'> ${error} </div>`,
        footer: "<a href>¿Necesitas ayuda?</a>",
      });
      e.preventDefault();
    } else {
        e.preventDefault();

      $.ajax({
        type: "POST",
        url: "./db/crearUsuario.php",
        data: {
          nombre,
          apellidos,
          email,
          password1,
          tipo
        },
        success: function (data) {
            let timerInterval
            console.log(data);
            if(data!='1'){
                Swal.fire({
                    title: '<strong> Usuario Creado </strong>',
                    html: 'Redirigiendo al login en   <b></b> milliseconds.',
                    timer: 2000,
                    icon: 'success',
                    timerProgressBar: true,
                    didOpen: () => {
                      Swal.showLoading()
                      timerInterval = setInterval(() => {
                        const content = Swal.getHtmlContainer()
                        if (content) {
                          const b = content.querySelector('b')
                          if (b) {
                            b.textContent = Swal.getTimerLeft()
                          }
                        }
                      }, 100)
                    },
                    willClose: () => {
                      clearInterval(timerInterval)
                    }
                  }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                      window.location.href ="./login.php";
                  }
                  })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'El usuario ya esta registrado',
                  })
            }
          


        },
      });
    }
  });
});
