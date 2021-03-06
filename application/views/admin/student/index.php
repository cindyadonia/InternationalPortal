<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">International Students</h4>
        </div>
    </div>
</div>
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- DATA TABLE -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List of International Students</h4>
					<?= $this->session->flashdata('message');?>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Student No</th>
                                    <th>Name</th>
                                    <th>Birth Date</th>
                                    <th>Nationality</th>
                                    <th>University</th>
                                    <th>Study Program</th>
                                    <th>Joined On</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($students as $student):?>
                                <tr>
                                    <td><?= $student['student_no'];?></td>
                                    <td><?= $student['name'];?></td>
                                    <td><?= date('d-M-Y',strtotime($student['birth_date']));?></td>
                                    <td><?= $student['nationality'];?></td>
                                    <td><?= $student['university_origin'];?></td>
                                    <td><?= $student['study_program_name'];?></td>
                                    <td><?= date('d M Y',strtotime($student['joined_at']));?></td>
                                    <td><?php if($student['is_active'] == 1){echo "Active";} else{echo "Not Active";}?></td>
                                    <td>
                                        <a href="<?= base_url('Admin/Student/show/'.$student['id'])?>" class="btn btn-primary">Edit</a>
                                        <a href="" data-student-id="<?= $student['id'];?>" data-toggle="modal" data-target="#deleteStudent"  class="btn btn-danger btnDelStudent" name="btnDelStudent">Delete</a>
                                        <!-- onclick="return confirm('Are you sure you want to delete this student?')" -->
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Container fluid  -->

<!-- SoftDelete Student - Modal -->
<div id="deleteStudent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Delete Student</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h4>You are going to delete this student.</h4>
                <p>Are you sure you want to delete this student?</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-danger" id="target-delete-button">Delete</a>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<script src="<?= base_url('assets');?>/libs/jquery/dist/jquery.min.js"></script>

<script>
    $('.btnDelStudent').click(function() {
        var id = $(this).attr("data-student-id");
        var link = "<?= base_url('Admin/Student/destroy/') ?>";
        $('#target-delete-button').attr("href", link+id);
    });
</script>