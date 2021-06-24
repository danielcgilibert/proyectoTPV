$(document).ready(function () {
  let padre = "";

  $(".menuLink").on("click", function ({ target }) {
    if (!$(target).hasClass("active")) {
      $("#main").children().hide();
      $(".nav-link").removeClass("active");

      const clase = target.id.split("-"); // busca el id de los div para mostrar

      $("#" + target.id).addClass("active");
      $("#" + clase[0]).show();
    }
  });

  $(".mesa").on("click", function ({ target }) {
    padre = $(target).closest(".mesa");
    let mesaid = padre.attr("mesaid"); //! Posible fallo consultar por id de mesa
    let ticketid = padre.attr("ticketid");
    let mesaEstado = padre.attr("mesaEstado");
    console.log(ticketid);
    console.log(padre);

    if (mesaEstado == 1 && ticketid.length > 0) {
      $.ajax({
        type: "POST",
        url: "./db/consultarTicket.php",
        data: {
          id: ticketid.trim(),
        },
        success: function (data) {
          $("#tbodyMesasCuenta").empty();

          let datos = JSON.parse(data);

          console.log(datos);

          if (datos.length == 0) {
            $.ajax({
              type: "POST",
              url: "./db/consultarTicketVacio.php",
              data: {
                id: ticketid.trim(),
              },
              success: function (results) {
                let datosTickeVacio = JSON.parse(results);
                let total = 0;

                $("#mesasTicketId").text(ticketid.trim());
                $("#mesasAtendido").text(
                  datosTickeVacio[0]["nombreUsuario"] +
                    " " +
                    datosTickeVacio[0]["apellidosUsuario"]
                );
                $("#mesasId").text(datosTickeVacio[0]["idMesa"]);
                $("#mesasFecha").text(datosTickeVacio[0]["fecha"]);
                $("#mesasCIF").text(datosTickeVacio[0]["CIF"]);
                $("#mesasNombreEmpresa").text(
                  datosTickeVacio[0]["nombreEmpresa"]
                );
                $("#mesasTelefono").text(datosTickeVacio[0]["telefono"]);

                $("#mesasInputId").val(datosTickeVacio[0]["idMesa"]);
                $("#mesasInputTicketId").val(ticketid.trim());

                $("#precioMesasTotal").text(0 + " € ");
                $("#modalMesa").modal();
              },
            });
          } else {
            let total = 0;
            $("#mesasTicketId").text(ticketid.trim());
            $("#mesasAtendido").text(
              datos[0]["nombreUsuario"] + " " + datos[0]["apellidosUsuario"]
            );
            $("#mesasId").text(datos[0]["idMesa"]);
            $("#mesasFecha").text(datos[0]["fecha"]);
            $("#mesasCIF").text(datos[0]["CIF"]);
            $("#mesasNombreEmpresa").text(datos[0]["nombreEmpresa"]);
            $("#mesasTelefono").text(datos[0]["telefono"]);

            $("#mesasInputId").val(datos[0]["idMesa"]);
            $("#mesasInputTicketId").val(ticketid.trim());

            datos.forEach((lineaTicket) => {
              console.log(lineaTicket);
              $("#tbodyMesasCuenta").append(
                `
                <tr>
                <th scope="row">${lineaTicket.unidadesPedidas}</th>
                <td>${lineaTicket.descripcion}</td>
                <td>${lineaTicket.precio} €</td>
                <td>${
                  parseInt(lineaTicket.precio) *
                  parseInt(lineaTicket.unidadesPedidas)
                } €</td>
              </tr>`
              );
              total =
                total +
                parseFloat(lineaTicket.precio) *
                  parseFloat(lineaTicket.unidadesPedidas);
            });

            $("#precioMesasTotal").text(total + " € ");
            $("#modalMesa").modal();
          }
        },
      });
    }
  });

  $(".editarProducto").on("click", function ({ target }) {
    padre = $(target).closest(".producto");

    let IdProducto = padre.attr("idproducto");
    let nombreProducto = padre.find(".nombreProducto").text();
    let descripcionProducto = padre.find(".descripcionProducto").text();
    let precioProducto = padre.find(".precioProducto").text();

    const inputIdProducto = $("#modalProducto #inputIdProducto");
    const inputNombreProducto = $("#modalProducto #inputNombreProducto");
    const inputDescripcionProducto = $(
      "#modalProducto #inputDescripcionProducto"
    );
    const inputPrecioProducto = $("#modalProducto #inputPrecioProducto");

    inputIdProducto[0].value = IdProducto;
    inputNombreProducto[0].value = nombreProducto;
    inputDescripcionProducto[0].value = descripcionProducto;
    inputPrecioProducto[0].value = parseInt(precioProducto);
    var input = document.getElementById("inputImagenProducto");
    var file = "";

    $("#modalProducto").modal();

    $("#updateProducto").on("click", (e) => {
      e.stopImmediatePropagation();

      if (
        inputNombreProducto[0].value.trim().length > 3 &&
        inputDescripcionProducto[0].value.trim().length > 3 &&
        inputPrecioProducto[0].value.trim().length > 0
      ) {
        var formData = new FormData();

        formData.append("id", inputIdProducto[0].value.trim());
        formData.append("nombre", inputNombreProducto[0].value.trim());
        formData.append(
          "descripcion",
          inputDescripcionProducto[0].value.trim()
        );
        formData.append("precio", inputPrecioProducto[0].value.trim());
        formData.append("categoria", categoria);

        file = input.files[0];

        if (file != undefined) {
          if (!!file.type.match(/image.*/)) {
            console.log("entra");
            formData.append("image", file);
            $.ajax({
              type: "POST",
              url: "./db/editarProductos.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function () {
                padre
                  .find(".nombreProducto")
                  .text(inputNombreProducto[0].value.trim());
                padre
                  .find(".descripcionProducto")
                  .text(inputDescripcionProducto[0].value.trim());
                padre
                  .find(".precioProducto")
                  .text(inputPrecioProducto[0].value.trim() + " €");

                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Producto Actualizado",
                  showConfirmButton: false,
                  timer: 1200,
                });
              },
            });
            $("#modalProducto").modal("hide");
          } else {
            Swal.fire({
              title: "Error en la extensión",
              icon: "info",
              html: `<p>
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Extensiones disponibles</a>
              </p>
  
                          <div class="row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
  
                    <strong>Extensiones permitidas : </strong>
                    <br/>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">JPG</li>
                    <li class="list-group-item">PNG</li>
                    <li class="list-group-item">RAW</li>
                    <li class="list-group-item">BMP</li>
                  </ul>
                    </div>
                  </div>
                </div>
                          `,
              showCloseButton: true,
              showCancelButton: false,
              focusConfirm: false,
              confirmButtonText: '<i class="fa fa-thumbs-up"></i> Vale!',
              confirmButtonAriaLabel: "Ok!",
            });
          }
        } else {
          $.ajax({
            type: "POST",
            url: "./db/editarProductos.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
              padre
                .find(".nombreProducto")
                .text(inputNombreProducto[0].value.trim());
              padre
                .find(".descripcionProducto")
                .text(inputDescripcionProducto[0].value.trim());
              padre
                .find(".precioProducto")
                .text(inputPrecioProducto[0].value.trim() + " €");

              Swal.fire({
                position: "center",
                icon: "success",
                title: "Producto Actualizado",
                showConfirmButton: false,
                timer: 1200,
              });
            },
          });
          $("#modalProducto").modal("hide");
        }
      } else {
        Swal.fire({
          icon: "info",
          title: "Fallos en la validación",
          html: `<div class='m-3'> Todos los campos deben estar rellenos y con 3 caracteres como mínimo </div>`,
          footer: "<a href>¿Necesitas ayuda?</a>",
        });
      }
    });
  });

  $(".borrarProducto").on("click", function ({ target }) {
    padre = $(target).closest(".producto");

    let IdProducto = padre.attr("idproducto");
    console.log(IdProducto);

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: "¿Estás seguro de que quieres borrar el producto?",
        text: "¡No vas a poder deshacerlos cambios!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "¡Sí, borralo!",
        cancelButtonText: "¡No, cancalar!",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "./db/borrarProducto.php",
            data: {
              id: IdProducto,
            },
            success: function () {
              $(target).closest(".producto").remove();

              swalWithBootstrapButtons.fire(
                "Borrado!",
                "Tu producto a sido elimando correctamente!.",
                "success"
              );
            },
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire("Cancelado", "", "error");
        }
      });
  });

  var categoria = "";
  $(".anadirProducto").on("click", function ({ target }) {
    padre = $(target).closest(".anadirProducto");
    categoria = padre.attr("idCategoria");

    $("#modalAnadirProducto").modal();
    $("#formAnadirProducto")[0].reset();
    var input = document.getElementById("inputAnadirImagenProducto");
    var file = "";

    $("#anadirProducto").on("click", function (e) {
      e.stopImmediatePropagation();
      const inputNombreProducto = $(
        "#modalAnadirProducto #inputAnadirNombreProducto"
      );
      const inputDescripcionProducto = $(
        "#modalAnadirProducto #inputAnadirDescripcionProducto"
      );
      const inputPrecioProducto = $(
        "#modalAnadirProducto #inputAnadirPrecioProducto"
      );

      if (
        inputNombreProducto[0].value.trim().length > 3 &&
        inputDescripcionProducto[0].value.trim().length > 3 &&
        inputPrecioProducto[0].value.trim().length > 0
      ) {
        var formData = new FormData();
        formData.append("nombre", inputNombreProducto[0].value.trim());
        formData.append(
          "descripcion",
          inputDescripcionProducto[0].value.trim()
        );
        formData.append("precio", inputPrecioProducto[0].value.trim());
        formData.append("categoria", categoria);
        file = input.files[0];

        if (file != undefined) {
          if (!!file.type.match(/image.*/)) {
            formData.append("image", file);
            $.ajax({
              type: "POST",
              url: "./db/anadirProductos.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function () {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Producto Añadido",
                  showConfirmButton: false,
                  timer: 1200,
                });
              },
            });
            $("#modalAnadirProducto").modal("hide");
          } else {
            Swal.fire({
              title: "Error en la extensión",
              icon: "info",
              html: `<p>
              <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Extensiones disponibles</a>
            </p>

                        <div class="row">
              <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                  <div class="card card-body">

                  <strong>Extensiones permitidas : </strong>
                  <br/>
                  <ul class="list-group list-group-flush">
                  <li class="list-group-item">JPG</li>
                  <li class="list-group-item">PNG</li>
                  <li class="list-group-item">RAW</li>
                  <li class="list-group-item">BMP</li>
                </ul>
                  </div>
                </div>
              </div>
                        `,
              showCloseButton: true,
              showCancelButton: false,
              focusConfirm: false,
              confirmButtonText: '<i class="fa fa-thumbs-up"></i> Vale!',
              confirmButtonAriaLabel: "Ok!",
            });
          }
        } else {
          $.ajax({
            type: "POST",
            url: "./db/anadirProductos.php",
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Producto Añadido",
                showConfirmButton: false,
                timer: 1200,
              });
            },
          });

          $("#modalAnadirProducto").modal("hide");
        }
      } else {
        Swal.fire({
          icon: "info",
          title: "Fallos en la validación",
          html: `<div class='m-3'> Todos los campos deben estar rellenos y con 3 caracteres como mínimo </div>`,
          footer: "<a href>¿Necesitas ayuda?</a>",
        });
      }
    });
  });

  $("#botonCrearCategoria").on("click", function ({ target }) {
    $("#modalCrearCategoria").modal();

    $("#crearCategoria").on("click", function (e) {
      e.stopImmediatePropagation();

      const inputNombreCategoria = $(
        "#modalCrearCategoria #inputNombreCategoria"
      );

      var input = document.getElementById("inputImagenCategoria");
      var file = input.files[0];
      if (inputNombreCategoria[0].value.trim().length > 3) {
        if (file != undefined) {
          var formData = new FormData();
          if (!!file.type.match(/image.*/)) {
            formData.append("image", file);
            formData.append("nombre", inputNombreCategoria[0].value.trim());

            $.ajax({
              type: "POST",
              url: "./db/crearCategoria.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function () {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Categoria Creada",
                  showConfirmButton: false,
                  timer: 1200,
                });
              },
            });

            $("#formCrearCategoria")[0].reset();
            $("#modalCrearCategoria").modal("hide");
          } else {
            Swal.fire({
              title: "Error en la extensión",
              icon: "info",
              html: `<p>
              <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Extensiones disponibles</a>
            </p>

                        <div class="row">
              <div class="col">
                <div class="collapse multi-collapse" id="multiCollapseExample1">
                  <div class="card card-body">

                  <strong>Extensiones permitidas : </strong>
                  <br/>
                  <ul class="list-group list-group-flush">
                  <li class="list-group-item">JPG</li>
                  <li class="list-group-item">PNG</li>
                  <li class="list-group-item">RAW</li>
                  <li class="list-group-item">BMP</li>
                </ul>
                  </div>
                </div>
              </div>
                        `,
              showCloseButton: true,
              showCancelButton: false,
              focusConfirm: false,
              confirmButtonText: '<i class="fa fa-thumbs-up"></i> Vale!',
              confirmButtonAriaLabel: "Ok!",
            });
          }
        } else {
          Swal.fire({
            position: "center",
            icon: "info",
            title: "Por favor introduce una imagen",
            showConfirmButton: false,
            timer: 1200,
          });
        }
      } else {
        Swal.fire({
          position: "center",
          icon: "info",
          title: "La categoria tiene que tener minimo 3 caracteres",
          showConfirmButton: false,
          timer: 1200,
        });
      }
    });
  });

  $(".borrarCategoria").on("click", function ({ target }) {
    padre = $(target).closest(".card");
    IdCategoria = padre.attr("idcategoria");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: "¿Estás seguro de que quieres borrar esta categoría?",
        text: "¡No vas a poder deshacer los cambios! todos los productos relacionados a esta categoría se borraran también",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "¡Sí, borralo!",
        cancelButtonText: "¡No, cancalar!",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "./db/borrarCategoria.php",
            data: {
              id: IdCategoria,
            },
            success: function () {
              $(target).closest(".categoria").remove();

              swalWithBootstrapButtons.fire(
                "Borrado!",
                "Tu Categoría a sido elimando correctamente!.",
                "success"
              );
            },
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire("Cancelado", "", "error");
        }
      });
  });

  var IdCategoria = "";
  $(".editarCategoria").on("click", function ({ target }) {
    padre = $(target).closest(".card");

    IdCategoria = padre.attr("idcategoria");
    let nombreCategoria = padre.find(".card-title").text();
    inputEditarNombreCategoria.value = nombreCategoria;

    var input = document.getElementById("inputEditarImagenCategoria");
    var file = "";
    $("#modalEditarCategoria").modal();

    $("#editarCategoria").on("click", (e) => {
      e.stopImmediatePropagation();
      file = input.files[0];

      if (inputEditarNombreCategoria.value.trim().length > 3) {
        if (file != undefined) {
          var formData = new FormData();
          if (!!file.type.match(/image.*/)) {
            formData.append("image", file);
            formData.append("nombre", inputEditarNombreCategoria.value.trim());
            formData.append("id", IdCategoria);

            $.ajax({
              type: "POST",
              url: "./db/editarCategoria.php",
              data: formData,
              processData: false,
              contentType: false,
              success: function () {
                padre
                  .find(".card-title")
                  .text(inputEditarNombreCategoria.value.trim());

                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Categoría Actualizada",
                  showConfirmButton: false,
                  timer: 1200,
                });
              },
            });
            $("#modalEditarCategoria").modal("hide");
          } else {
            Swal.fire({
              title: "Error en la extensión",
              icon: "info",
              html: `<p>
                <a class="btn btn-primary" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Extensiones disponibles</a>
              </p>
  
                          <div class="row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
  
                    <strong>Extensiones permitidas : </strong>
                    <br/>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">JPG</li>
                    <li class="list-group-item">PNG</li>
                    <li class="list-group-item">RAW</li>
                    <li class="list-group-item">BMP</li>
                  </ul>
                    </div>
                  </div>
                </div>
                          `,
              showCloseButton: true,
              showCancelButton: false,
              focusConfirm: false,
              confirmButtonText: '<i class="fa fa-thumbs-up"></i> Vale!',
              confirmButtonAriaLabel: "Ok!",
            });
          }
        } else {
          Swal.fire({
            position: "center",
            icon: "info",
            title: "Por favor introduce una imagen",
            showConfirmButton: false,
            timer: 1200,
          });
        }
      } else {
        Swal.fire({
          position: "center",
          icon: "info",
          title: "La categoria tiene que tener minimo 3 caracteres",
          showConfirmButton: false,
          timer: 1200,
        });
      }
    });
  });

  let IdUsuario = "";
  $(".botonEditarUsuario").on("click", function ({ target }) {
    $("#formEditarUsuario")[0].reset();

    $("#modalEditarUsuario").modal();
    padre = $(target).closest(".card");

    IdUsuario = padre.attr("idUsuario");
    let NombreUsuario = padre.find(".nombreUsuario").text().trim();
    let ApellidosUsuario = padre.find(".apellidosUsuario").text().trim();
    let emailUsuario = padre.find(".emailUsuario").text().trim();
    let perfilUsuario = padre.attr("perfilUsuario");

    inputEditNombreUsuario.value = NombreUsuario;
    inputApellidosUsuario.value = ApellidosUsuario;
    inputEmailUsuario.value = emailUsuario;
    inputPasswordUsuario.value = "";

    if (perfilUsuario == "1") {
      $("#camarero").attr("selected", true);
    } else if (perfilUsuario == "2") {
      $("#cocinero").attr("selected", true);
    } else {
      $("#gerente").attr("selected", true);
    }

    $("#editarUsuario").on("click", (e) => {
      e.stopImmediatePropagation();
      Swal.fire({
        title: "¿Quieres cambiar la contraseña?",
        text: "Si pulsa el botón cancelar se guardaran todos los datos menos la contraseña",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "./db/editarUsuario.php",
            data: {
              id: IdUsuario,
              NombreUsuario: inputEditNombreUsuario.value.trim(),
              ApellidosUsuario: inputApellidosUsuario.value.trim(),
              emailUsuario: inputEmailUsuario.value.trim(),
              perfilUsuario: inputEditTipoUsuario.value.trim(),
              contrasenaUsuario: inputPasswordUsuario.value.trim(),
            },
            success: function (data) {
              if (data == 0) {
                padre
                  .find(".card-title")
                  .text(inputEditNombreUsuario.value.trim());
                padre.attr("perfilUsuario", inputEditTipoUsuario.value.trim());

                $("#camarero").removeAttr("selected");
                $("#cocinero").removeAttr("selected");
                $("#gerente").removeAttr("selected");

                if (padre.attr("perfilUsuario") == "1") {
                  padre.find(".tipoPerfil").text("Camarero");
                  $("#camarero").attr("selected", true);
                } else if (padre.attr("perfilUsuario") == "2") {
                  padre.find(".tipoPerfil").text("Cocinero");
                  $("#cocinero").attr("selected", true);
                } else {
                  padre.find(".tipoPerfil").text("Gerente");
                  $("#gerente").attr("selected", true);
                }

                padre
                  .find(".emailUsuario")
                  .text(inputEmailUsuario.value.trim());
                padre
                  .find(".nombreUsuario")
                  .text(inputEditNombreUsuario.value.trim());
                padre
                  .find(".apellidosUsuario")
                  .text(inputApellidosUsuario.value.trim());

                console.log(inputEditTipoUsuario.value.trim());
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Usuario Actualizado",
                  showConfirmButton: false,
                  timer: 1200,
                });

                $("#modalEditarUsuario").modal("hide");
              } else {
                let fallo = "";
                data == 1 ? (fallo = "Contraseña minimo con 8 caracteres") : "";
                if (data == 2) {
                  fallo = `
                  <i class="fas fa-times"></i> Contraseña invalida :
                  <ul class='list-group'>
                  <li class="list-group-item">Mínimo ocho caracteres</li>
                  <li class="list-group-item">Debe contener al menos una mayúscula</li>
                  <li class="list-group-item">Debe contener al menos una minúscula</li>
                  <li class="list-group-item">Debe contener al menos un dígito</li>
              </ul>  
                  `;
                }
                data == 3
                  ? (fallo = "fallo en el update de la base de datos")
                  : "";
                data == 4 ? (fallo = "email ya existe") : "";

                Swal.fire({
                  icon: "error",
                  html: `${fallo}`,
                  footer: "<a href>¿Necesitas ayuda?</a>",
                });
              }
            },
          });
        } else {
          $.ajax({
            type: "POST",
            url: "./db/editarUsuario.php",
            data: {
              id: IdUsuario,
              NombreUsuario: inputEditNombreUsuario.value.trim(),
              ApellidosUsuario: inputApellidosUsuario.value.trim(),
              emailUsuario: inputEmailUsuario.value.trim(),
              perfilUsuario: inputEditTipoUsuario.value.trim(),
            },
            success: function (data) {
              if (data == 0) {
                padre
                  .find(".card-title")
                  .text(inputEditNombreUsuario.value.trim());
                padre.attr("perfilUsuario", inputEditTipoUsuario.value.trim());

                $("#camarero").removeAttr("selected");
                $("#cocinero").removeAttr("selected");
                $("#gerente").removeAttr("selected");

                if (padre.attr("perfilUsuario") == "1") {
                  padre.find(".tipoPerfil").text("Camarero");
                  $("#camarero").attr("selected", true);
                } else if (padre.attr("perfilUsuario") == "2") {
                  padre.find(".tipoPerfil").text("Cocinero");
                  $("#cocinero").attr("selected", true);
                } else {
                  padre.find(".tipoPerfil").text("Gerente");
                  $("#gerente").attr("selected", true);
                }

                padre
                  .find(".emailUsuario")
                  .text(inputEmailUsuario.value.trim());
                padre
                  .find(".nombreUsuario")
                  .text(inputEditNombreUsuario.value.trim());
                padre
                  .find(".apellidosUsuario")
                  .text(inputApellidosUsuario.value.trim());

                console.log(inputEditTipoUsuario.value.trim());
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Usuario Actualizado",
                  showConfirmButton: false,
                  timer: 1200,
                });
                $("#modalEditarUsuario").modal("hide");
              }
            },
          });
        }
      });
    });
  });

  $(".botonBorrarUsuario").on("click", function ({ target }) {
    padre = $(target).closest(".card");
    IdUsuario = padre.attr("idUsuario");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: "¿Estás seguro de que quieres borrar el usuario?",
        text: "¡No vas a poder deshacer los cambios!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "¡Sí, borralo!",
        cancelButtonText: "¡No, cancalar!",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "./db/borrarUsuario.php",
            data: {
              id: IdUsuario,
            },
            success: function () {
              $(target).closest(".card").remove();

              swalWithBootstrapButtons.fire(
                "Borrado!",
                "El usuario a sido elimando correctamente!.",
                "success"
              );
            },
          });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire("Cancelado", "", "error");
        }
      });
  });

  $(".listarTicket").on("click", function ({ target }) {
    $("#modalConsultarTicket").modal();
    $("#mostrarTicket").hide();
    $(".botonImprimir").remove();

    $("#consultarTicket").on("click", (e) => {
      e.stopImmediatePropagation();

      $.ajax({
        type: "POST",
        url: "./db/consultarTicket.php",
        data: {
          id: inputConsultarNumeroTicket.value.trim(),
        },
        success: function (data) {
          $("#mostrarTicket").hide();
          $("#tbodyCuenta").empty();
          $(".botonImprimir").remove();

          let datos = JSON.parse(data);

          console.log(datos);

          if (datos.length == 0) {
            Swal.fire({
              icon: "error",
              title: "Ticket no encontrado",
              footer: "<a href>¿Necesitas ayuda?</a>",
            });
          } else {
            let total = 0;
            $("#numeroTicket").text(inputConsultarNumeroTicket.value.trim());
            $("#atendidoPorConsultarTicket").text(
              datos[0]["nombreUsuario"] + " " + datos[0]["apellidosUsuario"]
            );
            $("#mesaConsultarTicket").text(datos[0]["idMesa"]);
            $("#fechaConsultarTicket").text(datos[0]["fecha"]);
            $("#empresaCIFConsultarTicket").text(datos[0]["CIF"]);
            $("#empresaNombreConsultarTicket").text(datos[0]["nombreEmpresa"]);
            $("#empresaTelefonoConsultarTicket").text(datos[0]["telefono"]);

            datos.forEach((lineaTicket) => {
              console.log(lineaTicket);
              $("#tbodyCuenta").append(
                `
                <tr>
                <th scope="row">${lineaTicket.unidadesPedidas}</th>
                <td>${lineaTicket.descripcion}</td>
                <td>${lineaTicket.precio} €</td>
                <td>${lineaTicket.precio} €</td>
              </tr>`
              );
              total =
                total +
                parseFloat(lineaTicket.precio) *
                  parseFloat(lineaTicket.unidadesPedidas);
            });

            $("#precioTotal").text(total + " € ");
            $(".footerConsultarTicket").prepend(`
            <form action="./generarPdf.php" method="post" target="_blank" class="botonImprimir">
            <button type="submit" class="btn btn-info mt-3" style="padding: 10px !important;" > <i class="far fa-file-pdf"></i> </button>
            <input type="hidden" name="idTicket" value=${inputConsultarNumeroTicket.value.trim()} />
            <input type="hidden" name="nombreUsuario" value= ${
              datos[0]["nombreUsuario"]
            } />
            <input type="hidden" name="apellidoUsuario" value="${
              datos[0]["apellidosUsuario"]
            }" />
            <input type="hidden" name="fecha" value="${datos[0]["fecha"]}" />

            <input type="hidden" name="idMesa" value=${datos[0]["idMesa"]} />
        </form>


            `);
            $("#mostrarTicket").show();
          }
        },
      });
      //$("#modalEditarUsuario").modal("hide");
    });
  });

  $("#guardarDatosEmpresa").on("click", function (e) {
    let nombreEmpresa = $("#inputNombreEmpresa").val().trim();
    let telefonoEmpresa = $("#inputTelefonoEmpresa").val().trim();
    let cifEmpresa = $("#inputCifEmpresa").val().trim();
    let idEmpresa = $("#formEditarEmpresa").attr("idEmpresa").trim();

    let error = "";
    let validado = true;
    var regexTelefono = /^(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}$/;
    var regexCif = /([a-z]|[A-Z]|[0-9])[0-9]{7}([a-z]|[A-Z]|[0-9])/g;

    if (nombreEmpresa.length < 3) {
      error +=
        '<i class="fas fa-times"></i>' +
        " El nombre de la empresa debe ser mayor a tres caracteres <br/>";
      $("#inputNombreEmpresa").addClass("errorCreacion");
      $("#inputNombreEmpresa").focus();
      validado = false;
    } else {
      $("#inputNombreEmpresa").removeClass("errorCreacion");
    }

    if (telefonoEmpresa.length < 3 || !regexTelefono.test(telefonoEmpresa)) {
      error += `<i class="fas fa-times"></i> Telefono invalido
     
  <br/>
      
        `;
      $("#inputTelefonoEmpresa").addClass("errorCreacion");
      $("#inputTelefonoEmpresa").focus();
      validado = false;
    } else {
      $("#inputTelefonoEmpresa").removeClass("errorCreacion");
    }

    if (!regexCif.test(cifEmpresa)) {
      error += `<i class="fas fa-times"></i> CIF invalido
     
      <br/>`;

      $("#inputCifEmpresa").addClass("errorCreacion");
      $("#inputCifEmpresa").focus();
      validado = false;
    } else {
      $("#inputCifEmpresa").removeClass("errorCreacion");
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
        url: "./db/editarEmpresa.php",
        data: {
          id: idEmpresa,
          nombreEmpresa,
          telefonoEmpresa,
          cifEmpresa,
        },
        success: function () {
          Swal.fire({
            position: "center",
            icon: "success",
            title: "Empresa Actualizada",
            showConfirmButton: false,
            timer: 1200,
          });
        },
      });
    }
  });

  let idLinea = 0;
  let card = "";
  $(".finalizarPedido").on("click", function ({ target }) {
    padre = $(target).closest(".pedidoFila");
    card = $(target).closest(".pedidoCocina");
    idLinea = $(target).attr("idLineaTicket");

    $.ajax({
      type: "POST",
      url: "./db/finalizarPedido.php",
      data: {
        idLinea: idLinea,
      },
      success: function (data) {
        if (data) {
          card.addClass("bg-success");
          card.removeClass("bg-light");

          padre.removeClass("pedidoFila");

          padre
            .find(".textoPedidoPendiente")
            .removeClass("textoPedidoPendiente");
          padre
            .find(".fechaPedidoPendiente")
            .removeClass("fechaPedidoPendiente");

          padre.find(".card-text").addClass("textoPedidoFinalizado");
          padre.find(".card-text").addClass("fechaPedidoFinalizado");

          $(target).remove();

          $(".pedidosFinalizados").prepend(padre);
        }
      },
    });
  });

  $(".listadoTickets").on("click", function ({ target }) {
    $(".tablaResultadoFechas").empty();

    $("#consultarTicketsFecha").on("click", function ({ target }) {
      let fechaInicio = $("#fechaInicioTicket").val().trim();
      let fechaFin = $("#fechaFinalTicket").val().trim();

      var date = new Date(fechaInicio);
      var usaDate = date.toLocaleDateString("zh-Hans-CN", {
        hourCycle: "h23",
        hour: "2-digit",
        minute: "2-digit",
      });

      var date2 = new Date(fechaFin);
      var usaDate2 = date2.toLocaleDateString("zh-Hans-CN", {
        hourCycle: "h23",
        hour: "2-digit",
        minute: "2-digit",
      });

      $.ajax({
        type: "POST",
        url: "./db/consultarTicketsFecha.php",
        dataType: "json",
        data: {
          fechaInicio: usaDate,
          fechaFin: usaDate2,
        },
        success: function (data) {
          $(".tablaResultadoFechas").empty();

          console.log(data);
          let datos;
          datos = '<div class="table-responsive"> ';
          datos += `<table class="table table-hover text-center">
          <thead>
            <tr>
              <th scope="col">Ticket</th>
              <th scope="col">Unidades</th>
              <th scope="col">Precio</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>
        `;

          let total = 0;

          for (let i in data) {
            total = 0;
            for (let j in data[i]) {
              total = total + parseInt(j) * parseInt(data[i][j]);
              datos += `<tr>
              <th scope="row">${i}</th>
              <td>${j}</td>
              <td>${data[i][j]} €</td>
              <td>${total} € </td>
              </tr>`;
            }
            datos += `<tr><td colspan="4" class="table-info"> <strong><i class="fas fa-calculator"></i> Total del Ticket ${i}  : <span class="badge badge-primary p-1" style="font-size:15px"> ${total} €</span>      </strong> </td></tr>`;
          }

          datos += `  </tbody>
          </table>
          `;
          datos += "</div>";
          if (Object.keys(data).length > 0) {
            datos +="<hr/>";

          } else {
            datos += "<h3 class='text-center'>Sin registros</h3>";
          }
          $(".tablaResultadoFechas").append(datos);
        },
      });
    });

    $("#modalListadoTickets").modal();
  });
});
