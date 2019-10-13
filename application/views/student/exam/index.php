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
