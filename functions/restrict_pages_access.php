<?php // REMOVER ESSA LINHA AO ADICIONAR NO FUNCTIONS.PHP

/*
 * VERIFICAR SE ESTA LOGADO PRA ACESSAR A DASHBOARD
 * SE NÃO ESTIVER SERÁ REDIRECIONADO PARA HOME
 */

function restrict_pages_access() {
    // Verifica se a página atual é a "dashboard", "nova-conta-a-pagar" ou "nova-conta-a-receber"
    if (is_page('dashboard') || is_page('nova-conta-a-pagar') || is_page('nova-conta-a-receber')) {
        // Verifica se o usuário não está logado
        if (!is_user_logged_in()) {
            // Redireciona para a página inicial
            wp_redirect(home_url());
            exit;
        } else {
        // Redireciona o usuário para a página "dashboard" se estiver logado
        wp_redirect('dashboard');
        exit;
		}
    }
}
add_action('template_redirect', 'restrict_pages_access');

// FIM DO SCRIPT DA VERIFICAÇÃO DE LOGIN
