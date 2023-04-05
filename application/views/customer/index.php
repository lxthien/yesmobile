<div id="content">
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
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Tên</th>
			                        <th>Điện thoại</th>
			                        <th>Số lần sửa chữa</th>
			                        <th>Tổng chi phí</th>
									<th>Action</th>
			                    </tr>
			                    </thead>
			                    <tbody>
			                    	<?php foreach ($customers as $row): ?>
		                            <tr>
		                                <td><?php echo $row->name; ?></td>
		                                <td><?php echo $row->phone; ?></td>
		                                <td>1</td>
		                                <td>5000000</td>
										<td>
											<a href="<?php echo base_url().'customers/edit/'.$row->id; ?>"><i class="fa fa-edit"></i></a>
											<a href="<?php echo base_url().'customers/histories/'.$row->id; ?>"><i class="fa fa-history"></i></a>
											<a href="<?php echo base_url().'customers/delete/'.$row->id; ?>"><i class="fa fa-times"></i></a>
										</td>
		                            </tr>
		                        	<?php endforeach; ?>
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