<?php 

function  download_notes($text)
{
	

//Set the date/ time that it was generated.
date_default_timezone_set('America/Toronto');
$filename = 'sermonnotes('.date('Y-m-d h:i:s a', time()).')'.'.html';

header('Content-Disposition: attachment; filename="'.$filename.'"');
header('Content-Type: text/plain'); # Don't use application/force-download - it's not a real MIME type, and the Content-Disposition header is sufficient
header('Content-Length: ' . strlen($text));
header('Connection: close');


//exit($text);
}

// A function that will delete the delete areas
function remove_DeleteSections($result) {
	$z = strpos($result, '<!--delete start-->');
	
	while ($z == true) 
	{
		
		$startTag = "<!--delete start-->";
		$endTag = "<!--delete end-->";
		$pos1 = strpos($result, $startTag) ;
		$pos2 = strpos($result, $endTag) + strlen($endTag);
		$result = substr_replace($result, '', $pos1, $pos2-$pos1);
		
		$z = strpos($result, '<!--delete start-->');
		
	}
	return $result;
}
?>