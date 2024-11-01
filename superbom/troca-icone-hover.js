    const header = document.getElementById('masthead');
    header.addEventListener('mouseover', trocaImagem);
    header.addEventListener('mouseout', voltaImagem);

    function trocaImagem(){
        const logo = header.querySelectorAll('.site-branding a img');
        logo.forEach(imagem =>{
        imagem.src = "https://novo.superbom.com.br/wp-content/uploads/2024/10/rumo-aos-100-logo_BLACK_.png";
        })
    }

    function voltaImagem(){
        const logo = header.querySelectorAll('.site-branding a img');
        logo.forEach(imagem =>{
            imagem.src = "https://novo.superbom.com.br/wp-content/uploads/2024/10/rumo-aos-100-logo_WHITE_.png";
        })
    }
