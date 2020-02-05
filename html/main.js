const some = "some";
const el = document.querySelector('.shuffle-word');

const arr = some.split('');


function shuffle(array) {
    for (let i = array.length - 1; i > 0; i--) {
      let j = Math.floor(Math.random() * (i + 1)); 
      
      // "деструктурирующее присваивание"    
      // let t = array[i];
      // array[i] = array[j];
      // array[j] = t
      [array[i], array[j]] = [array[j], array[i]];      
    }

    if(array.join('') === some) {
        console.log('Совпадение');
        return
    }
    el.innerHTML = array;
}



$(function(){

  $('.steps__item').click(function(){
    $(this).find('.steps__hide').addClass('hidden');    
  });

  $('.video__link').click(function(e){
    e.preventDefault();

    const path = "https://www.youtube.com/embed/XiaBl_3Paw8";

    $('.media__video').toggleClass('hidden');
    $('.media__img').toggleClass('hidden');
    $('.media__frame').attr('src', path);
  });
});



