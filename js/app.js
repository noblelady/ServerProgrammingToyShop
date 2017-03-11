$(document).foundation();
$(document).ready(function(){
  $('.catalog').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 5
  });
  $('.admin-animals').slick({
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 5
  });
});
