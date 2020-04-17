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
            <h4 class="page-title">News</h4>
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
    <!-- Row -->
    <div class="row">
        <div class="col-12">
            <!-- Row -->
            <div class="row">
                <!-- column -->
                <div class="col-sm-12 col-xs-12">
                    <?php foreach($newss as $news){?>
                    <!-- News -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 col-xs-12">
                                    <img class="card-img-top img-responsive" src="<?= base_url('uploads/news/'.$news['file_path'])?>" alt="Card image cap">
                                </div>
                                <div class="col-sm-8 col-xs-12">
                                    <h4 class="card-title"><?= $news['title']?></h4>
                                    <p class="text-secondary"><?= date('d M Y',strtotime($news['created_at']))?> by <?= $news['author']?></p>
                                    <p class="card-text text-justify"><?php echo substr($news['content'], 0, 500)?></p>
                                    <a href="<?= base_url('Student/UniversityNews/view/'.$news['id'])?>" class="btn btn-primary">Read More</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- News -->
                    <?php } ?>

                </div>
                <!-- column -->
            </div>
        </div>
    </div>
    <!-- End Row -->
    
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
