$(document).ready(function(){
	

	$("#solicitar").validate({
						   
	rules:{
        assunto:{required:true, minlength: 5},
        ms:{required: true, minlength: 15}
				},
				
        messages:{
        assunto:{required: "Digite o assunto", minlength: "Minimo 5 caracteres"},
        ms:{required: "Digite sua mensagem", minlength: "Mensagem muito curta, minímo 15 caracteres"}
         	},						   
   });
  
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
  
  
   $("#Alterar2").validate({
						   
	rules:{
        Usuario:{required:true, minlength: 5},
        login:{required:true, minlength: 5},
        email:{required: true, email:true}
      			},
				
        messages:{
        Usuario:{required:"Encha o campo nome", minlength: "Minimo 5 caracteres" },
	login:{required:"Encha o campo login", minlength: "Minimo 5 caracteres" },
	email:{required: "Encha o campo e-mail", email: "Informe um email válido"},
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
   
   
   $("#registro").validate({
						   
	rules:{
        Dt_Execucao:{required: true, minlength:10, maxlength:10},
        Nr_Processo:{required:true, minlength: 5},
        Cliente:{required:true, minlength: 5}
    },
				
        messages:{
        Dt_Execucao:{required: "Encha o campo Data Execução", minlength: "Deve ter exatamente 10 Caracteres ex: 2014-01-28", maxlength: "Deve ter exatamente 10 Caracteres ex: 2014-01-28"},
	Nr_Processo:{required:"Encha o campo Processo", minlength: "Minimo 5 caracteres" },
	Cliente:{required: "Encha o campo Cleinte", minlength: "Minimo 5 caracteres"}
         	},						   
   });
  
  $("#caixa2").validate({
						   
	rules:{
        caixa:{required: true, minlength:9, maxlength:9},
        prateleira:{required: true, minlength:7, maxlength:7}
        
    },
				
        messages:{
        caixa:{required: "Encha o campo Caixa", minlength: "Deve ter exatamente 9 Caracteres ex: 201401076", maxlength: "Deve ter exatamente 9 Caracteres ex: 201401076"},    
        prateleira:{required: "Encha o campo Prateleira", minlength: "Deve ter exatamente 7 Caracteres ex: IAB-V-2", maxlength: "Deve ter exatamente 7 Caracteres ex: IAB-V-2"}
       
	 	},						   
   });
  
  
  $("#caixa").validate({
						   
	rules:{
        prateleira:{required: true, minlength:7, maxlength:7}
        
    },
				
        messages:{
        prateleira:{required: "Encha o campo Prateleira", minlength: "Deve ter exatamente 7 Caracteres ex: IAB-V-2", maxlength: "Deve ter exatamente 7 Caracteres ex: IAB-V-2"}
        
	 	},						   
   });
  
  
})