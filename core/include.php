
<?php

require 'Session.php';
require 'form.php';
 $count= microtime(true);
require 'functions.php';
require 'router.php';

require ROOT.DS.'config'.DS.'config.php';

require 'Request.php';
require 'controller.php';
require 'model.php';
require 'dispatcher.php';
?>

<div style="position:fixed; bottom:0; background:#900; color:#fff; left:0; right:0;"> 
<?php echo'<center>Page générée en '.round(microtime(true)-$count,5).'secondes </center>';?>
</div>
