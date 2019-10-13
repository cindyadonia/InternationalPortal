<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">International Student</h4>
        </div>
    </div>
</div>
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- EDIT STUDENT -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Student Informations</h4>
                    <!-- <h5 class="card-subtitle"> </h5> -->
                    <form class="form" action="<?= base_url('admin/student/update/'.$student['id'])?>" method="POST">
                        <input type="hidden" name="id" value="<?= $student['id'];?>">
                        <div class="form-group mt-4 row">
                            <label for="example-text-input" class="col-2 col-form-label">Student No</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="student_no" name="student_no" value="<?= $student['student_no'];?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Name</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="name" name="name" value="<?= $student['name'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Birth Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="birth_date" name="birth_date" value="<?= $student['birth_date'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Nationality</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="nationality" name="nationality" value="<?= $student['nationality'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">University Origin</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="university_origin" name="university_origin" value="<?= $student['university_origin'];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-month-input2" class="col-2 col-form-label">Semester</label>
                            <div class="col-10">
                                <select class="custom-select col-12" id="semester" name="semester" value=<?= set_value('semester')?>>
                                    <option value="1" <?php if($student['semester'] == 1 ){ echo "selected";}else{}?>>Semester One</option>
                                    <option value="2" <?php if($student['semester'] == 2 ){ echo "selected";}else{}?>>Semester Two</option>
                                    <option value="3" <?php if($student['semester'] == 3 ){ echo "selected";}else{}?>>Semester Three</option>
                                    <option value="4" <?php if($student['semester'] == 4 ){ echo "selected";}else{}?>>Semester Four</option>
                                    <option value="5" <?php if($student['semester'] == 5 ){ echo "selected";}else{}?>>Semester Five</option>
                                    <option value="6" <?php if($student['semester'] == 6 ){ echo "selected";}else{}?>>Semester Six</option>
                                    <option value="7" <?php if($student['semester'] == 7){ echo "selected";}else{}?>>Semester Seven</option>
                                    <option value="8" <?php if($student['semester'] == 8 ){ echo "selected";}else{}?>>Semester Eight</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-month-input2" class="col-2 col-form-label">Course</label>
                            <div class="col-10">
                                <select class="custom-select col-12" id="course" name="course" value=<?= set_value('course')?>>
                                    <?php
                                    foreach($courses as $course){ ?>
                                    <option value="<?= $course['id']?>" <?php if($student['course_id'] ==  $course['id'] ){ echo "selected";}else{}?>><?= $course['name']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Join Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="joined_at" name="joined_at" value="<?= date($student['joined_at']);?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-month-input2" class="col-2 col-form-label">Status</label>
                            <div class="col-10">
                                <select class="custom-select col-12" id="is_active" name="is_active" value=<?= set_value('is_active')?>>
                                    <option value="1" <?php if($student['is_active'] == 1 ){ echo "selected";}else{}?>>Active</option>
                                    <option value="2" <?php if($student['is_active'] == 0 ){ echo "selected";}else{}?>>Not Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-password-input" class="col-2 col-form-label">New Password</label>
                            <div class="col-10">
                                <input class="form-control" type="password" id="password" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-password-input" class="col-2 col-form-label">Confirm New Password</label>
                            <div class="col-10">
                                <input class="form-control" type="password" id="password_c" name="password_c">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-password-input" class="col-2 col-form-label"></label>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TIME TABLE -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Time Table</h4>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <div class="dl">
                                <a href="<?= base_url('admin/timetable/create/'.$student['id'])?>" class="btn btn-primary">Add Subject</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Class</th>
                                    <th class="border-0">Subject</th>
                                    <th class="border-0">Time and Location</th>
                                    <th class="border-0">Lecturer</th>
                                    <th class="border-0">Credits</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($schedules as $schedule):?>
                                <tr>
                                    <td><?= $schedule['class'];?></td>
                                    <td><?= $schedule['name'];?></td>
                                    <td><?= $schedule['timeandlocation'];?></td>
                                    <td><?= $schedule['lecturer'];?></td>
                                    <td><?= $schedule['credits'];?></td>
                                    <td>
                                        <a href="<?= base_url('admin/timetable/show/'.$schedule['id'])?>" class="btn btn-primary">Edit</a>
                                        <a href="" data-schedule-id="<?= $schedule['id'];?>" data-student-id="<?=$student['id']?>" data-toggle="modal" data-target="#deleteSchedule"  class="btn btn-danger btnDelSchedule" name="btnDelSchedule">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <tr>
                                    <td colspan="3"> </td>
                                    <td class="font-weight-bolder"> Total Credits </td>
                                    <td colspan="2" class="font-weight-bolder"><?= $totalcredit['totalcredit'];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EXAM -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Midterm Exam List -->
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Exam Schedules</h4>
                            <h5 class="card-subtitle"> Midterm Exam</h5>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <div class="dl">
                                <a href="<?= base_url('admin/examschedule/create/'.$student['id'])?>" class="btn btn-primary">Add Exam Schedule</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Class</th>
                                    <th class="border-0">Subject</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0">Time and Location</th>
                                    <th class="border-0">Table No</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($midterms as $midterm):?>
                                <tr>
                                    <td><?= $midterm['class'];?></td>
                                    <td><?= $midterm['name'];?></td>
                                    <td><?= date('d-M-Y',strtotime($midterm['date'])) ?></td>
                                    <td><?= $midterm['timeandlocation'];?></td>
                                    <td><?= $midterm['table_no'];?></td>
                                    <td>
                                        <a href="<?= base_url('admin/examschedule/show/'.$student['id'].'/'.$midterm['mid_id'])?>" class="btn btn-primary">Edit</a>
                                        <a href="" data-midterm-id="<?= $midterm['mid_id'];?>" data-student-id="<?=$student['id']?>" data-toggle="modal" data-target="#deleteExamSchedule"  class="btn btn-danger btnDelExamSchedule" name="btnDelExamSchedule">Delete</a>
                                        <!-- onclick="return confirm('Are you sure you want to delete this student?')" -->
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Final Exam List -->
                    <div class="d-md-flex align-items-center" style="padding-top:20px">
                        <div>
                            <h5 class="card-subtitle"> Final Exam</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Class</th>
                                    <th class="border-0">Subject</th>
                                    <th class="border-0">Date</th>
                                    <th class="border-0">Time and Location</th>
                                    <th class="border-0">Table No</th>
                                    <th class="border-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($finals as $final):?>
                                <tr>
                                    <td><?= $final['class'];?></td>
                                    <td><?= $final['name'];?></td>
                                    <td><?= date('d-M-Y',strtotime($final['date'])) ?></td>
                                    <td><?= $final['timeandlocation'];?></td>
                                    <td><?= $final['table_no'];?></td>
                                    <td>
                                        <a href="<?= base_url('admin/examschedule/show/'.$student['id'].'/'.$final['mid_id'])?>" class="btn btn-primary">Edit</a>
                                        <a href="" data-midterm-id="<?= $final['mid_id'];?>" data-toggle="modal" data-target="#deleteExamSchedule"  class="btn btn-danger btnDelExamSchedule" name="btnDelExamSchedule">Delete</a>
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



    <!-- SoftDelete Schedule - Modal -->
    <div id="deleteSchedule" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Delete Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h4>You are going to delete this schedule.</h4>
                    <p>Are you sure you want to delete this schedule?</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-danger" id="target-delete-schedule">Delete</a>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- SoftDelete ExamSchedule - Modal -->
    <div id="deleteExamSchedule" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="vcenter">Delete Midterm Exam Schedule</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <h4>You are going to delete this midterm schedule.</h4>
                    <p>Are you sure you want to delete this midterm schedule?</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-danger" id="target-delete-midterm">Delete</a>
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



</div>
<script src="<?= base_url('assets');?>/libs/jquery/dist/jquery.min.js"></script>

<script>
    $('.btnDelSchedule').click(function() {
        var id = $(this).attr("data-schedule-id");
        var student_id = $(this).attr("data-student-id");
        var link = "<?= base_url('admin/timetable/destroy/') ?>";
        $('#target-delete-schedule').attr("href", link+id+'/'+student_id);
    });

    $('.btnDelExamSchedule').click(function() {
        var id = $(this).attr("data-midterm-id");
        var student_id = $(this).attr("data-student-id");
        var link = "<?= base_url('admin/examschedule/destroy/') ?>";
        $('#target-delete-midterm').attr("href", link+id+'/'+student_id);
    });
</script>