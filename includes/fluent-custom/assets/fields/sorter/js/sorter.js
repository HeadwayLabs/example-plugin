/**
 * Info Field
 */
(function($) {
    'use strict';
    
    $.fluent = $.fluent || {};
    
    $.fluent.sorter = {
        
        $el: null,
        
        set: function( o ){
            $.extend( this, o );
            return this;
        },
        
        init: function(){
            if($.fluent.is_clone_field(this.$el)){
                return false;
            }
            $(this.$el).attr('colspan', 2).addClass('sorter-type-'+$(this.$el).find('div[data-sorter-type]').data('sorter-type'));
            if(fluent.context != 'user'){
                //meta boxes
                $(this.$el).closest('tr').find('td.label').hide();
            }else{
                //user meta
                $(this.$el).closest('tr').find('th').hide();
            }
        }
    };
    
    $(document).on('fluent/create_fields', function(e, el){
		$(el).find('.field-type-sorter').each(function(){
            $.fluent.sorter.set({ $el : $(this) }).init();
		});
	});
    
    //we must fire it here even though it duplicates it
    $('.wrap').find('.field-type-sorter').each(function(){
        $.fluent.sorter.set({ $el : $(this) }).init();
    });
    
})(jQuery);