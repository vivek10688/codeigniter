<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Medicine Category List</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            <?php if ($info_message = $this->session->flashdata('info_message')): ?>
            <div id="form-messages" class="alert alert-success" role="alert">
                <?php echo $info_message; ?>
            </div>
            <?php endif ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button class="btn btn-primary"><i class="fa fa-th-list">&nbsp; Medicine Category List</i></button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display nowrap" cellspacing="0" width="100%" id="notice">
                            <thead>
                                <tr class="bg-primary">
                                    <th>S.No</th>
                                    <th>Category Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $count = 1;
                                    if($medicine_category){
                                        foreach ($medicine_category as $value) {
                                ?>
                                <tr class="odd gradeX" id="tr_<?php echo $count?>">
                                    <td>
                                        <?php echo $count; ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->category_name;?>
                                    </td>

                                    <td class="center">
                                        <?php echo $value->description;  ?>
                                    </td>
                                    <td class="center">
                                        <?php if($value->status==1){ ?>
                                        <button class="btn btn-primary">Active</button>
                                        <?php } else{ ?>
                                        <button class="btn btn-danger">Inactive</button>
                                        <?php } ?>
                                    </td>
                                    <td class="center">
                                        <?php echo $value->created_at;  ?>
                                    </td>
                                    <td class="center">
                                        <a href="<?php echo base_url('pharma/medicine_category/'.$value->id); ?>" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |
                                        <a href="javascript:void(0)" onclick="delete_list('<?php echo $value->id?>','<?php echo $count?>')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                                </tr>
                                <?php $count++; } }?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#notice').DataTable({
            responsive: true,
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1] /* 1st one, start by the right */
            }]
        });
    });


    function delete_list(id, tr_id) {
        swal({
            title: "Are you sure?",
            text: "Are you sure that you want to delete?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonText: "Yes, Delete it!",
            confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax({
                url: "<?php echo base_url('doctor/delete')?>",
                data: {
                    id: id,
                    table: 'notices'
                },
                type: "POST"
            }).done(function(data) {
                swal("Deleted!", "Record was successfully deleted!", "success");
                $('#tr_' + tr_id).remove();
            });
        });
    }
</script>