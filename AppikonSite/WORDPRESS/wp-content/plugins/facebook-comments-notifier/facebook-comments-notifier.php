<?php
/*
Plugin Name: Facebook Comments Notifier
Plugin URI: http://wordpress.org/extend/plugins/facebook-comments-notifier/
Description: This plugin adds Facebook comments on your WordPress website and sends email notification when a new comment is made.
Version: 1.5
Author: Lieberman Technologies, Andrew Epperson, Kevin Seifert
Author URI: http://www.LTnow.com
License: GPL2

Copyright 2013  Lieberman Technologies

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



///////////////////////////////////////////////////////////////////////////////
// Plugin Init
///////////////////////////////////////////////////////////////////////////////


// fcn_htmlencode: options for whitespace conversion
// default: \n -> &x10;  \r -> &x13;
define( 'FCN_HTML_BR', 1 );      // "\n" -> "<br />"
define( 'FCN_HTML_NBSP', 2 );    // " " -> "&nbsp;"
define( 'FCN_HTML_NBSP_BR', 3);  // 1 + 2
define( 'FCN_HTML_BR_NBSP', 3);  // 1 + 2
define( 'FCN_HTML_PRESERVE', 4); // no change 


// Runs when plugin is activated
register_activation_hook(__FILE__,'fcn_plugin_install'); 
if ( ! function_exists('fcn_plugin_install') )
{
	function fcn_plugin_install() 
	{
		add_option( 'fcn_options', array() );
	}
}


// Runs on plugin deactivation
register_deactivation_hook( __FILE__, 'fcn_plugin_remove' );
if ( ! function_exists('fcn_plugin_remove') )
{
	function fcn_plugin_remove() 
	{
		delete_option( 'fcn_options' );
	}
}


///////////////////////////////////////////////////////////////////////////////
// Front End
///////////////////////////////////////////////////////////////////////////////


// enqueue javascript
add_action('wp_enqueue_scripts', 'fcn_scripts_load');


// js loader
function fcn_scripts_load() 
{
	global $post;

	$options = get_option( 'fcn_options' );

	$app_id  = @$options['app_id'];
	global $admin_user_id;
	$admin_user_id  = @$options['admin_user_id'];
	$width   = @$options['width'];
	$colorscheme = @$options['colorscheme'];

	# NOTE: This block may need to deregister additional scripts 
	#  if other plugins load the facebook sdk under another handle.
	#  These will all use the global var FB and may conflict.
	wp_deregister_script( 'facebook-sdk' );
	wp_deregister_script( 'facebook' );

	$lang_region = fcn_get_language_region();
	$fbsdk = 'http://connect.facebook.net/'.$lang_region.'/all.js#xfbml=1';

	if ( $app_id ) 
	{
		$fbsdk .= '&appId='. $app_id;
	}
	
	// check for admin user id
	if ( $admin_user_id ) 
	{
		add_action('wp_head', 'ltnow_fbadmin_wp_head');
		function ltnow_fbadmin_wp_head(){
			global $admin_user_id;
			echo '<meta property="fb:admins" content="{' . $admin_user_id . '}"/> <!-- Facebook Admin ID -->' . PHP_EOL;
		}
	}
	
	wp_register_script( 'facebook-sdk', $fbsdk, array('jquery') );
	wp_enqueue_script( 'facebook-sdk' );

	wp_deregister_script( 'fcn-scripts' );

	# widget, global js data 
	$fbwidget = plugin_dir_url('/').'facebook-comments-notifier/fb-comments.js';
	$jsparams = array();
	$jsparams['ajaxurl']   = admin_url( 'admin-ajax.php' );
	$jsparams['permalink'] = get_permalink(); 

	if  ( $width ) 
	{
		$jsparams['width'] = $width;
	}
	if ( $colorscheme ) 
	{
		$jsparams['colorscheme'] = $colorscheme;
	}

	wp_register_script( 'fcn-scripts', $fbwidget, array('jquery', 'facebook-sdk'));
	wp_localize_script( 'fcn-scripts', 'fcn_global_data', $jsparams );
	wp_enqueue_script( 'fcn-scripts' );

}


// Send email
if ( ! function_exists('fcn_comment_notify') )
{
	function fcn_comment_notify( $data = null ) 
	{

		if ( ! $data ) 
		{
			$data = $_REQUEST;
		}

		$options = get_option( 'fcn_options' );

		// read ajax packet

		$commentID       = @$data['commentID'];
		$parentCommentID = @$data['parentCommentID'];
		$href            = @$data['href'];
		$userName        = @$data['userName'];
		$commentText     = @$data['commentText'];


		// get current time
		$wp_currenttime = current_time('mysql');
		$wp_time = explode(" ", $wp_currenttime);
		$wp_time[1]; 
		//end current time
		
		$fdate = date(get_option('date_format'));
		$ftime = $wp_time[1];

		$admin_email = @$options['admin_email'];

		if ( ! $admin_email ) {
			$admin_email = get_bloginfo('admin_email');
		}

		$blogurl = get_bloginfo('url');
		// $headers = 'From: LTnow <notice@LTnow.com>' . "\r\n";
		
		$message = "";
		if ( $href ) 
		{
			$message .= 'Page: '.$href."\n\n";
		}

		if ( $userName ) 
		{
			$message .= 'From: '.$userName."\n\n";
		}

		# comment or reply?
		$commentLabel = 'Comment';
		if ( $parentCommentID ) 
		{
			$commentLabel = 'Reply';
		}	

		if ( $commentText ) 
		{
			$message .= $commentLabel . ': '.$commentText."\n\n";
		}

		if ( $commentID ) 
		{
			$message .= $commentLabel. ' #'.$commentID."\n\n";
		}

		$message .= 'Submitted on '.$fdate.' at '.$ftime."\n\n";

		// uncomment to see email message in log:
		# fcn_debug (array($admin_email, "new $commentLabel on $blogurl", $message));
		wp_mail($admin_email, "You have a new $commentLabel on $blogurl",       $message);

	}

}


// ajax callback: email and terminate thread
// for both logged-in and non-logged-in users
add_action('wp_ajax_fcn_comment_created', 'fcn_comment_notify_handler');
add_action('wp_ajax_nopriv_fcn_comment_created', 'fcn_comment_notify_handler');

if ( ! function_exists('fcn_comment_notify_handler') )
{
	function fcn_comment_notify_handler( $data = null )
	{
		$result = fcn_comment_notify( $data = null ) ;
		$response = array();

		# ajax confirm message for sys debug
		$response = array( 'status' => 1, 'message' => 'ok' );
		if ( ! $result )
		{
			$response = array( 'status' => 0, 'message' => 'could not send mail' );

			// uncomment for verbose mail debug
			/*
			try
			{
				# return more verbose wp_mail errors
				global $ts_mail_errors;
				global $phpmailer;
				if (!isset($ts_mail_errors))
				{
					$ts_mail_errors = array();
				}
				if (isset($phpmailer))
				{
					$ts_mail_errors[] = $phpmailer->ErrorInfo;
				}

				$response = array( 'status' => 0, 'message' => 'error', 'data' => $ts_mail_errors );
			}
			catch ( Exception $ex )
			{
				$response = array( 'status' => 0, 'message' => 'error', 'data' => $ex->getMessage() );

			}
			*/
			// end debug
		}
		print json_encode( $response );
		die();
	}
}


///////////////////////////////////////////////////////////////////////////////
// Admin
///////////////////////////////////////////////////////////////////////////////


// admin menu
if ( is_admin() )
{
	add_action('admin_menu', 'fcn_admin_menu');

	function fcn_admin_menu() 
	{
		// title, menu, priv, unique id, callback
		add_options_page('Facebook Comment Notifier Options', 'Facebook Comments', 'administrator', 'fcn', 'fcn_admin_options_page');

	}
}


// enforce nonce 
function fcn_admin_security() 
{
	$nonce = @$_REQUEST['fcn_nonce'];
	if (! wp_verify_nonce($nonce, 'fcn_nonce') ) 
	{
		die('Security check failed');
	}
}


// simple admin form and handler
function fcn_admin_options_page() 
{

	$data = $_REQUEST;
	$options = get_option( 'fcn_options' );
	$message = '';

	// option keys
	$form = array( 
				'app_id'      => array( 'type'=>'text', 'label' => __('Facebook AppID')	),
				'admin_user_id'      => array('type'=>'text', 'label' => __('Facebook User ID')	),
				'admin_email' => array( 'type'=>'text', 'label' => __('Notification Email(s)') ),
				'width'       => array( 'type'=>'text', 'label' => __('Width') ),
				'colorscheme'       => array( 'type'=>'select', 'label' => __('Your Color Scheme'), 'options' => array( 'light'=>'light','dark'=>'dark',), 'default' => 'light', ),
				); 

	// update model
	$action = @$data['fcn_action'];
	if ( $action )	{
		fcn_admin_security();
		if ( $action == 'update' ) 
		{
			foreach( $form as $key => $def ) 
			{
				$options[$key] = fcn_get_value( $key );
			}
			update_option( 'fcn_options', $options ); 
			$message = 'Facebook Comments Notifier: Settings Updated';
		}
	}

	// print form
	$nonce = wp_create_nonce('fcn_nonce');
	$html = '';
	$html .= '<div>';
	$html .= '<form method="post">';
	$html .= fcn_html_widget(array('id'=> 'fcn_action', 'type'=>'hidden', 'value'=>'update' )) ; 
	$html .= fcn_html_widget(array('id'=> 'fcn_nonce', 'type'=>'hidden', 'value'=> $nonce )) ; 

	if ( $message ) 
	{
		$html .= '<div class="wrap"><div class="updated"><p>';
		$html .= fcn_htmlencode($message);
		$html .= '</p></div></div>';
	}

	$html .= '<h2>' . __('Facebook Comments Notifier Settings') . '</h2>';
	$html .= '<table>';
	foreach( $form as $key => $def ) 
	{
		$html .= '<tr>';
		$html .= '<td style="width:130px;">' . fcn_htmlencode( $def['label'] ) . ':</td>';
		$widget = array('type'=>$def['type'], 'id'=> $key, 'value'=> @$options[$key] );

		if ( $def['options'] ) {
			$widget['options'] = $def['options'];
		}

		$html .= '<td>' . fcn_html_widget($widget) . '</td>';
		$html .= '</tr>';
	}
	$html .= '</table>';
	
	$html .= '<br />';
	$html .= '<p><i>Separate multiple email addresses with a comma.</i></p>';
	$html .= '<p><i>The "Width" can either be blank, or an integer (number of pixels).</i></p>';
	
	$html .= '<br /><p><strong>How To Locate your Facebook User ID:</strong></p>';
	$html .= '<ol><li>Be sure that you are logged in to Facebook.</li>';
	$html .= '<li>Visit this page: <a href="http://developers.facebook.com/tools/explorer/" target="_blank">http://developers.facebook.com/tools/explorer/</a>.</li>';
	$html .= '<li>You user ID will be display in the response text area.</li></ol>';
	$html .= '<p>To add multiple moderators, separate the uids by comma without spaces.</p>';

	$html .= '<br />';
	$html .= fcn_html_widget(array('id'=> 'fcn_submit', 'type'=>'submit', 'value'=>  __('Save Changes') )) ; 
	$html .= '</form>';
	$html .= '<br />';
	
	// Support Message
	$html .= '<p>For Suggestions and Support, please visit the <a href="http://wordpress.org/support/plugin/facebook-comments-notifier" target="_blank">support page on WordPress.org</a>.</p>';
	$html .= '<p>If you are having trouble receiving the email notifications, please review the <a href="http://wordpress.org/extend/plugins/facebook-comments-notifier/faq/">plugin\'s FAQ</a>.</p>';	
	
	$html .= '</div>';

	echo $html;
}


// add Settings link
function set_plugin_meta($links, $file) {
	$plugin = plugin_basename(__FILE__);
	// create link
	if ($file == $plugin) {
		return array_merge(
			$links,
			array( sprintf( '<a href="options-general.php?page=%s">%s</a>', 'fcn', __('Settings') ) )
		);
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'set_plugin_meta', 10, 2 );


///////////////////////////////////////////////////////////////////////////////
// Common Utilities
///////////////////////////////////////////////////////////////////////////////


// print debug messages
function fcn_debug ( $s ) 
{
	error_log( print_r( $s, 1 ) );
}


# get language code, for example: "en_US"
#   arg is separator (- by default)
function fcn_get_language_region( $sep = '_' ) 
{
	$lang_region = get_bloginfo('language');
	if ( ! $lang_region ) 
	{
		# pick one
		$lang_region = 'en-US';
	}
	if ( $sep ) 
	{
		$lang_region = str_replace('-', $sep, $lang_region);
	}
	return $lang_region;
}


// get value from array, default to request
// for wiring up html form controls
function fcn_get_value( $name, $data = null ) 
{
	if ( $data === null ) 
	{
		$data = $_REQUEST;
	}

	if ( isset ( $data[$name] ) ) 
	{
		$value = $data[$name];
		// wordpress adding slashes, even if magic quotes off
		$value = stripslashes( $value );
		return $value;
	}
	return null;
}


// function to escape input for html (page display, or attributes)
function fcn_htmlencode( $s, $ws = null )
{
	$flags = ENT_QUOTES;

	$html = @htmlentities( $s, $flags, 'UTF-8' );

	// handle whitespace conversion
	if ( $ws )
	{
		if ( $ws == 2 || $ws == 3 )
		{
			$html = str_replace( "\t", '&nbsp;&nbsp;&nbsp;&nbsp;', $html );
			$html = str_replace( ' ', '&nbsp;', $html );
		}

		if ( $ws == 1 || $ws == 3 )
		{
			$html = str_replace( "\r\n", "\n", $html ); // pc
			$html = str_replace( "\r", "\n", $html );   // mac (old <= 9)
			$html = str_replace( "\n", '<br />', $html );
		}
	}
	else 	
	{
		$html = str_replace( "\n", '&#10;', $html );
		$html = str_replace( "\r", '&#13;', $html );
	}

	return $html;
}


// build key="value" attributes of the tag
function fcn_html_attrs( $def )
{
	$attrs = '';
	foreach ( $def as $key => $value )
	{
		$attrs .= ' '.$key.'="'.fcn_htmlencode($value).'"';
	}
	return $attrs;
}


// html form elements 
function fcn_html_widget ( $def ) 
{
	$html = '';

	// defaults
	if ( !strlen( @$def['value'] ) ) 
	{
		$tmp = @$def['default'];
		if ( strlen( $tmp ) ) 
		{
			$def['value'] = $tmp;
		}	
	}

	// automatically wireup to last request
	if ( !strlen( @$def['value'] ) ) 	
	{
		$tmp = fcn_get_value( @$def['id'] );
		if ( strlen( $tmp ) ) 
		{
			$def['value'] = $tmp; 
		}
	}

	if ( ! strlen( @$def['name'] ) && strlen( @$def['id'] ) ) 
	{
		@$def['name'] = @$def['id'];
	}

	if ( !strlen( @$def['type'] ) ) 
	{
		@$def['type'] = 'text';
	}

	$id      = @$def['id'];
	$name    = @$def['name'];
	$value	 = @$def['value'];
	$default = @$def['default'];
	$class	 = @$def['class'];
	$style	 = @$def['style'];
	$type	 = @$def['type'];
	$label	 = @$def['label'];
	$text	 = @$def['text'];
	$options = @$def['options'];

	// fix binary attributes 
	$props = array( 'disabled', 'multiple', 'checked', 'selected', );
	foreach ( $props as $key ) 	
	{
		if ( @$def[$key] ) 
		{
			@$def[$key] = $key; # checked="checked"
		} else {
			unset( $def[$key] );
		}
	}

	// remove extended properties
	$extended = array( 'js', 'default', 'text', 'label', 'options', );
	foreach ( $extended as $key ) 
	{
		unset( $def[$key] );
	}


	if ( strlen( $label ) ) 
	{
		$html .= '<label class="wlabel">'. $label . '</label> ';
	} 

	switch ($type) 
	{

		case 'a':

			$html .= '<a ';
			unset( $def['type'] );
			unset( $def['value'] );
			$html .= fcn_html_attrs( $def );
			$html .= '>';
			$html .= fcn_htmlencode( $text );
			$html .= '</a>';
			break;			

		case 'textarea':

			$html .= '<textarea ';
			unset( $def['type'] );
			unset( $def['value'] );
			$html .= fcn_html_attrs( $def );
			$html .= '>';
			$html .= fcn_htmlencode( $value );
			$html .= '</textarea>';
			break;

		case 'multi_select':

			$def['multiple'] = 'multiple"';

		case 'select':

			$html .= '<select ';
			unset( $def['value'] );
			$html .= fcn_html_attrs( $def );
			$html .= '>';
 
			// for default option: Select One ... 
			if ( strlen( $text ) ) 
			{
				$html .= '<option value="">'. $text . '</option>';
			}
			$s = ' selected="selected"';

			// select values
			if ( is_array( $options ) ) 
			{
				foreach ($options as $key => $option) 
				{
					$text = $option ;
					// allow both formats:
					//  'id' => text
					//  'id' => array( 'text' => text, ... )
					if ( is_array( $option ) ) 
					{ 
						 $text = $option['text'];
					}

					$html .= '<option value="'. fcn_htmlencode($key) . '" ';

					// allow single or multiple selected values
					// pass in array if multiple select

					if ( !is_array( $value ) && strcmp( $value, $key ) == 0 ) 
					{
						$html .= $s;
					} 
					else if ( is_array($value) && in_array($key, $value) ) 
					{
						$html .= $s;
					}

					$html .= '>'. $text. '</option>';
					$html .= "\n";
				}
			}
			$html .= '</select>';

			break;
			
		case 'text':

			$def['style'] = 'width:300px;';
			
		default:

			$html .= '<input';
			$html .= fcn_html_attrs( $def );
			$html .= ' />';
			break;

	}

	return $html;
}


