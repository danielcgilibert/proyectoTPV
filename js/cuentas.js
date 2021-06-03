$(document).ready(function () {
  var categoria = "";
  var padre = "";
  var total = 0;
  var lineas = [];


  if($(".numeroTicket").attr("nuevo")=='1'){
    $.ajax({
      type: "POST",
      url: "./db/cargarLineas.php",
      data: {
        id: parseInt($(".numeroTicket").text())
      },
      success: function (data) {
        data = JSON.parse(data)
        console.log(data);
        data.forEach(element => {
          let linea =  {
            id: element.idProducto,
            nombre: element.nombre,
            precio: parseFloat(element.precio),
            borrado:0
          }
          lineas.push(linea)
        });
        console.log(lineas);

      }
    });
  }
  

  $(document).on("click", '.borrarLinea', function ({ target }) {
    let linea = $(target).closest("tr");
    lineas.forEach(element => {
      if(element.id==linea.attr("idProducto")){
          element.borrado=1;
      }
    });
    linea.addClass("table-danger")
    console.log(lineas);

  });

  $(document).on("click", '.anadirTicket', function ({ target }) {
    let linea = $(target).closest("tr");
    lineas.forEach(element => {
      if(element.id==linea.attr("idProducto")){
          element.borrado=0;
      }
    });
    console.log(lineas);

    linea.removeClass("table-danger")
  });

  $(".continuarBoton").on("click", function ({ target }) {  

    if(lineas.length > 0){

      let lineasEnviar = lineas.filter(linea => linea.borrado==0);

      let datos = JSON.stringify(lineasEnviar);
      let idTicket = parseInt($(".numeroTicket").text());
      let idMesa = parseInt($(".mesaId").text());
      let fecha = $(".fecha").text();
      console.log(fecha);
      var date=new Date(fecha);

      console.log(date);
      var usaDate=date.toLocaleDateString('zh-Hans-CN', {
        hourCycle: 'h23',
        hour: '2-digit',
        minute: '2-digit'
    });
    
      fecha =usaDate;

      let idUsuario = parseInt($(".usuario").attr("idUsuario"));
      let empresaId = 1;

      $.ajax({
        type: "POST",
        url: "./db/generarTicket.php",
        data: {
          idUsuario,
          empresaId,
          fecha,
          idMesa,
          idTicket,
          datos
        },
        success: function (data) {
          if(data=='0'){
            Swal.fire({
              title: '<strong> Ticket Generado con Exito! </strong>',
              html: 'Redirigiendo a mesas en   <b></b> milliseconds.',
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
                window.location.href ="./admin.php";
            }
            })
          }else{
            let error="";
            if(data=='1'){error="error en la creacion de ticket"};
            if(data=='2'){error="error en la creacion de linea"};
            if(data=='3'){error="error en la actualizacion de la mesa"};

            Swal.fire({
              icon: 'error',
              title: 'Ticket no generado',
              text: error
            })
          }
        },
      });

    }else{
      Swal.fire({
        icon: 'error',
        title: 'Ticket no generado',
        text: 'Debe haber al menos una línea en el ticket',
      })
    }

  });
  
  $(".selecionarCategoria").on("click", function ({ target }) {
    padre = $(target).closest(".card");
    categoria = padre.attr("idCategoria");
    console.log(categoria);
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
        $(".anadirProductoAlTicket").unbind("click").on("click", function ({ target }) {
          padre = $(target).closest(".card");
          let producto = {
            id: padre.attr("idProducto"),
            nombre: padre.attr("nombreProducto"),
            idCategoria: padre.attr("idCategoria"),
            precio: parseFloat(padre.attr("precioProducto")),
            borrado:0
          };


          
          $(".cantidadProducto").text("0.00");
          $(".inputCantidadProductos").val("0");

          $("#collapseThree").collapse("show");
          let valorNumero = 0;
          $(".botonNumero").on("click", function ({ target }) {

            let valorNumeroNuevo = $(target)
              .closest(".botonNumero")
              .attr("valor");
            valorNumero = parseInt(valorNumero) + parseInt(valorNumeroNuevo);

            $(".inputCantidadProductos").val(valorNumero);

            $(".cantidadProducto").text(
              parseFloat(valorNumero) * parseFloat(producto.precio)
            );

            $(".resetCantidad").on("click", function ({ target }) {
              valorNumero = 0;
              $(".inputCantidadProductos").val(valorNumero);
            });
          });
          
          $(".anadirCantidadTicket").unbind("click").on("click", function ({ target }) {
            producto.cantidadPedida=valorNumero;
            producto.valorTotalLinea=parseFloat(valorNumero) * parseFloat(producto.precio);

            total= total + parseFloat(valorNumero) * parseFloat(producto.precio);

            $("#tbodyCuenta").append(
              `
              <tr idProducto=${producto.id}>
              <th scope="row"> ${valorNumero} </th>
              <td>${producto.nombre}</td>
              <td>${producto.precio} €</td>
              <td>${producto.valorTotalLinea} €</td>
              <td>
              <button type="button" class="btn btn-outline-success anadirTicket"><i class="far fa-plus-square"></i></button>
              <button type="button" class="btn btn-outline-danger borrarLinea"><i class="fas fa-backspace"></i></button>
              </td>
          </tr>
            `
            );

            $('#precioTotal').text(total + ' €');
              lineas.push(producto);
              console.log(lineas);
            $("#collapseOne").collapse("show");
          });
        });
      },
    });
  });

});
