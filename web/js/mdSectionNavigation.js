var mdSectionNavigation = {

  observers: function(obj, active){
    $(obj).children().hide();
    $('#section' + active).addClass('current').show();
  },
  
  next: function(){
    if(typeof arguments[0] == 'undefined'){
      $('.current').removeClass('current').hide().next().addClass('current').fadeIn(1000);
    }else{
      $('.current').removeClass('current').hide();
      $('#section' + arguments[0]).addClass('current').fadeIn(500);      
    }
    return false;
  },
  
  previous: function(){
    $('.current').removeClass('current').hide();
    $('#section1').addClass('current').fadeIn(500);
    return false;
  }  
};
