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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Exam Schedule</h4>
                    <!-- <h5 class="card-subtitle"> </h5> -->
                    <form class="form" action="<?= base_url('Admin/ExamSchedule/update/'.$exam['id'])?>" method="POST">
                        <div class="form-group mt-4 row">
                            <label for="example-month-input2" class="col-2 col-form-label">Subject</label>
                            <div class="col-10">
                                <select class="custom-select col-12" id="subject" name="subject" value="<?= set_value('subject')?>" required>
                                    <?php
                                    foreach($subjects as $subject){ ?>
                                    <option value="<?= $subject['id']?>" <?php if($exam['student_schedule_id'] ==  $subject['id'] ){ echo "selected";}else{}?>><?= $subject['subject']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-4 row">
                            <label for="example-month-input2" class="col-2 col-form-label">Exam Type</label>
                            <div class="col-10">
                                <select class="custom-select col-12" id="exam_type" name="exam_type" value="<?= set_value('exam_type')?>" required>
                                    <option selected="">Choose Subject...</option>
                                    <option value="1" <?php if($exam['exam_type'] == "1" ){ echo "selected";}else{}?>>Midterm Exam</option>
                                    <option value="2" <?php if($exam['exam_type'] == "2" ){ echo "selected";}else{}?>>Final Exam</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Location</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="location" name="location" value="<?= $exam['location']?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Date</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="date" name="date" value="<?= $exam['date']?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Start Time</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="start_time" name="start_time" value="<?= $exam['start_time']?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">End Time</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="end_time" name="end_time" value="<?= $exam['end_time']?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Table No</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="table_no" name="table_no" value="<?= $exam['table_no']?>" required>
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

