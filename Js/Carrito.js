function deleteProdCar(idProd){
    swal({
        title:'Confirmar producto',
        text:'¿Estas seguro de eliminar el producto del carrito?',
        icon: "warning",
        buttons: true,
        dangerMode: true,

      }).then((result)=>{
        if(result){
          $.ajax({
            data: {"idProd" : idProd},
            type: "POST",
            dataType: "json",
            url: "APIs/DeleteProdCarrito.php"
        }).done(function (re) {
            if(re ==='true'){
              swal({
                  icon: 'success',
                  title: 'Producto eliminado del carrito',
              }).then((value) => {
                window.location.href="Carrito.php";;
              });
            }else{
              swal({
                icon: 'error',
                title: 'Producto no eliminado del carrito',
            });
            }


        }).fail(function (re) {
            console.log("La solicitud regreso con un error: " + re);
        });
        }
      });

}

function cambiarCantidad(cant){
    if(cant.value != 0){
        $.ajax({
            data: {"idProd" :  cant.getAttribute('idProd'), "cantidad": cant.value},
            type: "POST",
            dataType: "json",
            url: "APIs/UpdateCar.php"
        }).done(function (result) {
          if(result ==='true'){
            window.location.href="Carrito.php";
          }else{

          }

        }).fail(function (result) {

        });
    }


}



function PagarCarrito(user){
  swal({
    title:'Confirmar Pago',
    text:'¿Estas seguro de terminar la compra?',
    icon: "warning",
    buttons: true,
    dangerMode: true,

  }).then((result)=>{
    if(result){
      $.ajax({
        data: {"userCompra" : user},
        type: "POST",
        url: "APIs/API_Prod.php"
    }).done(function (re) {
      if(re ==='true'){
        swal({
            icon: 'success',
            title: 'Productos comprados',
        }).then((value) => {
          AgregarComentario(user);
        });
      }else{
        swal({
          icon: 'error',
          title: 'No hay existencias suficientes de este producto: '+re,
      });
      }


    }).fail(function (re) {
        console.log("La solicitud regreso con un error: " + re);
    });
    }
  });


}

function AgregarComentario(user){
  $.ajax({
    data: {"userComenta" : user},
    type: "POST",
    url: "APIs/API_Prod.php"
}).done(function (re) {
  document.getElementById('colListas').innerHTML = re;
}).fail(function (re) {
    console.log("La solicitud regreso con un error: " + re);
});
}

function Comentar(id){
  
  if(document.getElementById('ComentarioPedido'+id).value =="" || document.getElementById('Calificacion'+id).value ==""){
    swal({
            icon: 'error',
            title: 'Por favor agrega un comentario y una calificacion',
        });
        return;
  }
  var parametros = {
    "Comentario" : id,
    "text" : document.getElementById('ComentarioPedido'+id).value,
    "calif": document.getElementById('Calificacion'+id).value,
};

  $.ajax({
    data: parametros,
    type: "POST",
    url: "APIs/API_Prod.php"
}).done(function (re) {
  if(re ==='true'){
    swal({
        icon: 'success',
        title: 'Comentario agregado. Gracias!',
    }).then((value) => {
      AgregarComentario('algo');
    });
  }else{
    swal({
      icon: 'error',
      title: 'Error al agregar el comentario',
  });
  }
}).fail(function (re) {
    console.log("La solicitud regreso con un error: " + re);
});
}


$('#btnBuscar').click(function(){
  window.location.href= "TodoProd.php?b="+document.getElementById('inpBuscar').value;
});