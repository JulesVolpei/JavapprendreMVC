


var mySwiper = new Swiper('.swiper-container' , {
  slidesPerView : 1,
  centeredSlides : true,
  longSwipes: false,
  effect : 'coverflow',
  coverflowEffect: {
    rotate: 3,
    stretch: 0,
    depth: 150,
    modifier: 3,
    slideShadows: true

  },

  pagination: {
    el: '.swiper-pagination',
    clickable: true,
    renderBullet: function (index, className) {
        return '<span class= "swiper-pagination-bullet"></span>';
      },
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

})