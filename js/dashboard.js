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

    console.log(padre);
    const IdProducto = padre.attr("idproducto");
    const nombreProducto = padre.find(".nombreProducto").text();
    const descripcionProducto = padre.find(".descripcionProducto").text();
    const precioProducto = padre.find(".precioProducto").text();


   const inputIdProducto=  $("#modalProducto #inputIdProducto");
   const inputNombreProducto=  $("#modalProducto #inputNombreProducto");
   const inputDescripcionProducto=  $("#modalProducto #inputDescripcionProducto");
   const inputPrecioProducto = $("#modalProducto #inputPrecioProducto");
   

   inputIdProducto[0].value = IdProducto;
   inputNombreProducto[0].value = nombreProducto;
   inputDescripcionProducto[0].value = descripcionProducto;
   inputPrecioProducto[0].value = parseInt(precioProducto);

    $("#modalProducto").modal();
  });
});
