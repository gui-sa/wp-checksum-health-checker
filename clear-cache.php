<?php
/*
 * Plugin Name:       External Cache Cleaner Trigger
 * Description:       Cria uma API pública que ao receber um chamado: limpa o cache das página.
 * Version:           1.0.0
 * Author:            Guilherme Salomao Agostini
 * Requires Plugins:  breeze
 */

// Some com a barra o admin... Só para testar.
 add_filter('show_admin_bar', '__return_false');

// Retorna literalmente um JSON... na rota https://wordpress-1267825-4788253.cloudwaysapps.com/wp-json/no-cache/v1/clear-cache

 add_action('rest_api_init', function() {
    register_rest_route('/no-cache/v1', '/clear-cache', [
        'methods' => 'GET',
        'callback' => 'clear_cache',
        'permission_callback' => '__return_true',
    ]);
});

function clear_cache() {

    try{
        do_action('breeze_clear_all_cache');
        header("Cache-Control: no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        return [
            'event' => 'cleared',
            'timestamp' => time(),
        ];
    } catch (Exception $e){
        header("Cache-Control: no-cache, must-revalidate, max-age=0");
        header("Pragma: no-cache");
        return [
            'event' => 'passed',
        ];  
    }

}

// Serve um HTML pela REST API... Porém por esse caminho teria que implementar um BFF, ou, um Cachê Busting alterando as versões dos recursos dinamicamente.
// Aparentemente o Breeze oferece um comando para limpeza do cachê... Vou testar esse caminho.