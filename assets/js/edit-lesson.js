// $(window).bind('beforeunload', function(e) {
//   if (confirm) return "Are you sure?";
// });

const edited = $('#edited-lesson');
const addSnip = $('#main-accord-add');
const snip = $('#main-accord-snippet');
const subSnip = $('#sub-accord');
let previewFrame = document.getElementById('frame-preview').contentWindow.document;
let auto = true;

function editorAdm(){
	let container = CKEDITOR.instances.ckedit.getData();
	let plainText = '' +
	`<link rel="stylesheet" href="http://localhost/offline/roboto.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/bootstrap/bootstrap.min.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/theme/theme.css">`+
  `<link rel="stylesheet" href="${host}assets/vendor/prism/prism-line.css">`+
  `<link rel="stylesheet" href="${host}assets/css/global.css">`+
  `<link rel="stylesheet" href="${host}assets/css/js-lesson.css">`+
  `<style>body { padding: 30px; }</style>`+
  `<body class="blog-content">\n${container}\n</body>`+
	`<script src="${host}assets/vendor/prism/prism-line.js"><\/script>`+
	`<script src="${host}assets/vendor/jquery/jquery.min.js"><\/script>`+
	`<script src="${host}assets/js/injected-sandbox.js"><\/script>`;
	
	previewFrame.open();
	previewFrame.writeln(plainText);
	previewFrame.close();
	$('.ctrl .btn-primary').addClass('changed');
}



$(function(){
	CKEDITOR.replace('ckedit');
	CKEDITOR.dtd.$removeEmpty['i'] = false;
	editorAdm();
	CKEDITOR.instances.ckedit.on('change',wait(editorAdm,1000));
	$('.ctrl').on('click','.btn-outline-info',function() {
		// let ic = $(this).find('i');
		// ic.toggleClass('fa-hourglass-half fa-stop');
		// if (ic.hasClass('fa-stop')) {
		//   ic.removeClass('fa-spin');
		// } else {
		//   ic.addClass('fa-spin');
		// }
	});
	$('.content-left').resiz({ handleSelector: ".splitter", resizeHeight: false });

	// =================== UPDATE
	edited.on('click','#btn-update',function(){
		let countWords = $('#cke_wordcount_ckedit').text().replace(',','').split(' ');
		let countSnips = subSnip.find('form').length;
		let myData = {
			id: $('#input-id').val(),
			title: $('#input-title').val(),
			slug: $('#input-slug').val(),
			content: CKEDITOR.instances.ckedit.getData(),
			length: countWords[3],
			snippet: countSnips
		};
		ajaxTemp({
			u: 'xhra/update_lesson', d: myData, b: null, c: null,
			s: function(data){
				myAlert(data);
				if (data[0] == 1) {
					$('.ctrl .btn-primary').removeClass('changed');
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
					$('#snip-length').html(countSnips);
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
					let temp = templateSnip(data[3],data[4]);
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

	// =================== DELETE SNIPPET
	subSnip.on('click','.btn-outline-danger',function(e){
		e.preventDefault();
		let form = $(this).parents('form');

		let myData = form.serialize();
		let ok = confirm(`Delete ?`);
		if (ok) {
			ajaxTemp({
				u: 'xhra/delete_snippet', d: myData, b: null, c: null,
				s: function(data){
					myAlert(data);
					if (data[0] == 1) {
						form.remove();
					}
				}
			});
		}
	});	


	// =================== DELETE
	// edited.on('click','.btn-del',function(e){
	// 	alert('nothing happend');
	// });
});