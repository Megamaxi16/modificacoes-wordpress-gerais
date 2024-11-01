<?php 



?>

<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title"><div class="comments-title">Escreva sua Avaliação</div> <small><a rel="nofollow" id="cancel-comment-reply-link" href="/vaga/clinicas-queromed/#respond" style="display:none;">Cancelar resposta</a></small></h3><form action="https://missaosa.com.br/wp-comments-post.php" method="post" id="commentform" class="comment-form">
	 	<div id="lt-comment-reviews" class="lt-comment-reviews">
			<div class="comment-reviews-content">
            <div class="comment-reviews-inner clearfix">
   			  	      				<div class="review-item">
      					<label>Quality</label>
      					<div class="stars select-review" data-review-key="quality">
      						<span data-star="5" class="star dashicons dashicons-star-filled active"></span>
      						<span data-star="4" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="3" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="2" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="1" class="star dashicons dashicons-star-filled"></span>
      					  <input type="hidden" class="lt-review-val" id="lt-review-quality-val" required="required" name="lt_review[quality]" value="5">
      					</div>
      				</div>
   			        				<div class="review-item">
      					<label>Hospitality</label>
      					<div class="stars select-review" data-review-key="hospitality">
      						<span data-star="5" class="star dashicons dashicons-star-filled active"></span>
      						<span data-star="4" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="3" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="2" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="1" class="star dashicons dashicons-star-filled"></span>
      					  <input type="hidden" class="lt-review-val" id="lt-review-hospitality-val" required="required" name="lt_review[hospitality]" value="5">
      					</div>
      				</div>
   			        				<div class="review-item">
      					<label>Service</label>
      					<div class="stars select-review" data-review-key="service">
      						<span data-star="5" class="star dashicons dashicons-star-filled active"></span>
      						<span data-star="4" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="3" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="2" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="1" class="star dashicons dashicons-star-filled"></span>
      					  <input type="hidden" class="lt-review-val" id="lt-review-service-val" required="required" name="lt_review[service]" value="5">
      					</div>
      				</div>
   			        				<div class="review-item">
      					<label>Pricing</label>
      					<div class="stars select-review" data-review-key="price">
      						<span data-star="5" class="star dashicons dashicons-star-filled active"></span>
      						<span data-star="4" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="3" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="2" class="star dashicons dashicons-star-filled"></span>
      						<span data-star="1" class="star dashicons dashicons-star-filled"></span>
      					  <input type="hidden" class="lt-review-val" id="lt-review-price-val" required="required" name="lt_review[price]" value="5">
      					</div>
      				</div>
   			     			</div>
            <div class="avg-total-tmp">
               <span class="value">5.00</span>
               <span class="avg-title">Média de Estrelas</span>
            </div>
         </div>   
	 	</div>

<div class="form-group"><textarea placeholder="Adicione um Comentário" rows="5" id="comment" class="form-control" name="comment" aria-required="true"></textarea></div><p class="form-submit"><input name="submit" type="submit" id="submit" class="btn " value="Enviar"> <input type="hidden" name="comment_post_ID" value="1605" id="comment_post_ID">
<input type="hidden" name="comment_parent" id="comment_parent" value="0">
</p><input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment_disabled" value="0d471076e6"><script type="text/javascript">
/* <![CDATA[ */
(function(){if(window===window.parent){document.getElementById('_wp_unfiltered_html_comment_disabled').name='_wp_unfiltered_html_comment';}})();
/* ]]&gt; */
</script>
</form>	</div>

<script>
    if(document.querySelector(".job_listing-template-default")){
    
        let labels = document.querySelectorAll(".comment-reviews-inner.clearfix label");
        labels.foreach( categoria =>{

            switch (categoria.innerHTML) {

                case "Quality":
                    categoria.innerHTML = "Qualidade";
				break;
				case "Hospitality":
					categoria.innerHTML = "Hospitality";
				break;
				case "Service":
				categoria.innerHTML = "Serviço";
				break;
				case "Pricing":
				categoria.innerHTML = "Preço";
				break;
            }

        });
    }

    
</script>