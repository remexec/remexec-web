<?php
	$tmpfname = tempnam("/tmp", "source").".cpp";
	$srcfile = fopen($tmpfname, "w");
	fwrite($srcfile, $_POST['code']);
	fclose($srcfile);

	$command = "./remexec ".escapeshellcmd($_POST['lang'])." ".escapeshellcmd($tmpfname);
	$handle = popen($command.' 2>&1', 'r');
	while ($read = fgets($handle)){
		echo htmlspecialchars ($read);
	}
	pclose($handle);

	unlink($srcfile);
?>
