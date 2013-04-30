<?php

function debug($var){

	$debug= debug_backtrace();
	echo '<p>&nbsp;</p><p><a href="#" onclick=$(this).parent().next(\'ul\').slideToggle();><strong>'.$debug[0]['file'].'</strong> 1'.$debug[0]['line'].'</a></p>';
	echo '<ol style="display=none">';
	foreach ($debug as $k=>$v) {
		if ($k>0) {
			echo'<li><strong>'.$v['file'].'</strong> 1'.$v['line'].'</li>';
		}
	}
	echo '</ol>';
	echo '<pre>';
	print_r($var);
	echo '</pre>';

}

?>