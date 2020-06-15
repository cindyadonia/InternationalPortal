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
<!-- TIME TABLE -->
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4 class="card-title">Time Table</h4>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($schedules) > 0){
                                foreach($schedules as $schedule):?>
                                <tr>
                                    <td><?= $schedule['class'];?></td>
                                    <td><?= $schedule['name'];?></td>
                                    <td><?= $schedule['timeandlocation'];?></td>
                                    <td><?= $schedule['lecturer'];?></td>
                                    <td><?= $schedule['credits'];?></td>
                                </tr>
                                <?php endforeach;} else { ?>
                                    <td colspan="5" style="text-align:center"> You don't have any schedules right now.</td>
                                <?php } ?>
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
</div>

