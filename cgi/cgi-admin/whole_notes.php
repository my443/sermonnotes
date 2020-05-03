<html><head>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />

<meta name="viewport" content="width=device-width; initial-scale=1.0;"/> 

<link rel="stylesheet" href="/snv2-complete/css/whole_notes.css" type="text/css"/>
</head>
<title>

sermonnotes.ca

</title>

<body>

            <?php
            $cwd = getcwd();
            $sntext = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/snv2-complete/datafiles/web_out.html');
            $sntext =  str_replace("<hr />", "", $sntext);
            echo $sntext;
            ?>    

</body>

</html>