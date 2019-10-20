$(document).ready(function(){
  $('#btn-logout').on('click',function(e){
    e.preventDefault();
    var href = $(this).data('href');
    Swal.fire({
      title : '<h1 class="header-swal danger">H<small>ai...</small></h1>',
      html : 
      '<div class="img-swal">' +
      '<div class="text-focus-in"><img src="'+ host +'assets/img/feed/no.gif"></div>' + 
      '</div>' +
      '<h3 class="info-swal danger">apa kamu yakin ingin logout ?</p>',
      type : '',
      showCancelButton : true,
      confirmButtonText: '<span>Ya</span>',
      cancelButtonText: '<span>Ngga</span>',
      buttonsStyling : false,
      customClass: {
        confirmButton: 'effect effect-prm',
        cancelButton: 'effect effect-no'
      }
    }).then((result) => {
      if(result.value){
          Swal.fire({
            title : '<h1 class="header-swal success">Y<small>eah...</small></h1>',
            html :
            '<div class="img-swal">'+
            '<img class="text-focus-in" src="'+ host +'assets/img/feed/bye.gif">'+
            '</div>' + 
            '<h3 class="info-swal success">sedang mengalihkan halaman</h3>' +
            '<h4 class="message-swal">mohon tunggu sebentar</h4>' +
            '<img src="'+ host +'assets/img/feed/bars.svg" height="50">',
            type : '',
            showConfirmButton: false,
            showCloseButton: false,
          });
        setTimeout(function(){
          window.location.href = href;
        }, 3000);
      }
    });
  });  
});