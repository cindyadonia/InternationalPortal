<!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Left Part  -->
            <!-- ============================================================== -->
            <div class="left-part bg-white fixed-left-part">
                <!-- Mobile toggle button -->
                <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
                <!-- Mobile toggle button -->
                <div class="p-15">
                    <h4>Chat Sidebar</h4>
                </div>
                <div class="scrollable position-relative" style="height:100%;">
                    <div class="p-15">
                        <h5 class="card-title">Search Contact</h5>
                        <form>
                            <input class="form-control" type="text" placeholder="Search Contact">
                        </form>
                    </div>
                    <hr>
                    <ul class="mailbox list-style-none">
                        <li>
                            <div class="message-center chat-scroll">
                            <?php foreach($recipients as $recipient):?>
                                <a href="<?= base_url('Message/showChat/'.$recipient['user_no'])?>" class="message-item">
                                    <div class="mail-contnet">
                                        <h5 class="message-title"><?= $recipient['name'];?></h5>
									</div>
                                </a>
							<?php endforeach; ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Left Part  -->
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Right Part  Mail Compose -->
            <!-- ============================================================== -->
            <div class="right-part">
                <div class="p-20">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><?= $receiver['name']?></h4>
                            <div class="chat-box scrollable" style="height:calc(100vh - 300px);">
                                <!--chat Row -->
                                <ul class="chat-list">
                                    <?php foreach($chats as $chat){
                                        if($chat['sender_no'] == $this->session->userdata('user_no'))
                                        {
                                        ?>
                                    <li class="odd chat-item">
                                        <div class="chat-content">
                                            <div class="box bg-light-inverse"><?= $chat['content']?></div>
                                        </div>
                                        <div class="chat-time"><?= date('H:i',strtotime($chat['created_at'])) ?></div>
                                    </li>
                                        <?php } else if($chat['sender_no'] != $this->session->userdata('user_no')){?>
                                    <li class="chat-item">
                                        <div class="chat-content">
                                            <div class="box bg-light-info"><?= $chat['content']?></div>
                                        </div>
                                        <div class="chat-time"><?= date('H:i',strtotime($chat['created_at'])) ?></div>
                                    </li>
                                    <?php }}?>
                                    <!-- <li class="chat-item">
                                        <div class="chat-content">
                                            <h6 class="font-medium">James Anderson</h6>
                                            <div class="box bg-light-info">Lorem Ipsum is simply dummy text of the printing &amp; type setting industry.</div>
                                        </div>
                                        <div class="chat-time">10:56 am</div>
                                    </li>
                                    <li class="odd chat-item">
                                        <div class="chat-content">
                                            <div class="box bg-light-inverse">Whats budget of the new project.</div>
                                            <br>
                                        </div>
                                        <div class="chat-time">10:59 am</div>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
						<!-- INPUT TEXT -->
                        <div class="card-body border-top">
                            <div class="row">
                                <div class="col-9">
                                    <div class="input-field m-t-0 m-b-0">
                                        <input id="textarea1" placeholder="Type and enter" class="form-control border-0" type="text">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <a class="btn-circle btn-lg btn-cyan float-right text-white" href="javascript:void(0)"><i class="fas fa-paper-plane"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url('assets');?>/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('assets');?>/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url('assets');?>/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="<?= base_url('assets');?>/js/app.min.js"></script>
    <script src="<?= base_url('assets');?>/js/app.init.light-sidebar.js"></script>
    <script src="<?= base_url('assets');?>/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= base_url('assets');?>/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?= base_url('assets');?>/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?= base_url('assets');?>/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= base_url('assets');?>/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= base_url('assets');?>/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="<?= base_url('assets');?>/extra-libs/c3/d3.min.js"></script>
    <script src="<?= base_url('assets');?>/extra-libs/c3/c3.min.js"></script>
    <script src="<?= base_url('assets');?>/js/pages/dashboards/dashboard4.js"></script>

    <!--This page JavaScript -->
    <script>
    $(function() {
        $(document).on('keypress', "#textarea1", function(e) {
            if (e.keyCode == 13) {
                var id = $(this).attr("data-user-id");
                var msg = $(this).val();
                msg = msg_sent(msg);
                $("#someDiv").append(msg);
                $(this).val("");
                $(this).focus();
            }
        });
    });
    </script>

    <!--This page plugins -->
    <!-- <script src="<?= base_url('assets');?>/extra-libs/DataTables/datatables.min.js"></script>
    <script src="<?= base_url('assets');?>/js/pages/datatable/datatable-basic.init.js"></script> -->
    
</body>
