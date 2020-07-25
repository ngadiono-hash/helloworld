
const edited = $('#edited-lesson');
const addSnip = $('#main-accord-add');
const snip = $('#main-accord-snippet');
const subSnip = $('#sub-accord');

function preview(){
	let container = CKEDITOR.instances.ckedit.getData();
	let previewFrame = document.getElementById('frame-preview').contentWindow.document;
	let plainText = '' +
	`<link rel="stylesheet" href="http://localhost/offline/roboto.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/bootstrap/bootstrap.min.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/theme/theme.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/prism/prism-line.css">`+
  `<link rel="stylesheet" href="${host}assets/css/global.css">`+
  `<link rel="stylesheet" href="${host}assets/css/js-lesson.css">`+
  `<style>body { padding: 30px; text-align: justify; }</style>`+
  `<body class="blog-content">`+
	container +
	`</body>`+
	`<script src="${host}assets/vendor/prism/prism-line.js"><\/script>`+
	`<script src="${host}assets/vendor/jquery/jquery.min.js"><\/script>`+
	`<script>
	$(function(){
	var prv = $('.blog-content');
	var a = prv.find('[href*=tryit]').addClass('btn btn-default').text('Try It');
	var pre = prv.find('.code-toolbar pre.language-javascript.line-numbers').siblings('.toolbar');
	for (var i = 0; i < a.length; i++) {
	  pre[i].append(a[i]);
	}
	prv.find('.wrapper-content').after('<hr class="mb-5">').before('<span class="anchor"></span>');
	});
	<\/script>`;
	previewFrame.open();
	previewFrame.writeln(plainText);
	previewFrame.close();
	$('.splitter').addClass('changed');
}

function templateSnip(i){
	let links = `${host}tryit/file/${i.title.replace(/\s+/g,'-').toLowerCase()}`;
	let temp = '' +
	`<form>`+
	`<button type="button" class="btn btn-block btn-default my-2" data-toggle="collapse" data-target="#acc-${i.id}" aria-expanded="false">${i.title}</button>`+
	`<div id="acc-${i.id}" data-id="${i.id}" class="collapse p-2" data-parent="#sub-accord">`+
	`<ul class="nav nav-tabs nav-fill">`+
	`<button type="button" class="btn btn-outline-success mx-1"><i class="fa fa-fw fa-save"></i></button>`+
	`<button type="button" data-href="${links}" class="btn btn-outline-dark mx-1"><i class="fa fa-fw fa-link"></i></button>`+
	`<a href="${links}" class="btn btn-outline-info mx-1" target="_blank"><i class="fa fa-fw fa-location-arrow"></i></a>`+
	`<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-h-${i.id}">HTM</a></li>`+
	`<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-c-${i.id}">CSS</a></li>`+
	`<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-j-${i.id}">JSC</a></li>`+
	`<li class="nav-item">`+
  `<input type="hidden" name="id" value="${i.id}">`+
  `<input type="text" name="title" class="form-control" value="${i.title}"></li></ul>`+
	`<div class="tab-content">`+
	`<div class="tab-pane p-2 active" id="tab-h-${i.id}">`+
	`<textarea class="form-control" name="htm" rows="8">${i.htm}</textarea></div>`+
	`<div class="tab-pane p-2 fade" id="tab-c-${i.id}">`+
	`<textarea class="form-control" name="css" rows="8">${i.css}</textarea></div>`+
	`<div class="tab-pane p-2 fade" id="tab-j-${i.id}">`+
	`<textarea class="form-control" name="jsc" rows="8">${i.jsc}</textarea></div>`+
	`</div></div></form>`;
	return temp;
}
$(function(){
	$('.panel-left,.content-left').resiz({ handleSelector: ".splitter", resizeHeight: false });
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
			u: 'xhra/update_lesson', d: myData, b: null, c: null,
			s: function(data){
				myAlert(data);
				if (data[0] == 1) {
					$('.splitter').removeClass('changed');
					$('#input-update').html(data[3]).css('color','red');
					let h3 = '', h4 = '';
					if(data[4] != ''){
						data[4].forEach(function(el) { h3 += `<li>${el}</li>` });
					}
					if (data[5] != '') {
						data[5].forEach(function(el) { h4 += `<li>${el}</li>` });
					}
					$('#sub-h3').html(h3);
					$('#sub-h4').html(h4);
				}
			}
		});
	});

	// =================== ADD SNIPPET
	addSnip.on('click','.btn-outline-success',function(e){
		e.preventDefault();
		let form = $(this).parents('.collapse').find('form');
		let myData = form.serialize();
		ajaxTemp({
			u: 'xhra/create_snippet', d: myData, b: null, c: null,
			s: function(data){
				myAlert(data);
				if (data[0] == 1) {
					form.find('input:not([type="hidden"])').val('');
					form.find('textarea').val('');
					let temp = templateSnip(data[3]);
					subSnip.append(temp);
				}
			}
		});
	});

	// =================== UPDATE SNIPPET
	subSnip.on('click','.btn-outline-success',function(e){
		e.preventDefault();
		let form = $(this).parents('form');
		let myData = form.serialize();
		ajaxTemp({
			u: 'xhra/update_snippet', d: myData, b: null, c: null,
			s: function(data){
				myAlert(data);
				if (data[0] == 1) {
					let temp = templateSnip(data[3]);
					form.html(temp);
				}
			}
		});
	});

	subSnip.on('click','.btn-outline-dark',function(e){
		let href = $(this).data('href');
		copyToClipboard(href);
	});


	// =================== DELETE
	// edited.on('click','.btn-del',function(e){
	// 	alert('nothing happend');
	// });
});