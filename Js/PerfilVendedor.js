

function mostrarProductos(user){
   document.getElementById("content").classList.remove('justify-content-center');
  document.getElementById("colListas").removeAttribute("hidden");
  var parametros ={
    "productosVendedor":"si",
    "user" : user
  };
  $.ajax({
    data: parametros,
    type: 'POST',
    url: 'APIs/API_Prod.php',
    success: function(result) {
      document.getElementById('colListas').innerHTML = result;
    }
  })
}
function mostrarProductosLista(lista){
  var valores = window.location.search;
  var urlParams = new URLSearchParams(valores);
  var user = urlParams.get('user');
  var parametros ={
    "prodListasVendedor":"si",
    "listaProdV" : lista,
    "user" : user
  };
  $.ajax({
    data: parametros,
    type: "GET",
    url: "APIs/API_Lista.php" 
}).done(function (result) {
    document.getElementById('colListas').innerHTML = result;

}).fail(function (result) {
    console.log("La solicitud regreso con un error: " + result);
}); 
}



$('#btnBuscar').click(function(){
  window.location.href= "TodoProd.php?b="+document.getElementById('inpBuscar').value;
});

 
$(document).ready(function(){
  var valores = window.location.search;
  var urlParams = new URLSearchParams(valores);
  var producto = urlParams.get('user');
  var param ={
    "listasVendedor":"si",
    "user" : producto
  };

  $.ajax({
    data: param,
    type: 'POST',
    url: 'APIs/API_Lista.php',
    success: function(result) {
      
      document.getElementById('lista').innerHTML = result;
    }
  })


});

$('#lista').change(function(){
  if(document.getElementById('lista').value != 'Selecciona una lista'){
    document.getElementById("content").classList.remove('justify-content-center');
  document.getElementById("colListas").removeAttribute("hidden");
  mostrarProductosLista(document.getElementById('lista').value);
  }
  
 });

 $('#MostrarProd').click(function(){
  
 });

