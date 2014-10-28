<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('sb-admin-2.css');
		echo $this->Html->css('plugins/timeline.css');
		echo $this->Html->css('plugins/metisMenu/metisMenu.min.css');
        echo '<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">';

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1></h1>
		</div>
		<div id="content">

            <!-- NAWIGACJA -->
            <?php echo $this->element('menu'); ?>

            <!-- FLASH KOMUNIKATY -->
            <?php $flash = $this->Session->flash() ?>
            <?php if (!empty($flash)) : ?>
                <div class="alert alert-danger">
                    <?php echo $flash ?>
                </div>
            <?php endif ?>

            <!-- TREŚĆ STRONY -->
            <div id="wrapper">
			    <?php echo $this->fetch('content'); ?>
            </div>

		</div>

        <!-- STOPKA -->
		<div id="footer"></div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
    <?php

    echo $this->Html->script('jquery-1.11.0.js');
    echo $this->Html->script('bootstrap.min.js');
    echo $this->Html->script('plugins/metisMenu/metisMenu.min.js');
    echo $this->Html->script('sb-admin-2.js');

    ?>
</body>
</html>
