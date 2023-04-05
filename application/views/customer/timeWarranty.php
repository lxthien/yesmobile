<div class="allboxsp1 warranty row">
	<div class="col-md-12">
		<h1 class="h1-title">Kiểm tra bảo hành sửa chữa điện thoại</h1>
		<div class="line-title">
			<div class="left-30">&nbsp;</div>
			<div class="left-70">&nbsp;</div>
		</div>

		<div class="ttincongghe">
			<div class="sreentieude">
				<div class="tieude">
					<form class="timeWarranty">
						<input type="text" name="search" class="search" value="<?php echo $phoneNumber ?>" placeholder="Vui lòng nhập số điện thoại...">
						<button>Kiểm tra</button>
					</form>
				</div>
				<div align="justify" class="noidungchitiet timeWarrantyBody">
				</div>
			</div>
		</div>
		<div class="time-warranty-note">
		Quý khách hàng vui lòng nhập số điện thoại để kiểm tra bảo hành: </br>
		- Đối với các máy sửa chữa phần cứng, Yes Mobile áp dụng chế độ bảo hành từ 3 - 12 tháng. </br>
		- Quý khách hàng tham thảo thêm thông tin <a class="service-view-map" style="font-size:14px" target="_blank" href="<?php echo base_url('che-do-bao-hanh.html'); ?>">chính sách bảo hành</a> của Chúng tôi.</br>
		- Mọi thắc mắc hoặc cần tư vấn, Quý khách hàng vui lòng liên hệ ngay: 0847 72 72 72 
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
			if ($('.timeWarranty .search').val() != '') {
				$.ajax({
				    type: "POST",
				    url: "<?php echo base_url(); ?>searchHistory",
				    data: 'q=' + $('.timeWarranty .search').val(),
				    dataType: "text",
				    success: function(resultData){
				        $('.timeWarrantyBody').html(resultData);
				        $('.time-warranty-note').hide();
				    },
					error: function() {
						alert("Có lỗi trong quá trình kiểm tra. Vui lòng kiểm tra lại hoặc quay lại sau một thời gian");
					}
				});
			}

			$( ".timeWarranty button" ).click(function( event ) {
				event.preventDefault();
				$.ajax({
				    type: "POST",
				    url: "<?php echo base_url(); ?>searchHistory",
				    data: 'q=' + $('.timeWarranty .search').val(),
				    dataType: "text",
				    success: function(resultData){
				        $('.timeWarrantyBody').html(resultData);
				        $('.time-warranty-note').hide();
				    },
					error: function() {
						alert("Có lỗi trong quá trình kiểm tra. Vui lòng kiểm tra lại hoặc quay lại sau một thời gian");
					}
				});
			});
		})
	</script>
</div>