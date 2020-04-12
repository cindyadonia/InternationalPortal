    <div class="page-wrapper">
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
                            <a recipient-no="<?= $recipient['user_no']?>" class="message-item get-chat-box">
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
        <div class="right-part">
            <div class="text-center" style="margin-top:30%">
                <h4>Choose an Admin to start a chat</h4>
            </div>
        </div>

    </div>

    <div style="display: none;">
        <form action="<?php echo base_url("Message/store/"); ?>" method="POST" enctype="multipart/form-data" id="uploadFileForm">
            <input type="file" name="file_path" id="chooseFile">
            <input type="hidden" name="recipient" id="file-recipient-no">
            <input type="text" name="message" id="file-message">
            <button type="submit" name="asd" value="enter" id="uploadFileSubmitButton">Submit button</button>
        </form>
    </div>

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
        class MyInterval {
            status = false;
            constructor(status) {
                this.status = status;
            }

            getStatus() { return this.status; };
            setStatus(status) { this.status = status; };
        }
        var currentInterval = false;
        $(document).ready(function() {
            var refreshInterval = new MyInterval(false);
            function Interval(fn, time) {
                var timer = false;
                this.start = function () {
                    if (!this.isRunning())
                        console.log("call start");
                        console.log(fn, time);
                        timer = setInterval(fn, time);
                };
                this.stop = function () {
                    console.log("call stop")
                    clearInterval(timer);
                    timer = false;
                };
                this.isRunning = function () {
                    console.log("Check is running");
                    return timer !== false;
                };
            }

            function refreshChat(recipient_no)
            {
                console.log(recipient_no);
                var last_chat_id = $('ul.chat-list li:last-child').attr('data-id');
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url("Message/newMessage/"); ?>' + recipient_no + "/" + last_chat_id,
                    data:{},
                    success:function(data){
                        var jsonObject = JSON.parse(data);
                        var html = "";
                        for (i = 0; i < jsonObject.new_chats.length; i++)
                        {
                            if(jsonObject.new_chats[i].sender_no == <?= $this->session->userdata('user_no') ?>)
                            {
                                html += "<li class='odd chat-item' data-id='" + jsonObject.new_chats[i].id + "'>";
                                html += "<div class='chat-content'>";
                                if (jsonObject.new_chats[i].file_path) {
                                    html += "<div class='box bg-light-inverse'>File has been sent. <a style='color:Yellow' href='<?php echo base_url()?>Message/download/" + jsonObject.new_chats[i].file_path+ "'>Download here</a></div>";
                                } else {
                                    html += "<div class='box bg-light-inverse'>" + jsonObject.new_chats[i].content + "</div>";
                                }
                                // html += "<div class='box bg-light-inverse'>" + jsonObject.new_chats[i].content + "</div>";
                                // html += "</div>";
                                html += "<div class='chat-time'>" +new Date(jsonObject.new_chats[i].created_at).toString().slice(16,21); + "</div>";
                                html += "</li>";
                            }
                            else if(jsonObject.new_chats[i].sender_no != <?= $this->session->userdata('user_no') ?>)
                            {
                                html += "<li class='chat-item' data-id='" + jsonObject.new_chats[i].id + "'>";
                                html += "<div class='chat-content'>";
                                if (jsonObject.new_chats[i].file_path) {
                                    html += "<div class='box bg-light-info'>File has been sent. <a href='<?php echo base_url()?>Message/download/" + jsonObject.new_chats[i].file_path+ "'>Download here</a></div>";
                                } else {
                                    html += "<div class='box bg-light-info'>" + jsonObject.new_chats[i].content + "</div>";
                                }
                                // html += "<div class='box bg-light-info'>" + jsonObject.new_chats[i].content + "</div>";
                                // html += "</div>";
                                html += "<div class='chat-time'>" +new Date(jsonObject.new_chats[i].created_at).toString().slice(16,21); + "</div>";
                                html += "</li>";
                            }
                        }
                        $('ul.chat-list').append(html);
                        // $('.chat-box.scrollable').scrollTop($('.chat-list').height());
                    }
                }); 
            }

            $('.get-chat-box').on('click',function(){
                var recipient_no = $(this).attr('recipient-no');
                $('#file-recipient-no').val(recipient_no);
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url("Message/showChat/"); ?>' + recipient_no,
                    data:{},
                    success:function(data){
                        $('.right-part').empty();
                        var jsonObject = JSON.parse(data);
                        var html = "";
                        html += "<div class='p-20'><div class='card'><div class='card-body'>";
                        html += "<h4 class='card-title'>" + jsonObject.receiver['name'] + "</h4>";
                        html += "<div class='chat-box scrollable' style='height:calc(100vh - 300px);'>";
                        html += "<ul class='chat-list'>";
                        for (i = 0; i < jsonObject.chats.length; i++)
                        {
                            if(jsonObject.chats[i].sender_no == <?= $this->session->userdata('user_no') ?>)
                            {
                                html += "<li class='odd chat-item' data-id='" + jsonObject.chats[i].id + "'>";
                                html += "<div class='chat-content'>";
                                if (jsonObject.chats[i].file_path) {
                                    html += "<div class='box bg-light-inverse'>File has been sent. <a style='color:Yellow' href='<?php echo base_url()?>Message/download/" + jsonObject.chats[i].file_path+ "'>Download here</a></div>";
                                } else {
                                    html += "<div class='box bg-light-inverse'>" + jsonObject.chats[i].content + "</div>";
                                }
                                html += "</div>";
                                html += "<div class='chat-time'>" +new Date(jsonObject.chats[i].created_at).toString().slice(16,21); + "</div>";
                                html += "</li>";
                            }
                            else if(jsonObject.chats[i].sender_no != <?= $this->session->userdata('user_no') ?>)
                            {
                                html += "<li class='chat-item' data-id='" + jsonObject.chats[i].id + "'>";
                                html += "<div class='chat-content'>";
                                if (jsonObject.chats[i].file_path) {
                                    html += "<div class='box bg-light-info'>File has been sent. <a href='<?php echo base_url()?>Message/download/" + jsonObject.chats[i].file_path+ "'>Download here</a></div>";
                                } else {
                                    html += "<div class='box bg-light-info'>" + jsonObject.chats[i].content + "</div>";
                                }
                                html += "</div>";
                                html += "<div class='chat-time'>" +new Date(jsonObject.chats[i].created_at).toString().slice(16,21); + "</div>";
                                html += "</li>";
                            }
                        }
                        html += "</ul></div></div><div class='card-body border-top'><div class='row'><div class='col-9'><div class='input-field m-t-0 m-b-0'><input id='message' placeholder='Type and enter' class='form-control border-0' type='text'></div></div><div class='col-3'><a id='choose-file' class='btn-circle btn-lg btn-cyan float-right text-white'><i class='fas fa-paperclip'></i></a><a id='send-msg' class='btn-circle btn-lg btn-cyan float-right text-white' href='javascript:void(0)'><i class='fas fa-paper-plane'></i></a></div></div></div></div></div>";
                        
                        $('.right-part').append(html);
                        // console.log($('.chat-box.scrollable').scrollHeight);
                        $('.chat-box.scrollable').scrollTop($('.chat-list').height());

                        var input = document.getElementById("message");
                        input.addEventListener("keyup", function(event) {
                            if (event.keyCode === 13) {
                                event.preventDefault();
                                document.getElementById("send-msg").click();
                            }
                        });

                        $('#send-msg').on('click', function(){			
                            var msg = $(this).parent().prev().children().children().val();
                            if(msg){
                                $.ajax({
                                    type:'POST',
                                    url:'<?php echo base_url("Message/store/"); ?>',
                                    data:{
                                        message:msg,
                                        recipient:recipient_no,
                                    },
                                    success:function(data){
                                        $('#message').val("");
                                    }
                                });
                            }
                        });
                    }
                });

                if (refreshInterval.getStatus()) {
                    currentInterval.stop();
                    
                    currentInterval = new Interval(function() {
                        refreshChat(recipient_no)
                    }, 1000);
                    currentInterval.start();
                    refreshInterval.setStatus(true);
                } else {
                    currentInterval = new Interval(function() {
                        refreshChat(recipient_no)
                    }, 1000);
                    currentInterval.start();
                    refreshInterval.setStatus(true);
                }
                
            });
        });



        $(document).ready(function() {
            $(document).on("click", "#choose-file", function () {
                $('#chooseFile').trigger('click');
            });

            $('#chooseFile').on('change', function(){
                console.log("CHANGE");
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url("Message/store/"); ?>",
                    data: new FormData(document.getElementById("uploadFileForm")),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response){
                        document.getElementById("uploadFileForm").reset();
                    },
                    error: function(e) {
                        document.getElementById("uploadFileForm").reset();
                    }
                });
            });
        });
    </script>
</body>