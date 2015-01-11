app.directive('typeahead', [function() {

	var engine = new Bloodhound({
	  name: 'homesearch',
	  limit: 5,
  	// prefetch: '/search',
	  remote: '/search/%QUERY',
	  // datumTokenizer: function(datum) {
	  //   return Bloodhound.tokenizers.whitespace(datum.val);
	  // },
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace
	});

	var promise = engine.initialize();
	promise
		.done(function() { console.log('success!'); })
		.fail(function() { console.log('err!'); });

  return {
    restrict: 'C',
    scope: { title: '@' },
    link: function(scope, element, attrs) {
    	element.typeahead({
    		hint: true,
			  minLength: 3,
			  highlight: true,
			}, {
				name: 'engine',
				displayKey: 'val',
			  source: engine.ttAdapter()
			});
    }
  };

}]);