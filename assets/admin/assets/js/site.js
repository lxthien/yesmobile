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

    // Đồng bộ các ô tick nhanh của mục "Đặc điểm" với ô nhập Đặc điểm (cách nhau bằng dấu .)
    var $taskForm = $('#taskForm');
    var $taskFeatures = $('#taskFeatures');
    if ($taskForm.length && $taskFeatures.length) {
        var $featureCheckboxes = $taskForm.find('input[name="featureFlags[]"]');
        var escapeFeatureRe = function(s) {
            return s.replace(/[.*+?^${}()|[\]\\\/]/g, '\\$&');
        };
        var baseFeatureText = function(opt) {
            return $.trim((opt || '').replace(/\.+\s*$/, ''));
        };
        var hasFeatureOption = function(text, opt) {
            var base = baseFeatureText(opt);
            if (!base) return false;
            return new RegExp('(?:^|\\.\\s*)' + escapeFeatureRe(base) + '(?:\\.\\s*|\\s*$)', 'i').test(text || '');
        };

        $featureCheckboxes.on('change', function() {
            var val = $(this).val();
            var base = baseFeatureText(val);
            var cur = $.trim($taskFeatures.val() || '');
            if ($(this).is(':checked')) {
                if (!hasFeatureOption(cur, val)) {
                    if (cur === '') {
                        cur = base + '.';
                    } else {
                        if (!/\.$/.test(cur)) cur += '.';
                        cur += ' ' + base + '.';
                    }
                    $taskFeatures.val(cur);
                }
            } else {
                var re = new RegExp('(^|\\.\\s*)' + escapeFeatureRe(base) + '(?:\\.\\s*|\\s*$)', 'i');
                cur = $.trim(cur.replace(re, function(m, lead) {
                    return lead ? '. ' : '';
                }).replace(/\.\s*$/, '.'));
                $taskFeatures.val(cur);
            }
        });

        $taskFeatures.on('input', function() {
            var cur = $(this).val() || '';
            $featureCheckboxes.each(function() {
                $(this).prop('checked', hasFeatureOption(cur, $(this).val()));
            });
        });
    }
});