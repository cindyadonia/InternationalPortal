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
    <!-- EDIT STUDENT -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"><?= $news['title']?></h4>
                    <h5 class="card-subtitle"> <?= date('d M Y',strtotime($news['created_at']))?> by <?= $news['author']?> </h5>
                    <p class="card-text text-justify"><?= $news['content']?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('assets');?>/libs/jquery/dist/jquery.min.js"></script>