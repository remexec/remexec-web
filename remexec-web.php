<?php
///	var_dump($_POST);

	$tmpfname = tempnam("/tmp", "source").".cpp";
	$srcfile = fopen($tmpfname, "w");
	fwrite($srcfile, $_POST['code']);
	fclose($srcfile);

	$command = "./remexec cpp ".escapeshellcmd($tmpfname);
	$handle = popen($command.' 2>&1', 'r');
	while ($read = fgets($handle)){
		echo htmlspecialchars ($read)."<br>";
	}
	pclose($handle);

	unlink($srcfile);
?>
