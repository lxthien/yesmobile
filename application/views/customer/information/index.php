<div id="content" class="customers">
    <div class="outer">
        <div class="inner bg-light lter">
            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>Danh sách khách hàng</h5>
                        </header>
                        <div id="collapse4" class="body">
                            <table class="table table-bordered table-condensed table-hover table-striped">
                                <tbody>
                                    <tr>
                                        <td><label class="control-label col-lg-4">Khách hàng chưa quay lại:</label></td>
                                        <td>
                                            <select class="form-control customer_back" name="customer_back">
                                                <option value="">Vui lòng chọn</option>
                                                <option value="1">1 năm</option>
                                                <option value="2">2 năm</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table id="dataTableCustomer" class="table table-bordered table-condensed table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tên</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Cửa Hàng Sửa</th>
                                        <th>SLYC</th>
                                        <th>TotalPrices</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!--End Datatables-->
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>