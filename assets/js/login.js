$(document).ready(function() {
  $('.nd label').css('opacity',0);
  let btnLog = $('.btn-log');
  $('#form-login input').on('keyup',function(){
   var rmb, $1,$2,$3;
   rmb = $('#remember');
   $1   = $('#input-key_email');
   $2   = $('#input-key_pass');
   if( $(this).val() != '' ){
    $(this).parents('.form-group').find('label').css('opacity',1);
  } else {
    $(this).parents('.form-group').find('label').css('opacity',0);
  }
  $(this).parents('.form-group').find('#error').html('');
  });

  $('#form-login').on('click','.btn-log',function(e) {
   e.preventDefault();
    let myData = {
      key_email: $('[name="key_email"]').val(),
      key_pass: $('[name="key_pass"]').val(),
      remember: $('[type="checkbox"]').val()
    }
    ajaxTemp({
      u: 'xhrm/set_login', d: myData, b: null, c: null,
      s: function(data){
        $.each(data, function(key, value){
          $('[name="'+key+'"]').parents('.form-group').find('#error').html(value);
        });
        if (data[0] == 1) myAlert(data);
      }
		});
  });
});