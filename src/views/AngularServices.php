var <?php echo $appName;?>Services	= angular.module('<?php echo $appName;?>Services', ['ngResource']);

<?php foreach($services as $service):?>
	<?php echo $service;?>
<?php endforeach;?>

