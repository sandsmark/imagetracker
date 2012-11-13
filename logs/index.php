<html>
<body>
<b>
<?
$exclude = array (".", ".." ,"index.php", ".htaccess");
$file = $_SERVER['QUERY_STRING']; 
echo $file . ":</b><br>";
if ($file) {
	if (eregi("/", $file)) die();
	$filehandle = fopen($file, 'r' );
	while (!feof($filehandle)) {
		print(fread($filehandle,4096));
		flush();
	};
	fclose($filehandle);
} else {
	echo "<PRE>"; 
	$handle = opendir("."); 
	while ($file = readdir($handle)) { 
		$extfind = substr($fn, -5, 5);
		if (!eregi(".txt", $file)) continue;
		if (!is_dir($file)) echo "<a href=index.php?$file>$file</a>\n"; 
	}
	closedir($handle); 
	echo "</PRE>"; 
};
?>
</body>
</html>
