<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Faculty</h4>
        </div>
    </div>
</div>
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Faculty Info -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Faculty Form</h4>
					<?= $this->session->flashdata('message');?>
                    <!-- <h5 class="card-subtitle"> </h5> -->
                    <form class="form" action="<?= base_url('Admin/Faculty/update/'.$faculty['id'])?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Faculty Code</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="code" name="code" value="<?= $faculty['code']?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Name</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="name" name="name" value="<?= $faculty['name']?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-password-input" class="col-2 col-form-label"></label>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Faculty's StudyPrograms -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Study Programs for <?= $faculty['name'] ?></h4>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <div class="dl">
                                <a href="<?= base_url('Admin/StudyProgram/create/'.$faculty['id'])?>" class="btn btn-primary">Add Study Program</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Code</th>
                                    <th class="border-0">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($study_programs as $study_program):?>
                                <tr>
                                    <td><?= $study_program['code'];?></td>
                                    <td><?= $study_program['name'];?></td>
                                    <td>
                                        <a href="<?= base_url('Admin/StudyProgram/show/'.$study_program['id'])?>" class="btn btn-primary">Edit</a>
                                        <a href="" data-study_program-id="<?= $study_program['id'];?>" data-faculty_id="<?= $faculty['id']?>" data-toggle="modal" data-target="#deleteStudyProgram"  class="btn btn-danger btnDelStudyProgram" name="btnDelStudyProgram">Delete</a>
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
<!-- SoftDelete StudyProgram - Modal -->
<div id="deleteStudyProgram" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Delete Study Program</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h4>You are going to delete this study program.</h4>
                <p>Are you sure you want to delete this study program?</p>
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
    $('.btnDelStudyProgram').click(function() {
        var id = $(this).attr("data-study_program-id");
        var faculty_id = $(this).attr("data-faculty_id");
        var link = "<?= base_url('Admin/StudyProgram/destroy/') ?>";
        $('#target-delete-button').attr("href", link+id+'/'+faculty_id);
    });
</script>