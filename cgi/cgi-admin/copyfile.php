<?php
echo '';
$cwd = getcwd();
$file = $_SERVER['DOCUMENT_ROOT'].'/snv2-complete/datafiles/prepared_default.htm';
$newfile = $_SERVER['DOCUMENT_ROOT'].'/snv2-complete/Default.htm';

if (!copy($file, $newfile))
  {
  echo "Failed to copy $file...\n";
  }
else
  {
  echo "Copy Successful\n";
  }

echo $cwd;
?>
