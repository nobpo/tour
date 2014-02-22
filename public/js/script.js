$(document).ready(function(){

	

	var province;
	var province_def = 0;


	$.ajax({
			//url: '/PCU17/public/service/amphur/',
			url: 'service/province',
			type: 'GET',
			dataType: 'json',		
		}).success(function(province_in){
			var select = $('#province');
			var options = select.prop('options');
			$('option', select).remove();
			$("#region select").val(0);
			province = province_in;
			select.append("<option value='0'>ทุกจังหวัด</option>");
			$.each(province, function(index, array) {
				$('#province').append("<option value='" + array['Province_id'] + "'>" + array['Province_name'] + '</option>');
			});
			
		});

		


		$('#region').on('change',function(event) {
			var select = $('#province');
			var options = select.prop('options');
			$('option', select).remove();
			if($("#region option:selected").val() == 0){
				select.append("<option value='0'>ทุกจังหวัด</option>");
			}
			$.each(province, function(index, array) {
				if(array['Region'] == $("#region option:selected").val() || $("#region option:selected").val() == 0)
					select.append("<option value='" + array['Province_id'] + "'>" + array['Province_name'] + '</option>');				
			});	

			var select = $('#district');
			var options = select.prop('options');
			$('option', select).remove();
			
				select.append("<option value='0'>ทุกอำเภอ</option>");
			
			$.each(district, function(index, array) {
				if(array['Province_id'] == $("#province option:selected").val() || $("#province option:selected").val() == 0)
					select.append("<option value='" + array['District_id'] + "'>" + array['District_name'] + '</option>');				
			});	

		});

	var district;
	var district_def = 0;

		$.ajax({
			//url: '/PCU17/public/service/amphur/',
			url: 'service/district',
			type: 'GET',
			dataType: 'json',		
		}).success(function(district_in){
			var select = $('#district');
			var options = select.prop('options');
			$('option', select).remove();
			$("#province select").val(0);
			district = district_in;
			select.append("<option value='0'>ทุกอำเภอ</option>");
			$.each(district, function(index, array) {
				$('#district').append("<option value='" + array['District_id'] + "'>" + array['District_name'] + '</option>');
			});
			
		});

		


		$('#province').on('change',function(event) {
			var select = $('#district');
			var options = select.prop('options');
			$('option', select).remove();
			
				select.append("<option value='0'>ทุกอำเภอ</option>");
			
			$.each(district, function(index, array) {
				if(array['Province_id'] == $("#province option:selected").val() || $("#province option:selected").val() == 0)
					select.append("<option value='" + array['District_id'] + "'>" + array['District_name'] + '</option>');				
			});	

		});
	$('.add-search').hide();

	$("#link-ad").click(function(){
		if($('.add-search').is(":hidden")){
			$('.add-search').slideDown("slow");
		} else {
			$('.add-search').hide();
		}
	});

	$('#type select').val(0);

	for(var i = 1; i <= 12; i++){
		$("input[name='add" + i + "']").attr('checked', false);
	}



	



		
});