<?php
	$ext = "";
	switch($_POST['lang']){
		case 'cpp':
			$ext = ".cpp";
			break;
		case 'python':
			$ext = ".py";
			break;
		case 'bash':
			$ext = ".sh";
			break;
	}
	$tmpfname = "/tmp/source".md5(date()).$ext;
	$srcfile = fopen($tmpfname, "w");
	fwrite($srcfile, $_POST['code']);
	fclose($srcfile);

	$command = "./remexec ".escapeshellcmd($_POST['lang'])." ".escapeshellcmd($tmpfname);
	$handle = popen($command.' 2>&1', 'r');
	while ($read = fgets($handle)){
		echo htmlspecialchars ($read);
	}
	pclose($handle);

	unlink($tmpfname);
?>
