<?php
/*
 Plugin Name: Debug Bar ACF
 Author: Marc Neuhaus
 Version: 0.1
 */


add_action('debug_bar_panels', 'debug_bar_acf');

function debug_bar_acf( $panels ) {
    require_once 'class-debug-bar-acf.php';
    $panels[] = new Debug_Bar_Acf();
    return $panels;
}
