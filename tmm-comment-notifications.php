<?php
/*
Plugin Name: Comment Notifications by The Mighty Mo! Design Co.
Plugin URI: http://www.themightymo.com
Description: Send comment notifications to specific users for EVERY comment that is posted on a site or sub-site. Uses Advanced Custom Fields. Multi-site ready!
Author: Sherwin Calims
Author URI: http://www.themightymo.com
Version: 0.2
Text Domain: tmm-comment-notifications
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
Initially Created By: Sherwin Calims
*/

//while hasfield(emails_to_be_notified) email_address
//option 1

add_action('comment_post', 'notify_author_of_reply', 10, 2);

function notify_author_of_reply($comment_id, $approved){
	global $blog_id;
	$current_blog_details = get_blog_details( array( 'blog_id' => $blog_id ) );
 
    $emails_to_be_notified=array();
	if( get_field('emails_to_be_notified', 'option') ):  
		while( has_sub_field('emails_to_be_notified', 'option') ):  
		   $emails_to_be_notified[]=get_sub_field('email_address', 'option');	
		   $emailx.='  '.get_sub_field('email_address', 'option');
		endwhile;  
    endif; 
	
  if($approved){
    $comment = get_comment($comment_id);
	$post = get_post($comment->comment_post_ID);
	$comment_author = ($comment->comment_author);
	$subject = $current_blog_details->blogname . " - New comment from " . $comment_author . " on \"" .$post->post_title . "\"";
	$notify_message = "On " . get_the_date("l, F jS, Y") . " at " . get_the_time() . ", " . $comment->comment_author . " wrote: \r\n\r\n" . $comment->comment_content . "\r\n\r\n";
	$notify_message .= '<a href="'.get_comment_link( $comment_id ).'">Click here to reply.</a>' . "\r\n";
	
	wp_mail($emails_to_be_notified, $subject, $notify_message);
  }
}

/** changing default wordpres email settings */
add_filter( 'wp_mail_from_name', 'custom_wp_mail_from_name' );
function custom_wp_mail_from_name( $original_email_from ) {
	return get_bloginfo('name');
}
add_filter( 'wp_mail_from', 'custom_wp_mail_from' );
function custom_wp_mail_from( $original_email_address ) {
	//Make sure the email is from the same domain 
	//as your website to avoid being marked as spam.
	return 'donotreply@mightylucy.com';
}
