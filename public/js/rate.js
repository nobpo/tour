$(document).ready(function(){
    var rate_data;

	$('.ratings_stars').hover(
                // Handles the mouseover
                function() {
                    $(this).prevAll().andSelf().addClass('ratings_over');
                    $(this).nextAll().removeClass('ratings_vote'); 
                },
                // Handles the mouseout
                function() {
                    $(this).prevAll().andSelf().removeClass('ratings_over');
                    set_votes($('.rate_widget'));
                }
    );

    $('.rate_widget').each(function(i){
    	$.ajax({
    		url: ''+ $(this).attr('id') + '/rate',
    		type: 'GET',
    		dataType: 'json',
    	}).success(function(data){
    		$(this).data('rate', data);
    		rate_data = data;
    		set_votes($('.rate_widget'));
    	});
    	
    	
    });



    function set_votes(wid){
    		//console.log(rate_data.Tour_attr_id + " Test");
    		var avg = rate_data.whole_avg;
    		var votes = rate_data.number_votes;
		    var exact = rate_data.dec_avg;
		     
		    $(wid).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
		    $(wid).find('.star_' + avg).nextAll().removeClass('ratings_vote'); 
		    $(wid).find('.total_votes').text( votes + ' votes recorded (' + exact.toFixed(2) + ' rating)' );
    }

    $('.ratings_stars').bind('click', function(){
        var star = this;
        var widget = $('.rate_widget');

        var clicked_data = {
            clicked_on: $(star).attr('id'),
            widget_id : widget.attr('id')
        };

        $.ajax({
            url: ''+ $('.rate_widget').attr('id') + '/rate/set',
            type: 'POST',
            dataType: 'json',
            data: clicked_data,
        }).success(function(data){
            set_votes(widget);
        }).done(function(data){
            set_votes(widget);
        });


        alert('ขอบคุณที่ Rate ครับ');
        location.reload();
    });


});