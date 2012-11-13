<?php 
/* 
MTS ImageTrack v1.0a
Copyright (C) 2006 MTS PROductions 

This program is free software; you can redistribute it and/or modify it under 
the terms of the GNU General Public License as published by the Free Software 
Foundation; either version 2 of the License, or (at your option) any later 
version. 

This program is distributed in the hope that it will be useful, but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
PARTICULAR PURPOSE. See the GNU General Public License for more details. 

You should have received a copy of the GNU General Public License along with 
this program; if not, write to the 
Free Software Foundation, Inc., 
59 Temple Place - Suite 330, 
Boston, MA 02111-1307, USA. 

Author Email: martin.sandsmark@gmail.com
*/ 

//Info about the client
$date =		date("m-d-Y-H:i:s");
$ip =		$_SERVER['REMOTE_ADDR'];
$client =	$_SERVER['HTTP_USER_AGENT'];
$referer =	$_SERVER['HTTP_REFERER'];
$id =		$_SERVER['QUERY_STRING'];
$id =		$new_string = ereg_replace("[^0-9]", "", $string);


//Write info to a file in the directory "logs"
$filename = './logs/' . $id . $date . '_' .  $ip . '.txt';
$file =  fopen($filename, "w");
$contents = '<b>ID number:' . $id . '</b>';
$contents = $contents . 'Date:' . $date;
$contents = $contents . '<br>IP-Address:' . $ip;
$contents = $contents . '<br>Client program info:' . $client;
$contents = $contents . '<br>Referer:' . $referer;
$contents = $contents . '<br>-MTS ImageTrack';
fwrite($file,$contents);
fclose($file);


//Send the headers
header('Last-Modified: ' . date('D, d M Y G:i:s T',filemtime('passed'))); 
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1 - Don't cache this
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header('Accept-Ranges: bytes');
header('Content-Length: ' . filesize('passed'));
header('Connection: close');
Header("Content-type: image/jpeg");

//send the image to the browser
$imgfile = fopen('passed','r');
while(!feof($imgfile)) {
    print(fread($imgfile,4096));
    flush();
}
fclose($imgfile);
?>