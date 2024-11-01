<?php
if(file_exists('../../../wp-config.php')){ 
	require('../../../wp-config.php'); 
}else {
	require('wp-config.php'); 
}

$href = $_REQUEST['url'];
$title = $_REQUEST['title'];
$id = $_REQUEST['id'];
$key = $_REQUEST['key'];
$pubid = $_REQUEST['pubid'];

//DB Plugin Options
$options = get_option("ZDScribdiPaper_options");

if($pubid == "") {
	$pubid = $options['pubid'];
}

// Make sure document is an uri
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
}else {
	$find_http = "http://";
	$pos_http = strpos($href, $find_http);
	if($pos_http === false) {
		$error = "<em><strong>ZD Scribd iPaper:</strong> requires either a scribd document id or a document url.</em><br><em>Usage: [scribd]url[/scribd] or [scribd id=\"7202623\" key=\"key-1n8x0qsfnb1ldctfjron\"]</em><br>";
		return $error;
		exit;
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Private Document</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="robots" content="noindex, nofollow" />
<script type="text/javascript" src="http://www.scribd.com/javascripts/view.js"></script>
<style type="text/css">
.scribd { <?php echo $options['style']; ?> }
</style>
</head>
<div id="zdscribdid" class="scribd"><a href="<?php get_bloginfo('wpurl'); ?>">ZD Scribd iPaper</a></div>
<script type="text/javascript">
	<?php if($href == "") { ?>
	var zdscribdjs = scribd.Document.getDoc(<?php echo $id; ?>, '<?php echo $key; ?>');
	<?php }else{ ?>
	var zdscribdjs = scribd.Document.getDocFromUrl('<?php echo $href; ?>', '<?php echo $pubid; ?>');
	
	zdscribdjs.addParam('public', <?php echo $options['public']; ?>);
	zdscribdjs.addParam('title', '<?php echo $title ?>');
	<?php } ?>
	var oniPaperReady = function(e){
		zdscribdjs.api.setFullscreen(true);
	}
	zdscribdjs.addEventListener('iPaperReady', oniPaperReady);
	zdscribdjs.addParam('jsapi_version', 1);
	zdscribdjs.addParam('disable_related_docs', <?php echo $options['disable_related_docs']; ?>);
	zdscribdjs.addParam('mode', '<?php echo $options['mode']; ?>');
	zdscribdjs.write('zdscribdid');
</script>
<body>
</body>
</html>
