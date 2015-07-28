<?php

	$fh = fopen('./msg.txt', 'r'); //打开文件

	 // //往文件写内容
	 // if(fwrite($fh, '去你逗比的'))
	 // 	echo "Ok";

	 // //关闭文件
	 // fclose($fh);
	$msg=fgetcsv($fh);
	print_r($msg);

	
 ?>