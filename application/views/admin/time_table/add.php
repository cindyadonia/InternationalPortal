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
                    <h4 class="card-title">New Subject Form</h4>
                    <!-- <h5 class="card-subtitle"> </h5> -->
                    <form class="form" action="<?= base_url('admin/timetable/store/'.$student_id)?>" method="POST">
                        <div class="form-group mt-4 row">
                            <label for="example-text-input" class="col-2 col-form-label">Subject</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="subject" name="subject" value=<?= set_value('subject')?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Credits</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="credits" name="credits" value=<?= set_value('credits')?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Lecturer</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="lecturer" name="lecturer" value=<?= set_value('lecturer')?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Class</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="class" name="class" value=<?= set_value('class')?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Location</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="location" name="location" value=<?= set_value('location')?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Day</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="day" name="day" value=<?= set_value('day')?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Start Time</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="start_time" name="start_time" value=<?= set_value('start_time')?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">End Time</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="end_time" name="end_time" value=<?= set_value('end_time')?>>
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

