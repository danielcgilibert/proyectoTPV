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

    if (mesaEstado == 1 && ticketid.length > 0 ) {
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
            Swal.fire({
              icon: "error",
              title: "Ticket no encontrado",
              footer: "<a href>¿Necesitas ayuda?</a>",
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
                <td>${lineaTicket.precio} €</td>
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
        inputPrecioProducto[0].value.trim().length > 1
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
        inputPrecioProducto[0].value.trim().length > 1
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

    if (perfilUsuario == "1") {
      $("#camarero").attr("selected", true);
    } else if (perfilUsuario == "2") {
      $("#cocinero").attr("selected", true);
    } else {
      $("#gerente").attr("selected", true);
    }

    $("#editarUsuario").on("click", (e) => {
      e.stopImmediatePropagation();
      console.log(perfilUsuario);

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
        success: function () {
          padre.find(".card-title").text(inputEditNombreUsuario.value.trim());
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

          padre.find(".emailUsuario").text(inputEmailUsuario.value.trim());
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
        },
      });
      $("#modalEditarUsuario").modal("hide");
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
});
