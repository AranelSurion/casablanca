<?php
/* 
	Casablanca | December 29, 2012 
	Copyright 2012 Aranel Surion <aranel@aranelsurion.org>
	Casablanca dashboard for Raspberry Pi. See README for details.

         /`   `'.
        /   _..---;
        |  /__..._/  .--.-.
        |.'  e e | ___\_|/____
       (_)'--.o.--|    | |    |
      .-( `-' = `-|____| |____|
     /  (         |____   ____|
     |   (        |_   | |  __|
     |    '-.--';/'/__ | | (  `|
     |      '.   \    )"";--`\ /
     \        ;   |--'    `;.-'
  	 |`-.__ ..-'--'`;..--'`

	Happy new year!
*/

$GLOBALS['REQUEST_MICROTIME'] = microtime( TRUE );
function load_time( $buffer ){
return str_replace('{microtime}', round( microtime( TRUE ) - $GLOBALS['REQUEST_MICROTIME'], 4 ), $buffer);}
ob_start( 'load_time' ); 

require "functions.php";
check_login_die();

$uname = shell_exec("uname -a");

$cpu_info = shell_exec('cat /proc/cpuinfo');
$board_ver = intval(hexdec(substr($cpu_info, strpos($cpu_info, 'Revision	: ') + 11, 5)));
$cmdline = shell_exec('cat /proc/cmdline');	
$mem_base = substr($cmdline, strpos($cmdline, 'mem_base') + 11, 1);
$mem_size = substr($cmdline, strpos($cmdline, 'mem_size') + 11, 1);
$issue = shell_exec('cat /boot/issue.txt');
$issue_type = substr($issue, 0 , strpos($issue, ')') + 1);

require_once('phpChart_Lite/conf.php');
?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>pi@casablanca | Dashboard</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="favicon.gif">
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/script.js"></script>  
</head>
<body>

<script language="JavaScript">

function refresh() {

	/* see original: tafb.yi.org */

    $.get("dashboard.php", function(data){
        var $data=$(data);

        $("#overview").html( $data.find('#overview').html() );
        $("#templabel").html( $data.find('#templabel').html() );
        $("#status").html( $data.find('#status').html() );
        $("#cpuinfo").html( $data.find('#cpuinfo').html() );	
        $("#dmesg").html( $data.find('#dmesg').html() );	
        $("#osinfo").html( $data.find('#osinfo').html() );	
        $("#topmemory").html( $data.find('#topmemory').html() );
        $("#memoryusage").html( $data.find('#memoryusage').html() );	
        $("#gpio").html( $data.find('#gpio').html() );
        $("#network").html( $data.find('#network').html() );
        $("#diskusage").html( $data.find('#diskusage').html() );
        $("#usbstatus").html( $data.find('#usbstatus').html() );
        $("#cmdline").html( $data.find('#cmdline').html() );
        $("#turbomode").html( $data.find('#turbomode').html() );
        $("#voltages").html( $data.find('#voltages').html() );
        $("#codecs").html( $data.find('#codecs').html() );
        $("#frequencies").html( $data.find('#frequencies').html() );
        $("#cmdline").html( $data.find('#cmdline').html() );

    });

}

</script>

	<!-- TOP BAR -->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
	
				<li class="v-sep"><a href="do.php?do=logout" class="round button dark ic-left-arrow image-left">Log out</a></li>
				<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in</a>

					<ul>
						<li><a href="do.php?do=services">Check services</a></li>
						<li><a href="do.php?do=messages">Read messages</a></li>
						<li><a href="do.php?do=syslog">Read syslog</a></li>
						<li><a href="do.php?do=killsessions">Kill all PHP sessions</a></li>
						<li><a href="do.php?do=phpinfo">Get PHPinfo</a></li>
						<li><a href="do.php?do=logout">Log out</a></li>
					</ul> 
				</li>
				<li class="v-sep"><a href="javascript:refresh()" class="round button dark menu-refresh image-left">Refresh</a>
			

				
				
			</ul> <!-- end nav -->


		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
	
	
	
	<!-- HEADER -->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="dashboard.php" class="active-tab dashboard-tab">Dashboard</a></li>
				<li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>:9091">Transmission</a></li>
				<li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>:6667">Bouncer</a></li>
			</ul> <!-- end tabs -->
			
			<!-- The logo will automatically be resized to 30px height. -->
			<a href="#" id="company-branding-small" class="fr"><img src="raspbmc.png" /></a>
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
		
		<div class="page-full-width cf">
		
			<div class="side-menu-no-style fl">
				<div align="center"><img src="raspberry.gif"></div>
				<div class="side-content-no-style" align="center"><?php echo shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd version'); ?></div>
				<div class="side-content-no-style" align="center" style="background: #f8f9fa;">
<pre>
<?php
//Include Class
include('ServerStatus.class.php');
//Initialise Class
$ss    =    new    ServerStatus();
//Config
$cfg['host']    =    (empty($_GET['host']) ? 'localhost' : $_GET['host']);
$cfg['services'][0]    =    array('name' => 'Web Server','port' => 80);
$cfg['services'][1]    =    array('name' => 'SSH','port' => 13377);
$cfg['services'][2]    =    array('name' => 'FTP','port' => 21);
$cfg['services'][3]    =    array('name' => 'BNC','port' => 6667);
$cfg['services'][4]    =    array('name' => 'Transmission','port' => 9091);


?>
<style type="text/css" media="all">
.bg-red{background-color:#F33;}
.bg-green{background-color:#3F3;}
</style>
<div id= "status" align="center">
<table class="statable">
    <thead>
        <tr>
            </pre><th colspan="3">STATUS</th><pre>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($cfg['services'] as $service){
            echo '<tr>';
                echo '<td class="name">'.$service['name'].'</td>';
                if($ss->checkServer($cfg['host'], $service['port'])){
                    echo '<td class="bg-green">OK</td>';    
                }else{
                    echo '<td class="bg-red">FAIL</td>';
                }
            echo '</tr>';
        }
        ?>
    </tbody>
</div>
</table>
</pre></div>


				<div class="side-menu">
					<h3>Turbo Mode</h3>
				</div>
				<div id="turbomode" class="side-content-no-style">
				<br>
				<pre>
<?php
$cpu_freq = shell_exec('cat /boot/config.txt | grep arm_freq');
$cpu_freq = substr($cpu_freq, 9, 2);
?>
   <img src="images/<?php if ($cpu_freq == '70') echo "02"; else echo '10'; ?>.png" width="16" height="16" />  None
   <img src="images/<?php if ($cpu_freq == '80') echo "03"; else echo '10'; ?>.png" width="16" height="16" />  Modest
   <img src="images/<?php if ($cpu_freq == '84') echo "03"; else echo '10'; ?>.png" width="16" height="16" />  XBMC (High)
   <img src="images/<?php if ($cpu_freq == '90') echo "05"; else echo '10'; ?>.png" width="16" height="16" />  Medium
   <img src="images/<?php if ($cpu_freq == "95") echo "06"; else echo "10"; ?>.png" width="16" height="16" />  High
   <img src="images/<?php if ($cpu_freq == "10") echo '01'; else echo '10'; ?>.png" width="16" height="16" />  Turbo</pre>
				</div>

				<div class="side-menu">
					<h3>Voltages</h3>
				</div>
				<div id="voltages" class="side-content-no-style">
				<br>
				<pre>
<?php echo '    <b>core</b> ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd measure_volts core');
echo ' <b>sdram_c</b> ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd measure_volts sdram_c');
echo ' <b>sdram_i</b> ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd measure_volts sdram_i');
echo ' <b>sdram_p</b> ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd measure_volts sdram_p');
?></pre>
				</div>

				<div class="side-menu">
					<h3>Codecs</h3>
				</div>
				<div id="codecs" class="side-content-no-style">
				<br>
				<pre>
<?php
echo ' ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd codec_enabled H263');
echo ' ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd codec_enabled H264');
echo ' ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd codec_enabled MPG2');
echo ' ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd codec_enabled VP8');
echo ' ' . shell_exec('sudo -u www-data /opt/vc/bin/vcgencmd codec_enabled WVC1');
?></pre>
				</div>

				<div class="side-menu">
					<h3>Frequencies</h3>
				</div>
				<div id="frequencies" class="side-content-no-style">
				<br>
				<pre>
<?php
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd  measure_clock arm');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '   arm = ' . str_pad($clock3, 13, " ", STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock core');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '  core = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock h264');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '  h264 = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock v3d');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '   v3d = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock uart');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '  uart = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock emmc');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '  emmc = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock pixel');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo ' pixel = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock vec');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '   vec = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock hdmi');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '  hdmi = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />';
$clock = shell_exec(' sudo -u www-data /opt/vc/bin/vcgencmd measure_clock dpi');
$clock2 = substr($clock, (strlen($clock) - 1 - strpos($clock, '=')) * -1);
$clock3 = number_format(intval($clock2), 0, '.', ',');
echo '   dpi = ' . str_pad($clock3, 13, ' ', STR_PAD_LEFT) . '<br />'; 
?></pre>
				</div>

			</div>



			<div class="side-content fr">
			
				<div class="half-size-column fl">
	
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">CPU INFO</h3>
							<span class="fr expand-collapse-text">collapse</span>
							<span class="fr expand-collapse-text initial-expand">expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div id="cpuinfo" class="content-module-main donotflow">
							<pre><?php
echo $cpu_info;
if (intval(substr(shell_exec('cat /proc/cpuinfo | grep "CPU revision"'), -1, 1)) && 0x80) 
echo 'Warranty Bit    : Bad'; 
else 
echo 'Warranty Bit    : Good<br /><br />'; 
echo 'Memory Size     : ' . intval($mem_size) * 256 . 'M<br />';
echo 'Memory Split    : ';
switch ($mem_base) {
	case 'f':
		echo ((intval($mem_size) - 1) * 256) + 240 . 'M ARM / 16M GPU';
		break;
	case 'e':
		echo ((intval($mem_size) - 1) * 256) + 224 . 'M ARM / 32M GPU';
		break;
	case 'c':
		echo ((intval($mem_size) - 1) * 256) + 192 . 'M ARM / 64M GPU';
		break;
	case '8':
		echo ((intval($mem_size) - 1) * 256) + 128 . 'M ARM / 128M GPU';
		break;
	default:
		echo 'Other/User Defined';}?></pre>
						
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">DMESG OUTPUT</h3>
							<span class="fr expand-collapse-text">collapse</span>
							<span class="fr expand-collapse-text initial-expand">expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div id="dmesg" class="content-module-main donotflow">
						<pre>
<?php echo shell_exec('dmesg | tail -10'); ?></pre>
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->	


					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">OS INFO</h3>
							<span class="fr expand-collapse-text">collapse</span>
							<span class="fr expand-collapse-text initial-expand">expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div id="osinfo" class="content-module-main donotflow">
						<pre>
<?php echo str_replace(") ", ")\n", shell_exec('cat /proc/version')); echo '<br />' . $issue_type;	?></pre>
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->						

					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">GPIO Pins - Board Version <?php echo $board_ver; ?></h3>
							<span class="fr expand-collapse-text">collapse</span>
							<span class="fr expand-collapse-text initial-expand">expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div id="gpio" class="content-module-main donotflow" align="center">
						<pre>
^^^SD Socket       ^^Board Edges&gt;&gt;<table width="252" border="1" align="center" bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#000000">
<!-- pin 1 & 2 -->
<tr>
<td width="110" align="right">(pin 1)   3v3</td><td width="16" height="16"><img src="images/06.png" alt="" width="16" height="16" border="0" /></td>
<td width="16" height="16"><img src="images/01.png" width="16" height="16" alt="" /></td><td width="110" align="left">5v</td>
</tr>
<!-- pin 3 & 4 -->
<tr>
<td width="110" align="right">[8]I2S0 SDA</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 8')); ?>.png" width="16" height="16" alt="" /></td>
<?php
if ($board_ver < 4)
echo '<td width="16" height="16"><img src="images/09.png" width="16" height="16" alt="" /></td><td width="110" align="left">(pin 4)   DNC</td>';
else
echo '<td width="16" height="16"><img src="images/01.png" width="16" height="16" alt="" /></td><td width="110" align="left">5v</td>';
?>
</tr>
<!-- pin 5 & 6 -->
<tr>
<td width="110" align="right">[9]I2S0 SCL</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 9')); ?>.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/02.png" width="16" height="16" alt="" /></td><td width="110" align="left">Gnd</td>
</tr>
<!-- pin 7 & 8 -->
<tr>
<td width="110" align="right">[7]GPIO 4</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 7')); ?>.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 15')); ?>.png" width="16" height="16" alt="" /></td><td width="110" align="left">UART TXD[15]</td>
</tr>
<!-- pin 9 & 10 -->
<tr>
<?php
if ($board_ver < 4)
echo '<td width="110" align="right">(pin 9)   DNC</td><td width="16" height="16"><img src="images/09.png" width="16" height="16" alt="" /></td>';
else
echo '<td width="110" align="right">Gnd</td><td width="16" height="16"><img src="images/02.png" width="16" height="16" alt="" /></td>';
?>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 16')); ?>.png" width="16" height="16" alt="" /></td><td width="110" align="left">UART RXD[16]</td>
</tr>
<!-- pin 11 & 12 -->
<tr>
<td width="110" align="right">[0]GPIO 17</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 0')); ?>.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 1')); ?>.png" width="16" height="16" alt="" /></td><td width="110" align="left">GPIO 18[1]</td>
</tr>
<!-- pin 13 & 14 -->
<tr>
<?php
if ($board_ver < 4)
echo '<td width="110" align="right">[2]GPIO 21</td><td width="16" height="16"><img src="images/' . (shell_exec('gpio read 2')) . '.png" width="16" height="16" alt="" /></td>';
else
echo '<td width="110" align="right">[2]GPIO 27</td><td width="16" height="16"><img src="images/' . (shell_exec('gpio read 2')) . '.png" width="16" height="16" alt="" /></td>';
if ($board_ver < 4)
echo '<td width="16" height="16"><img src="images/09.png" width="16" height="16" alt="" /></td><td width="110" align="left">(pin 14)  DNC</td>';
else
echo '<td width="16" height="16"><img src="images/02.png" width="16" height="16" alt="" /></td><td width="110" align="left">(pin 14)  Gnd</td>';
?>
</tr>
<!-- pin 15 & 16 -->
<tr>
<td width="110" align="right">[3]GPIO 22</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 3')); ?>.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 4')); ?>.png" width="16" height="16" alt="" /></td><td width="110" align="left">GPIO 23[4]</td>
</tr>
<!-- pin 17 & 18 -->
<tr>
<?php
if ($board_ver < 4)
echo '<td width="110" align="right">(pin 17)  DNC</td><td width="16" height="16"><img src="images/09.png" width="16" height="16" alt="" /></td>';
else
echo '<td width="110" align="right">3v3</td><td width="16" height="16"><img src="images/06.png" width="16" height="16" alt="" /></td>';
?>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 5')); ?>.png" width="16" height="16" alt="" /></td><td width="110" align="left">GPIO 24[5]</td>
</tr>
<!-- pin 19 & 20 -->
<tr>
<td width="110" align="right">[12]SPI0 MOSI</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 10')); ?>.png" width="16" height="16" alt="" /></td>
<?php
if ($board_ver < 4)
echo '<td width="16" height="16"><img src="images/09.png" width="16" height="16" alt="" /></td><td width="110" align="left">(pin 20)  DNC</td>';
else
echo '<td width="16" height="16"><img src="images/02.png" width="16" height="16" alt="" /></td><td width="110" align="left">Gnd</td>';
?>
</tr>
<!-- pin 21 & 22 -->
<tr>
<td width="110" align="right">[13]SPI0 MISO</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 9')); ?>.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 6')); ?>.png" width="16" height="16" alt="" /></td><td width="110" align="left">GPIO 25[6]</td>
</tr>
<!-- pin 23 & 24 -->
<tr>
<td width="110" align="right">[14]SPI0 SCLK</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 14')); ?>.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 10')); ?>.png" width="16" height="16" alt="" /></td><td width="110" align="left">SPI0 CE0 N[10]</td>
</tr>
<!-- pin 25 & 26 -->
<tr>
<?php
if ($board_ver < 4)
echo '<td width="110" align="right">(pin 25)  DNC</td><td width="16" height="16"><img src="images/09.png" width="16" height="16" alt="" /></td>';
else
echo '<td width="110" align="right">Gnd</td><td width="16" height="16"><img src="images/02.png" width="16" height="16" alt="" /></td>';
?>
<td width="16" height="16"><img src="images/<?php  echo (shell_exec('gpio read 11')); ?>.png" width="16" height="16" alt="" /></td><td width="110" align="left">SPI0 CE1 N[11]</td>
</tr>
</table>
<?php
if ($board_ver < 4) goto skip; ?> 
<!-- GPIO header 2 --> 
<table width="252" border="1" align="center" bordercolor="#000000" bordercolorlight="#000000" bordercolordark="#000000">
<!-- pin 1 & 2 -->
<tr>
<td width="93" align="right">(pin 1)  5v</td><td width="16" height="16"><img src="images/01.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/06.png" alt="" width="16" height="16" border="0" /></td><td width="99" align="left">3v3</td>
</tr>
<!-- pin 3 & 4 -->
<tr>
<td width="93" align="right">[17]GPIO  8</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 17')); ?>.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 18')); ?>.png" width="16" height="16" alt="" /></td><td width="99" align="left">GPIO  9[18]</td>
</tr>
<!-- pin 5 & 6 -->
<tr>
<td width="93" align="right">[19]GPIO 10</td><td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 19')); ?>.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/<?php echo (shell_exec('gpio read 20')); ?>.png" width="16" height="16" alt="" /></td><td width="99" align="left">GPIO 11[20]</td>
</tr>
<!-- pin 7 & 8 -->
<tr>
<td width="93" align="right">(pin 7) Gnd</td><td width="16" height="16"><img src="images/02.png" width="16" height="16" alt="" /></td>
<td width="16" height="16"><img src="images/02.png" width="16" height="16" alt="" /></td><td width="99" align="left">(pin 8) Gnd</td>
</tr>
</table>
<?php
skip:
?>
<table width="100%" border="0" align="center">
<tr>
<td align="center">Numbers in [] are <a href="https://projects.drogon.net/raspberry-pi/wiringpi/" target="_new">WiringPi</a><br />GPIO assignments</td>
</tr>
</table>
</pre>
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->	

					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">CMDLINE</h3>
							<span class="fr expand-collapse-text">collapse</span>
							<span class="fr expand-collapse-text initial-expand">expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div id="cmdline" class="content-module-main donotflow">
						<pre>
<?php echo str_replace(" ", "\n", $cmdline); ?> </pre>
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->						

				</div>



				<div class="half-size-column fr">

				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">TEMPERATURE</h3>
						<span class="fr expand-collapse-text">collapse</span>
						<span class="fr expand-collapse-text initial-expand">expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div id="temperature" class="content-module-main cf donotflow" align="center">
<?php
$float_temp = round(intval(shell_exec('cat /sys/class/thermal/thermal_zone0/temp'))/1000, 1);
$s1 = array($float_temp);
$pc = new C_PhpChartX(array($s1), 'pitemp');
$pc->set_series_default(array(
    'renderer' => 'plugin::MeterGaugeRenderer',
    'rendererOptions' => array(
        'intervals' => array(35, 70, 85,90),
        'ticks' => array(10, 20, 30, 40, 50, 60, 70, 80, 90),
        'intervalColors' => array('#E7E658', '#66cc66', '#ff0000', '#000000')
		)
	)
);
$pc->draw(400, 230);
?><strong><div id="templabel"><pre>Pi Temperature = <?php echo $float_temp  . ' C (' . round(($float_temp * 9 / 5 + 32), 1) . ' F)'; ?></pre></div></strong>
			
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->

				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">OVERVIEW</h3>
						<span class="fr expand-collapse-text">collapse</span>
						<span class="fr expand-collapse-text initial-expand">expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div id="overview" class="content-module-main cf donotflow">
					<pre>
<?php echo shell_exec('w'); ?></pre>
				

				
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->

				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">TOP MEMORY</h3>
						<span class="fr expand-collapse-text">collapse</span>
						<span class="fr expand-collapse-text initial-expand">expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div id="topmemory" class="content-module-main cf donotflow">
					<pre>%MEM PROCESS
<?php echo shell_exec('ps axo %mem,cmd | sort -nr | head -n 10'); ?>	</pre>
				

				
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->

				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">MEMORY USAGE</h3>
						<span class="fr expand-collapse-text">collapse</span>
						<span class="fr expand-collapse-text initial-expand">expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div id="memoryusage" class="content-module-main cf donotflow">
					<pre>
<?php echo shell_exec('free -o -h'); ?></pre>
				

				
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->


				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">NETWORK</h3>
						<span class="fr expand-collapse-text">collapse</span>
						<span class="fr expand-collapse-text initial-expand">expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div id="network" class="content-module-main cf donotflow">
					<pre><?php echo shell_exec('ifconfig eth0'); ?></pre>
				

				
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->

				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">DISK USAGE</h3>
						<span class="fr expand-collapse-text">collapse</span>
						<span class="fr expand-collapse-text initial-expand">expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div id="diskusage" class="content-module-main cf donotflow">
					<pre>
<?php echo shell_exec('df -h -T'); ?></pre>
				

				
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->

				<div class="content-module">
				
					<div class="content-module-heading cf">
					
						<h3 class="fl">USB STATUS</h3>
						<span class="fr expand-collapse-text">collapse</span>
						<span class="fr expand-collapse-text initial-expand">expand</span>
					
					</div> <!-- end content-module-heading -->
					
					
					<div id="usbstatus" class="content-module-main cf donotflow">
					<pre>
<?php echo shell_exec('lsusb'); ?></pre>
				

				
					</div> <!-- end content-module-main -->
				
				</div> <!-- end content-module -->

			</div>

		
			</div> <!-- end side-content -->
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->
	
	
	
<?php include "footer.php" ?>

</body>
</html>