<?php
$filename = basename($_GET['file']);
$file = 'upload/'.$filename;

while (True) { 
	if(file_exists($file) == False) { // file does not exist
		$file = 'approved/'.$filename; 
		if(file_exists($file) == False){
			$file = 'rejected/'.$filename;
			if(file_exists($file) == False){
				die('file not found');
			}
			else {
				break;
			}
		}
		else {
			break;
		}
	}
	else {
		break;
	}
}



header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Disposition: attachment; filename=$file");
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: binary");
readfile($file);

?>