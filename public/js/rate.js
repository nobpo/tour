$(document).ready(function(){
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
    		console.log($(this).data('rate'));
    		set_votes(this);
    	});
    	
    	
    });

    function set_votes(wid){
    		console.log($(wid).data('rate').whole_avg + " Test");
    		var avg = $(wid).data('rate').whole_avg;
    		var votes = $(wid).data('rate').number_votes;
		    var exact = $(wid).data('rate').dec_avg;
		     
		    $(wid).find('.star_' + avg).prevAll().andSelf().addClass('ratings_vote');
		    $(wid).find('.star_' + avg).nextAll().removeClass('ratings_vote'); 
		    $(wid).find('.total_votes').text( votes + ' votes recorded (' + exact + ' rating)' );
    	}


});