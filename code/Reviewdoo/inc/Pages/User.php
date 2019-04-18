<?php

/* 
 * Created by Aaron Manning, 2018
 */

namespace Inc\Pages;

use Inc\Base\BaseController;
use Inc\Database\DatabaseAPI;

class User extends BaseController
{
    
    public $posts = array();
    public $instances = array();
    public $comment_counter;

    function __construct() {
        $this->comment_counter = 0;
    }

    public function register(){
         
        add_shortcode( 'rd', array($this,'getPostContent'));
    }

    public function getPostContent($atts = []){

        // normalize attribute keys, lowercase
        $atts = array_change_key_case((array)$atts, CASE_LOWER);
    
        // override default attributes with user attributes
        $atts = shortcode_atts([
            'taxo' => null,
        ], $atts);

        global $postid;
        $postid = get_the_ID();

        // get json data from db
        $databaseQuery = new DatabaseAPI();
        $data = $databaseQuery->getJsonBomb($postid, $atts['taxo'])->json;

        // send the data as an object to front end
        wp_localize_script(
            'rdJsCore',
            'rdJson',
            $data
        );

        // plugin structure
        $rdNodeContent = <<<EOT

<div class="rd-container">
    <div class="rd-header">
        <span class="rd-menu dashicons dashicons-menu"></span>
        <div class="rd-breadcrumb">
        </div>
        <div class="rd-header-button-group">
            <input id="rd-search"></input>
            <button type="button" class="rd-edit rd-button">
                <span class="rd-edit-icon dashicons dashicons-edit"></span>
                <span class="rd-edit-text">Edit</span>
            </button>
            <button type="button" class="rd-cancel rd-button" style="display: none;">
                <span class="rd-done-icon dashicons dashicons-no"></span>
                <span class="rd-done-text">Cancel</span>
            </button>
        </div>
    </div>
    <div class="rd-header">
        <div class="rd-header-button-group rd-header-category-group">
        <select name="category" class="rd-category-select" id="category">
        </select>
        </div>
        <div class="rd-header-rhs">
        <span class="rd-slider-icon dashicons dashicons-admin-users"></span>
            <div class="rd-merge-slider">
                <div class="rd-slider-handle rd-slider-handle-merge ui-slider-handle"></div>
            </div>
            <span class="rd-slider-icon dashicons dashicons-groups"></span>
            <div class="rd-overall-score">
                <span></span>
            </div>
        </div>
    </div>
    <span class="rd-arrow rd-arrow-left dashicons dashicons-arrow-left-alt2"></span>
    <div class="rd-node-area"></div>
    <span class="rd-arrow rd-arrow-right dashicons dashicons-arrow-right-alt2"></span>
</div>

EOT;

        ob_start();
        echo $rdNodeContent;

        if ( post_password_required($postid) ) {
            return;
        }

        // gather comments for a specific page/post 
        $comments = get_comments(array(
            'post_id' => $postid,
            'status' => 'approve' // type of comments to be displayed
        ));

        $comment_count = count($comments);

        echo '<div class="rd-comment-area">';

        // comment form
        echo <<<EOT
        <form style="display: none;" action="/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate="">
        <div class="rd-comment-box">

            <h5>Comment</h5>
            <div class="rd-topic-area">
                <h5 style="display: none;">Topics</h5>
                <ul class="rd-topics">
                </ul>
            </div>
            <textarea id="comment" name="comment" aria-required="true" rows="4" cols="50"></textarea>
         
            <p class="form-submit">
                <input name="submit" class="rd-done" type="submit" id="submit" value="Done">
EOT;
        echo '<input type="hidden" name="comment_post_ID" value="'.$postid.'" id="comment_post_ID">';
        echo '<input type="hidden" name="comment_parent" id="comment_parent" value="0">';
        echo '</p></form></div>';


        if ($comment_count > 0) {
            echo '<ol class="rd-comment-list">';
            // Display the list of comments via template function
            wp_list_comments(array(
                'per_page' => 10,
                'reverse_top_level' => false,
                'type' => 'comment',
                'callback' => array($this,'format_comment')
            ), $comments);
            echo '</ol>';

            echo '<span type="button" id="rd-comment-dropdown">('.($comment_count - 1).') Comment Toggle</span>';

            // If comments are closed and there are comments
            if ( ! comments_open($postid) && get_comments_number($postid) && post_type_supports( get_post_type($postid), 'comments' ) ) {
                echo '<p class="no-comments">Comments are closed</p>';
            }
        }

        // end of comment area
        echo '</div>';
        return ob_get_clean();
    }

    // modify the standard WP comment structure
    public function format_comment($comment, $args, $depth) {

        $this -> comment_counter ++;

        $tag       = 'div';
        $add_below = 'div-comment';

        echo '<' . $tag;
        echo ($this -> comment_counter > 1) ? ' class="rd-comment rd-hidden"' : ' class="rd-comment"'; 
        echo ' id="comment-';
        comment_ID();
        echo '">';

        if ( 'div' != $args['style'] ) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
        } ?>
            <div class="comment-author vcard"><?php 
                if ( $args['avatar_size'] != 0 ) {
                    echo get_avatar( $comment, $args['avatar_size'] ); 
                } 
                printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
            </div><?php 
            if ( $comment->comment_approved == '0' ) { ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
            } 
            comment_text();
            echo '</div></div>';
    }

    
}

