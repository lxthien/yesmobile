$(document).ready(function() {
    $(function() {
        $( "#customers" ).autocomplete({
            source: function(request, response) {
                $.ajax({
                       url: "https://yesmobile.com.vn/auths/checkWarrantyPeriod",
                       data:  {
                           mode : "ajax",
                           component : "consearch",
                           searcharg : "company",
                           task : "display",
                           limit : 15,
                           term : request.term
                       },
                       dataType: "json",
                       success: function(data) {
                        response(data);
                        alert(data);
                      }	
                })
            },
            select: function( event, ui ) {
                var keyvalue = ui.item.value;
                alert("Customer number is " + keyvalue);
            }
        });
        
        $("#frmAddUser").validate({
            rules:{
                phone:{
                    required: true,
                    number: true,
                    minlength: 10,
                    remote:{
                        url:'https://yesmobile.com.vn/customers/phoneCheckSignup',
                        type:'post',
                        data:{
                            phone :function(){
                                return $(':input[name="phone"]').val();
                            }
                        }
                    }
                }
            } ,
            messages:{
                phone:{
                    required: 'Vui lòng nhập di động',
                    number: 'Vui lòng chỉ nhập số',
                    minlength: 'Nhập tối thiểu 10 chữ số',
                    remote: "Số điện thoại này đã sử dụng. Vui lòng không đăng ký mới"
                }
            }
        });
    });

    $(function() {
        $('.customers').find('#dataTable_filter label span').html('Tìm kiếm khách hàng:');
    });
});