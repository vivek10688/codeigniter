<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Inventory Request</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="javascript:void(0)"><i class="fa fa-th-list">&nbsp;Inventory</i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <form role="form" method="post" action="#" class="registration_form">
                                <div class="form-group">
                                    <label>Equipment Name *</label>
                                    <input class="form-control" type="text" name="equipment_name" placeholder="Equipment Name" autocomplete="off" required="required" value="<?php echo set_value('equipment_name');?>">
                                    <span class="red"><?php echo form_error('equipment_name');?></span>
                                </div>
                                <div class="form-group">
                                    <label>No of Equipment *</label>
                                    <input type="text" name="no_of_equipment" class="form-control" placeholder="No of Equipment" autocomplete="off" required="required" value="<?php echo set_value('no_of_equipment');?>">
                                    <span class="red"><?php echo form_error('no_of_equipment');?></span>
                                </div>
                                <div class="form-group">
                                    <label>Others</label>
                                    <textarea name="others" class="form-control"></textarea>
                                    <span class="red"><?php echo form_error('others'); ?></span>
                                </div>
                                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                <input type="reset" class="btn btn-default" value="Reset"/>
                            </form>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
</div>
</div>