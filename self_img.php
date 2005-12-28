<?php
/*
Plugin Name: Self Image
Plugin URI: http://www.xyooj.com
Description: Plugin to allow you to place a link in the post that links to a full view of the post.
Date: 2005, November, 08
Author: Vaam Yob
Author URI: http://www.xyooj.com
Version: 1.0
*/

/*  Copyright 2005 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

add_filter('admin_footer', 'self_img_button');
add_filter('the_content','self_img_in_content');

function self_img_in_content($content) {
        $search_for = array('<!--self_img-->', '<!--/self_img-->');
        $replace_with = array('<a href="'.get_permalink().'">',
        '</a>');
       return str_replace($search_for,$replace_with, $content);
}

function self_img_button()
{
        if(strpos($_SERVER['REQUEST_URI'], 'post.php')) {
	?>
		<script language="JavaScript" type="text/javascript">
		<!--
		var toolbar = document.getElementById("ed_toolbar");
	<?php
		edit_insert_button("Self Image", "self_img_button", "insert a link to a full view of this post");
	?>
		function self_img_button() {
			edInsertContent(edCanvas, '<!-'+'-self_img-'+'->Replace With Image or Text<!-'+'-/self_img-'+'->');
		}
	    //--></script>
	    <?php
	}
}

/*
Taken from Phil's adsense plugin
Author: Phil Hord
Author URI: http://philhord.com
*/

if(!function_exists('edit_insert_button'))
{
        //edit_insert_button: Inserts a button into the editor
        function edit_insert_button($caption, $js_onclick, $title = '')
        {
?>
	        if(toolbar)
	        {
	                var theButton = document.createElement('input');
	                theButton.type = 'button';
	                theButton.value = '<?php echo $caption; ?>';
	                theButton.onclick = <?php echo $js_onclick; ?>;
	                theButton.className = 'ed_button';
	                theButton.title = "<?php echo $title; ?>";
	                theButton.id = "<?php echo "ed_{$caption}"; ?>";
	                toolbar.appendChild(theButton);
	        }
<?php

        }
}
?>
