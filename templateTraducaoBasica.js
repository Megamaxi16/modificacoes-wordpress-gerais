if(document.body.classList.contains("classe_específica_do_tipo_de_pagina_desejado")){
		
    elementosEmIngles = document.querySelectorAll(".classe_especifica_do_elemento_a_ser_traduzido");
    
    elementosEmIngles.forEach (elementoUnicoIngles =>{
        
        if(elementoUnicoIngles.textContent.includes("texto em inglês a ser substituido")){
            
            elementoUnicoIngles.textContent = elementoUnicoIngles.textContent.replace("texto em inglês a ser substituido", "Empresa");
        }
    });
}