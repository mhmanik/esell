<?php
/**
 * @author  AxilTheme
 * @since   1.0
 * @version 1.0
 */

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
?>

  <div class="tab-plans-wrapper tab-layout-2"> 
    <div class="row">    
    <div class="col-lg-4 col-12"> 
      <ul class="nav tab-nav tab-swipe" id="nav-tab" role="tablist">
        <?php
            $i = "";
            $j = "";
            $i == 1;     
            foreach ( $settings['library_tab_items'] as $library_tab_item ): 
            $tab_nav       = $library_tab_item['tab_nav'];  
            $i++;
            $nav_link =  $i==1 ? 'isActive active': null;
        ?>
      <li>
        <a class="tabnav <?php echo esc_attr( $nav_link );?>" id="basicPlan-<?php echo esc_attr( $i );?>" data-toggle="tab" href="#tab_link_<?php echo esc_attr( $i );?>" role="tab" aria-controls="basicPlan" aria-selected="true">        
          <div class="wooc-icon-wrp media layout-2 layout-<?php echo wp_kses_post( $library_tab_item['colortype'] );?>">   
            <?php if ( $library_tab_item['icontype'] == 'image' ): ?>
              <div class="img-box">
                <?php echo wp_get_attachment_image( $library_tab_item['image']['id'], 'full' );?>                
               </div>
              <?php else: ?>
              <div class="feature-icon">
                <?php Icons_Manager::render_icon( $library_tab_item['icon'] ); ?>
              </div>
            <?php endif; ?> 
            <div class="wooc-content-area media-body">
              <div class="wooc-content">                
                <?php if ( $library_tab_item['title'] ): ?>
                  <h2 class="wooc-title"><?php echo wp_kses_post( $library_tab_item['title'] );?></h2>
                <?php endif; ?>   
                <?php if ( $library_tab_item['subtitle'] ): ?>
                  <span class="wooc-subtitle"><?php echo wp_kses_post( $library_tab_item['subtitle'] );?></span>
                <?php endif; ?>                
              </div>
            </div>      
          </div>
        </a>
      </li>
        <?php  endforeach;?>
    </ul>
    </div>
      <div class="col-lg-8 col-12"> 
          <div class="tab-content" id="nav-tabContent">
          <?php 
          $j == 1; 
          foreach ( $settings['library_tab_items'] as $elementor_library ):
            $j++;
            $library_elementor_library = $elementor_library['library_tab_library'];              
            $tabpanel =  $j==1 ? 'active show': null;
            ?>  
              <div class="tab-pane <?php echo esc_attr($tabpanel);?>" id="tab_link_<?php echo esc_attr( $j );?>" aria-labelledby="basicPlan-tab">
                  <?php echo $content_1 = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $library_elementor_library ) ;?>
            </div>
          <?php  endforeach;?>
          </div> 
      </div>
    </div>
  </div>