<?php // <<-- REMOVER ESSA LINHA AO ADICIONAR NO FUNCTIONS.PHP

/* 
 * SCRIPT PRA CRIAR SHORTCODE's E FILTRO DE POSTAGENS
 */

function display_custom_posts($atts) {
    $atts = shortcode_atts( array(
        'post_type' => 'contas_a_pagar', 
    ), $atts );

    $args = array(
        'post_type' => $atts['post_type'],
        'posts_per_page' => -1,
        'author' => get_current_user_id()
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        // $output = '<div class="shortcode" style="color: white;"><ul>';

        while ($query->have_posts()) {
            $query->the_post();
            $titulo = get_the_title();
            $data = get_field('data_da_conta');
			      $description = get_field('descricao_da_conta');
            $valor = get_field('valor_da_conta');
			      $permalink = get_permalink();
			
            $output .= '<div class="shortcode" style="color: white;"><ul><li>';
            $output .= '<strong>Título:</strong> <a href="' . $permalink . '">' . $titulo . '</a><br>';
            $output .= '<strong>Data:</strong> ' . $data . '<br>';
            $output .= '<strong>Valor:</strong> ' . $valor . '<br>';
            $output .= '<strong>Descrição:</strong> ' . $description . '<br>';
            $output .= '</li><br></div>';
        }

        $output .= '</ul>';

        wp_reset_postdata();

        return $output;
    }

    return '<p style="color: white;">Nenhum post encontrado.</p>';
}

function register_custom_shortcodes() {
    add_shortcode('contas_a_pagar', 'display_custom_posts');
    add_shortcode('contas_a_receber', 'display_custom_posts');
}
add_action('init', 'register_custom_shortcodes');

// FIM DO SCRIPT

/* 
 *
 * Para mostrar "Contas a Pagar" usar shortcode [contas_a_pagar]
 * Para mostrar "Contas a Receber" usar shortcode [contas_a_receber post_type='contas_a_receber']
 *
 */
