$(document).ready(function () {
  $("a").on("click", function ({ target }) {
    if (!$(target).hasClass("active")) {
      $("#main").children().hide();
      $(".nav-link").removeClass("active");

      const clase = target.id.split("-"); // busca el id de los div para mostrar

      $("#" + target.id).addClass("active");
      $("#" + clase[0]).show();
    }
  });

  $(".mesa").on("click", function ({ target }) {
    const padre = $(target).closest(".mesa");
    let mesaid = padre.attr("mesaid");
    let ticketid = padre.attr("ticketid");
    let mesaEstado = padre.attr("mesaEstado");

    $("#modalMesa").modal();
  });

  $(".producto").on("click", function ({ target }) {
    const padre =  $(target).closest(".producto");

    let IdProducto = padre.attr("idproducto");
    let nombreProducto = padre.find(".nombreProducto").text();
    let descripcionProducto = padre.find(".descripcionProducto").text();
    let precioProducto = padre.find(".precioProducto").text();
    
  const inputIdProducto=  $("#modalProducto #inputIdProducto");
   const inputNombreProducto=  $("#modalProducto #inputNombreProducto");
   const inputDescripcionProducto=  $("#modalProducto #inputDescripcionProducto");
   const inputPrecioProducto = $("#modalProducto #inputPrecioProducto");
   

   inputIdProducto[0].value = IdProducto;
   inputNombreProducto[0].value = nombreProducto;
   inputDescripcionProducto[0].value = descripcionProducto;
   inputPrecioProducto[0].value = parseInt(precioProducto);

    $("#modalProducto").modal();

    
    $("#updateProducto").on("click", function () {
      $.ajax({
        type: "POST",
        url: './db/editarProductos.php',
        data: {
          id: inputIdProducto[0].value,
          nombre : inputNombreProducto[0].value,
          descripcion : inputDescripcionProducto[0].value,
          precio : inputPrecioProducto[0].value
        },
        success: function(){
          padre.find(".nombreProducto").text(inputNombreProducto[0].value); 
          padre.find(".descripcionProducto").text(inputDescripcionProducto[0].value);
          padre.find(".precioProducto").text(inputPrecioProducto[0].value + ' €');

          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Producto Actualizado',
            showConfirmButton: false,
            timer: 1200
          })
  
        }

      });
      $("#modalProducto").modal('hide');
    });
  });

  

  


});
