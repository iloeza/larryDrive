function realizaProceso(valorCaja1, valorCaja2){
        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
        };
        $.ajax({
                data:  parametros,
                url:   '?c=archivo&a=getarchivos&new_dir=carpeta1',
                type:  'get',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}
$(document).ready(function (e) {
 $("#subirArchivo").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "?c=archivo&a=SubirArchivo",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
   processData:false,
  })
  .done(function(data) {
  	// view uploaded file.
	$("#data").html(data);
   })
  .fail(function(){

   })
   .always(function(){
	//alert("Complete");
   });
 }));
});
