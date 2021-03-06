<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Appointment</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php $session_user_role  =  $this->session->userdata('user_role');
                if(validation_errors()){?>
            <div class="alert alert-danger"> <strong>Danger!</strong>
                <?php echo validation_errors(); ?> </div>
            <?php }if(!empty($msg)){?>
            <div class="alert alert-success">
                <?php echo $msg;?> </div>
            <?php }?>
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-info" role="alert">
                <?php echo $info_message; ?> </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('admin/appointment_list')?>"><i class="fa fa-th-list">&nbsp;Appointment List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('admin/addAppointment') ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-2">Appointment Type * </label>
                                    <div class="col-lg-6">
                                        <select class="wide" name="appointment_type" id="appointment_type">
                                            <option>-- Select Appointment Type --</option>
                                            <option value="On Call">On Call</option>
                                            <option value="Online">Online</option>
                                        </select>
                                        <span><?php echo form_error('appointment_type'); ?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Patient ID * </label>
                                    <div class="col-lg-6">
                                        <select class="wide" name="patient_id" id="patient_id">
                                            <option>-- Select Patient id --</option>
                                            <?php foreach ($patient as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>">
                                                <?php echo $value->id.' '.$value->first_name;?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                        <span><?php echo form_error('patient_id'); ?></span>
                                    </div>
                                    <?php if($session_user_role==1){?>
                                    <div class=""><a href="<?php echo base_url('admin/register/null/3')?>">Add New Patient</a></div>
                                    <?php }?>
                                </div>
                                <?php if($session_user_role!=4){?>
                                <div class="form-group">
                                    <label class="col-md-2">Hospital * </label>
                                    <div class="col-lg-6">
                                        <select class="wide" name="hospital_id" id="hospital_id" onchange="get_doctor(this.value)">
                                            <option value="">-- Select Hospital --</option>
                                            <?php foreach ($hospitals as $value) { ?>
                                            <option value="<?php echo $value->id; ?>" <?php echo set_select('hospital_id', $value->id); ?>><?php echo ucwords($value->hospital_name); ?></option>
                                            <?php } ?>
                                         </select>
                                        <span><?php echo form_error('hospital_id'); ?></span>
                                    </div>
                                </div>
                                <?php }elseif($session_user_role==4){
                                    $hospital_id = $this->session->userdata('hospital_id');
                                ?>
                                <input type="hidden" name="hospital_id" value="<?php echo $hospital_id; ?>">
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        get_doctor('<?php echo $hospital_id; ?>');
                                    });
                                </script>
                                <?php }?>
                                <div class="form-group">
                                    <label class="col-md-2">Doctor Name * </label>
                                    <div class="col-lg-6">
                                        <select class="wide" name="doctor_id" id="doctor_id" onchange="getSchedule(this.value)">
                                        </select>
                                        <span><?php echo form_error('doctor_id'); ?></span>
                                    </div>
                                </div>
                                <div id="data" style="display: none" class="col-lg-6 col-lg-offset-2">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">Doctor Schedule</div>
                                        <div class="panel-body">
                                            <table id="table" class="table table-bordered" border="1">
                                                <tr>
                                                    <th>Day</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Appointment Date * </label>
                                    <div class="col-md-6">
                                        <input type="text" name="appointment_date" id="appointment_date" class="form-control date" autocomplete="off" readonly="readonly" placeholder="Start Date" style="width: 50%;float: left;">
                                        <input type="text" id="timepicker" name="appointment_time" class="form-control" autocomplete="off" readonly="readonly" placeholder="Start Time" style="width: 50%;">
                                        <span><?php echo form_error('appointment_date'); ?></span>
                                    </div>
                                </div>
                                <span id="error" style="color: red"></span>
                                <div class="form-group">
                                    <label class="col-md-2">Problem * </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" rows="5" id="problem" name="problem" placeholder="Problem"></textarea>
                                        <span><?php echo form_error('problem'); ?></span>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12" align="center">
                                    <button type="submit" value="Save" id="submit" class="btn btn-success">Save</button>&nbsp;
                                    <input type="reset" class="btn btn-default" value="Reset"> </div>
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


<script type="text/javascript">
    $(document).ready(function() {
        $('select').niceSelect();
        $(".registration_form1").validate({
            rules: {
                "fname": "required",
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $('#timepicker').timepicker({
            change: function(time) {
                doctor_id            = $('#doctor_id').val();
                appointment_date     = $('#appointment_date').val();
                hospital_id          = $('#hospital_id').val();
                var appointment_time = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('admin/get_time')?>",
                    data: {
                        'doctor_id': doctor_id,
                        'appointment_date': appointment_date,
                        'hospital_id': hospital_id
                    },
                    success: function(data) {
                        var obj = JSON.parse(data);
                        for (var i = 0; i < obj.length; i++) {
                            var check = obj[i].appointment_time;
                            if (check == appointment_time) {
                                $('#error').html('Time already booked please try another..');
                                $('#submit').attr('disabled', true);
                                $('#timepicker').focus();
                                return false;
                            } else {
                                $('#error').text('');
                                $("#submit").removeAttr("disabled");
                            }
                        }
                    }
                });
            }
        });
    });


    function getSchedule(id) {
        var doctor_id = id;
        var appointment_date = $('#appointment_date').val();
        var appointment_time = $('#timepicker').val();
        var hospital_id = $('#hospital_id').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/get_schedule')?>",
            data: {
                'doctor_id': doctor_id,
                'appointment_date': appointment_date,
                'appointment_time': appointment_time,
                'hospital_id': hospital_id
            },
            success: function(data) {
                var obj = JSON.parse(data);
                $('#table tr').html('');
                $('#table').append('<tr><th>Hospital</th><th>Day</th><th>StartTime</th><th>EndTime</th></tr>');
                for (var i = 0; i < obj.length; i++) {
                    $('#table').append('<tr><td>' + obj[i].hospital_name + '</td><td>' + obj[i].day + '</td><td>' + obj[i].starttime + '</td><td>' + obj[i].endtime + '</td></tr>');
                    $('#data').show();
                }
            }
        });
    }
</script>