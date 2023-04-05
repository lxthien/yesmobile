$(document).ready(function(){
	var statusPhone = $('input[name=isStatus]:checked').val();
	if(statusPhone == 1) {
		$('#price-new').hide();
		$('#price-old').find('label').html('BH 12 tháng');
	} else {
		$('#price-new').show();
		$('#price-old').find('label').html('BH 3 tháng');
	}


	$('.loai-may').click(function(){
		if($(this).val() == 1) {
			$('#price-new').hide();
			$('#price-old').find('label').html('BH 12 tháng');
		} else {
			$('#price-new').show();
			$('#price-old').find('label').html('BH 3 tháng');
		}
	});
});