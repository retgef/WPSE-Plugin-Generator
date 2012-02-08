jQuery(document).ready(function($){
    $('.filters span, .actions span').click(function(){
       var _container = $(this).parents('p');
       var _hook_type = _container.attr('class');
       $('.'+_hook_type).append('<input type="text" name="'+_hook_type+'[]">');
    });
 });