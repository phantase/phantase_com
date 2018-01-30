$( function(){
	
	$('.gallery_view img').click(function(){
		$(this).toggleClass('selected');
	});
	
	$('#gallery_action_select_none').click(function(){
		$('.gallery_view img.selected').each(function(index){
			$(this).removeClass('selected');
		});
	});
	
	$('#gallery_action_select_all').click(function(){
		$('.gallery_view img').each(function(index){
			$(this).addClass('selected');
		});
	});
	
	$('#gallery_action_select_invert').click(function(){
		$('.gallery_view img').each(function(index){
			$(this).toggleClass('selected');
		});
	});
	
	$('#gallery_action_select_none').click(function(){
		$('.gallery_view img.selected').each(function(index){
			$(this).removeClass('selected');
		});
	});
	
	$('#gallery_action_generate_gallery').click(function(){
		var gdir = $('#gallerydir').text();
		var only = "";
		$('.gallery_view img.selected').each(function(index){
			only += this.id+";";
		});
		if( only.length > 0 ){
			only = " only="+only.substr(0,only.length-1);
		}
		var output = "[gallery dir="+gdir+only+"]";
		$('#generated_code').val(output);
	});
	
	$('#gallery_action_generate_singlepic').click(function(){
		var gdir = $('#gallerydir').text();
		var output = "";
		$('.gallery_view img.selected').each(function(index){
			output += "[singlepic dir="+gdir+" file="+this.id+" width=600 height=600]\n";
		});
		$('#generated_code').val(output);
	});
	
	$('#generated_code').focus(function(){
		$(this).select();
		$(this).mouseup(function(){
			$(this).unbind("mouseup");
			return false;
		});
	});
	
});