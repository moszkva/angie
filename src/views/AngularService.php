<?php echo $appName;?>Services.service('<?php echo $controller;?>Service', ['$http', '$resource', function($http, $resource){

	<?php if($methods['POST']):?>
	
		var postURL="<?php echo $url?>";			
	
		this.insert = function(properties){
			return $http.post(postURL, properties);
		};
	
	<?php endif;?>
	
	<?php if($methods['PUT']):?>
		
		var putURL="<?php echo $url;?>/:param";
		
		this.update = function(properties){
			return $http.put(putURL.replace(':param', properties.id), properties);
		};
	
	<?php endif; ?>
	
	<?php if($methods['DELETE']):?>
		
		var deleteURL="<?php echo $url;?>/:param";

		this.delete = function(id){
			return $http.delete(deleteURL.replace(':param', id));
		};
	
	<?php endif;?>
	
	this.show = function(id){
	
		var showURL="<?php echo $url;?>";	
	
		return $resource(showURL + '/' + id).get();
	}
	
}]);