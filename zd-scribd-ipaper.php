<?php
/*
Plugin Name: ZD Scribd iPaper
Version: 1.0
Plugin URI: http://www.proloy.me/projects/wordpress-plugins/zd-scribd-ipaper/
Description: Embed Scribd supported documents in your wordpress website.
Author: Proloy Chakroborty
Author URI: http://www.proloy.me/
*/

 
/*Copyright (c) 2009, Proloy Chakroborty
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:
    * Redistributions of source code must retain the above copyright
      notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright
      notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of Proloy Chakroborty nor the
      names of its contributors may be used to endorse or promote products
      derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY Proloy Chakroborty ''AS IS'' AND ANY
EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL Proloy Chakroborty BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.*/

////////////////////////////////////////////////////////////////////////////////////////////////////
// Version history:
//	1.0.0 - 29 June 2009: Initial release
////////////////////////////////////////////////////////////////////////////////////////////////////

//Check minimum required WordPress Version
global $wp_version;
$exit_msg = 'ZD Scribd iPaper require WordPress 2.5 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
if (version_compare($wp_version, "2.7", "<")) {
	exit($exit_msg);
}

//Make sure we're running an up-to-date version of PHP
$phpVersion = phpversion();
$verArray = explode('.', $phpVersion);
$error_msg = "'ZD Scribd iPaper' requires PHP version 5 or newer.<br>Your server is running version $phpVersion<br>";
if( (int)$verArray[0] < 5 ) {
	exit($error_msg);
}

class ZDScribdiPaper {
	//Name for our options in the DB
 	private $ZDScribdiPaper_DB_option = 'ZDScribdiPaper_options';
	private $plugin_url;
	private $plugin_dir;
	private $plugin_domid = 0;
	private $plugin_jsvar = 0;
	private $plugin_info = array('name'=>'ZD Scribd iPaper',
							 'version'=>'1.0',
							 'date'=>'2009-06-29',
							 'pluginhome'=>'http://www.proloy.me/projects/wordpress-plugins/zd-scribd-ipaper/',
							 'authorhome'=>'http://www.proloy.me/',
							 'rateplugin'=>'http://wordpress.org/extend/plugins/zd-scribd-ipaper/',
							 'support'=>'mailto:support@proloy.m',
							 'more'=>'http://www.proloy.me/projects/wordpress-plugins/');
		
	//Initialize WordPress hooks
 	public function __construct() {
 		$this->plugin_dir = dirname(__FILE__);
		$this->plugin_url = defined('WP_PLUGIN_URL') ? WP_PLUGIN_URL . '/' . dirname(plugin_basename(__FILE__)) : trailingslashit(get_bloginfo('wpurl')) . PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)); 
		
		//add shortcode handler
	 	add_shortcode('scribd', array(&$this, 'embedScribd'));
	 	add_shortcode('scribdlink', array(&$this, 'linkScribd'));
	 	
	 	//add js script to header
		add_action('wp_head', array(&$this, 'updateHeaderTag'));
		
		// Add Options Page
		add_action('admin_menu', array(&$this, 'addAdminMenu'));
    }
    
    //Set-up DB Variables
	public function install() {
		$options = array('pubid' => 'pub-85406264522162310696', 'height' => '600', 'width' => '590', 'public' => 'false', 'disable_related_docs' => 'true', 'mode' => 'list', 'auto_size' => 'true', 'style' => 'width: 100%; padding: 15px 0px;', 'wheredoc' => 'plugin', 'rewrite' => 'false', 'notsignedurl' => 'http://mywp.websmokers.info/wp-login.php', 'suma' => 'false', 'signintoview' => 'false', 'notsignedtext' => '<a href="http://mywp.websmokers.info/wp-login.php">Login</a> to view document.');
              
		update_option($this->ZDScribdiPaper_DB_option, $options);
	}
    
    //Includes the jauascript file in header tag
	public function updateHeaderTag() {
		echo '<script type="text/javascript" src="http://www.scribd.com/javascripts/view.js"></script>'."\n";
		echo '<script src="'.$this->plugin_url.'/assets/lightview2.5/js/prototype.js" type="text/javascript"></script>'."\n";
		echo '<script src="'.$this->plugin_url.'/assets/lightview2.5/js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>'."\n";
		echo '<script src="'.$this->plugin_url.'/assets/lightview2.5/js/lightview.js" type="text/javascript"></script>'."\n";
		echo '<link rel="stylesheet" href="'.$this->plugin_url.'/assets/lightview2.5/css/lightview.css" type="text/css" media="screen" />'."\n";
	}
    
    //Hook the options page
	public function addAdminMenu() {
		$plugin_page = add_options_page('ZD Scribd iPaper Options', 'ZD Scribd iPaper', 10, basename(__FILE__), array(&$this, 'handleOptions'));
		add_action('admin_head-'. $plugin_page, array(&$this, 'myplugin_admin_header'));		
	}
	
	public function myplugin_admin_header(){
		echo '<link href="'.$this->plugin_url.'/zdstyle.css'.'" rel="stylesheet" type="text/css" />';
	}
	
	//Handles Admin Page Options
	public function handleOptions() {
		//Plugin Information
		$plugin_info = $this->plugin_info;
		
		//DB Plugin Options
		$options = get_option($this->ZDScribdiPaper_DB_option);
		
		//Form Action URL
		$action_url = $_SERVER['REQUEST_URI'];
              
		if (isset($_POST['submitted'])) {
			//check security
			check_admin_referer('zdscribd-nonce');
			
			$options['pubid'] = $_POST['pubid'];			
			$options['height'] = $_POST['height'];
			$options['width'] = $_POST['width'];
			$options['public'] = $_POST['public'];
			$options['disable_related_docs'] = $_POST['disable_related_docs'];
			$options['mode'] = $_POST['mode'];
			$options['auto_size'] = $_POST['auto_size'];
			$options['style'] = $_POST['style'];			
			$options['signintoview'] = $_POST['signintoview'];
			$options['suma'] = $_POST['suma'];
			$options['notsignedurl'] = $_POST['notsignedurl'];
			$options['notsignedtext'] = $_POST['notsignedtext'];			
			$options['wheredoc'] = $_POST['wheredoc'];
	
			update_option($this->ZDScribdiPaper_DB_option, $options);
				
			echo '<div class="updated fade"><p>Plugin settings saved.</p></div>';
		}
		
		include('zd-scribd-ipaper-options.php');
	}
	
	//Embed Scribd iPaper in Post and Page
	public function embedScribd($atts, $content=null) {
		global $current_user;
		get_currentuserinfo();
		
		//DB Plugin Options
		$options = get_option($this->ZDScribdiPaper_DB_option);
		
		//iPaper DOM ID
		$ipaper_id = $this->getDOMId();
		
		//iPaper Jsvsacript Variable Name
		$ipaper_var = $this->getJSVar();
		
		// Make sure document is an uri
		if($content != null) {
			$find_http = "http://";
			$pos_http = strpos($content, $find_http);
			if($pos_http === false) {
				$error = "<em><strong>ZD Scribd iPaper:</strong> requires either a scribd document id or a document url.</em><br><em>Usage: [scribd]url[/scribd] or [scribd id=\"7202623\" key=\"key-1n8x0qsfnb1ldctfjron\"]</em><br>";
				return $error;
				exit;
			}
		}
		
		// Extract WordPress parameters
		extract(shortcode_atts(array('url' => '', 'pubid' => $options['pubid'], 'height' => $options['height'], 'width' => $options['width'], 'public' => $options['public'], 'disable_related_docs' => $options['disable_related_docs'], 'mode' => $options['mode'], 'auto_size' => $options['auto_size'], 'page' => '1', 'extension' => '', 'title' => '', 'id' => '', 'key' => '', 'access' => ''), $atts));
		
		$public = $this->formatAtts($public);
		$disable_related_docs = $this->formatAtts($disable_related_docs);
		$mode = $this->formatAtts($mode);
		$auto_size = $this->formatAtts($auto_size);		
		
		if($content == null and $url == "") {
			if($id == "") {
				$error = "<em><strong>ZD Scribd iPaper:</strong> id cannot be blank when not using document url.</em><br><em>Usage: [scribd]url[/scribd] or [scribd id=\"7202623\" key=\"key-1n8x0qsfnb1ldctfjron\"]</em><br>";
				return $error;
				exit;
			}
			if($key == "") {
				$error = "<em><strong>ZD Scribd iPaper:</strong> id cannot be blank when not using document url.</em><br><em>Usage: [scribd]url[/scribd] or [scribd id=\"7202623\" key=\"key-1n8x0qsfnb1ldctfjron\"]</em><br>";
				return $error;
				exit;
			}
		}
		
		$ipaper_html = '<div id="'.$ipaper_id.'" style="'.$options['style'].'"><a href="'.get_bloginfo('wpurl').'">ZD Scribd iPaper</a></div>'."\n";
		
		$ipaper_script  = '<script type="text/javascript">'."\n";
		if($content == null and $url == "") {
			$ipaper_script .= "var ".$ipaper_var." = scribd.Document.getDoc(".$id.", '".$key."')"."\n";
		}else {
			if($content != null) {
				$ipaper_script .= "var ".$ipaper_var." = scribd.Document.getDocFromUrl('".$content."', '".$pubid."');"."\n";
			}else {
				$ipaper_script .= "var ".$ipaper_var." = scribd.Document.getDocFromUrl('".$url."', '".$pubid."');"."\n";
			}
			$ipaper_script .= $ipaper_var.".addParam('public', ".$public.");"."\n";
			if($extension != "") {
				$ipaper_script .= $ipaper_var.".addParam('extension', '".$extension."');"."\n";
			}
			if($title != "") {
				$ipaper_script .= $ipaper_var.".addParam('title', '".$title."');"."\n";
			}
		}
		$ipaper_script .= $ipaper_var.".addParam('jsapi_version', 1);"."\n";
		$ipaper_script .= $ipaper_var.".addParam('height', ".$height.");"."\n";
		$ipaper_script .= $ipaper_var.".addParam('width', ".$width.");"."\n";
		$ipaper_script .= $ipaper_var.".addParam('disable_related_docs', ".$disable_related_docs.");"."\n";
		$ipaper_script .= $ipaper_var.".addParam('mode', '".$mode."');"."\n";
		$ipaper_script .= $ipaper_var.".addParam('auto_size', ".$auto_size.");"."\n";
		$ipaper_script .= $ipaper_var.".addParam('page', ".$page.");"."\n";
		$ipaper_script .= $ipaper_var.".write('".$ipaper_id."');"."\n";
		$ipaper_script .= '</script>'."\n"; 
		
		$ipaper_output = $ipaper_html.$ipaper_script;
		
		if($access == "") {
			if($options['signintoview'] == "true") {
				$access = "private";
			}else {
				$access = "public";
			}
		}
		
		if($access == "private") {
			if($options['suma'] == "true") {
				if(SumaSubscriptionProfiles::isGoodStandingSubscriber($userID = null) or $current_user->user_level == "10") {
					return $ipaper_output;
				}else {
					return stripslashes($options['notsignedtext']);
				}
			}else {
				if(is_user_logged_in()) {
					return $ipaper_output;
				}else {
					return stripslashes($options['notsignedtext']);
				}
			}
		}else {
			return $ipaper_output;
		}		
		
	}
	
	//Embed Scribd iPaper in Post and Page
	public function linkScribd($atts, $content=null) {
		global $current_user;
		get_currentuserinfo();
		
		//DB Plugin Options
		$options = get_option($this->ZDScribdiPaper_DB_option);
		
		
		// Extract WordPress parameters
		extract(shortcode_atts(array('href' => '','id' => '', 'key' => '', 'title' => '', 'caption' => '', 'pubid' => $options['pubid'], 'access' => ''), $atts));
		
		$param = array('pubid' => $pubid, 'title' => $title, 'href' => '', 'id' => '', 'key' => '');
		
		if($href == "") {
			if($id == "") {
				$error = "<em><strong>ZD Scribd iPaper:</strong> id cannot be blank when not using document url.</em><br><em>Usage: [scribd]url[/scribd] or [scribd id=\"7202623\" key=\"key-1n8x0qsfnb1ldctfjron\"]</em><br>";
				return $error;
				exit;
			}
			if($key == "") {
				$error = "<em><strong>ZD Scribd iPaper:</strong> id cannot be blank when not using document url.</em><br><em>Usage: [scribd]url[/scribd] or [scribd id=\"7202623\" key=\"key-1n8x0qsfnb1ldctfjron\"]</em><br>";
				return $error;
				exit;
			}
			$param['id'] = $id;
			$param['key'] = $key;
		}else {
			$find_http = "http://";
			$pos_http = strpos($href, $find_http);
			if($pos_http === false) {
				$error = "<em><strong>ZD Scribd iPaper:</strong> requires either a scribd document id or a document url.</em><br><em>Usage: [scribd]url[/scribd] or [scribd id=\"7202623\" key=\"key-1n8x0qsfnb1ldctfjron\"]</em><br>";
				return $error;
				exit;
			}
			$param['href'] = $href;
		}
		
		if($access == "") {
			if($options['signintoview'] == "true") {
				$access = "private";
			}else {
				$access = "public";
			}
		}
		
		if($access == "private") {
			if($options['suma'] == "true") {
				if(SumaSubscriptionProfiles::isGoodStandingSubscriber($userID = null) or $current_user->user_level == "10") {
					$ipaper_link = '<a href="'.$this->getLink($param).'" rel="iframe" title="'.$title.' :: '.$caption.' :: fullscreen: true" class="lightview">'.$content.'</a>';
				}else {
					$ipaper_link = '<a href="'.$options['notsignedurl'].'" title="Sign-in to view">'.$content.'</a>';
				}
			}else {
				if(is_user_logged_in()) {
					$ipaper_link = '<a href="'.$this->getLink($param).'" rel="iframe" title="'.$title.' :: '.$caption.' :: fullscreen: true" class="lightview">'.$content.'</a>';
				}else {
					$ipaper_link = '<a href="'.$options['notsignedurl'].'" title="Sign-in to view">'.$content.'</a>';
				}
			}
		}else {
			$ipaper_link = '<a href="'.$this->getLink($param).'" rel="iframe" title="'.$title.' :: '.$caption.' :: fullscreen: true" class="lightview">'.$content.'</a>';
		}
		
		return $ipaper_link;
	}
	
	//getlink
	private function getLink($param=array()) {
		//DB Plugin Options
		$options = get_option($this->ZDScribdiPaper_DB_option);
		
		if($param['href'] == "") {
			$link = "id=".$param['id']."&key=".$param['key'];
		}else {
			$link = "url=".$param['href']."&title=".$param['title']."&pubid=".$param['pubid'];
		}
		
	   	if($options["wheredoc"] == "home"){ 
	   		return get_bloginfo('url')."/doc.php?".$link;
	   	}else if($options["wheredoc"] == "plugin"){ 
			return get_bloginfo('url')."/wp-content/plugins/zd-scribd-ipaper/doc.php?".$link;
	   }
	}
	
	//Generates iPaper DOM id
	private function getDOMId() {
		global $wp_query;
		$this->plugin_domid = $this->plugin_domid + 1;
		$the_post_id = $wp_query->post->ID;
		$ipaper_id = "zdscribdid_".$the_post_id."_".$this->plugin_domid;
		return $ipaper_id;
	}
	
	//Generates iPaper JavaScrip variable name
	private function getJSVar() {
		global $wp_query;
		$this->plugin_jsvar = $this->plugin_jsvar + 1;
		$the_post_id = $wp_query->post->ID;
		$ipaper_var = "zdscribdvar_".$the_post_id."_".$this->plugin_jsvar;
		return $ipaper_var;
	}
	
	//Changes attributes to lower case and removes spaces
	private function formatAtts($atts) {
		$atts = strtolower($atts);
		$atts = str_replace (" ", "", $atts);
		return $atts;
	}
}

//Initialize Plugin
if (class_exists('ZDScribdiPaper')) {
	$ZDScribdiPaper = new ZDScribdiPaper();
	if (isset($ZDScribdiPaper)) {
		register_activation_hook(__FILE__, array(&$ZDScribdiPaper, 'install'));
	}
}
?>