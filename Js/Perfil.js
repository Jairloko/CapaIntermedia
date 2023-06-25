var cotizarEdit;
var listaGb;


var userMsg;
var idProductoMsg;
 
$(document).ready(function(){
  // let text = "";
  //   for (let i = 0; i < 10; i++) {
  //    text += "<div class='row row-cols-1 row-cols-lg-3 border-bottom  py-2 mb-2 text-center'><div class='col'><img src='Img/Productos/1.jpg'></div><div class='col align-middle'>Xbox Series X</div><div class='col'> <a href='Carrito.php' class='btn btn-success w-100 mb-3'>Agregar</a><a href='Producto.php' class='btn btn-danger w-100'>Eliminar</a></div></div>";
  //   }       
  //   document.getElementById("prodLista").innerHTML=text; 



    // var checkbox = document.getElementById("cotizar");
    // checkbox.addEventListener("change", function(){
    //   var checked = checkbox.checked;
    //   if(checked){
    //     document.getElementById("precio").setAttribute("hidden","");
    //   }
    //   else{
    //     document.getElementById("precio").removeAttribute("hidden");
    //   }
    // });

    // if(document.getElementById('categoriaProd')){
    //   $.ajax({
    //     type: 'POST',
    //     url: 'APIs/CargarCategorias.php',
    //     cache: false,
    //     contentType: false,
    //     processData: false,
    //     success: function(result) {
    //       document.getElementById('categoriaProd').innerHTML = result;
    //     }
    //   })
    // }






});
 
function mostrarProductos(){
  $.ajax({
    type: 'POST',
    url: 'APIs/CargarProductosUser.php',
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      document.getElementById('colSecundaria').innerHTML = result;
    }
  })
}

function mostrarProductosList(list){
  listaGb = list;
  var param={"prodListas" : "si",
  "listaName" : list};
  $.ajax({
    data: param,
    type: "GET",
    url: "APIs/API_Lista.php" 
}).done(function (result) {
    document.getElementById('colSecundaria').innerHTML = result;

}).fail(function (result) {
    console.log("La solicitud regreso con un error: " + result);
}); 
}


function mostrarProductosAdmin(){
  $.ajax({
    type: 'POST',
    url: 'APIs/CargarProductosAdmin.php',
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      document.getElementById('colSecundaria').innerHTML = result;
    }
  })
}


function traerDataProd(producto){
  $.ajax({
    data: {"idProd" : producto},
    type: "GET",
    dataType: "json",
    url: "APIs/CargarDataProducto.php" 
}).done(function (result) {
    document.getElementById('modalEditProdData').innerHTML = result;
    $('#modalEditProd').modal('show');
   
    $.ajax({
      data:{"cat" : document.getElementById('categoriaProdEdit').value},
      type: "GET",
      dataType :"json",
      url: "APIs/CargarCategoriasEdit.php"
    }).done(function(re){
        document.getElementById('categoriaProdEdit').innerHTML = re;
    }).fail(function (re) {
      console.log("La solicitud regreso con un error: " + re);
    }); 

    cotizarEdit = document.getElementById("cotizarEdit");
    cotizarEdit.addEventListener("change", function(){
      var checked = cotizarEdit.checked;
      if(checked){
        document.getElementById("precioEdit").setAttribute("hidden","");
      }
      else{
        document.getElementById("precioEdit").removeAttribute("hidden");
      }
    });

    $('#formEditProd').on('submit',function(e){
      e.preventDefault();
      var formData = new FormData(this);     
      swal({
        title:'Confirmar actualización',
        text:'Se actualizara la información del producto',
        icon: "warning",
        buttons: true,
        dangerMode: true,
        
      }).then((result)=>{
        if(result){
          e.preventDefault();
          $.ajax({
            type: 'POST',
            url: $('#formEditProd').attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
              if(result ==='true'){
                swal({
                    icon: 'success',
                    title: 'Producto actualizado',
                });
              }else{
                swal({
                  icon: 'error',
                  title: 'Producto no actualizado',
              });
              }
              mostrarProductos();
            }
            
          })
        }
      });
    });



}).fail(function (result) {
    console.log("La solicitud regreso con un error: " + result);
});     
}

function eliminarProd(producto){
  swal({
    title:'Confirmar eliminacion',
    text:'¿Estas seguro de eliminar el producto?',
    icon: "warning",
    buttons: true,
    dangerMode: true,
    
  }).then((result)=>{
    if(result){
      $.ajax({
        data: {"idProd" : producto},
        type: "POST",
        dataType: "json",
        url: "APIs/DeleteProd.php" 
    }).done(function (re) {
        if(re ==='true'){
          swal({
              icon: 'success',
              title: 'Producto eliminado',
          });
        }else{
          swal({
            icon: 'error',
            title: 'Producto no eliminado',
        });
        }
        mostrarProductos();

    }).fail(function (re) {
        console.log("La solicitud regreso con un error: " + re);
    }); 
    }
  });


 
}

function autorizarProd(producto){
  $.ajax({
    data: {"idProd" : producto},
    type: "POST",
    dataType: "json",
    url: "APIs/AutorizarProducto.php" 
}).done(function (result) {
  if(result ==='true'){
    swal({
        icon: 'success',
        title: 'Producto autorizado',
    }).then((value) => {
        mostrarProductosAdmin();
    });
  }else{
    swal({
      icon: 'error',
      title: 'Error al autorizar el producto',
  }).then((value) => {
      mostrarProductosAdmin();
  });
  }

}).fail(function (result) {
    
});     
}

function cancelarProd(producto){
  $.ajax({
    data: {"idProd" : producto},
    type: "POST",
    dataType: "json",
    url: "APIs/CancelarProducto.php" 
}).done(function (result) {
  if(result ==='true'){
    swal({
        icon: 'success',
        title: 'Producto no autorizado',
    }).then((value) => {
        mostrarProductosAdmin();
    });
  }else{
    swal({
      icon: 'error',
      title: 'Error al autorizar el producto',
  }).then((value) => {
      mostrarProductosAdmin();
  });
  }

}).fail(function (result) {
    
}); 
}


function eliminarProdLista(producto){
  swal({
    title:'Confirmar eliminacion',
    text:'¿Estas seguro de eliminar el producto de la lista?',
    icon: "warning",
    buttons: true,
    dangerMode: true,
    
  }).then((result)=>{
    if(result){
      $.ajax({
        data: {"idProd" : producto, "listName":listaGb},
        type: "POST",
        dataType: "json",
        url: "APIs/DeleteProdLista.php" 
    }).done(function (re) {
        if(re ==='true'){
          swal({
              icon: 'success',
              title: 'Producto eliminado de la lista',
          });
        }else{
          swal({
            icon: 'error',
            title: 'Producto no eliminado de la lista',
        });
        }
        mostrarProductosLista(listaGb);

    }).fail(function (re) {
        console.log("La solicitud regreso con un error: " + re);
    }); 
    }
  });


 
}

$('#lista').change(function(){
  if(document.getElementById('lista').value != 'Selecciona una lista'){
    document.getElementById("content").classList.remove('justify-content-center');
    document.getElementById("user").classList.remove('col-xl-5');
    document.getElementById("user").classList.remove('col-xxl-4');
    document.getElementById("user").classList.add('col-xl-3');
    document.getElementById("colSecundaria").removeAttribute("hidden");
    mostrarProductosList(document.getElementById('lista').value);
  }
  
 });

$('#mostrarProductos').click(function(){
  document.getElementById("content").classList.remove('justify-content-center');
  document.getElementById("user").classList.remove('col-xl-5');
  document.getElementById("user").classList.remove('col-xxl-4');
  document.getElementById("user").classList.add('col-xl-3');
  document.getElementById("colSecundaria").removeAttribute("hidden");
  mostrarProductos();
 });

$('#mostrarProductosAdmin').click(function(){
  document.getElementById("content").classList.remove('justify-content-center');
  document.getElementById("user").classList.remove('col-xl-5');
  document.getElementById("user").classList.remove('col-xxl-4');
  document.getElementById("user").classList.add('col-xl-3');
  document.getElementById("colSecundaria").removeAttribute("hidden");
  mostrarProductosAdmin();
});



//Mensajes
function Prueba(user,idProd){
  $.ajax({
    data: {"user" : user, "prod" : idProd},
    type: "GET",
    url: "APIs/API_Chat.php" 
}).done(function (result) {
  userMsg = user;
  idProductoMsg = idProd;
  document.getElementById("colSecundaria").innerHTML= result;
  $('#formM').on('submit',function(e){
    e.preventDefault();
    alert(userMsg+' '+idProductoMsg);
    var formData = new FormData(this);
    formData.append("userPara",userMsg);
    formData.append("idProd",idProductoMsg);
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

          Prueba(userMsg,idProductoMsg);
          
      }
  
    
  }
  })
  });
}).fail(function (result) {
    console.log("La solicitud regreso con un error: " + result);
});   
 



}

function cargarMensajes(){ 
  $.ajax({
    data: {"CargarPerfilesChat" : "cargar"},
    type: "GET",
    url: "APIs/API_Chat.php" 
}).done(function (result) {
   document.getElementById("colSecundaria").innerHTML = result;
}).fail(function (result) {
    console.log("La solicitud regreso con un error: " + result);
});     
 
}








$('#mensajes').click(function(){
  document.getElementById("content").classList.remove('justify-content-center');
  document.getElementById("user").classList.remove('col-xl-5');
  document.getElementById("user").classList.remove('col-xxl-4');
  document.getElementById("user").classList.add('col-xl-3');
  document.getElementById("colSecundaria").removeAttribute("hidden");
  cargarMensajes();
 });



if(document.getElementById('lista')){
  $.ajax({
    type: 'POST',
    url: 'APIs/CargarListas.php',
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      document.getElementById('lista').innerHTML = result;
    }
  })
}

$('#btnBuscar').click(function(){
  window.location.href= "TodoProd.php?b="+document.getElementById('inpBuscar').value;
});


$('#newCategoria').click(function(){
  
  $('#modalCategoria').modal('show');
  $('#addProd').modal('hide');

});

$('#cancelarCat').click(function(){
  $('#addProd').modal('show');
});









$('#formC').on('submit',function(e){
  e.preventDefault();
  var formData = new FormData(this);

  swal({
    title:'Confirmar actualización',
    text:'Se actualizara tu información',
    icon: "warning",
    buttons: true,
    dangerMode: true,
    
  }).then((result)=>{
    if(result){
      e.preventDefault();
      $.ajax({
        type: 'POST',
        url: $('#formC').attr('action'),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(result) {
          if(result ==='true'){
            swal({
                icon: 'success',
                title: 'Perfil actualizado',
            }).then((value) => {
                window.location.href="Perfil.php";
            });
          }else{
            swal({
              icon: 'error',
              title: 'Perfil no actualizado',
          }).then((value) => {
              window.location.href="Perfil.php";
          });
          }
        }
      
      })
    }
  });
});


$('#formNewList').on('submit',function(e){
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    type: 'POST',
    url: $('#formNewList').attr('action'),
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      if(result ==='true'){
        swal({
            icon: 'success',
            title: 'Lista creada',
        }).then((value) => {
            window.location.href="Perfil.php";
        });
      }else{
        swal({
          icon: 'error',
          title: 'Error al crear la lista',
      }).then((value) => {
          window.location.href="Perfil.php";
      });
      }
    }
  })
});


$('#formNewCat').on('submit',function(e){
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    type: 'POST',
    url: $('#formNewCat').attr('action'),
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      if(result ==='true'){
        swal({
            icon: 'success',
            title: 'Categoria creada',
        }).then((value) => {
          var selectCat = document.getElementById("categoriaProd");
          var nuevaOpcion = document.createElement("option");
          nuevaOpcion.value = document.getElementById("nombreCat").value;
          nuevaOpcion.text = document.getElementById("nombreCat").value;
          selectCat.add(nuevaOpcion);
            $('#addProd').modal('show');
            
        });
      }else{
        swal({
          icon: 'error',
          title: 'Error al crear la categoria',
      }).then((value) => {
          $('#addProd').modal('show');
          
      });
      }
    }
  })
});


$('#formNewProd').on('submit',function(e){
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    type: 'POST',
    url: $('#formNewProd').attr('action'),
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    success: function(result) {
      if(result ==='true'){
        swal({
            icon: 'success',
            title: 'Producto agregado. Esperando autorización del administrador',
        }).then((value) => {
          $('#addProd').modal('hide');
          window.location.href="Perfil.php";
          
        });
      }else{
        swal({
          icon: 'error',
          title: 'Error al agregar el producto',
      }).then((value) => {
        $('#addProd').modal('hide');
        window.location.href="Perfil.php";
        
      });
      }
    }
  })
});
