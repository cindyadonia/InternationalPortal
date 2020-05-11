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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">International Student Form</h4>
					<?= $this->session->flashdata('message');?>
                    <!-- <h5 class="card-subtitle"> </h5> -->
                    <form class="form" action="<?= base_url('Admin/Student/store')?>" method="POST">
                        <div class="form-group mt-4 row">
                            <label for="example-text-input" class="col-2 col-form-label">Student No</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="student_no" name="student_no" value="<?= set_value('student_no')?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Name</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="name" name="name" value="<?= set_value('name')?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Birth Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="birth_date" name="birth_date" value="<?= set_value('birth_date')?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Nationality</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="nationality" name="nationality" value="<?= set_value('nationality')?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">University Origin</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="university_origin" name="university_origin" value="<?= set_value('university_origin')?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-month-input2" class="col-2 col-form-label">Semester</label>
                            <div class="col-10">
                                <select class="custom-select col-12" id="semester" name="semester" value="<?= set_value('semester')?>" required>
                                    <option selected="" value="">Choose Semester...</option>
                                    <option value="1">Semester One</option>
                                    <option value="2">Semester Two</option>
                                    <option value="3">Semester Three</option>
                                    <option value="4">Semester Four</option>
                                    <option value="5">Semester Five</option>
                                    <option value="6">Semester Six</option>
                                    <option value="7">Semester Seven</option>
                                    <option value="8">Semester Eight</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-month-input2" class="col-2 col-form-label">Study Program</label>
                            <div class="col-10">
                                <select class="custom-select col-12" id="study_program" name="study_program" value="<?= set_value('study_program')?>" required>
                                    <option selected="" value="">Choose Study Program...</option>
                                    <?php
                                    foreach($study_programs as $study_program){ ?>
                                    <option value="<?= $study_program['id']?>"><?= $study_program['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Join Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="joined_at" name="joined_at" value="<?= set_value('joined_at')?>" required>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                            <label for="example-password-input" class="col-2 col-form-label">Password</label>
                            <div class="col-10">
                                <input class="form-control" type="password" id="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-password-input" class="col-2 col-form-label">Confirm Password</label>
                            <div class="col-10">
                                <input class="form-control" type="password" id="password_c" name="password_c">
                            </div>
                        </div> -->
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

