<?php echo $appName;?>.config(['$routeProvider',
    function($routeProvider) {
            $routeProvider
			<?php foreach($whenStatements as $when):?>
				<?php echo $when;?>
			<?php endforeach;?> 
			<?php echo $otherwise;?>
}]);