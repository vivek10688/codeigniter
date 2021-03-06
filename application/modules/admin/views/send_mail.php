<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Send Mail</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="col-lg-12">
            <?php if(!empty($msg)){?>
            <div class="alert alert-success">
                <?php echo $msg;?>
            </div>
            <?php }?>

            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="btn btn-primary" href="<?php echo base_url('admin/mail_list')?>"><i class="fa fa-th-list">&nbsp;Mail List </i></a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/send_mail')?>" class="registration_form1">
                                <div class="form-group"> <label class="col-md-2">Title * </label>
                                    <div class="col-lg-6"> <select class="form-control" name="reciever_id[]" multiple="multiple">

                                        <option value="">-- Select Receiver --</option>

                                        <?php foreach($users as $user){?>
                                        <option value="<?php echo $user->id;?>"><?php echo ucwords($user->first_name.' '.$user->last_name);?></option>
                                        <?php }?>
                                    </select> <span class="red"><?php echo form_error('reciever_id'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Subject * </label>
                                    <div class="col-lg-6"> <input type="text" id="subject" maxlength="30" name="subject" class="form-control"> <span class="red"><?php echo form_error('subject'); ?></span> </div>
                                </div>
                                <div class="form-group"> <label class="col-md-2">Message * </label>
                                    <div class="col-lg-6"> <textarea class="form-control" rows="5" id="message" name="message" placeholder="Message">
                                            </textarea> <span class="red"><?php echo form_error('message'); ?></span>
                                        <script type="text/javascript">
                                            CKEDITOR.replace('message');
                                        </script>
                                    </div>
                                </div>
                                <div class="clearfix"></div><br/><br/>
                                <div class="col-md-12" align="center"> <button type="submit" value="Save" class="btn btn-success">Save</button>
                                &nbsp;<button type="reset" class="btn btn-default">Reset</button> </div>
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