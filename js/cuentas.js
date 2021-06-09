"use strict";
$(document).ready(function () {
  var categoria = "";
  var padre = "";
  //var total = 0.00;
  var lineas = [];

  $(".informacionPOP").click(function ({ target }) {
    $(".informacionPOP").popover({
      html: true,
      sanitize: false,
      content: function () {
        return `
        <div>
        <div class="row ">
        <div class="col-md-12">
        <i class="far fa-minus-square"></i> El botón con el simbolo menos no creará la línea en la base de datos
        </div>

    </div>
    <hr>
    <div class="row">
                            <div class="col-md-12">
                            <i class="far fa-trash-alt"></i> El botón con icono de basura eliminará la línea que está en la base de datos
                            </div>
                        </div>
        </div>
        `;
      },
    });
  });

  $(document).on("click", ".editLinea", function ({ target }) {
    //let totalLineas=0;
    let linea = $(target).closest("tr");
    let idProductoEdit = linea.attr("idProducto");
    let thUnidadesPedidas = $(linea).children("th");
    thUnidadesPedidas.empty();
    thUnidadesPedidas.append(`
    <div class="form-group">
    <input type="number" class="form-control inputEditUnidades" min="1" max="100" required>

    <button type="button" class="btn btn-primary btn-lg btn-block mt-1 aceptarEditUnidad" style="height:35px"><i class="fas fa-check"></i></button>

  </div>
    
    `);
    $(document).one("click", ".aceptarEditUnidad", function ({ target }) {
      let totalAnadir = 0;
      let unidadesNuevas = $(".inputEditUnidades").val();
      let importe = $(linea).find(".importe");
      console.log(importe);
      lineas.forEach((element) => {
        if (element.id == idProductoEdit) {
          element.cantidadPedida = unidadesNuevas;
          importe.text(`${element.cantidadPedida * element.precio}  €`);
        }
      });
      thUnidadesPedidas.empty();
      thUnidadesPedidas.append(`
        ${unidadesNuevas}
    `);

      lineas.forEach((element) => {
        totalAnadir =
          totalAnadir +
          parseFloat(element.precio) * parseFloat(element.cantidadPedida);
        console.log();
      });

      $("#precioTotal").text(totalAnadir + " €");
    });
  });

  if ($(".numeroTicket").attr("nuevo") == "1") {
    $.ajax({
      type: "POST",
      url: "./db/cargarLineas.php",
      data: {
        id: parseInt($(".numeroTicket").text()),
      },
      success: function (data) {
        data = JSON.parse(data);
        console.log(data);
        data.forEach((element) => {
          let linea = {
            id: element.idProducto,
            idLinea: element.idLinea,
            cantidadPedida: element.unidadesPedidas,
            nombre: element.nombre,
            precio: parseFloat(element.precio),
            borrado: 0,
          };
          //total=total+ parseFloat(element.cantidadPedida) * parseFloat(element.precio);
          lineas.push(linea);
        });
      },
    });
  }

  $(document).on("click", ".noIncluirLinea", function ({ target }) {
    let linea = $(target).closest("tr");
    lineas.forEach((element) => {
      if (element.id == linea.attr("idProducto")) {
        element.borrado = 1;
      }
    });
    linea.addClass("table-warning");
  });

  $(document).on("click", ".eliminarLinea", function ({ target }) {
    let linea = $(target).closest("tr");
    lineas.forEach((element) => {
      if (element.id == linea.attr("idProducto")) {
        element.borrado = 2;
      }
    });
    linea.addClass("table-danger");
  });

  $(document).on("click", ".anadirTicket", function ({ target }) {
    let linea = $(target).closest("tr");
    lineas.forEach((element) => {
      if (element.id == linea.attr("idProducto")) {
        element.borrado = 0;
      }
    });
    linea.removeClass("table-danger");
    linea.removeClass("table-warning");
  });

  $(".continuarBoton").on("click", function ({ target }) {
    let lineasEnviar = lineas.filter(
      (linea) => linea.borrado == 0 || linea.borrado == 2
    );

    if (lineasEnviar.length > 0) {
      console.log(lineasEnviar);
      let datos = JSON.stringify(lineasEnviar);
      let idTicket = parseInt($(".numeroTicket").text());
      let idMesa = parseInt($(".mesaId").text());
      let fecha = $(".fecha").text();
      var date = new Date(fecha);
      var usaDate = date.toLocaleDateString("zh-Hans-CN", {
        hourCycle: "h23",
        hour: "2-digit",
        minute: "2-digit",
      });

      fecha = usaDate;

      let idUsuario = parseInt($(".usuario").attr("idUsuario"));
      let empresaId = 1;
      if ($(".numeroTicket").attr("nuevo") == "0") {
        $.ajax({
          type: "POST",
          url: "./db/generarTicket.php",
          data: {
            idUsuario,
            empresaId,
            fecha,
            idMesa,
            idTicket,
            datos,
          },
          success: function (data) {
            if (data == "0") {
              Swal.fire({
                title: "<strong> Ticket Generado con Exito! </strong>",
                html: "Redirigiendo a mesas en   <b></b> milliseconds.",
                timer: 2000,
                icon: "success",
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  timerInterval = setInterval(() => {
                    const content = Swal.getHtmlContainer();
                    if (content) {
                      const b = content.querySelector("b");
                      if (b) {
                        b.textContent = Swal.getTimerLeft();
                      }
                    }
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                },
              }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                  window.location.href = "./admin.php";
                }
              });
            } else {
              let error = "";
              if (data == "1") {
                error = "error en la creacion de ticket";
              }
              if (data == "2") {
                error = "error en la creacion de linea";
              }
              if (data == "3") {
                error = "error en la actualizacion de la mesa";
              }

              Swal.fire({
                icon: "error",
                title: "Ticket no generado",
                text: error,
              });
            }
          },
        });
      } else {
        let idTicketModificar = parseInt($(".numeroTicket").text());

        $.ajax({
          type: "POST",
          url: "./db/modificarTicket.php",
          data: {
            idUsuario,
            empresaId,
            fecha,
            idMesa,
            idTicketModificar,
            datos,
          },
          success: function (data) {
            Swal.fire({
              title: "<strong> Ticket Modificado con Exito! </strong>",
              html: "Redirigiendo a mesas en   <b></b> milliseconds.",
              timer: 2000,
              icon: "success",
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                  const content = Swal.getHtmlContainer();
                  if (content) {
                    const b = content.querySelector("b");
                    if (b) {
                      b.textContent = Swal.getTimerLeft();
                    }
                  }
                }, 100);
              },
              willClose: () => {
                clearInterval(timerInterval);
              },
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                window.location.href = "./admin.php";
              }
            });
          },
        });
      }
    } else {
      Swal.fire({
        icon: "error",
        title: "Error de línea",
        text: "Debe haber al menos una línea en el ticket",
      });
    }
  });
  //let totalAnadir = 0;

  $(".selecionarCategoria").on("click", function ({ target }) {
    padre = $(target).closest(".card");
    categoria = padre.attr("idCategoria");
    $.ajax({
      type: "POST",
      url: "./db/cargarProductosCategoria.php",
      data: {
        id: categoria,
      },
      success: function (data) {
        data = JSON.parse(data);
        $(".productosCargados").empty();
        data.forEach((element) => {
          let imagen =
            element.imagen !== null
              ? `data:image/png;base64,` + element.imagen
              : "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6c/No_image_3x4.svg/1200px-No_image_3x4.svg.png";
          $(".productosCargados").append(
            `
                        <div class="col-lg-6 col-xl-4 mb-3 text-center producto" idProducto=${element.idProducto} >

                    <div class="card" style="width: 12rem;" idProducto=${element.idProducto} idCategoria=${element.idCategoria} nombreProducto=${element.nombre} descripcionProducto=${element.descripcion}  precioProducto=${element.precio} >
                      <img class="card-img-top" src=${imagen} alt="Card image cap">
                      <div class="card-body">
                        <h5 class="card-title nombreProducto">${element.nombre}</h5>
                        <hr>

                        <p class="descripcionProducto"> ${element.descripcion} </p>
                        <p class="precioProducto"> ${element.precio} € </p>

                      </div>

                      <div class="p-2">
                        <div class="row">

                          <div class="col-sm-12 text-center">
                          
                            <button type="button" class="btn btn-outline-info anadirProductoAlTicket"><i class="fas fa-plus"></i></button>

                          </div>
             

                        </div>
                      </div>
                    </div>
                  </div>


                        
                        `
          );
        });

        $("#collapseTwo").collapse("show");
        $(".anadirProductoAlTicket")
          .unbind("click")
          .on("click", function ({ target }) {
            padre = $(target).closest(".card");
            let existe = false;

            lineas.forEach((element) => {
              if (element.id == padre.attr("idProducto")) {
                existe = true;
              }
            });

            if (!existe) {
              let producto = {
                id: padre.attr("idProducto"),
                idLinea: null,
                nombre: padre.attr("nombreProducto"),
                idCategoria: padre.attr("idCategoria"),
                precio: parseFloat(padre.attr("precioProducto")),
                borrado: 0,
              };

              $(".cantidadProducto").text("0.00");
              $(".inputCantidadProductos").val("0");

              $("#collapseThree").collapse("show");
              let valorNumero = 0;
              $(".botonNumero").on("click", function ({ target }) {
                let valorNumeroNuevo = $(target)
                  .closest(".botonNumero")
                  .attr("valor");

                valorNumero =
                  parseInt(valorNumero) + parseInt(valorNumeroNuevo);

                $(".inputCantidadProductos").val(valorNumero);

                $(".cantidadProducto").text(
                  parseFloat(valorNumero) * parseInt(producto.precio)
                );

                $(".resetCantidad").on("click", function ({ target }) {
                  valorNumero = 0;
                  $(".inputCantidadProductos").val(valorNumero);
                  $(".cantidadProducto").text(valorNumero);
                });
              });

              $(".anadirCantidadTicket")
                .unbind("click")
                .on("click", function ({ target }) {
                  let totalAnadir = 0;
                  producto.cantidadPedida = valorNumero;
                  producto.valorTotalLinea =
                    parseFloat(valorNumero) * parseFloat(producto.precio);

                  $("#tbodyCuenta").append(
                    `
                <tr idProducto=${producto.id}>
                <th scope="row" class="unidadesPedidas"> ${valorNumero} </th>
                <td>${producto.nombre}</td>
                <td>${producto.precio} €</td>
                <td class="importe">${producto.valorTotalLinea} €</td>
                <td>
                <button type="button" class="btn btn-outline-success anadirTicket"><i class="far fa-plus-square"></i></button>
                <button type="button" class="btn btn-outline-warning noIncluirLinea"><i class="far fa-minus-square"></i></button>
                <button type="button" class="btn btn-outline-info editLinea"><i class="far fa-edit"></i></button>

                </td>
            </tr>
              `
                  );

                  lineas.push(producto);

                  lineas.forEach((element) => {
                    totalAnadir =
                      totalAnadir +
                      parseFloat(element.precio) *
                        parseFloat(element.cantidadPedida);
                    console.log();
                  });

                  $("#precioTotal").text(totalAnadir + " €");
                  console.log(lineas);
                  $("#collapseOne").collapse("show");
                });
            } else {
              Swal.fire({
                icon: "error",
                title: "Error Producto",
                text: "No puedes añandir un producto ya añadido",
              });
              $("#collapseOne").collapse("show");
            }
          });
      },
    });
  });

  $(".cobrarTicket").on("click", function (e) {
    e.preventDefault();
    let idMesa = parseInt($(".mesaId").text());

    $.ajax({
      type: "POST",
      url: "./db/vaciarMesa.php",
      data: {
        idMesa,
      },
      success: function (data) {
        if (data == 0) {
          $("#formCobrar").submit();
          document.location.href = './admin.php'

        } else {
          Swal.fire({
            icon: "error",
            title: "Error Mesa",
            text: "Algo a salido mal al intentar dejar vacia una mesa",
          });
          
        }
      },
    });
  });
});
