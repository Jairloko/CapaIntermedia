function addCarrito(idProd){
     swal({
          title:'Confirmar producto',
          text:'¿Estas seguro de agregar el producto al carrito?',
          icon: "warning",
          buttons: true,
          dangerMode: true,
          
        }).then((result)=>{
          if(result){
            $.ajax({
              data: {"idProd" : idProd, "cantidad": 1},
              type: "POST",
              dataType: "json",
              url: "APIs/AddProdCarrito.php" 
          }).done(function (re) {
              if(re ==='true'){
                swal({
                    icon: 'success',
                    title: 'Producto agregado al carrito',
                });
              }else{
                swal({
                  icon: 'error',
                  title: 'Producto no agregado al carrito',
              });
              }
              
      
          }).fail(function (re) {
              console.log("La solicitud regreso con un error: " + re);
          }); 
          }
        });
}


$('#btnBuscar').click(function(){
  window.location.href= "TodoProd.php?b="+document.getElementById('inpBuscar').value;
});