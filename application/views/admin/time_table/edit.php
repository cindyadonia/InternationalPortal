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
                    <h4 class="card-title">Subject Form</h4>
                    <!-- <h5 class="card-subtitle"> </h5> -->
                    <?= $this->session->flashdata('message');?>
                    <form class="form" action="<?= base_url('Admin/TimeTable/update/'.$schedule['id'])?>" method="POST">
                        <div class="form-group mt-4 row">
                            <label for="example-text-input" class="col-2 col-form-label">Subject</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="subject" name="subject" value="<?= $schedule['name'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Credits</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="credits" name="credits" value="<?= $schedule['credits'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Lecturer</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="lecturer" name="lecturer" value="<?= $schedule['lecturer'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Class</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="class" name="class" value="<?= $schedule['class'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Location</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="location" name="location" value="<?= $schedule['location'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Day</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="day" name="day" value="<?= $schedule['day'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Start Time</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="start_time" name="start_time" value="<?= $schedule['start_time'];?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">End Time</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="end_time" name="end_time" value="<?= $schedule['end_time'];?>" required>
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

