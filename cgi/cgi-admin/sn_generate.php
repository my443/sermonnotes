<?php
// Start the buffering //
ob_start();
?>


<html><head>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

<meta name="viewport" content="width=device-width; initial-scale=1.0;"/> 

<link rel="stylesheet" href="/snv2-complete/css/mobile-v3.css" type="text/css"/>

<title>

sermonnotes.ca example

</title>

<meta name="generator" content="-" />

<!-- Function for Show/Hide Divs -->

<script language="JavaScript" src="/snv2-complete/js/snv2.js"></script>

</head>

<body><div name="NotesHeader">



<form name="action_id" action="/snv2-complete/cgi/noteappble-v2.php" method="post">

            <?php
            $cwd = getcwd();
            
            include 'snfunctions.php';
            $sntext = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/snv2-complete/datafiles/web_out.html');
            
            $with_entry = insert_entry($sntext, 
										'<span style="background-color: #9933ff; color: #ffffff;" title="entryformat">',
										'</span>');
			$with_verse = bible_link ($with_entry, 
										'<span class="underline" style="color: #0000ff;" title="verseformat">',
										'</span>');
										
			$with_notes = insert_notes ($with_verse, '<hr />');
			
            echo $with_notes;
            
            ?>  
            
<!--delete start-->
<div name='disappearing_div' style='display:block;'>
<p><center><b>Keep your notes!</b></center></p>
<table style="width:100%;"><tr>
<td>
<input style="width:25px; height:25px" type="radio" id="choice1" name="choice" value="download" onclick="submit_type('choice1');">Download Notes
</td>
<td> 
<input style="width:25px; height:25px" type="radio" id="choice2" name="choice" value="email" onclick="submit_type('choice2');" checked>Email Notes
</td>
</tr>
</table>

<div style="background-color:#FF9147;">
<div id = 'EmailSection' style="display:block;">
<p style="text-align: left"  ><b>Email Address:</b> 
<input name="EmailAddress" id="EmailAddress" onkeyup="input_size('EmailAddress');" size="13"    type="text" />

(Email address must be completed in order to receive your completed form when you click submit.)

</p>
</div>
</div>
<p>
 <input type="submit" id='SubmitButton' value="Email the notes to me. . ." onclick="needToConfirm = false;" />
</p>
</div><!--delete end-->
<p> </p>

</form>  

<hr>

<p><center>Your feedback is important to us. If you have any comments or questions about the online note application, please send us an email by clicking <a href="mailto:jvandijk.mail@gmail.com?Subject=Sermon Notes Comments">here.</a></center></p><body>

<p><center>
Your privacy:  Your email is only used to deliver your sermon notes to your mailbox.  Your email address and sermon notes are <b><u>NOT</u></b> saved by this application.</center>
</p>


</body>

</html>

<?php
echo '';

// Get the content that is in the buffer and put it in your file //
file_put_contents($_SERVER['DOCUMENT_ROOT'].'/snv2-complete/datafiles/prepared_default.htm', ob_get_contents());
?>

<p><a href="copyfile.php" target="_blank">Publish Sermon Notes</a></p>