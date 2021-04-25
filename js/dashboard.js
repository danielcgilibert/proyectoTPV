$(document).ready(function () {
  $("a").on("click", function ({ target }) {
    if (!$(target).hasClass("active")) {
      $("#main").children().hide();
      $(".nav-link").removeClass("active");

      const clase = target.id.split("-"); // busca el id de los div para mostrar
      
      $("#" + target.id).addClass("active");
        console.log(target.id);
      $("#" + clase[0]).show("slow");

    
    }
  });

  $(".mesa").on("click", function () {
    $("#modalMesa").modal();
  });
});
