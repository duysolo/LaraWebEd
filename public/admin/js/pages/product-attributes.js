(function($){
    $(document).ready(function(){
        var $body = $('body');
        $body.on('submit', '.update-attributes-form', function(event){
            var fields = [];
            $('.attribute-set-group tbody tr').each(function(index, value){
                var $current = $(value);
                var isActivated = $current.find('.active-checkbox').is(':checked');
                if(isActivated) {
                    var field = {
                        id: $current.attr('data-attribute-id') || 0,
                        change_price: $current.find('.change-price').val() || 0,
                        is_percentage: $current.find('.is-percentage').is(':checked')
                    };
                    fields.push(field);
                }
            });
            $('#product_attributes').val(JSON.stringify(fields));
        });
    });
})(jQuery);