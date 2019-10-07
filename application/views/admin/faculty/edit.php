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
                    <!-- <h5 class="card-subtitle"> </h5> -->
                    <form class="form" action="<?= base_url('faculty/update/'.$faculty['id'])?>" method="POST" enctype="multipart/form-data">
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

    <!-- Faculty's Courses -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Courses for <?= $faculty['name'] ?></h4>
                        </div>
                        <div class="ml-auto d-flex no-block align-items-center">
                            <div class="dl">
                                <a href="<?= base_url('course/add/'.$faculty['id'])?>" class="btn btn-primary">Add Course</a>
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
                                <?php foreach($courses as $course):?>
                                <tr>
                                    <td><?= $course['code'];?></td>
                                    <td><?= $course['name'];?></td>
                                    <td>
                                        <a href="<?= base_url('course/show/'.$course['id'])?>" class="btn btn-primary">Edit</a>
                                        <a href="" data-course-id="<?= $course['id'];?>" data-toggle="modal" data-target="#deleteCourse"  class="btn btn-danger btnDelCourse" name="btnDelCourse">Delete</a>
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

