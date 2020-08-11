const Quiz = $('.quiz-content'),
  setWel = $('.welcome'),
  setSign = $('.sign'),
  setStart = $('.start'),
  up = $('.anch'),
  ending = $('.finish');
let myRest, ctg, ctgA, usr, totalQuiz, sqActive, sqForm, iData, barWidth, barDiv;
let myQuiz = [];
let totalTime = 30, remainTime, animateTime;
let timeStart = null, timeEnd, spent;
let btn = '<button type="button" class="btn btn-default scale-in-center">Selanjutnya</button>';

lead();

function lead(){
  $.post(host+'xhrm/boarding',{ lb: label },function(data){
    let d = $.parseJSON(data), bg = d.beginner.da, md = d.medium.da;
    let columns = ['rank','name','score','spent','date'];
    let head = ['rangking','username','skor','durasi','terdaftar'];
    $('#js-bg').html(createTable(bg,columns,head));
    $('#js-md').html(createTable(md,columns,head));
    let eachTdSp = $(".quiz-board table tr td:nth-child(4)");
    let eachTdDt = $(".quiz-board table tr td:nth-child(5)");
    for (let i = 0; i < eachTdSp.length; i++) {
      let cvrtSp = msToTime(eachTdSp[i].innerHTML);
      let cvrtDt = convert_time(eval(eachTdDt[i].innerHTML),true);
      eachTdSp[i].innerHTML = cvrtSp;
      eachTdDt[i].innerHTML = cvrtDt;
    }
  });
}

function getFormData(form){
  let in_array = {}, un_array = form.serializeArray();
  $.map(un_array, function(n, i){
    in_array[n['name']] = n['value'];
  });
  return in_array;
}
function timeToSlide() {
  remainTime = (remainTime === undefined) ? totalTime : remainTime ;
  barDiv = Quiz.find('.squence-form').parents('.active').find('.time-progress');
  barWidth = remainTime * barDiv.width() / totalTime;
  barDiv.find('div').animate({ width: barWidth }, 500);
  Quiz.find('.squence-form').parents('.active').find('.remaining').html( remainTime + " detik");
  remainTime--;
  if (remainTime <= -1) {
    clearInterval(animateTime);
    nextQuest();
  }
}
function clue(){
  let temp = `<div class="accordion" id="accord">`;
  let term;
  for (let i = 0; i < myRest[0].length; i++){
    link = myRest[0][i].l.replace(/\s+/g,'-').toLowerCase();
    term = (myRest[0][i].r) ? 'btn-default' : 'btn-danger';
    temp += `<div class="card mb-1">`;
    temp += `<div class="card-header ${term}">`;
    temp += `<a data-toggle="collapse" data-target="#co${i}" aria-expanded="false">Soal Latihan#${i+1}<span class="ml-auto"></span></a>`;
    temp += `</div>`;
    temp += `<div id="co${i}" class="collapse" data-parent="#accord">`;
    temp += `<div class="card-body">`;
    temp += myRest[0][i].q;
    temp += `<div class="row text-center">`;
    temp += `<div class="col-lg-6"><div class="alert-success py-3 px-1 rounded"><h5>jawaban benar</h5><hr><h6 class="a">${myRest[0][i].c}</h6></div></div>`;
    if (!myRest[0][i].r) {
      temp += `<div class="col-lg-6"><div class="alert-warning py-3 px-1 rounded"><h5>jawaban kamu</h5><hr><h6 class="a">${myRest[0][i].y}</h6></div></div>`;
    }
    temp += `</div>`;
    temp += `<h5 class="mt-3">referensi : <a href="${myRest[0][i].l}" class="link" target="_blank">${myRest[0][i].t}</a></h5>`;
    temp += `</div>`;
    temp += `</div>`;
    temp += `</div>`;
  }
  temp += `</div>`;

  $('#modal-result').find('.result-content').html(temp);
  Prism.highlightAll();
}
function nextQuest(){
  remainTime = totalTime;
  animateTime = setInterval(timeToSlide,1000);
  sqActive = Quiz.find('.squence-form').parents('.active');
  sqForm = sqActive.find('form');
  iData = getFormData(sqForm);
  myQuiz.push(iData);


  sqActive.removeClass('scale-in-center').addClass('slide-out-left');
  setTimeout(function(){
    sqActive.next('.card').addClass('active').fadeIn();
    sqActive.hide().removeClass('slide-out-left active').addClass('scale-in-center');
    if (sqActive.next('div.card').length == 0) {
      timeEnd = new Date().getTime();
      spent = timeEnd - timeStart;
      ajaxTemp({
        u: 'xhrm/get_result',
        d: { quest: myQuiz, dur: spent, usr: usr, ctg: ctg, date: timeEnd },
        b: startAjax,
        c: endAjax,
        s: function(data) {
          clearInterval(animateTime);
          ending.find('.side-setup .alert-info h2').html(totalQuiz);
          ending.find('.side-setup .alert-success h2').html(data.result.rest.true);
          ending.find('.side-setup .alert-danger h2').html(data.result.rest.false);
          ending.find('.time-result').html(msToTime(data.result.rest.spent));
          ending.find('.sum-result').html(`<button class="btn btn-default mx-1 check-rest">Periksa Jawaban</button>`);
          ending.find('.fire-result').html(data.result.rest.fire);
          ending.find('.msg-result').html(data.result.msg);
          ending.find('.img-result').attr('src',`${host}assets/img/emo/${data.result.img}`);
          ending.find('.scores').html(data.result.rest.score);
          ending.fadeIn();
          myRest = [data.evaluate];
          lead();
          clue();
        }
      });
    }
  },700);
}
function slideSetup(select){
  $(select).removeClass('scale-in-center').addClass('slide-out-left');
  setTimeout(function(){
    $(select).next('.setup').fadeIn();
    $(select).hide().removeClass('slide-out-left').addClass('scale-in-center');
  },700);
}

// quiz function
$(function(){
  setWel.on('change','input[type="radio"]',function(e){
    ctg = $(this).val();
    ctgA = $(this).parent('.wrap').find(`label[for="${ctg}"]`).text();
    $(e.target).parents('.side-setup').find('.groups')
    .html(btn);
  });
  setWel.on('click','.btn-default',function(){
    slideSetup('.welcome');
  });

  setSign.find('input').on({
    keypress : function(e) {
      if ( e.which == 13 ) e.preventDefault();
    },
    keyup : wait(function(){
      usr = $(this).val();
      $(this).blur();
      ajaxTemp({
        u: 'xhrm/get_user',
        d: { usr: usr, ctg: ctg },
        b: function(){
          setSign.find('.valid-user').hide();
          setSign.find('.side-setup img').show();
        },
        s: function(data){
          setSign.find('.side-setup img').hide();
          $('.valid-user').html(data[1]).show();
          if (data[0]) {
            setSign.find('input').removeClass('input-error');
            setSign.find('.groups').html(btn);
          } else {
            setSign.find('input').addClass('input-error');
            setSign.find('.groups').html('');
          }
        },
        c: null
      });
    }, 1000)
  });

  setSign.on('click','.btn-default',function(){
    $.post(host+'xhrm/get_quiz',{ ctg: ctg },function(data){
      setStart.after(data);
      totalQuiz = Quiz.find('.squence-form').length;
      Quiz.find('.quiz-total').html(totalQuiz);
      Quiz.find('.quiz-category').html(ctgA);
      Prism.highlightAll();
    });
    $('.quiz-user').html(usr);
    slideSetup('.sign');
  });

  setSign.find('input').focus(function(){
    setSign.find('input').removeClass('input-error');
    setSign.find('.groups').html('');
  });

  setStart.on('click','.btn-default',function(e){
    timeStart = new Date().getTime();
    animateTime = setInterval(timeToSlide,1000);
    setStart.hide().next('.card').fadeIn().addClass('active');
  });
  Quiz.on('change','input[name="ch"]',function(e){
    $(e.target).parents('.active').find('.next-slide').fadeIn();
  });
  Quiz.on('click','button',function() {
    $('html').animate({'scrollTop': up.offset().top });
  });
  Quiz.on('click',function(e){
    let $this = $(e.target);
    if ($this.hasClass('next-slide')) {
      remainTime = -1;
      timeToSlide();
    } else if ($this.hasClass('check-rest')) {
      $('#modal-result').modal('show');
    }
  });
});