
const edited = $('#edited-lesson');
function preview(){
	let container = CKEDITOR.instances.ckedit.getData();
	let previewFrame = document.getElementById('frame-preview').contentWindow.document;
	let plainText = '' +
	`<link rel="stylesheet" href="http://localhost/offline/roboto.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/bootstrap/bootstrap.min.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/theme/theme.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/prism/prism-line.css">`+
  `<link rel="stylesheet" href="${host}assets/css/global.css">`+
  `<link rel="stylesheet" href="${host}assets/css/blog.css">`+
  `<style>body { padding: 30px; text-align: justify; }</style>`+
  `<body class="blog-content">`+
	container +
	`</body>`+
	`<script src="${host}assets/vendor/prism/prism-line.js"><\/script>`+
	`<script src="${host}assets/vendor/jquery/jquery.min.js"><\/script>`+
	`<script>
	$(function(){
	var prv = $('.blog-content');
	prv.find('.code-toolbar pre.language-html').siblings('.toolbar').append('<button class="btn btn-default execute">Try It</button>');
	prv.find('a').addClass('link');
	prv.find('.wrapper-content').after('<hr class="mb-5">').before('<span class="anchor"></span>');
	});
	<\/script>`;
	previewFrame.open();
	previewFrame.writeln(plainText);
	previewFrame.close();
	$('.splitter').addClass('changed');
}
$(function(){
	CKEDITOR.replace('ckedit');
	CKEDITOR.dtd.$removeEmpty['i'] = false;
	preview();
	CKEDITOR.instances.ckedit.on('change', wait(preview,1000));
	// =================== UPDATE
	edited.on('click','#btn-update',function(){
		let countWords = $('#cke_wordcount_ckedit').text().replace(',','').split(' ');
		let myData = {
			id: $('#input-id').val(),
			title: $('#input-title').val(),
			slug: $('#input-slug').val(),
			content : CKEDITOR.instances.ckedit.getData(),
			length : countWords[3]
		};
		ajaxTemp({
			u: 'xhra/update_lesson',
			d: myData,
			b: null,
			s: function(data){
				myAlert(data);
				if (data[0] == 1) {
					$('.splitter').removeClass('changed');
					$('#input-update').html(data[3]).css('color','red');
					let h3 = '', h4 = '';
					if(data[4] != ''){
						data[4].forEach(function(el) { h3 += '<li>'+el+'</li>' });
					}
					if (data[5] != '') {
						data[5].forEach(function(el) { h4 += '<li>'+el+'</li>' });
					}
					$('#sub-h3').html(h3);
					$('#sub-h4').html(h4);
				}
			},
			c: null
		});
	});

	// =================== DELETE
	edited.on('click','.btn-del',function(e){
		alert('nothing happend');
	});
});