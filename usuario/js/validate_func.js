$(document).ready(function(){
	

	$("#add_res").validate({
						   
	rules:{
        ms_mensagem:{required: true, minlength: 15}
				},
				
        messages:{
        ms_mensagem:{required: "Digite sua mensagem", minlength: "Mensagem muito curta, minímo 15 caracteres"}
         	},						   
   });
   
    $("#Alterar").validate({
						   
	rules:{
        Usuario:{required:true, minlength: 5},
        login:{required:true, minlength: 5},
        email:{required: true, email:true}
				},
				
        messages:{
        Usuario:{required:"Encha o campo nome", minlength: "Minimo 5 caracteres" },
	login:{required:"Encha o campo login", minlength: "Minimo 5 caracteres" },
	email:{required: "Encha o campo e-mail", email: "Informe um email válido"}
         	},						   
   });
  
   $("#senha").validate({
						   
	rules:{
        Senha:{required:true, minlength: 5}
        
				},
				
        messages:{
        Senha:{required:"Encha o campo senha", minlength: "Minimo 5 caracteres" }
	
         	},						   
   });
  
  
  
})