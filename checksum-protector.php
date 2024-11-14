<?php
/*
 * Plugin Name:       Checksum Protector
 * Description:       Cria uma API pública. Esta API recebe o checksum referente à rota de uma página. Se for igual, ele retorna '{"health":"OK"}', se for diferente: retorna '{"health":"CORRUPTED"}'
 * Version:           1.0.0
 * Author:            Guilherme Salomao Agostini
 */

// Some com a barra o admin... Só para testar.
 add_filter('show_admin_bar', '__return_false');

// Retorna literalmente um JSON... na rota https://wordpress-1267825-4788253.cloudwaysapps.com/wp-json/no-cache/v1/home

 add_action('rest_api_init', function() {
    register_rest_route('/no-cache/v1', '/home', [
        'methods' => 'GET',
        'callback' => 'serve_no_cache_page',
        'permission_callback' => '__return_true',
    ]);
});

function serve_no_cache_page() {
    header("Cache-Control: no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header('Content-Type: text/html') ;
    echo '<h1>Hello World</h1>';
    exit();
}

// Serve um HTML pela REST API... Porém por esse caminho teria que implementar um BFF, ou, um Cachê Busting alterando as versões dos recursos dinamicamente.
// Aparentemente o Breeze oferece um comando para limpeza do cachê... Vou testar esse caminho.