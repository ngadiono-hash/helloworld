$(document).ready(function() {	
	compilex();
	$('#input-title').on('change',function() {
		$('#title-snippet').text($(this).val());
	});
	$('#select-library').select2({
		placeholder: 'pilih resource library'
	});
	$('#select-tag').select2({
		placeholder: 'pilih maksimal 3 tag',
		maximumSelectionLength: 3
	});	
	$('#checkbox-public').on('change',function(){
		if(this.checked){
			$('#input-public').val(1);
		} else {
			$('#input-public').val(0);
		}
	});
	$('#select-tag').on('change',function(){
		var tag_name = [];
		var samp = $(this).find('option:selected',this);
		var tag_val = $(this).val();	
		samp.each(function(){
			tag_name.push('<a class="btn btn-sm btn-prm">'+ $(this).text() +'</a>');
			$('#input-tag').val(tag_val);
			$('#tag-name').html(tag_name.join(' - '));
		});
		if(samp.length == 0){
			$('#input-tag').val('');
			$('#tag-name').text('belum ada tag');
		}		
	});
	$('#select-library').on('change',function(){
		$('.add-library').removeClass('hide').fadeIn();
		var selected_id = [];
		var selected_name = [];
		var sample = $(this).find('option:selected',this);
		var selected_val = $(this).val();	
		sample.each(function(){
			selected_id.push($(this).data('id'));
			selected_name.push('<a class="btn btn-sm btn-prm" title="'+$(this).val().match(uri_pattern).join('\n')+'">'+ $(this).text() +'</a>');
			$('#input-framework').val(selected_id);
			$('#source-framework').val(selected_val.join('\n'));
			$('#source-name').html(selected_name.join(' - '));
		});
		if(sample.length == 0){
			$('#input-framework').val('');
			$('#source-framework').val('');
			$('#source-name').text('tidak ada framework yang dipilih');
		}
		compilex();
	});
	$('#checkbox-jquery').on('change',function(){
		var check = $(this).data('id');
		var jVal 	= $(this).val();
		if(this.checked){
			$('#input-jquery').val(check);
			$('#source-jquery').val(jVal);
			$('#jquery-name').html('<a class="btn btn-sm btn-prm" title="'+jVal.match(uri_pattern).join('\n')+'">jQuery</a>');
			$('#badge-js').html('JS + jQuery');
		} else {
			$('#input-jquery').val('');
			$('#source-jquery').val('');
			$('#jquery-name').text('jQuery non-aktif');
			$('#badge-js').html('Tab JAVASCRIPT');
		}
		compilex();
	});
}); // ready