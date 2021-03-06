<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets');?>/images/favicon/favicon.png">
    <link rel="apple-touch-icon" sizes="16x16" href="<?= base_url('assets');?>/images/favicon/apple-icon.png">
    <title><?= $title;?></title>
    <!-- Custom CSS -->
    <link href="<?= base_url('assets');?>/extra-libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets');?>/css/style.min.css" rel="stylesheet">

    <!-- This page plugin CSS -->
    <link href="<?= base_url('assets');?>/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Summer Note Text Editor CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets');?>/libs/summernote/dist/summernote-bs4.css">

</head>

<body>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- Main wrapper - style you can find in pages.scss -->
    <div id="main-wrapper">