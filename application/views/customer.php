<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--IE Compatibility modes-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Mobile first-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phần mềm quản lý công việc nội bộ Yes Mobile</title>
        
        <meta name="description" content="Phần mềm quản lý công việc nội bộ Yes Mobile - Sửa chữa điện thoại từ 2010">
        <meta name="author" content="">

        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        
        <meta name="msapplication-TileColor" content="#5bc0de" />
        <meta name="msapplication-TileImage" content="<?php echo base_url().'assets/admin'; ?>/assets/img/metis-tile.png" />
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/bootstrap/css/bootstrap.css">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!-- Metis core stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/css/main.css">
        
        <!-- metisMenu stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/metismenu/metisMenu.css">
        
        <!-- animate.css stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/animate.css/animate.css">

        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/css/jquery-ui-1.8.18.custom.css">
        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/css/admin-custom.css?v=<?php echo time(); ?>">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css">

        <!--For Development Only. Not required -->
        <script>
            less = {
                env: "development",
                relativeUrls: false,
                rootpath: "/assets/admin/assets/"
            };
        </script>
        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/css/style-switcher.css">
        <link rel="stylesheet/less" type="text/css" href="<?php echo base_url().'assets/admin'; ?>/assets/less/theme.less">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.js"></script>

        <!-- animate.css stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/font/stylesheet.css">
        <link rel="stylesheet" href="<?php echo base_url().'assets/admin'; ?>/assets/lib/chosen/chosen.css">

      </head>

      <body class="sidebar-left-mini">
          <div class="bg-dark dk" id="wrap">
                <?php $this->load->view('customer/partial/top'); ?>
                <?php $this->load->view('customer/partial/left'); ?>
                <?php $this->load->view($view); ?>
          </div>
          <!-- /#wrap -->
        <footer class="Footer bg-dark dker">
            <p>2010 &copy; Yes Mobile</p>
        </footer>
        <!-- /#footer -->

        <!--jQuery -->
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/jquery/jquery.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.26.6/js/jquery.tablesorter.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>

        <!--Bootstrap -->
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/bootstrap/js/bootstrap.js"></script>
        <!-- MetisMenu -->
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/metismenu/metisMenu.js"></script>
        <!-- Screenfull -->
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/screenfull/screenfull.js"></script>
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/bootstrap-daterangepicker/daterangepicker.js"></script>
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/jquery-validation/jquery.validate.js"></script>
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/lib/chosen/chosen.jquery.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

        <!-- Metis core scripts -->
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/js/core.js"></script>
        <!-- Metis demo scripts -->
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/js/app.js"></script>

        <script src="<?php echo base_url().'assets/admin'; ?>/assets/js/simple.money.format.js"></script>

        <script src="<?php echo base_url().'assets/admin'; ?>/assets/js/site.js"></script>

        <script>
            $(function() {
                Metis.MetisTable();
                Metis.formGeneral();
            });

            $(document).ready(function() {
                $('.money').simpleMoneyFormat();
                
                $(".chzn-select").chosen();

                $('#dpTotal').datepicker({
                    endDate: new Date()
                }).on('changeDate', function (ev) {
                    var startDate = new Date(ev.date);
                    var curr_day = startDate.getDate();
                    var curr_month = startDate.getMonth() + 1;
                    var curr_year = startDate.getFullYear();
                    var time_report = curr_year + '-' + curr_month + '-' + curr_day;

                    window.location.replace("<?php echo base_url()."tasks/listToday"; ?>" + "?time=" + time_report);
                });

                var table = $('#dataTableCustomer').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 50,
                    "sAjaxSource": "<?php echo base_url()."customers/customersPage"; ?>",
                    "fnServerData": function(sSource, aoData, fnCallback) {
                        aoData.push({
                            "name": "customer_back",
                            "value": $('.customer_back').val()
                        });
                        $.ajax({
                            "dataType": 'json',
                            "type": "GET",
                            "url": sSource,
                            "data": aoData,
                            "success": fnCallback
                        });
                    },
                    "bSort": false,
                    "bPaginate": true,
                    "sPaginationType": "full_numbers",
                    "oLanguage": {
                        "sSearch": "<span>Tìm kiếm:</span>"
                    },
                    draggable: false,
                    <?php if ($this->ion_auth->in_group('admin_shop')) { ?>
                    dom: 'Blfrtip',
                    buttons: [
                        'excelHtml5'
                    ],
                    <?php } ?>
                    "lengthMenu": [[10, 20, 30, 40, 50, 100, 150, 200, -1], [10, 20, 30, 40, 50, 100, 150, 200, "All"]],
                    "order": [],
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "customer1" },
                        { "data": "customer2" },
                        { "data": "customer12" },
                        { "data": "customer9" },
                        { "data": "customer10" },
                        { "data": "customer11" }
                    ]
                });

                $('.customer_back').change( function() {
                    table.draw();
                } );

                $('#dataTableCustomer tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = table.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( formatCustomer(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );

                function formatCustomer ( d ) {
                    return '<table cellpadding="15" cellspacing="0" border="0" class="table table-bordered table-condensed table-striped no-footer">'+
                        '<tr>'+
                            '<td>Máy sửa mới nhất:</td>'+
                            '<td>'+d.customer3+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Imei:</td>'+
                            '<td>'+d.customer4+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Thời gian nhận:</td>'+
                            '<td>'+d.customer5+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Giá:</td>'+
                            '<td>'+d.customer6+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Thời gian bảo hành:</td>'+
                            '<td>'+d.customer7+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Lưu ý nội bộ:</td>'+
                            '<td>'+d.customer8+'</td>'+
                        '</tr>'+
                    '</table>';
                }
                
                $("div.toolbar").html('<a class="task-add" href="<?php echo base_url('tasks/add'); ?>">Nhập máy sửa chữa mới</a><a class="customer-add" href="<?php echo base_url('customers/add'); ?>">Thêm khách hàng mới</a>');


                var tableTask = $('#dataTableTask1').DataTable({
                    "lengthMenu": [[100, -1], [100, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    "dom": '<"toolbar">frtip',
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });
                var tableTaskLS = $('#dataTableTask1_LS').DataTable({
                    "lengthMenu": [[100, -1], [100, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    "dom": '<"toolbar">frtip',
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });

                $('#dataTableTask1 tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );
                $('#dataTableTask1_LS tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTaskLS.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );

                function format ( d ) {
                    return '<table cellpadding="15" cellspacing="0" border="0" class="table table-bordered table-condensed table-striped no-footer">'+
                        '<tr>'+
                            '<td>Người nhận máy:</td>'+
                            '<td>'+d.taks14+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Lưu ý nội bộ:</td>'+
                            '<td>'+d.taks15+'</td>'+
                        '</tr>'
                    '</table>';
                }


                var tableTask2 = $('#dataTableTask2').DataTable({
                    "lengthMenu": [[50, -1], [50, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });
                var tableTask2_LS = $('#dataTableTask2_LS').DataTable({
                    "lengthMenu": [[50, -1], [50, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });

                $('#dataTableTask2 tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask2.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );
                $('#dataTableTask2_LS tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask2_LS.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );


                var tableTask3 = $('#dataTableTask3').DataTable({
                    "lengthMenu": [[50, -1], [50, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });
                var tableTask3_LS = $('#dataTableTask3_LS').DataTable({
                    "lengthMenu": [[50, -1], [50, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });

                $('#dataTableTask3 tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask3.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format3(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );
                $('#dataTableTask3_LS tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask3_LS.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format3(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );

                function format3 ( d ) {
                    return '<table cellpadding="15" cellspacing="0" border="0" class="table table-bordered table-condensed table-striped no-footer">'+
                        '<tr>'+
                            '<td>Người nhận máy:</td>'+
                            '<td>'+d.taks14+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Lưu ý nội bộ:</td>'+
                            '<td>'+d.taks15+'</td>'+
                        '</tr>'
                    '</table>';
                }


                var tableTask4 = $('#dataTableTask4').DataTable({
                    "lengthMenu": [[50, -1], [50, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });
                var tableTask4_LS = $('#dataTableTask4_LS').DataTable({
                    "lengthMenu": [[50, -1], [50, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks14" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });

                $('#dataTableTask4 tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask4.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format4(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );
                $('#dataTableTask4_LS tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask4_LS.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format4(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );

                function format4 ( d ) {
                    return '<table cellpadding="15" cellspacing="0" border="0" class="table table-bordered table-condensed table-striped no-footer">'+
                        '<tr>'+
                            '<td>Người nhận máy:</td>'+
                            '<td>'+d.taks14+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Lưu ý nội bộ:</td>'+
                            '<td>'+d.taks15+'</td>'+
                        '</tr>'+
                        '<tr>'
                    '</table>';
                }


                var tableTask5 = $('#dataTableTask5').DataTable({
                    "lengthMenu": [[50, -1], [50, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });
                var tableTask5_LS = $('#dataTableTask5_LS').DataTable({
                    "lengthMenu": [[50, -1], [50, "All"]],
                    "order": [],
                    "oLanguage": {
                        "sSearch": "<span>Search:</span>"
                    },
                    draggable: false,
                    "columns": [
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": null,
                            "defaultContent": ''
                        },
                        { "data": "taks1" },
                        { "data": "taks2" },
                        { "data": "taks3" },
                        { "data": "taks4" },
                        { "data": "taks5" },
                        { "data": "taks6" },
                        { "data": "taks7" },
                        { "data": "taks8" },
                        { "data": "taks9" },
                        { "data": "taks10" },
                        { "data": "taks11" },
                        { "data": "taks12" },
                        { "data": "taks13" },
                        { "data": "taks14" },
                        { "data": "taks15" }
                    ],
                    "columnDefs": [
                        {
                            "targets": [ 14 ],
                            "visible": false
                        },
                        {
                            "targets": [ 15 ],
                            "visible": false
                        }
                    ],
                    "ordering": false
                });

                $('#dataTableTask5 tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask5.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format5(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );
                $('#dataTableTask5_LS tbody').on('click', 'td.details-control', function () {
                    var tr = $(this).closest('tr');
                    var row = tableTask5_LS.row( tr );
                
                    if ( row.child.isShown() ) {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else {
                        row.child( format5(row.data()) ).show();
                        tr.addClass('shown');
                    }
                } );

                function format5 ( d ) {
                    return '<table cellpadding="15" cellspacing="0" border="0" class="table table-bordered table-condensed table-striped no-footer">'+
                        '<tr>'+
                            '<td>Người nhận máy:</td>'+
                            '<td>'+d.taks14+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Lưu ý nội bộ:</td>'+
                            '<td>'+d.taks15+'</td>'+
                        '</tr>'+
                        '<tr>'
                    '</table>';
                }

                $('body').on('click', '.task-history', function(e) {
                    $('#ajaxModal').remove();
                    e.preventDefault();

                    var url = $(this).data("url"),
                        $modal = $('<div id="ajaxModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true" data-backdrop="false"><div class="modal-dialog modal-lg" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"></div></div></div></div>');

                    $('body').append($modal);
                    $.ajax({
                        url: url,
                        dataType: 'html',
                        success: function(res) {
                            $('.modal-body').append(res);

                            // show modal
                            $modal.modal('show');

                        },
                        error:function(request, status, error) {
                            console.log("ajax call went wrong:" + request.responseText);
                        }
                    });
                });

                $('#confirmDialog').dialog({
                    autoOpen: false,
                    width: 500,
                    modal: true,
                    resizable: false,
                    buttons: {
                        "Đã nhập": function () {
                            $(".ui-dialog-buttonpane button:contains('Đã nhập')").button("disable");
                            $(".ui-dialog-buttonpane button:contains('Chưa nhập')").button("disable");
                            document.forms['taskForm'].submit();
                        },
                        "Chưa nhập": function () {
                            $(this).dialog("close");
                        }
                    }
                });

                $('#taskForm').submit(function (e) {
                    e.preventDefault();
                    
                    if ( $(this).find('input[name="taskStatus"]:checked').val() == 1 ) {
                        $('#confirmDialog').dialog('open');
                    } else {
                        e.currentTarget.submit();
                    }
                });

                $('.nav-tabs').on('click', 'li', function() {
                    console.log($(this).find('a').attr('href'));
                    $hrefId = $(this).find('a').attr('href');

                    if ($hrefId.indexOf('chls') > 0) {
                        $('[href="#chls1"], [href="#chls2"], [href="#chls3"], [href="#chls4"], [href="#chls5"]').tab('show');
                    } else {
                        $('[href="#chvt1"], [href="#chvt2"], [href="#chvt3"], [href="#chvt4"], [href="#chvt5"]').tab('show');
                    }
                })
            });
        </script>
        <script src="<?php echo base_url().'assets/admin'; ?>/assets/js/style-switcher.js"></script>
      </body>

</html>