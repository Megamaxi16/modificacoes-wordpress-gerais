        //Esse código muda os links de paginas do woocommerce para links das páginas feitas do 0
        const hrefs = document.querySelectorAll('a');
        let contador = 0;
        hrefs.forEach(link =>{

        if(link.href.includes('prd-hdm')){
            var linkNovo = link.href.replace('prd-hdm/', 'produtos/');
            link.href = linkNovo;
            console.log(link.href);
        }
        });

        //esse código elimina o modal e o ajax
        var lista = document.querySelectorAll('ul.products.columns-4 li a');
        var linkProduto;
        lista.forEach(itensLista =>{

            //essa parte muda o link do botão do hover
            if(!itensLista.href.includes('?add-to-') && itensLista.parentElement.classList.contains('product-header')){
                linkProduto = itensLista.href;
            }

            else if(itensLista.href.includes('?add-to-') && itensLista.closest('.product-header .buttons')) {
                itensLista.href = linkProduto;
            }

            //elimina o modal
            itensLista.classList.remove('woocommerce-LoopProduct-link');
            itensLista.classList.remove('woocommerce-loop-product__link');

            //elimina o ajax
            itensLista.classList.remove('ajax_add_to_cart');
        
            if(itensLista.href.includes('?add-to-cart')){
                itens.lista.href = ''; 
            }
        });