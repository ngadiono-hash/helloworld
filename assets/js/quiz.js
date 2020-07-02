const form = $('.quiz-content'), userForm = $('#form-user'), fin = $('.finish');
let myRest, active, iData, user, timeleft, timer, barWidth, barDiv, totalQuiz = 0;
let myQuiz = [], timetotal = 30;
let timeStart, timeEnd;

function getFormData(form){
  let in_array = {}, un_array = form.serializeArray();
  $.map(un_array, function(n, i){
    in_array[n['name']] = n['value'];
  });
  return in_array;
}
function myTimer() {
  timeleft = (timeleft === undefined) ? timetotal : timeleft ;
  barDiv = form.find('.quiz-form').parents('.active').find('.time-progress');
  barWidth = timeleft * barDiv.width() / timetotal;
  barDiv.find('div').animate({ width: barWidth }, 500);
  form.find('.quiz-form').parents('.active').find('.spent').html( timeleft + " detik");
  timeleft--;
  if (timeleft <= -1) {
    clearInterval(timer);
    slide();
  }
}
function generateResultQuiz(){
  let temp = `<div class="accordion" id="accord">`;
  let term;
  for (let i = 0; i < myRest[0].length; i++){
    link = myRest[0][i].rel.replace(/\s+/g,'-').toLowerCase();
    term = (myRest[0][i].result) ? 'btn-default' : 'btn-danger';
    temp += `<div class="card mb-1">`;
    temp += `<div class="card-header ${term}">`;
    temp += `<a data-toggle="collapse" data-target="#co${i}" aria-expanded="false">Soal Latihan#${i+1}<span class="ml-auto"></span></a>`;
    temp += `</div>`;
    temp += `<div id="co${i}" class="collapse" data-parent="#accord">`;
    temp += `<div class="card-body">`;
    temp += myRest[0][i].question;
    temp += `<div class="row text-center">`;
    temp += `<div class="col-lg-6"><div class="alert-success py-3 px-1 rounded"><h5>jawaban benar</h5><hr><h6 class="a">${myRest[0][i].correct}</h6></div></div>`;
    if (!myRest[0][i].result) {
      temp += `<div class="col-lg-6"><div class="alert-warning py-3 px-1 rounded"><h5>jawaban kamu</h5><hr><h6 class="a">${myRest[0][i].yours}</h6></div></div>`;
    }
    temp += `</div>`;
    temp += `<h5 class="mt-3">referensi : <a href="${myRest[0][i].rel}" class="link" target="_blank">${myRest[0][i].title}</a></h5>`;
    temp += `</div>`;
    temp += `</div>`;
    temp += `</div>`;
  }
  temp += `</div>`;

  $('#modal-result').find('.result-content').html(temp);
  Prism.highlightAll();
}
function slide(){
  timeleft = timetotal;
  timer = setInterval(myTimer,1000);
  active = form.find('.quiz-form').parents('.active');
  iData = getFormData(active.find('form'));
  myQuiz.push(iData);

  active.removeClass('scale-in-center').addClass('slide-out-left');
  setTimeout(function(){
    active.next('.card').addClass('active').fadeIn();
    active.hide().removeClass('slide-out-left active').addClass('scale-in-center');
    if (active.next('div.card').length == 0) {
      timeEnd = new Date().getTime();
      ajaxTemp({
        u: 'xhrm/get_result',
        d: { quest: myQuiz },
        b: startAjax,
        s: function(data){
          clearInterval(timer);
          let dat = data;
          let temp = '';
          temp += `<button class="btn btn-default mx-1 check-rest">Periksa Jawaban</button>`;
          temp += `<button class="btn btn-default mx-1 submit-rest">Submit Score</button>`;
          
          fin.find('.side-setup .alert-info h2').html(dat.plain.summary[0]);
          fin.find('.side-setup .alert-success h2').html(dat.plain.summary[1]);
          fin.find('.side-setup .alert-danger h2').html(dat.plain.summary[2]);
          fin.find('.scores').html(`${dat.score.toFixed(2)}`);
          fin.find('.sum-result').html(temp);
          fin.find('.usr-result').html('Hai ' + user);
          fin.find('.msg-result').html(dat.plain.msg);
          fin.find('.img-result').attr('src',`${host}assets/img/emo/${dat.plain.img}`);
          fin.fadeIn();
          myRest = [dat.evaluate,dat.score.toFixed(2)];
          generateResultQuiz();
        },
        c: endAjax
      });
    }
  },700);
}
function slidePre(select){
  $(select).removeClass('scale-in-center').addClass('slide-out-left');
  setTimeout(function(){
    $(select).next('.setup').fadeIn();
    $(select).hide().removeClass('slide-out-left').addClass('scale-in-center');
  },700);
}

// quiz function
$(function(){
  $('.quiz-content').on('click','button', function(){
    let $target = $('.anch');
    $('html').animate({'scrollTop': $target.offset().top });
  });

  form.on('change','input[name="category"]',function(e){
    label = $(this).val();
    $(e.target).parents('.side-setup').find('.groups').html('<button type="button" class="btn scale-in-center btn-default">Selanjunya</button>');
  });
  $('.welcome').on('click','.btn-default',function(){
    slidePre('.welcome');
  });
  userForm.find('input').keyup(wait(function(e){
    user = $(this).val();
    $(this).blur();
    ajaxTemp({
      u: 'xhrm/check_user',
      d: {user: user, label: label},
      b: function(){
        userForm.find('.user-result').hide();
        userForm.find('img').show();
      },
      s: function(data){
        let dat = data;
        userForm.find('img').hide();
        $('.user-result').html(dat[1]).show();
        if (dat[0]) {
          userForm.find('input').removeClass('input-error');
          userForm.find('.groups').html('<button type="button" class="btn btn-default scale-in-center">Selanjutnya</button>');
        } else {
          userForm.find('input').addClass('input-error');
          userForm.find('.groups').html('');
        }
      },
      c: null
    });
  }, 1000));
  $('.sign').on('click','.btn-default',function(){
    $.post(host+'xhrm/get_quiz',{ level:label },function(data){
      $('.start').after(data);
      let len = form.find('form.quiz-form');
      totalQuiz = len.length;
      let cat = form.find('form.quiz-form').data('name');
      $('.quiz-count').html(totalQuiz);
      $('.category-active').html(cat);
      Prism.highlightAll();
    });
    $('.user-active').html(user);
    slidePre('.sign');
  });
  userForm.find('input').focus(function(){
    userForm.find('input').removeClass('input-error');
    userForm.find('.groups').html('');
  });
  $('.start').on('click','.btn-default',function(){
    timeStart = new Date().getTime();
    timer = setInterval(myTimer,1000);
    $('.start').hide().next('.card').fadeIn().addClass('active');
    form.find('.total').html(totalQuiz);
  });
  form.on('change','input[name="ch"]',function(e){
    $(e.target).parents('.active').find('.next-slide').fadeIn();
  });
  form.on('click',function(e){
    let $this = $(e.target);
    if ($this.hasClass('next-slide')) {
      timeleft = -1;
      myTimer();
    } else if ($this.hasClass('check-rest')) {
      $('#modal-result').modal('show');
    } else if ($this.hasClass('submit-rest')) {
      ajaxTemp({
        u: 'xhrm/submit_score',
        d: { score: myRest[1], label: label, user: user },
        b: startAjax,
        s: function(data) { 
          myAlert(data);
          $this.remove() 
        },
        c: endAjax
      });
    }
  });
});