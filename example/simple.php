<?php

require_once(dirname(__file__).'/../lib/POpen4.php');

$p = new POpen4("/bin/bash");
list($pid, $stdin, $stdout, $stderr) = array($p->pid(), $p->stdin(), $p->stdout(), $p->stderr());

fwrite($stdin, "echo 42.out\n");
fwrite($stdin, "echo 42.err 1>&2\n");
fclose($stdin);

echo "pid    : ".$pid."\n";
echo "stdout : ".trim(fread($stdout, 1024))."\n";
echo "stderr : ".trim(fread($stderr, 1024))."\n";
echo "status : ".trim(print_r($p->status(), true))."\n";
