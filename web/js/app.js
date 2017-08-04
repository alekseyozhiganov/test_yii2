(function(){
	$('.calculation-delete').click(function(e){
		if(!confirm('Are you sure you want to delete the calculation?')){
			e.preventDefault();
		}
	});
})();