// 모든 문서가 다 로딩이 되면 자동으로 실행해주는 함수
//(document.ready와 같다.)
$(function(){
  var slideshow = $('.slideshow'),
      slideshowImg = slideshow.find('#main_img_bar'),
      slides = slideshowImg.find('a'), // 슬라이드가 네 개라서 배열로 들어옴
      slidesCount = slides.length,
      nav = slideshow.find('#slideshow_nav'),
      prev = nav.find('.prev'),
      next = nav.find('.next'),
      currentIndex = 0, //현재 슬라이드를 첫 번째 화면으로 세팅해주는 변수값
      incrementValue = 1, // index의 증감치 조절
      interval = 3000, // 자동 슬라이드 변화 시간
      timer = null, // setInterval객체
      indicator = slideshow.find('#slideshow_indi');

      //가로로 슬라이드 배치
      //slides[0]~[3] 왼쪽 기준 0%~300%(100%씩 증가)
      slides.each(function(index){
        var newLeft = index*100+'%';
        $(this).css({left: newLeft}); //선택된 객체에서 움직임
      });

      //슬라이드 화면 이동하는 함수
      function goToSlide(index){
        slideshowImg.animate({left: -100*index+'%'}, 1000, 'easeInOutExpo');
        currentIndex = index;
        if(currentIndex === 0){
          prev.addClass('disabled');
        } else {
          prev.removeClass('disabled');
        }

        if(currentIndex === slidesCount-1){
          next.addClass('disabled');
        } else {
          next.removeClass('disabled');
        }
        indicator.find('a').removeClass('active');
        indicator.find('a').eq(currentIndex).addClass('active'); //해당 인덱스의 인디케이터만 검은색으로
      }

      //nav 이벤트 처리: 누를 때 마다 슬라이드 이동
      prev.click(function(event){
        event.preventDefault(); //앵커태그 기본 기능 막기
        if(currentIndex !== 0 ){
          currentIndex -= 1;
        }
        goToSlide(currentIndex);
      });
      next.click(function(event){
        event.preventDefault(); //앵커태그 기본 기능 막기
        if(currentIndex !== slidesCount-1 ){
          currentIndex += 1;
        }
        goToSlide(currentIndex);
      });

      indicator.find('a').click(function(event){
        event.preventDefault();
        var point = $(this).index(); //현재 누른 위치의 인덱스값을 받는다.
        goToSlide(point);
      });

      // 자동 이미지 슬라이드
      //setInterval (일을 하는 함수 구현, 시간);
      function autoDisplayStart(){
        timer = setInterval(function(){
          if(currentIndex === slidesCount-1){
            incrementValue = -1;
          } else if(currentIndex === 0){
            incrementValue = 1;
          }
          var nextIndex = (currentIndex + incrementValue) % slidesCount;
          goToSlide(nextIndex);
        }, interval);
      }

      function autoDisplayStop(){
        clearInterval(timer);
      }

      slideshow.mouseenter(function(event){
        autoDisplayStop();
      });
      slideshow.mouseleave(function(evnet){
        autoDisplayStart();
      });
      goToSlide(currentIndex);
      autoDisplayStart();
});
