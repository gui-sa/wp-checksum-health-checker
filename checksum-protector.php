<?php
/*
 * Plugin Name:       Checksum Protector
 * Description:       Cria uma API pública. Esta API recebe o checksum referente à rota de uma página. Se for igual, ele retorna '{"health":"OK"}', se for diferente: retorna '{"health":"CORRUPTED"}'
 * Version:           1.0.0
 * Author:            Guilherme Salomao Agostini
 */

 add_filter('show_admin_bar', '__return_false');