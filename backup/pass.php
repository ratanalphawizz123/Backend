<?php

$test1='$P$BKRmx6jQJGnKljlbmwduEGnW1hU1X21';

echo $test = password_hash('123456',PASSWORD_BCRYPT);

if($test1== $test2){
	echo 'palak';
}else{
	echo 'test';
}           