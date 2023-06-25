// Aqui obtenemos el elemento del Form con el id que tu le pusiste
const form = document.getElementById("formR");
// Aqui obtenemos todos los inputs del Form
const inputs = document.querySelectorAll("#formR input");
//Las expresiones para las validaciones

const expresiones={
    nombre: /^[a-zA-ZÀ-ÿ\u00f1\u00d1\s]{1,25}$/,
    email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    usuario: /^.{6,}$/,
    contrasenia: /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/,
};
// Esto es para que en la fecha no se pueda ingresar una fecha mayor a la actual. 
nacimiento.max = new Date().toLocaleDateString('en-ca')

//Todas las validaciones
const validar = (e) =>{
    switch(e.target.name){
        case "nombre":
            if(e.target.value == ""){
                
            }
            else if(!expresiones.nombres.test(e.target.value)){
                 swal({
                    icon: 'error',
                    title: 'Algo salió mal',
                    text: 'No se permiten números ni caracteres especiales en Nombre/s',
                }).then((value) => {
                  e.target.value="";
                });
                
            }
        break;
        case "email":
            if(e.target.value == ""){
               
            }
            else if(!expresiones.email.test(e.target.value)){
                    swal({
                    icon: 'error',
                    title: 'Algo salió mal',
                    text: 'Formato no valido de Email',
                }).then((value) => {
                  e.target.value="";
                });
            }

        break;
        case "usuario":
            if(e.target.value == ""){
               
            }
            else if(!expresiones.usuario.test(e.target.value)){
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
            if(e.target.value == ""){
               
            }
            else if(!expresiones.contrasenia.test(e.target.value)){
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

//Aqui obtienes los inputs para mandarlas a validar
inputs.forEach((input)=>{
   input.addEventListener("change", validar)

});

$('#formR').on('submit',function(e){
    e.preventDefault();
    const genero = document.getElementById("genero");
    const rol = document.getElementById("rol");
    if( genero.value=="Selecciona un sexo"){
        swal({
            icon: 'error',
            title: 'Algo salió mal',
            text: 'Selecciona un sexo',
        });
    }else if(rol.value=="Selecciona un rol"){
        swal({
            icon: 'error',
            title: 'Algo salió mal',
            text: 'Selecciona un rol',
        });
    }else{
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $('#formR').attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(result){
             swal({
                 icon: 'success',
                 title: 'Usuario registrado',
             }).then((value) => {
                 window.location.href="Main.php";
             });
         if(condition){}
         else{}
      }
      })
    }
});

