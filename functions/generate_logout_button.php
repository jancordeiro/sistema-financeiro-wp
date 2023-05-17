<?php // REMOVER ESSA LINHA AO ADICIONAR EM FUNCTIONS.PHP

/*
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

// FIM DO BOTÃO E SHORTCODE LOGOUT

/*
 * Usar shortcode [logout_button] para inserir o botão de Logout
 */
