<?php
/**
 * @author  Axilweb
 * @since   1.0
 * @version 1.0
 * @package blogar
 */


class Sidebar_Generator {
    public $prefix = 'axil_';
    public $option_name = null;
    public $base_url = null;
    public $version = '1.0.0';
    public function __construct() {
        $this->option_name = $this->prefix . '_custom_sidebars';
        $this->base_url = $this->get_base_url(). '/';
        add_action( 'sidebar_admin_page', array( $this, 'sidebar_form' ) );
        add_action( 'init' , array( $this, 'register_sidebars' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
        add_action( 'wp_ajax_axil_add_sidebar' , array( $this, 'ajax_add_sidebar' ) );
        add_action( 'wp_ajax_axil_remove_sidebar', array( $this, 'ajax_remove_sidebar' ) );
    }
    private function get_base_url(){
        $file = dirname( dirname(__FILE__) );
        // Get correct URL and path to wp-content
        $content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
        $content_dir = untrailingslashit( WP_CONTENT_DIR );
        // Fix path on Windows
        $file = wp_normalize_path( $file );
        $content_dir = wp_normalize_path( $content_dir );
        $url = str_replace( $content_dir, $content_url, $file );
        return $url;
    }

    public function sidebar_form() {
        ?>
        <div class="widgets-holder-wrap">
            <div id="axil-new-sidebar" class="widgets-sortables">
                <div class="sidebar-name">
                    <div class="sidebar-name-arrow"></div>
                    <h2><?php esc_html_e( 'Add New Sidebar', 'blogar' ); ?><span class="spinner"></span></h2>
                </div>
                <div class="sidebar-description">
                    <form style="padding:0 7px;" method="POST" action="<?php echo esc_url( admin_url( 'admin-ajax.php?action=axil_add_sidebar' ) );?>">
                        <?php wp_nonce_field( 'axil_add_sidebar' ); ?>
                        <table class="form-table">
                            <tr>
                                <th scope="row"><?php esc_html_e( 'Name', 'blogar' ) ?></th>
                                <td><input type="text" class="text" name="name" value=""></td>
                                <td><input type="submit" class="button-primary" value="<?php esc_html_e( 'Add New', 'blogar' ) ?>"></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    public function register_sidebars() {
        $sidebars = get_option( $this->option_name, array() );

        if ( !$sidebars ) {
            return;
        }

        foreach ( $sidebars as $sidebar ) {
            register_sidebar( $sidebar );
        }
    }

    public function load_scripts() {
        $screen = get_current_screen();

        if ( $screen->id != 'widgets' ) return;
        wp_enqueue_script('admin-sidebar-generator', $this->base_url . 'assets/js/admin-sidebar-generator.js', array('jquery'), $this->version );


        $localize_data = array(
            'confirm'  => esc_html__( 'Are you sure you want to remove this custom sidebar', 'blogar' ),
            'failed'   => esc_html__( 'Operation failed' , 'blogar' ),
            'ajaxurl'  => admin_url( 'admin-ajax.php?action=axil_remove_sidebar' ),
            'nonce'    => wp_create_nonce( 'axil_remove_sidebar' ),
        );

        wp_localize_script( 'admin-sidebar-generator', 'axilSidebarObj', $localize_data );
    }

    public function ajax_add_sidebar() {
        $name  = isset( $_REQUEST['name'] ) ? sanitize_text_field( $_REQUEST['name'] ) : null;
        $nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : null;

        if ( empty( $name ) ) {
            wp_send_json_error( esc_html__( "Sidebar name can't be empty", 'blogar' ) );
        }
        if ( empty( $nonce ) ) {
            wp_send_json_error( esc_html__( 'Empty nonce', 'blogar' ) );
        }
        if ( ! wp_verify_nonce( $nonce, 'axil_add_sidebar' ) ) {
            wp_send_json_error( esc_html__( 'Invalid nonce', 'blogar' ) );
        }

        $id = 'axil-sidebar-' . sanitize_title( $name );
        $sidebars = get_option( $this->option_name, array() );

        if ( array_key_exists( $id, $sidebars ) ) {
            wp_send_json_error( esc_html__( 'Sidebar with the same name already exists. Please choose a different name', 'blogar' ) );
        }

        $sidebars[$id] = array(
            'id'             => $id,
            'name'           => $name,
            'class'          => 'axil-custom',
            'description'    => '',
            'before_widget'  => '<div class="%1$s widget-sidebar widget %2$s widgets-sidebar">',
            'after_widget'   => '</div>',
            'before_title'  => '<div class="widget-title"><h3>',
            'after_title'   => '</h3></div>',
        );

        update_option( $this->option_name, $sidebars );

        if ( ! function_exists( 'wp_list_widget_controls' ) ) {
            include_once ABSPATH . 'wp-admin/includes/widgets.php';
        }

        ob_start();
        ?>
        <div class="widgets-holder-wrap sidebar-axil-custom closed">
            <?php wp_list_widget_controls( $id, $name ); ?>
        </div>
        <?php
        wp_send_json_success( ob_get_clean() );
    }

    public function ajax_remove_sidebar() {
        $id    = isset( $_REQUEST['id'] ) ? sanitize_text_field( $_REQUEST['id'] ) : null;
        $nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : null;

        if ( empty( $id ) ) {
            wp_send_json_error( esc_html__( 'Sidebar ID not found', 'blogar' ) );
        }
        if ( empty( $nonce ) ) {
            wp_send_json_error( esc_html__( 'Empty nonce', 'blogar' ) );
        }
        if ( ! wp_verify_nonce( $nonce, 'axil_remove_sidebar' ) ) {
            wp_send_json_error( esc_html__( 'Invalid nonce', 'blogar' ) );
        }

        $sidebars = get_option( $this->option_name, array() );

        unset( $sidebars[ $id ] );

        update_option( $this->option_name, $sidebars );

        wp_send_json_success();
    }
}

new Sidebar_Generator;