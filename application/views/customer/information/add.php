<div id="content">
    <div class="outer">
        <div class="inner bg-light lter">
            <div class="row">
                <div class="col-lg-12">
                    <div class="box dark">
                        <header>
                            <div class="icons"><i class="fa fa-edit"></i></div>
                            <h5>Nhập thông tin khách hàng</h5>
                            <div class="toolbar">
                                <nav style="padding: 8px;">
                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </nav>
                            </div>
                        </header>
                        <div id="div-1" class="body">
                            <form id="<?php echo $customer->id != null ? "frmEditUser" : "frmAddUser"; ?>" class="form-horizontal" action="<?php echo base_url().'customers/save'; ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo $customer->id; ?>">
                                <input type="hidden" name="action" value="save" />
                                <div class="form-group">
                                    <label for="text1" class="control-label col-lg-4">Tên</label>
                                    <div class="col-lg-8">
                                        <input name="name" type="text" id="text1" placeholder="Tên" class="form-control" value="<?php echo $customer->name; ?>" <?php echo $shop == 0 ? "" : "readonly"; ?>>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass1" class="control-label col-lg-4">Điện thoại</label>
                                    <div class="col-lg-8">
                                        <input name="phone" class="form-control" type="text" id="pass1" placeholder="Điện thoại" value="<?php echo $customer->phone; ?>" <?php echo $shop == 0 ? "" : "readonly"; ?> />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-4">&nbsp;</div>
                                    <div class="col-lg-8">
                                        <button type="submit" class="btn btn-default" data-dismiss="modal" name="save">Lưu</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>