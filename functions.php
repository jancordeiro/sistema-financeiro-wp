<?php
// REMOVER DESSA LINHA PARA CIMA PARA RETIRAR A TAG <?php AO ADICIONAR NO ARQUIVO 'functions.php' no seu WordPress 

/* 
 * SCRIPT PRA CRIAR SHORTCODE's E FILTRO DE POSTAGENS
 * 
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
        $output = '<div style="color: white;"><ul>';

        while ($query->have_posts()) {
            $query->the_post();
            $titulo = get_the_title();
            $data = get_field('descricao_da_conta');
			$description = get_field('data_da_conta');
            $valor = get_field('valor_da_conta');
			$permalink = get_permalink();
			
            $output .= '<li>';
            $output .= '<strong>Título:</strong> <a href="' . $permalink . '">' . $titulo . '</a><br>';
            $output .= '<strong>Data:</strong> ' . $data . '<br>';
            $output .= '<strong>Valor:</strong> ' . $valor . '<br>';
			$output .= '<strong>Descrição:</strong> ' . $description . '<br>';
			$output .= '</li></div>';
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

// FIM DO SCRIPT QUE CRIA SHORTCODEs E FILTRO DE POSTAGEM

/*
 * VERIFICAR SE ESTA LOGADO E REDIRECIONA
 * A função 'is_page' verifica se está logado para acessar as páginas;
 * Se não estiver logado, é redirecionado pra home. 
 */

function restrict_dashboard_access() {
    // Verifica se a página atual é a "dashboard", "nova-conta-a-pagar" ou "nova-conta-a-receber"
    if (is_page('dashboard') || is_page('nova-conta-a-pagar') || is_page('nova-conta-a-receber')) {
        // Verifica se o usuário não está logado
        if (!is_user_logged_in()) {
            // Redireciona para a página inicial
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('template_redirect', 'restrict_dashboard_access');

// FIM DO SCRIPT DA VERIFICAÇÃO DE LOGIN

/*
 * 
 * CRIAR BOTÃO DE LOGOUT
 */

function generate_logout_button() {
    // Verifica se o usuário está logado
    if (is_user_logged_in()) {
        // Obtém o link da página inicial
        $home_url = home_url('/');

        // Cria o botão de logout redirecionando para a página inicial
        $logout_url = wp_logout_url($home_url);

        // Retorna o HTML do botão de logout
        return '<div class="logout-button"><a class="logout-btn" href="' . $logout_url . '"><i aria-hidden="true" class="fas fa-sign-out-alt"></i> Logout (Sair)</a></div>';
    }
}

// CRIA O SHORTCODE PARA INVOCAR O BOTÃO

function logout_button_shortcode() {
    return generate_logout_button();
}
add_shortcode('logout_button', 'logout_button_shortcode');

// FIM DO BOTÃO E SHORTCODE SAIR/LOGOUT
