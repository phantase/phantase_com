$( function(){
	
	if( $('#contentPage').size() > 0 ){
	
		CKEDITOR.config.extraPlugins = 'custoSave,youtube';

		var editotor = CKEDITOR.replace( 'contentPage', {
						toolbar: [
							{ name: 'document', groups: [ 'mode', 'document' ], items: [ 'Source', '-', 'custoSave', 'Preview' ] },
							{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
							{ name: 'editing', groups: [ 'spellchecker' ], items: [ 'Scayt' ] },
							{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
							{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
							'/',
							{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Youtube' ] },
							{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
							{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
							{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
							{ name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
						]});
						
		editotor.on("save",function(data){
			var page_id = $('#page_id').val();
			var page_content = this.getData();
			
			$.ajax({ 
				type : 'POST',
				data : { 'action':'editPage',
						'page_id': page_id,
						'page_content': page_content},
				url  : './admin/article/processwrite/',
				success: function(responseText){ // Get the result and assign to each cases
					if( responseText == 1 ){
						$('#saveResult').css('color','#007F46').html('Page sauvegardée').fadeIn().delay(3000).fadeOut();
					} else {
						$('#saveResult').css('color','#FF6A00').html('Erreur').fadeIn().delay(3000).fadeOut();
					}
				}
			});
		});
	
	}
	
	$('#saveMeta').click(function(){
		
		//$article_id,$article_titre,$article_html,$article_accroche
		
		var article_id = $('#article_id').val();
		var article_titre = $('#article_titre').val();
		var article_html = $('#article_html').val();
		var article_accroche = $('#article_accroche').val();
		
		$.ajax({ 
			type : 'POST',
			data : { 'action':'editArticle',
					'article_id': article_id,
					'article_titre': article_titre,
					'article_html': article_html,
					'article_accroche': article_accroche},
			url  : './admin/article/processwrite/',
			success: function(responseText){ // Get the result and assign to each cases
				if( responseText == 1 ){
					$('#saveResult').css('color','#007F46').html('Métadonnées sauvegardées').fadeIn().delay(3000).fadeOut();
				} else {
					$('#saveResult').css('color','#FF6A00').html('Erreur').fadeIn().delay(3000).fadeOut();
				}
			}
		});
	});
	
	$('#selectedPage').change(function(){
		window.location = $('#article_base_write_url').val() + $(this).val() + "/";
	});
	
	$('#icon_plus_page').click(function(){
		var article_html = $('#article_html').val();
		
		$.ajax({ 
			type : 'POST',
			data : { 'action':'createPage',
					'article_html': article_html},
			url  : './admin/article/processwrite/',
			success: function(responseText){ // Get the result and assign to each cases
				if( responseText > 0 ){
					$('#saveResult').css('color','#007F46').html('Page créée').fadeIn().delay(3000).fadeOut();
					$('#selectedPage').append('<option value="'+responseText+'">'+responseText+'</option>');
					$('#nbPages').html(responseText);
				} else {
					$('#saveResult').css('color','#FF6A00').html('Erreur').fadeIn().delay(3000).fadeOut();
				}
			}
		});
	});
					
});