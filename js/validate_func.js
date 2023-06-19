$(document).ready(function(){
	

	$("#cadastra").validate({
						   
	rules:{
        nome:{required:true, minlength: 5},
        login:{required:true, minlength: 5},
        senha:{required: true, minlength: 5},
        email:{required: true, email:true}
				},
				
        messages:{
        nome:{required:"Encha o campo nome", minlength: "Minimo 5 caracteres" },
	login:{required:"Encha o campo login", minlength: "Minimo 5 caracteres" },
	senha:{required: "Informe uma senha", minlength: "Minimo 5 caracteres"},
        email:{required: "Encha o campo e-mail", email: "Informe um email válido"}
         	},						   
   });
  
})