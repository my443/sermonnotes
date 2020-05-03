<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="/snv2-complete/css/button.css" type="text/css"/>
<title>sermonnotes.ca Sermon Notes Tool</title>

<!-- TinyMCE -->
<script type="text/javascript" src="/snv2-complete/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		entity_encoding: "raw",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,preview,fullscreen|,forecolor,backcolor|,fullscreen",
		/*theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|",*/
		/* theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",*/
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		formats : {
			alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
			aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
			alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
			alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
			bold : {inline : 'span', 'classes' : 'bold'},
			italic : {inline : 'span', 'classes' : 'italic'},
			underline : {inline : 'span', 'classes' : 'underline', exact : true},
			strikethrough : {inline : 'del'},
			verseformat : {inline : 'span', 'classes' : 'underline', styles : {color : '#0000FF'}, attributes : {title : 'verseformat'}},
			entryformat : {inline : 'span', styles : {backgroundColor: '#9933FF', color : '#ffffff'}, attributes : {title : 'entryformat'}},
			notesection : {inline : 'hr', styles : {backgroundColor: '#000000', color : '#ffffff'}, attributes : {title : 'notesection'}}
		},

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

</head>
<body>

<form method="post" action="AdminPage.php">
	<div>
		<h3>sermonnotes.ca Sermon Notes Tool</h3>

<!-- <p>Page Header:  <input id="st" name="st" size="12" type="text"></p>-->

		<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
		<!-- The text in the text area is loaded with php -->
		<div>
			<textarea id="elm1" name="elm1" rows="15" cols="80" style="width: 80%">
            
           
            <?php
            $sntext = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/snv2-complete/datafiles/web_out.html');
            echo $sntext;
            ?>     


			</textarea>
		</div>
        <a href="#" onclick="tinymce.activeEditor.formatter.apply('verseformat');return false;" class="button">Apply Verse Formatting</a>
        <a href="#" onclick="tinymce.activeEditor.formatter.remove('verseformat');return false;" class="button">Remove Verse Formatting</a>

        
        <a href="#" onclick="tinymce.activeEditor.formatter.apply('entryformat');return false;" class="button">Apply EntryBox</a>
        <a href="#" onclick="tinymce.activeEditor.formatter.remove('entryformat');return false;" class="button">Remove EntryBox</a>
        
        <a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'<hr />');" class="button">Add Note Section</a>
        <br>


		<br />
		<input type="submit" name="save" value="Submit" />
		<input type="reset" name="reset" value="Reset" />
	</div>
</form>
<script type="text/javascript">
if (document.location.protocol == 'file:') {
	alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
}
</script>

        <p>
            The text editor used for sermnnotes.ca is open source.  More information can be found at <a href="http://tinymce.moxiecode.com" target="_blank">TinyMCE</a>.
        </p>
</body>
</html>