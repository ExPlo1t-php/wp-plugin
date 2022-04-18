<?php
    namespace Duplicatepost\DuplicatePost\Controller;
    use Duplicatepost\DuplicatePost\DPostPlugin;

    class AdminController{
        const REDIRECT_TO_LIST = 0;
        const REDIRECT_TO_EDIT = 1;
        public function  __construct()
        {
            $this->init_hooks();
        }

        public function init_hooks():void
        {
            add_action('admin_menu', [$this, 'admin_menu']);
            add_action('admin_init', [$this, 'admin_init']);
            add_action('post_row_actions', [$this, 'duplicate_post_actions', 10, 2]);
        }

        public function admin_menu():void
        {
            add_options_page("Duplicate Post", "Duplicate Post", "manage_options", "duplicate-post", [$this, 'config_page']);
        }

        public function config_page():void{
            DPostPlugin::render('config');
            
        }

        public function admin_init():void{
            register_setting('general', 'dupliccate_post_general');
            add_settings_section('duplicate_post_main', null, null, 'duplicate_post');
            add_settings_field('redirect_to', 'rediger vers apres avoir clique sur <strong>dupliquer</strong>', [$this, 'redirect_to_render'], 'duplicate_post', 'duplicate_post_main');
        }

        public function redirect_to_render():void{
            $general_options = get_option("duplicate_post_general", ['redirect_to'=>0]);
            $selectedValue = $general_options['redirect_to'];
            ?>
                <select name="duplicate_post_general[redirect_to]">
                    <option value="<?=  self::REDIRECT_TO_LIST?>" <?= selected(self::REDIRECT_TO_LIST, $selectedValue)?>>vers la liste des articles</option>
                    <option value="<?=  self::REDIRECT_TO_EDIt?>" <?= selected( self::REDIRECT_TO_EDIT, $selectedValue)?>>vers  l'ecran de modification de l'article duplique</option>
                </select>
            <?php
        }

        public function duplicate_post_actions(array $actions, \WP_Post $post):array{
            if(current_user_can('edit_posts')){
                $post_id = $post->ID;
                $actions['duplicat_post']= '<a href="admin.php?post=$post_id&action="duplicate">dupliquer</a>';
                return $actions;
            }
        }

    }