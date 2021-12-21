/*-----------------------------------------------------------------------------------
    Class: apSearcher
    Use: Easy search in list with jquery plugin 
    Programming: Mohsen shafiee
    Site:  www.aparnet.ir
    Email: mohsen.sh12@hotmail.com 
-----------------------------------------------------------------------------------*/
(function($){
  $.apSearcher = function(settings){
    var config = $.extend({
      container:  'none',
      search: 'none',
      input: 'none',
      auto_focus: 'off'
    }, settings);
    
    if(config.auto_focus == 'on'){
      $(config.input).focus();
    }
    
    
    $(config.input).on('click change keyup blur', function(){
      var inputText = $(this).val();
      var rg = new RegExp(inputText, 'i');
      
      $(config.container).each(function(){
        var searchText = $(this).text();
        if (searchText.search(rg) == -1){
          $(this).closest(config.container).slideUp('fast');
        }else{
          $(this).closest(config.container).slideDown('fast');
        }
      })
    })
  }
})(jQuery);
