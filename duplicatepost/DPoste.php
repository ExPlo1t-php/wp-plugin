<?php
    /*
        Plugin Name: duplicate post
        Plugin URI: https://wordpress.com
        Description: Permet de dupliquer les articles de WordPress !
        Version: 0.1
        Author: DPost .inc
        Author URI: https://wordpress.com
    */
    use Duplicatepost\DuplicatePost\DPostPlugin;
    if ( ! defined( 'ABSPATH' ) ) 
        exit;

     define('DPost_PLUGIN_DIR', plugin_dir_path(__FILE__));

    require DPost_PLUGIN_DIR . 'vendor/autoload.php';
 
    $plugin = new DPostPlugin(__FILE__);