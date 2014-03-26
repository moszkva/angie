<?php echo $appName;?>Services.service('<?php echo $controller;?>Service', ['$http', '$resource', function($http, $resource){

	<?php if(!empty($postURL)):?>
	
		var postURL="<?php echo $postURL?>";			
	
		this.insert = function(properties){
			return $http.post(postURL, properties);
		};
	
	<?php endif;?>
	
	<?php if(!empty($putURL)):?>
		
		var putURL="<?php echo $putURL;?>";
		
		this.update = function(properties){
			return $http.put(putURL.replace(/:([A-Z]+)/i, properties.id), properties);
		};
	
	<?php endif; ?>
	
	<?php if(!empty($deleteURL)):?>
		
		var deleteURL="<?php echo $deleteURL;?>";

		this.delete = function(id){
			return $http.delete(deleteURL.replace(/:([A-Z]+)/i, id));
		};
	
	<?php endif;?>
	
	<?php if(!empty($showURL)):?>
		
		this.show = function(id){

			var showURL="<?php echo $showURL;?>";	

			return $resource(showURL.replace(/:([A-Z]+)/i, id)).get();
		}
		
		this.list = function(id, params){
			var listURL="<?php echo $showURL;?>";
			var settings={query:{method: 'get', isArray:true}};
			params = (typeof params==='undefined' ? {} : params);
		
			return $resource(listURL.replace(/:([A-Z]+)/i, id), params, settings).query();
		}		
		
	<?php endif;?>
		
	
}]);