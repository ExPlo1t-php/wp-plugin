<?php
    namespace Duplicatepost\DuplicatePost\Controller;

    class AdminController{

        public function  __construct()
        {
            $this->init_hooks();
        }

        public function init_hooks()
        {
            add_action('admin_menu', [$this, 'admin_menu']);
        }

        public function admin_menu()
        {
            add_options_page("Duplicate Post", "DPost", "manage_options", "duplicate-post");
        }

    }