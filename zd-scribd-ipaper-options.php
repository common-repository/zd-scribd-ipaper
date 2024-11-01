<div class="wrap">
  <h2><?php echo $plugin_info['name']; ?></h2>
  <div id="poststuff" class="mainblock">
    <!--Admin Page Right Column //start-->
    <div id="plugin-right">
      <!--Information Box //start-->
      <div class="stuffbox">
        <h3>Information:</h3>
        <div class="inside">
          <ul>
            <li><strong>Version:&nbsp;</strong><?php echo $plugin_info['version']; ?></li>
            <li><strong>Release Date:&nbsp;</strong><?php echo $plugin_info['date']; ?></li>
            <li><a href="<?php echo $plugin_info['pluginhome']; ?>" target="_blank">Plugin Homepage</a></li>
            <li><a href="<?php echo $plugin_info['rateplugin']; ?>" target="_blank">Rate this plugin</a></li>
            <li><a href="<?php echo $plugin_info['support']; ?>">Support and Help</a></li>
            <li><a href="<?php echo $plugin_info['authorhome']; ?>" target="_blank">Author Homepage</a></li>
            <li><a href="<?php echo $plugin_info['more']; ?>" target="_blank">More WordPress Plugins</a></li>
          </ul>
        </div>
      </div>
      <!--Information Box //end-->
      <!--Follow me on Box //start-->
      <div class="stuffbox">
        <h3>Follow me on:</h3>
        <div class="inside">
          <ul class="zdinfo">
            <li class="fb"><a href="http://www.facebook.com/people/Proloy-Chakroborty/1424058392" title="Follow me on Facebook" target="_blank">Facebook</a></li>
            <li class="ms"><a href="http://www.myspace.com/proloy" title="Follow me on MySpace" target="_blank">MySpace</a></li>
            <li class="tw"><a href="http://twitter.com/proloyc" title="Follow me on Twitter" target="_blank">Twitter</a></li>
            <li class="lin"><a href="http://www.linkedin.com/in/proloy" title="Follow me on LinkedIn" target="_blank">LinkedIn</a></li>
            <li class="plx"><a href="http://proloy.myplaxo.com/" title="Follow me on Plaxo" target="_blank">Plaxo</a></li>
          </ul>
        </div>
      </div>
      <!--Follow me on Box //end-->
      <!--Donate Box //start-->
      <div class="stuffbox">
        <h3>Donate:</h3>
        <div class="inside">
          <p>Please support me by donating as such as you can, so that I get motivation to develop this plugin and more plugins.</p>
          <p align="center"><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6451324" target="_blank"><img src="http://images.proloy.me/wp/paypal.gif" alt="Donate to Support Me" /></a></p>
        </div>
      </div>
      <!--Donate Box //end-->
    </div>
  <!--Admin Page Right Column //end-->

  <!--Admin Page Left Column //start-->
  <div id="plugin-left">
      <form action="<?php echo $action_url ?>" method="post" name="ZDScribdiPaper" id="ZDScribdiPaper">
        <input type="hidden" name="submitted" value="1" />
        <?php wp_nonce_field('zdscribd-nonce'); ?>
        <!--Options //start-->
        <div class="stuffbox">
          <h3>Options:</h3>
          <div class="inside">
            <ul>
              <li>
                <label for="pubid">Your publisher ID:&nbsp;
                <input type="text" name="pubid" id="pubid" style="width:200px;" value="<?php echo $options['pubid']; ?>" /><br />
                Note: This is developer's Publisher ID. Replace it with your Pulisher ID else all your document from url will get added to Developer's Scribd Account.
                </label>
                <p class="submit">
        			<input type="button" name="getkey" id="getkey" value="Sign-up for Scribd Account" onclick="window.open('http://www.scribd.com', '_blank');" />
      			</p>
              </li>
              <li>
                <label for="align">The HTML wrapper style (&lt;div&gt;):&nbsp;
                <input type="text" name="style" id="style" style="width:350px;" value="<?php echo $options['style']; ?>" />
                </label>
              </li>
              <li>
                <label for="height">iPaper Height:&nbsp;
                <input type="text" name="height" id="height" style="width:70px;" value="<?php echo $options['height']; ?>" />&nbsp;px
                </label>
              </li>
              <li>
                <label for="width">iPaper Width:&nbsp;
                <input type="text" name="width" id="width" style="width:70px;" value="<?php echo $options['width']; ?>" />&nbsp;px
                </label>
              </li>
              <li>
                <label for="public">When using document from url make document public:&nbsp;
                <select id="public" name="public" style="width:90px;">
                  <?php if($options['public'] == "false") { ?>
                  <option value="false" selected="selected">False</option>
                  <?php }else { ?>
                  <option value="false">False</option>
                  <?php } ?>
                  <?php if($options['public'] == "true") { ?>
                  <option value="true" selected="selected">True</option>
                  <?php }else { ?>
                  <option value="true">True</option>
                  <?php } ?>
                </select>
                </label>
              </li>
              <li>
                <label for="disable_related_docs">Disable Related Documents:&nbsp;
                <select id="disable_related_docs" name="disable_related_docs" style="width:90px;">
                  <?php if($options['disable_related_docs'] == "true") { ?>
                  <option value="true" selected="selected">True</option>
                  <?php }else { ?>
                  <option value="true">True</option>
                  <?php } ?>
                  <?php if($options['disable_related_docs'] == "false") { ?>
                  <option value="false" selected="selected">False</option>
                  <?php }else { ?>
                  <option value="false">False</option>
                  <?php } ?>
                </select>
                </label>
              </li>
              <li>
                <label for="auto_size">Auto Size:&nbsp;
                <select id="auto_sizes" name="auto_size" style="width:90px;">
                  <?php if($options['auto_size'] == "true") { ?>
                  <option value="true" selected="selected">True</option>
                  <?php }else { ?>
                  <option value="true">True</option>
                  <?php } ?>
                  <?php if($options['auto_size'] == "false") { ?>
                  <option value="false" selected="selected">False</option>
                  <?php }else { ?>
                  <option value="false">False</option>
                  <?php } ?>
                </select>
                </label>
              </li>
              <li>
                <label for="mode">Document Display Mode:&nbsp;
                <select id="mode" name="mode" style="width:90px;">
                  <?php if($options['mode'] == "list") { ?>
                  <option value="list" selected="selected">List</option>
                  <?php }else { ?>
                  <option value="list">List</option>
                  <?php } ?>
                  <?php if($options['mode'] == "book") { ?>
                  <option value="book" selected="selected">Book</option>
                  <?php }else { ?>
                  <option value="book">Book</option>
                  <?php } ?>
                  <?php if($options['mode'] == "slide") { ?>
                  <option value="slide" selected="selected">Slide</option>
                  <?php }else { ?>
                  <option value="slide">Slide</option>
                  <?php } ?>
                  <?php if($options['mode'] == "tile") { ?>
                  <option value="tile" selected="selected">Title</option>
                  <?php }else { ?>
                  <option value="tile">Title</option>
                  <?php } ?>
                </select>
                </label>
              </li>
              <li>
                <label for="signintoview">User must signin to view document:&nbsp;
                <select id="signintoview" name="signintoview" style="width:90px;">
                  <?php if($options['signintoview'] == "true") { ?>
                  <option value="true" selected="selected">True</option>
                  <?php }else { ?>
                  <option value="true">True</option>
                  <?php } ?>
                  <?php if($options['signintoview'] == "false") { ?>
                  <option value="false" selected="selected">False</option>
                  <?php }else { ?>
                  <option value="false">False</option>
                  <?php } ?>
                </select>
                </label>
              </li>
              <li>
                <label for="suma">Use Suma Authentication (<em>"User must signin to view document"</em> must be set to <em>"true"</em>):&nbsp;
                <select id="suma" name="suma" style="width:90px;">
                  <?php if($options['suma'] == "true") { ?>
                  <option value="true" selected="selected">True</option>
                  <?php }else { ?>
                  <option value="true">True</option>
                  <?php } ?>
                  <?php if($options['suma'] == "false") { ?>
                  <option value="false" selected="selected">False</option>
                  <?php }else { ?>
                  <option value="false">False</option>
                  <?php } ?>
                </select>
                </label>
              </li>
              <li>
                <label for="notsignedurl">Redirect URL for not signed in urser (when using <em>scribdlink</em> shorttag):&nbsp;
                <input type="text" name="notsignedurl" id="notsignedurl" style="width:110px;" value="<?php echo $options['notsignedurl']; ?>" />
                </label>
              </li>
              <li>
                <label for="notsignedtext">
                <p>Display text if user not signed in (when using <em>scribdlink</em> shorttag):</p>
                <textarea name="notsignedtext" id="notsignedtext" rows="5" cols="15" style="width:98%; height:150px"><?php echo stripslashes($options['notsignedtext']); ?></textarea>
                </label>
              </li>
              <li>
                <label for="wheredoc">Where is doc.php?:&nbsp;
                <select id="wheredoc" name="wheredoc" style="width:100px;">
                  <?php if($options['wheredoc'] == "home") { ?>
                  <option value="home" selected="selected">Home Directory</option>
                  <?php }else { ?>
                  <option value="home">Home Directory</option>
                  <?php } ?>
                  <?php if($options['wheredoc'] == "plugin") { ?>
                  <option value="plugin" selected="selected">Plugin Directory</option>
                  <?php }else { ?>
                  <option value="plugin">Plugin Directory</option>
                  <?php } ?>
                </select>
                <p>You can move doc.php to your wordpress root.</p>
                </label>
              </li>              
            </ul>
          </div>
        </div>
        <!--Options //end-->
        <div class="submit">
          <input type="submit" name="Submit" value="Update Options" />
        </div>
      </form>
    <p>&nbsp;</p>
    <h5>WordPress plugin by: <a href="http://www.proloy.me/" target="_blank">Proloy Chakroborty</a></h5>
  </div>
  <!--Admin Page Left Column //end-->
</div>
</div>
