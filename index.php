<?php
/**
 * Where your files are stored. "files" is the DIR.
 * Could also be . if you want it to be the main folder. i.e. index.php and images are stored in same dir.
 */
DEFINE("FILES", "./files"); 

$handle = opendir(FILES);
$filenames = array();

while($filename = readdir($handle)) {
	$filenames[] = $filename;
}

//Sort the files in alphanumeric order.
sort($filenames);

//Remove directory stuff i.e. . and ..
array_splice($filenames, 0, 2);

for($i = 0; $i < count($filenames); $i++) {
	$ext = substr($filenames[$i], -3);
	if($ext !== 'txt') {
		$file_name = "files/" . $filenames[$i] . ".txt";
		$filename = $filenames[$i];
		if(!file_exists($file_name)) {
			$handle = fopen($file_name, 'a') or die('failed to create text file.');
			fwrite($handle, $filename);
			fclose($handle);
			chmod($file_name, 0777);
		}
	}
}

//Close the directory
closedir($handle);

//Loop through all of the files and info.
for($i = 0; $i < count($filenames); $i++) {

	$ext = substr($filenames[$i], -3);
	if($ext !== 'txt') {
		$text = file_get_contents(FILES . '/' . $filenames[$i] . '.txt') or die('failed to open text file');
		echo "<b>" . $text . "</b><br />";
		echo "<img src='" . FILES . '/' . $filenames[$i] . "' /><br /><br />";
	}
	
}

?>
