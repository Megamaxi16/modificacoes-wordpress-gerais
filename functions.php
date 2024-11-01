<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '3.1.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		if ( apply_filters( 'hello_elementor_register_menus', true ) ) {
			register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-2' => esc_html__( 'Footer', 'hello-elementor' ) ] );
		}

		if ( apply_filters( 'hello_elementor_post_type_support', true ) ) {
			add_post_type_support( 'page', 'excerpt' );
		}

		if ( apply_filters( 'hello_elementor_add_theme_support', true ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);

			/*
			 * Editor Style.
			 */
			add_editor_style( 'classic-editor.css' );

			/*
			 * Gutenberg wide images.
			 */
			add_theme_support( 'align-wide' );

			/*
			 * WooCommerce.
			 */
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', true ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'hello_elementor_display_header_footer' ) ) {
	/**
	 * Check whether to display header footer.
	 *
	 * @return bool
	 */
	function hello_elementor_display_header_footer() {
		$hello_elementor_header_footer = true;

		return apply_filters( 'hello_elementor_header_footer', $hello_elementor_header_footer );
	}
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		$min_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( hello_elementor_display_header_footer() ) {
			wp_enqueue_style(
				'hello-elementor-header-footer',
				get_template_directory_uri() . '/header-footer' . $min_suffix . '.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'hello_elementor_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( ! function_exists( 'hello_elementor_add_description_meta_tag' ) ) {
	/**
	 * Add description meta tag with excerpt text.
	 *
	 * @return void
	 */
	function hello_elementor_add_description_meta_tag() {
		if ( ! apply_filters( 'hello_elementor_description_meta_tag', true ) ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$post = get_queried_object();
		if ( empty( $post->post_excerpt ) ) {
			return;
		}

		echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

// Admin notice
if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

// Settings page
require get_template_directory() . '/includes/settings-functions.php';

// Header & footer styling option, inside Elementor
require get_template_directory() . '/includes/elementor-functions.php';

if ( ! function_exists( 'hello_elementor_customizer' ) ) {
	// Customizer controls
	function hello_elementor_customizer() {
		if ( ! is_customize_preview() ) {
			return;
		}

		if ( ! hello_elementor_display_header_footer() ) {
			return;
		}

		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_elementor_customizer' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check whether to display the page title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * BC:
 * In v2.7.0 the theme removed the `hello_elementor_body_open()` from `header.php` replacing it with `wp_body_open()`.
 * The following code prevents fatal errors in child themes that still use this function.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		wp_body_open();
	}
}


// Cria o shortcode [meu_botao_add_carrinho]
function meu_shortcode_add_ao_carrinho() {
    global $product;

    if ( ! $product ) {
        return '';
    }

    $product_id = $product->get_id();
    $button_text = 'Adicionar ao Carrinho';

    ob_start();
    ?>
    <button type="button" class="button meu-botao-add-carrinho" data-product_id="<?php echo esc_attr( $product_id ); ?>"><?php echo esc_html( $button_text ); ?></button>

    <script type="text/javascript">
    jQuery(document).ready(function($){
        $('.meu-botao-add-carrinho').on('click', function(e){
            e.preventDefault();

			//definir variável de quantidade
			let quantidade = $('input[name="quantity"]').val();

            var $thisbutton = $(this),
                product_id = $thisbutton.data('product_id'),
                quantity = quantidade,
                data = {
                    action: 'meu_add_ao_carrinho',
                    product_id: product_id,
                    quantity: quantity,
                    variation_id: 0,
                    variation: {}
                };

            // Se for um produto variável, obtém os atributos selecionados
            var form = $('form.cart');
            if (form.length) {
                var formData = form.serializeArray();

                $.each(formData, function(i, field){
                    if (field.name.indexOf('attribute_') !== -1) {
                        data.variation[field.name] = field.value;
                    }
                    if (field.name === 'variation_id') {
                        data.variation_id = field.value;
                    }
                });
            }

            // Ajax request
            $.ajax({
                type: 'post',
                url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'meu_add_ao_carrinho' ),
                data: data,
                beforeSend: function(){
                    $thisbutton.removeClass('added').addClass('loading');
                },
                complete: function(){
                    $thisbutton.addClass('added').removeClass('loading');
                },
                success: function(response){
                    if (response.error && response.product_url) {
                        window.location = response.product_url;
                        return;
                    }

                    // Trigger event so themes can refresh other areas
                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);

                    // // Mensagem opcional
                    // alert('Produto adicionado ao carrinho!');
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    });
    </script>
    <?php

    return ob_get_clean();
}
add_shortcode( 'meu_botao_add_carrinho', 'meu_shortcode_add_ao_carrinho' );

// Manipulador AJAX para adicionar ao carrinho
add_action( 'wc_ajax_meu_add_ao_carrinho', 'meu_ajax_add_ao_carrinho' );
add_action( 'wc_ajax_nopriv_meu_add_ao_carrinho', 'meu_ajax_add_ao_carrinho' );

function meu_ajax_add_ao_carrinho() {
    $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );
    $variation_id      = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : 0;
    $variation         = isset( $_POST['variation'] ) ? array_map( 'sanitize_text_field', $_POST['variation'] ) : array();
    $product_status    = get_post_status( $product_id );

    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variation );

    if ( $passed_validation && 'publish' === $product_status && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation ) ) {

        do_action( 'woocommerce_ajax_added_to_cart', $product_id );

        if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
            wc_add_to_cart_message( array( $product_id => $quantity ), true );
        }

        // Retorna os fragmentos atualizados do carrinho
        WC_AJAX::get_refreshed_fragments();
    } else {

        // Redireciona para a página do produto em caso de erro
        $data = array(
            'error'       => true,
            'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id ),
        );

        wp_send_json( $data );
    }
}

function meu_enqueue_scripts() {
    if ( is_product() ) {
        wp_enqueue_script( 'wc-add-to-cart' );
    }
}
add_action( 'wp_enqueue_scripts', 'meu_enqueue_scripts' );

