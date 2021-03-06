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
            <?php if(validation_errors()){?>
            <div class="alert alert-danger"> <strong>Danger!</strong>
                <?php echo validation_errors(); ?> </div>
            <?php }if(!empty($msg)){?>
            <div class="alert alert-success">
                <?php echo $msg;?> </div>
            <?php }?>
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading"> <a class="btn btn-primary" href="<?php echo base_url('patient/appointment_list')?>"><i class="fa fa-th-list">&nbsp;Appointment List</i></a> </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <form role="form" method="post" action="<?php echo base_url('patient/addAppointment') ?>" class="registration_form1" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-md-2">Speciality * </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="speciality_id" id="speciality_id" onchange="get_hospital(this.value)">
                                            <option>-- Select Speciality --</option>
                                            <?php foreach ($speciality as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>">
                                                <?php echo ucwords($value->name);?>
                                            </option>
                                            <?php } ?>
                                        </select> <span><?php echo form_error('speciality_id'); ?></span> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Hospital * </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="hospital_id" id="hospital_id" onchange="get_doctor(this.value)">
                                            <option>-- Select Hospital --</option>
                                            <?php foreach ($hospitals as $key => $value) { ?>
                                            <option value="<?php echo $value->id; ?>">
                                                <?php echo ucwords($value->hospital_name);?>
                                            </option>
                                            <?php } ?>
                                        </select> <span><?php echo form_error('doctor_id'); ?></span> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Doctor Name * </label>
                                    <div class="col-lg-6">
                                        <select class="form-control" name="doctor_id" id="doctor_id" onchange="getSchedule(this.value)">
                                        </select> <span><?php echo form_error('doctor_id'); ?></span> </div>
                                </div>
                                <div id="data" style="display: none" class="col-lg-6 col-lg-offset-2">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading center">Doctor Schedule</div>
                                        <div class="panel-body">
                                            <table id="table" class="table table-bordered">
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
                                    <div class="col-lg-8">
                                        <div class="col-lg-4">
                                            <input type="text" id="appointment_date" name="appointment_date" class="form-control date" autocomplete="off" readonly="readonly" placeholder="Start Date"> </div>
                                        <div class="col-lg-4">
                                            <input type="text" id="timepicker" name="appointment_time" class="form-control" autocomplete="off" readonly="readonly" placeholder="Start Time"> </div>
                                        <span id="error" style="color: red"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2">Problem * </label>
                                    <div class="col-lg-6">
                                        <textarea class="form-control" rows="5" id="problem" name="problem" placeholder="Problem"></textarea> <span><?php echo form_error('problem'); ?></span> </div>
                                </div>
                                <div class="col-md-12" align="center">
                                    <button type="submit" id="submit" value="Save" class="btn btn-success">Save</button>
                                    <button type="reset" class="btn btn-default">Reset</button>
                                </div>
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
            doctor_id = $('#doctor_id').val();
            appointment_date = $('#appointment_date').val();
            var appointment_time = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('patient/get_time')?>",
                data: {
                    'doctor_id': doctor_id,
                    'appointment_date': appointment_date
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

function getSchedule() {
    var doctor_id = $('#doctor_id').val();
    var appointment_date = $('#appointment_date').val();
    var appointment_time = $('#timepicker').val();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('patient/get_schedule')?>",
        data: {
            'doctor_id': doctor_id,
            'appointment_date': appointment_date,
            'appointment_time': appointment_time
        },
        success: function(data) {
            var obj = JSON.parse(data);
            $('#table').find("tr:gt(0)").remove();
            for (var i = 0; i < obj.length; i++) {
                $('#table tr:first').after('<tr><td>' + obj[i].day + '</td><td>' + obj[i].starttime + '</td><td>' + obj[i].endtime + '</td></tr>');
                $('#data').show();

            }
        }
    });
}

function get_hospital(id) {
    if (id != '') {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('patient/get_hospitals')?>",
            data: {
                id: id
            },
            success: function(data) {
                var obj = JSON.parse(data);
                var option = '<option value="">-- Select Hospital--</option>';
                for (var i = 0; i < obj.length; i++) {
                    option += '<option value=' + obj[i].id + '>' + obj[i].hospital_name + '</option>';
                }
                $('#hospital_id').html(option);
            }
        });
    }
}
</script>