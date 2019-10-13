<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets');?>/images/favicon.png">
    <title>International Portal</title>
    <!-- Custom CSS -->
    <link href="<?= base_url('assets');?>/css/style.min.css" rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
		<div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(<?= base_url('assets');?>/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box">
				<div class="logo">
					<!-- <span class="db"><img src="<?= base_url('assets');?>/images/logo-icon.png" alt="logo" /></span> -->
					<h5 class="font-medium m-b-20">Sign In</h5>
					<?= $this->session->flashdata('message');?>
				</div>
				<!-- Form -->
				<div class="row">
					<div class="col-12">
						<form class="form-horizontal m-t-20" action="<?= base_url();?>" method="POST">
							<div class="input-group mt-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
								</div>
								<input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" id="username" name="username" value="<?= set_value('username');?>">
							</div>
								<?= form_error('username', '<small class="text-danger pl-1">', '</small>');?>
							<div class="input-group mt-3">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
								</div>
								<input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" id="password" name="password">
							</div>
							<?= form_error('password', '<small class="text-danger pl-1">', '</small>');?>
							<div class="form-group text-center mt-3">
								<div class="col-xs-12 p-b-20">
									<button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
								</div>
							</div>
							<!-- <div class="form-group m-b-0 m-t-10">
								<div class="col-sm-12 text-center">
									Don't have an account? <a href="authentication-register1.html" class="text-info m-l-5"><b>Sign Up</b></a>
								</div>
							</div> -->
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?= base_url('assets');?>/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('assets');?>/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url('assets');?>/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
		$('[data-toggle="tooltip"]').tooltip();
		$(".preloader").fadeOut();
    </script>
</body>

</html>