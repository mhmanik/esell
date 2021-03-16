<?php
if (!class_exists('wooc_Settings_API')):
    class wooc_Settings_API
    {

        private $settings_api;

        public function __construct()
        {
            $this->settings_api = new WeDevs_Settings_API;

            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_menu', array($this, 'admin_menu'));
        }


        public function admin_init()
        {

            //set the settings
            $this->settings_api->set_sections($this->get_settings_sections());
            $this->settings_api->set_fields($this->get_settings_fields());

            //initialize settings
            $this->settings_api->admin_init();
            /**
             * If not, return the standard settings
             **/

        }

        public function admin_menu()
        {
            // add_options_page( 'Settings API', 'Settings API', 'delete_posts', 'settings_api_test',  );
            add_submenu_page('woocommerce', 'Gallery Settings', 'Gallery Settings', 'delete_posts', 'wooc_options', array($this, 'wooc_plugin_page'));
        }

        public function get_settings_sections()
        {
            $sections = array(
                array(
                    'id' => 'wooc_settings',
                    'title' => __('Product Gallery Slider for WooCommerce Settings', 'wooc'),
                ),

            );
            return $sections;
        }

        /**
         * Returns all the settings fields
         *
         * @return array settings fields
         */
        public function get_settings_fields()
        {
            $settings_fields = array(
                'wooc_settings' => array(
                    array(
                        'name' => 'navIcon',
                        'label' => __('Navigation Icons', 'wooc'),
                        'desc' => __('Show Navigation icons. Default: Yes', 'wooc'),
                        'type' => 'select',
                        'default' => 'true',
                        'options' => array(
                            'true' => 'Yes',
                            'false' => 'No',
                        ),
                    ),
                    array(
                        'name' => 'navVertical',
                        'label' => __('Navigation Vertical Icons', 'wooc'),
                        'desc' => __('Show Vertical Navigation. Default: No', 'wooc'),
                        'type' => 'select',
                        'default' => 'false',
                        'options' => array(
                            'true' => 'Yes',
                            'false' => 'No',
                        ),
                    ),
                    array(
                        'name' => 'navPosition',
                        'label' => __('Navigation Position', 'wooc'),
                        'desc' => __('Show Vertical Navigation. Default: No', 'wooc'),
                        'type' => 'select',
                        'default' => 'left',
                        'options' => array(
                            'left' => 'Left',
                            'right' => 'Right',
                        ),
                    ),
                    array(
                        'name' => 'navColor',
                        'label' => __('Icon Color', 'wooc'),
                        'desc' => __('', 'wooc'),
                        'type' => 'color',
                        'default' => '',
                    ),
                    array(
                        'name' => 'thubms',
                        'label' => __('Thumbnails to Show', 'wooc'),
                        'desc' => __('Default: 4', 'wooc'),

                        'type' => 'text',
                        'default' => '4',
                        'sanitize_callback' => 'sanitize_text_field',
                    ),
                    array(
                        'name' => 'autoPlay',
                        'label' => __('Auto Play', 'wooc'),
                        'desc' => __('Default: No', 'wooc'),
                        'type' => 'select',
                        'default' => 'false',
                        'options' => array(
                            'true' => 'Yes',
                            'false' => 'No',
                        ),
                    ),
                    array(
                        'name' => 'Lightboxframewidth',
                        'label' => __('Lightbox Frame Width ', 'wooc'),
                        'desc' => __('Default: 600 px', 'wooc'),

                        'type' => 'text',
                        'default' => '600',
                        'sanitize_callback' => 'sanitize_text_field',
                    ),
                    array(
                        'name' => 'caption',
                        'label' => __('Lightbox Caption', 'wooc'),
                        'desc' => __('Show Image Attributes as caption in this Lightbox', 'wooc'),
                        'type' => 'select',
                        'default' => 'false',
                        'options' => array(
                            'true' => 'Yes',
                            'false' => 'No',
                        ),
                    ),


                ),
            );

            return $settings_fields;
        }

        public function wooc_plugin_page()
        {
            echo '<div class="wrap">';

            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
            ?>
            </div>
            <?php
        }

        /**
         * Get all the pages
         *
         * @return array page names with key value pairs
         */
        public function get_pages()
        {
            $pages = get_pages();
            $pages_options = array();
            if ($pages) {
                foreach ($pages as $page) {
                    $pages_options[$page->ID] = $page->post_title;
                }
            }

            return $pages_options;
        }

    }
endif;
