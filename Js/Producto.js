$('#lista').change(function(){
    if(document.getElementById('lista').value != "Selecciona una lista")
        document.getElementById("btnAddLista").removeAttribute("hidden");
    else
        document.getElementById("btnAddLista").setAttribute("hidden","");
   
   });

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
          data: {"idProd" : idProd, "cantidad": document.getElementById('cantidad').value},
          type: "POST",
          dataType: "json",
          url: "APIs/AddProdCarrito.php" 
      }).done(function (re) {
          if(re ==='true'){
            document.getElementById('cantidad').value = 1;
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
  

$(document).ready(function(){
 
    if(document.getElementById('precioProd').textContent == "Desconocido"){
        document.getElementById("btnCotizar").removeAttribute("hidden");
        document.getElementById("btnAgregar").setAttribute("hidden","");
    }

});

$('#btnBuscar').click(function(){
  window.location.href= "TodoProd.php?b="+document.getElementById('inpBuscar').value;
});

$('#btnAddLista').click(function(){

    swal({
        title:'Confirmar',
        text:'¿Estas seguro de agregar el producto a la lista '+document.getElementById('lista').value+'?',
        icon: "warning",
        buttons: true,
        dangerMode: true,
        
      }).then((result)=>{
        if(result){
          $.ajax({
            data: {"idProd" : document.getElementById('nameProd').getAttribute('idprod'), "lista" : document.getElementById('lista').value},
            type: "POST",
            dataType: "json",
            url: "APIs/AddProdLista.php" 
        }).done(function (re) {
            if(re ==='true'){
              swal({
                  icon: 'success',
                  title: 'Producto agregado a la lista',
              });
            }else{
              swal({
                icon: 'error',
                title: 'Producto no agregado a la lista',
            });
            }
            
    
        }).fail(function (re) {
            console.log("La solicitud regreso con un error: " + re);
        }); 
        }
      });

});


//Mensajes
$('#formM').on('submit',function(e){
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("userPara", document.getElementById("vendedor").text);
  formData.append("enviarMensaje", "enviar");
  $.ajax({
      type:'POST',
      url: 'APIs/API_Chat.php',
      data:formData,
      cache:false,
      contentType: false,
      processData: false,
      success:function(result){ 
       if(result ==='false'){
          swal({
           icon: 'error',
           title: 'No se pudo enviar el mensaje',
       });
      
      }else{
        swal({
            icon: 'success',
            title: 'Mensaje enviado',
        }).then(() => {
          document.getElementById("mensaje").value = "";
        });
    }

  
}
})
});

