        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
            <?= $this->session->flashdata('message');?>
                <!-- ============================================================== -->
                <!-- table -->
                <!-- ============================================================== -->
                <!-- DATA TABLE -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Active Students</h4>
                                <h6 class="card-subtitle">This is the list of current active international students</a></h6>
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
                                                <th>Action</th>
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
                                                <td> <a href="<?= base_url('Admin/Student/show/'.$student['id'])?>" class="btn btn-success">View</a> </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Student No</th>
                                                <th>Name</th>
                                                <th>Birth Date</th>
                                                <th>Nationality</th>
                                                <th>University</th>
                                                <th>Study Program</th>
                                                <th>Joined On</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            