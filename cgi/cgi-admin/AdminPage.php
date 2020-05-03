<?php
/*
 * note_parser.php
 * 
 * Copyright 2012 John van Dijk
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>


<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>sermonnotes.ca Admin Page</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.21" />
	<link rel="stylesheet" href="/snv2-complete/css/button.css" type="text/css"/>
</head>

<?php
$cwd = getcwd();
//Get the input Text
$input_text = $_POST['elm1'];

//Set the date/ time that it was generated.
date_default_timezone_set('America/Toronto');
$date_filename = date('Y-m-d h:i:s a', time());

//Save the most current web_out.html
$file = fopen($_SERVER['DOCUMENT_ROOT']."/snv2-complete/datafiles/version_history/".$date_filename,"w");
fwrite($file, $input_text);
fclose($file);

//Save it to the web-out file
$file = fopen($_SERVER['DOCUMENT_ROOT']."/snv2-complete/datafiles/web_out.html","w");
fwrite($file, $input_text);
fclose($file);

//Save the doc
$notes_doc = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
				"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><body>'
				.$input_text.'</body></html>';

$notes_doc = str_replace("<hr />", "", $notes_doc);
$file = fopen($_SERVER['DOCUMENT_ROOT']."/snv2-complete/datafiles/notes.doc","w");
fwrite($file, $notes_doc);
fclose($file);


//Bulletin notes creation
include 'snfunctions.php';

$bulletin_text = replace_tags(	$input_text,
					'<span style="background-color: #9933ff; color: #ffffff;" title="entryformat">',
					'</span>');

$bulletin_text =  '<span style="color: #00000;">
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
						"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><body>'
					.$bulletin_text.'</span></body></html>';

$bulletin_text = str_replace("<hr />", "", $bulletin_text);
$file = fopen($_SERVER['DOCUMENT_ROOT']."/snv2-complete/datafiles/bulletin_notes.doc","w");
fwrite($file, $bulletin_text);
fclose($file);

?>

            <h2>sermonnotes.ca administration choices.</h2>
            <p><a href='/snv2-complete/cgi/cgi-admin/whole_notes.php' target='_blank' class='button'>View Public Notes</a> </p>
            <p><a href='/snv2-complete/datafiles/notes.doc' class='button'>Download Full Notes</a></p> 
            <p><a href='/snv2-complete/cgi/cgi-admin/sn_generate.php' target='_blank' class='button'>Preview Sermon Notes</a></p> 
            <p><a href='/snv2-complete/datafiles/bulletin_notes.doc' class='button'>Download Bulletin Notes</a></p>
            <p><a href='/snv2-complete/cgi/cgi-admin/index.php' class='button'>Edit Sermon Note Document</a></p>

<p style="font-family:arial;font-size:10px;">
<?php

echo "Last File Genenerated in saved_web_out: <u>".$date_filename."</u>";

?>

</p>

<body>
	
</body>

</html>