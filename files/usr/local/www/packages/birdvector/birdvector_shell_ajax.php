<?php

function bird_shell_exec($cmd, &$stdout=null, &$stderr=null) {
	$cmd = 'birdc -r "' . addslashes($cmd) . '"';
    $proc = proc_open($cmd,[
        1 => ['pipe','w'],
        2 => ['pipe','w'],
    ],$pipes);
    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[2]);
    return proc_close($proc);
}

function bird_exec_command($cmd) {
    try {
        if (preg_match('/^\s*cd(\s+(?<path>[^\0]*)\s*|\s*)/', $cmd, $matches)) {
            chdir($matches["path"]);
            $retval = 0;
            $shell_exec_stdout = "";
            $shell_exec_stderr = "";
        } else {
            $retval = bird_shell_exec($cmd, $shell_exec_stdout, $shell_exec_stderr);
        }
    } catch (Exception $e) {
		return json_encode([
			'status' => 'error',
			'response' => $e->getMessage(),
		]);
    }

    $shell_exec = $shell_exec_stdout . (strlen($shell_exec_stderr) > 0 && strlen($shell_exec_stdout) > 0 ? "\n" . $shell_exec_stderr : $shell_exec_stderr);

	return json_encode([
		'status' => 'ok',
		'response' => str_replace("\n", "<br>", htmlentities($shell_exec)),
	]);

}

if (isset($_GET['cmd']) && !empty($_GET['cmd'])) {
	die(bird_exec_command($_GET['cmd'], '/'));
}



return json_encode([
	'status' => 'error',
	'response' => 'No command sent',
]);

?>
