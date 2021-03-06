<?php
$server = proc_open(PHP_BINARY . " src/pocketmine/PocketMine.php --no-setup --disable-readline", [
	0 => ["pipe", "r"],
	1 => ["pipe", "w"],
	2 => ["pipe", "w"]
], $pipes);
fwrite($pipes[0], "version\nmakeserver\nstop\n");
while(!feof($pipes[1])){
	echo fgets($pipes[1]);
}
fclose($pipes[0]);
fclose($pipes[1]);
fclose($pipes[2]);
echo "\n\nReturn value: ". proc_close($server) ."\n";
if(count(glob("plugins/DevTools/DarkSystem*.phar")) === 0){
	echo "DarkSystem PHAR was not created!\n";
	exit(1);
}else{
	echo "Prismarine PHAR created!\n";
	exit(0);
}
