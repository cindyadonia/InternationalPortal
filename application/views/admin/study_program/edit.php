<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Study Program</h4>
        </div>
    </div>
</div>
<!-- Container fluid  -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Study Program Form</h4>
                    <?= $this->session->flashdata('message');?>
                    <!-- <h5 class="card-subtitle"> </h5> -->
                    <form class="form" action="<?= base_url('Admin/StudyProgram/update/'.$study_program['id'])?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Study Program Code</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="code" name="code" value="<?= $study_program['code']?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Name</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="name" name="name" value="<?= $study_program['name']?>" required>
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
</div>

