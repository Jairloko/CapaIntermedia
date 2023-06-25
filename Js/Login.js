const form = document.getElementById("formL");
const inputs = document.querySelectorAll("#formL input");

const expresiones={
    usuario: /^[a-zA-Z0-9]{6,}$/,
    contraseña: /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/,
};

const validar = (e) =>{
    switch(e.target.name){
        case "usuario":
            if(!expresiones.usuario.test(e.target.value)){
                swal({
                    icon: 'error',
                    title: 'Algo salió mal',
                    text: 'Usuario mínimo de 6 caracteres',
                }).then((value) => {
                  e.target.value="";
                });
            }

        break;
        case "password":
            if(!expresiones.contraseña.test(e.target.value)){
                swal({
                    icon: 'error',
                    title: 'Algo salió mal',
                    text: 'Formato no valido de Contraseña\n-Mínimo 8 caracteres\n-1 mayúscula\n-1 minúscula\n-1 número\n-1 carácter',
                }).then((value) => {
                  e.target.value="";
                });
            }

        break;
    }
}

inputs.forEach((input)=>{
    input.addEventListener("change", validar)

});

$('#formL').on('submit',function(e){
    e.preventDefault();
    var formData = new FormData(this);
    console.log(formData);
    $.ajax({
        type:'POST',
        url: $('#formL').attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success:function(result){
         if(result ==='false'){
            swal({
             icon: 'error',
             title: 'Credenciales incorrectas',
         }).then((value) => {
             
         });
        
     }else{
        swal({
            icon: 'success',
            title: 'Iniciaste sesion',
        }).then((value) => {
            window.location.href="Main.php";
        });
     }
 
     if(condition){}
     else{}
  }
  })
});
