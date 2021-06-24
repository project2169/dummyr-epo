<?php
/**
 * @file
 * This file is for adding custom posts functions of theme.
 * 
 * @category  Post
 * @package   Posts
 * @author    Smit <smit.rathod@gmail.com>
 * @copyright 2021 Smit
 * @license   GNU General Public License version 2 or later; see LICENSE
 * @link      http://arch.local/
 */
add_theme_support('post-thumbnails');
add_post_type_support('project', 'thumbnail');
set_post_thumbnail_size(300, 560);
/**
 * This function is for registering custom post type Project.
 * 
 * @return void
 */
function Arch_Site_Custom_post()
{
    
    // for book post type
    register_post_type(
        'project', array(
        'supports'=>array('title', 'editor', 'excerpt', 'custom-fields'),
        'public'=>true,
        'labels'=>array('name'=>'projects', 'add_new_item'=>'Add New project', 'edit_item'=>'Edit project', 'singular_name'=>'project'),
        'taxonomies'=> array( 'category' ),
        'menu_icon'=>'dashicons-list-view'
        )
    );
}

add_action('init', 'Arch_Site_Custom_post');


/**
 * This function is for adding custom meta box.
 * 
 * @return void
 */
function Custom_metabox()
{
 
    add_meta_box( 
        'title-metabox',
        'Visibility option',
        'Title_Custom_Metabox_callback',
        'project',
        'advanced'
    );
}
 
add_action('add_meta_boxes', 'Custom_metabox');
 
/**
 * This function is for adding html fields in custom meta box.
 * 
 * @return void
 */
function Title_Custom_Metabox_callback()
{
     
    global $post;
     
    ?>
 
    <div class="row">
        <p>Only checked items will be visible.</p>
        <div class="fields">
            <input type="checkbox" id="title_box" name="title_box" value="title">
            <label for="title_box"> Title </label><br>
            <input type="checkbox" id="desc_box" name="desc_box" value="desc">
            <label for="desc_box"> Description </label><br>
            <input type="checkbox" id="date_box" name="date_box" value="date">
            <label for="date_box"> Date </label><br>
            <input type="checkbox" id="img_box" name="img_box" value="img">
            <label for="img_box"> Image </label><br>
        </div>
    </div>
 
    <?php
 
}
/**
 * This function is for saving custom meta box fields values.
 * 
 * @return void
 */
function Title_Save_Custom_metabox()
{
 
    global $post;
 
    if(isset($_POST["title_box"])) :
         
        update_post_meta($post->ID, 'title_preview', $_POST["title_box"]);
     
    endif;
    if(isset($_POST["desc_box"])) :
         
        update_post_meta($post->ID, 'desc_preview', $_POST["desc_box"]);
     
    endif;
    if(isset($_POST["date_box"])) :
         
        update_post_meta($post->ID, 'date_preview', $_POST["date_box"]);
     
    endif;
    if(isset($_POST["img_box"])) :
         
        update_post_meta($post->ID, 'img_preview', $_POST["img_box"]);
     
    endif;
}
 
add_action('save_post', 'Title_Save_Custom_metabox');
