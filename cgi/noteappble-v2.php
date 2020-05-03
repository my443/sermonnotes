 <?php

//  Noteappble - A web-based note taking service for smartphones
//  Copyright (C) 2012 --  John van Dijk

//  This program is free software; you can redistribute it and/or
//  modify it under the terms of the GNU General Public License
//  as published by the Free Software Foundation; either version 2
//  of the License, or (at your option) any later version.

//  This program is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.

//  You should have received a copy of the GNU General Public License
//  along with this program; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

#######################################
#  START OF CONFIGURATION PARAMETERS  #
#######################################

$debug_mode	= false;				# set to true (development) or false (production)


$dir_root	= $_SERVER['DOCUMENT_ROOT'].'/snv2-complete/';
$url_root	= 'http://mywebsite.ca/snv2-complete/';
$email_from	= 'examples@myemail.ca';
$email_subject	= 'Church Sermon Notes';
#$smtp_host	= 'ssl://smtp.gmail.com';
#$smtp_port	= 465;
#$smtp_auth	= true;
#$smtp_username	= 'myemailaddress@gmail.com';
#$smtp_password	= 'mypassword';
$smtp_host	= 'localhost';
$smtp_port	= 25;
$smtp_auth	= false;
$smtp_username	= 'myusername';
$smtp_password	= 'mypassword';

#####################################
#  END OF CONFIGURATION PARAMETERS  #
#####################################

include 'noteappble_v2_functions.php';


// If the choice is download, add the download header.
// Else, do nothing (pass)
$choice = $_POST['choice'];

if ($choice == "download")
{
	download_notes($input);
}
else
{
	echo '';
}


if( $debug_mode ) {
   error_reporting( E_ALL & ~E_STRICT );		# show most errors
   ini_set( 'display_errors', 1 );			# display errors
} else {
   error_reporting( E_COMPILE_ERROR|E_CORE_ERROR );	# suppress errors except critical failures
   ini_set( 'display_errors', 0 );			# don't display errors
}

$htmfile = $dir_root . "Default.htm";
$input = @file_get_contents($htmfile) or die("ERROR: Could not access file: $htmfile");

//Define an array to hold the names of all of the input and textarea tags.
$input_tags_array = array();
$textarea_tags_array = array();

//Help from http://jesusnjim.com/code/php/htmlparsephp.html
$doc = DOMDocument::loadHTML($input);
$doc -> saveHTML();
$inputtags = $doc-> getElementsByTagName("input");
$textarea_tags = $doc-> getElementsByTagName("textarea");

//$it= $doc->getElementsByTagName("input")->item(0);

// INPUT AREA SECTION
// Get all of the input tags.
foreach ($inputtags as $inputtags)
{
    $x = $inputtags->getAttribute("name");
    $y = $inputtags->getAttribute("type");
    if ($y == 'text')
		{$input_tags_array[] = $inputtags->getAttribute("name");}
	elseif ($y == 'checkbox')
		{$input_tags_array[] = "{{-checkbox-}}";}
	elseif ($y == 'radio')
		{$input_tags_array[] = "{{-radio-}}";}

}

//Get all of the input feilds and put them in an array.
foreach ($input_tags_array as $i)
{
    $z = $_POST[$i];
    
    
    if ($z=="")
        {$z="____________________________";}


    $input_values_array[] = $z;
}

//Find all of the input tags
preg_match_all('/<input[^>]+>/i',$input, $result);

$counter = 0;
foreach ($result[0] as $item)
{
	// Find the inserted word for each input-type (incl. checkbox input types.)
	$inserted_word = $input_values_array[$counter];
	// If the input tag is a checkbox, then the word is nothing.
	if (($input_tags_array[$counter] == "{{-checkbox-}}") or ($input_tags_array[$counter] == "{{-radio-}}"))
		{$inserted_word = "";}
	
	
    $input= Str_replace ($item, "<b><u>".$inserted_word."</b></u>", $input);
    $counter = $counter + 1;
}

// TEXTAREA SECTION
// Get all of the textarea tags.
foreach ($textarea_tags as $textarea_tags)
{
    $x = $textarea_tags->getAttribute("name");
    $textarea_tags_array[] = $textarea_tags->getAttribute("name");
}

// For each of the text areay tags:
// If there is nothing in the tag, then there is nothing added to the
// html output doc.
// If there is something in the tag, then it is added as a yellow shaded
// (as a table row, yellow shaded, no border.

foreach ($textarea_tags_array as $i)
{
    $z = $_POST[$i];

    if ($z=="")
        {$z="";}
    else
        {
        $z = str_replace("\n", "<br>", $z);
        $z="<table border='0' width='100%' style='background-color:#FFFFCC'><tr><td><b>". $z . "</b></td></tr></table>";
        }

    $textarea_values_array[] =  $z;
}



// Where it finds textarea feilds, it replaces them with
// the text from above.
preg_match_all('/<textarea[^>]+>/i',$input, $result);

$counter = 0;
foreach ($result[0] as $item)
{
    $input= Str_replace ($item, $textarea_values_array[$counter], $input);
    $counter = $counter + 1;
}

// replace all of the closing text area tags (remove them to nothing)
$input = str_replace ('</textarea>', '', $input);

$input = str_replace ("<div name='disappearing_div' style='display:block;'>", "<div name='disappearing_div' style='display:none;'>", $input);

//Find the head tag and insert hidden buttons css
$head_pos = strpos($input, "<head>");
$insert_pos = $head_pos + 6;
$insert_text = "<style>button {display: none}</style>";
$new_input = substr_replace($input, $insert_text, $insert_pos, 0);
$input = $new_input;


$del_input = remove_DeleteSections($input);

$input = $del_input;

echo $input;





$email_address = $_POST['EmailAddress'];


	// pear install --alldeps Mail
	// pear install --alldeps Mail_Mime
        // pear install Net_SMTP (may or may not be needed.)
        
        require_once "./Mail.php";
		include ('./mime.php');
		
        $from = "<$email_from>";
        $to = "<".$email_address.">";
        $subject = $email_subject;
		$crlf = "\n";
		
        $html = $input; 
		
		$mime = new Mail_mime(array('eol' => $crlf));
		$mime->setHTMLBody($html);
		$body = $mime->get();
		
        $headers = array ('From' => $from,
          'To' => $to,
          'Subject' => $subject);
        $smtp = Mail::factory('smtp',
          array ('host' => $smtp_host,
            'port' => $smtp_port,
            'auth' => $smtp_auth,
            'username' => $smtp_username,
            'password' => $smtp_password));

		$headers = $mime->headers($headers);
		
		$mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
          echo("<p style='color:red;'>ERROR: Unable to send email to $email_address: " . $mail->getMessage() . "</p>");
         } else {
          echo("<p>Message successfully sent!</p>");
         }
         
    echo $email_address;
?>
