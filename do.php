<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="favicon.ico" />
<?php 

require "functions.php";
check_login_die();

$do = $_GET['do']; ?>

<title>pi@casablanca | Do</title>
<pre>
<?php if ($do == "services"){ echo shell_exec('service --status-all'); } ?>
<?php if ($do == "syslog"){ echo shell_exec('/usr/bin/tail --lines=50 /var/log/syslog'); } ?>
<?php if ($do == "messages"){ echo shell_exec('/usr/bin/tail --lines=50 /var/log/messages'); } ?>
<?php if ($do == "phpinfo"){ echo phpinfo(); } ?>
<?php if ($do == "killsessions"){ shell_exec("rm /var/lib/php5/*"); echo "Destroying sessions..";} ?>
<?php if ($do == "logout"){ session_destroy(); echo "<meta HTTP-EQUIV='REFRESH' content='0; index.php'>"; } ?>


</pre>
<br>
<a href="dashboard.php">← Back</a>