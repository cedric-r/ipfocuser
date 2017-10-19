<?php

$debugfile = "/tmp/ipfocuserdebug.log";
$focuserUrl = "http://192.168.0.118/index.php";

function debug($message) {
        global $debugfile;

        $fp = fopen($debugfile, 'a');
        fwrite($fp, date("d/M/Y H:i", time())." ".$message);
        fclose($fp);
}

function addToURI($string, $add) {
	if ($string!="") {
		$string .= "&";
	}
	$string .= $add;
	return $string;
}

$string = "";
if ($_GET["absolutePosition"]) {
	debug("Absolute positioning: ".$_GET["absolutePosition"]."\n");
	addToURI($string, "op=move&position=".$_GET["absolutePosition"]);
}
if ($_GET["backlashSteps"]) {
	debug("Backlash steps: ".$_GET["backlashSteps"]."\n");
	addToURI($string, "backlash=".$_GET["backlashSteps"]);
}

if ($string!="") {
	$string = "?".$string;
} else {
	$string = "?op=status";
}

debug("Calling ".$focuserUrl.$string."\n");
print(file_get_contents($focuserUrl.$string));

?>
