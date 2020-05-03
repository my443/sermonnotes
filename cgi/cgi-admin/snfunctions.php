<?php

function replace_tags ($text, $open_str, $clos_str)
{
//echo $text.'<br>';

//echo $open_str.'<br>';

$opn_length = strlen($open_str);				// Get the length of the current string 
$cls_length = strlen($clos_str);

$s_count = substr_count($text, $open_str);		// Find how many replacments will need to be made.
																												

for ($i = 1; $i <= $s_count; $i++)				// For each replacement to be made
	{
	$pos 	= strpos($text, $open_str);			// Find the position of the search strting
	$begin 	= substr($text, 0, $pos);			// Beginning is 0 to where the searchstring starts.
	$end	= substr($text, $pos + $opn_length);	// End is from the start position + the searchstring length =  the end string.

	$close_tag = strpos($end, $clos_str);		// Find the closing span tag.
	$end 	= substr($end, $close_tag + $cls_length);		//  
	$text   = $begin.'____________'.$end;					// Add the two strings together.

	}
	return $text;

}

function insert_entry ($text, $open_str, $clos_str)
{

$sq = "'";

$opn_length = strlen($open_str);				// Get the length of the current string 
$cls_length = strlen($clos_str);

$s_count = substr_count($text, $open_str);	// Find how many replacments will need to be made.


for ($i = 1; $i <= $s_count; $i++)				// For each replacement to be made
	{
		
	$textbox = 'TextBox'.$i;					// Give the textbox a unique number
	$pos 	= strpos($text, $open_str);			// Find the position of the search strting
	$begin 	= substr($text, 0, $pos);			// Beginning is 0 to where the searchstring starts.
	$end	= substr($text, $pos + $opn_length);// End is from the start position + the searchstring length =  the end string.
	
	$close_tag = strpos($end, $clos_str);		// Find the closing span tag.
	$entry_text = substr($end, 0, $close_tag);  // From the beginning of 'end' to where the close_tag starts is the word that should be entered.
	$end 	= substr($end, $close_tag + $cls_length);		//  
	
	$text   = $begin.'<input  name="'.$textbox.'" id="'.$textbox.'"  size="8" type="text" onkeyup="input_size('.$sq.$textbox.$sq.');">'.'<input style="width:27px; height:27px" id="ck'.$textbox.'" type="checkbox" onchange="auto_enter('.$sq.'ck'.$textbox.$sq.','.$sq.$entry_text.$sq.', '.$sq.$textbox.$sq.');">'.$end;					// Add the strings together.

	}
	return $text;

}

function bible_link ($text, $open_str, $clos_str)
{

$opn_length = strlen($open_str);				// Get the length of the current string 
$cls_length = strlen($clos_str);

$s_count = substr_count($text, $open_str);		// Find how many replacments will need to be made.
																												

for ($i = 1; $i <= $s_count; $i++)				// For each replacement to be made
	{
	$pos 	= strpos($text, $open_str);			// Find the position of the search strting
	$begin 	= substr($text, 0, $pos);			// Beginning is 0 to where the searchstring starts.
	$end	= substr($text, $pos + $opn_length);	// End is from the start position + the searchstring length =  the end string.

	$close_tag = strpos($end, $clos_str);		// Find the closing span tag.
	$link_text = substr($end, 0, $close_tag);	// The text is from the start of 'end' to when the close-string starts.
	$end 	= substr($end, $close_tag + $cls_length);		//  
	$text   = $begin.'<a href="http://www.biblegateway.com/passage/?search='.
						$link_text.'&amp;version=NLT" target="_blank">'.$link_text.
						'</a>'.$end;					// Add the  strings together.

	}
	return $text;


}

function insert_notes ($text, $open_str)
{
	
$opn_length = strlen($open_str);				// Get the length of the current string 


$s_count = substr_count($text, $open_str);	// Find how many replacments will need to be made.

for ($i = 1; $i <= $s_count; $i++)				// For each replacement to be made
	{
	$Num = substr(("000".$i), -3);
	$NotesNum = 'Notes'.$Num;					// Give the textbox a unique number
	$pos 	= strpos($text, $open_str);			// Find the position of the search strting
	$begin 	= substr($text, 0, $pos);			// Beginning is 0 to where the searchstring starts.
	$end	= substr($text, $pos + $opn_length);// End is from the start position + the searchstring length =  the end string.
	
	$sq = "'";
			

	$text   = $begin."<!--delete start--><div name='disappearing_div' style='display:block;'>".
'<button type="button" class="notesbutton"  style="width:90%" onclick="javascript:ShowHide('.$sq.$NotesNum.$sq.');">Notes</button><button type="button" class="arrowbutton"  style="width:10%" onclick="javascript:ShowHide('.$sq.$NotesNum.$sq.');">&gt;&gt;</button>'."</div><!--delete end-->".

'<textarea id="'.$NotesNum.'" name="'.$NotesNum.'" style="width: 100%; display:none;" rows="3"   onkeyup="resizeIt('.$sq.$NotesNum.$sq.')"></textarea>
</p>'
.$end;					// Add the strings together.

	}
	return $text;

}
?>