<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset= utf-8" />
	<title><?php echo isset($title_for_layout)?$title_for_layout:'Mon site' ?></title>
	<link rel="stylesheet" type="text/css" href="http://twitter.guthub.com/bootstrap/assets/css/bootstrap-1.2.0.min.css">
</head>
<body>
<div class="topbar" style="position:static">
	<divclass="topbar-inner">
		<div class="container">
		<h3><a href="#">Mon Site</a></h3>
	<ul class="nav">
		<?php $pagesmenu= $this->request('Page','getMenu'); ?>
		<?php foreach ($pagesmenu as $p): ?>
			<li><a href="<?php echo BASE_URL.'/page/view'.$p->id; ?>" title="<?php echo $p->name; ?>"><?php echo $p->name; ?></a></li>
		<?php endforeach; ?>
		<li><a href="<?php echo Router::url("posts/index"); ?>">Blog</a></li>
	</ul>
 </div>
</div>
</div>

		<div class="container" style="padding-top=60px">			
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
		<?php $count= microtime(true); ?>
		<div style="position:fixed; bottom:0; background:#900; color:#fff; left:0; right:0;"> 
		<?php echo'<center>Page générée en '.round(microtime(true)-$count,5).'secondes </center>';?>
</div>
</body>
</html>