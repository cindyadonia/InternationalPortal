<div class="page-wrapper">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">News</h4>
        </div>
    </div>
</div>
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- DATA TABLE -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List of News</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($newss as $news):?>
                                <tr>
                                    <td><?= $news['title'];?></td>
                                    <td><?= date('d M Y',strtotime($news['created_at']));?></td>
                                    <td><?= $news['author'];?></td>
                                    <td><?= $news['category'];?></td>
                                    <td>
                                        <a href="<?= base_url('Admin/News/show/'.$news['id'])?>" class="btn btn-primary">Edit</a>
                                        <a href="" data-news-id="<?= $news['id'];?>" data-toggle="modal" data-target="#deleteNews"  class="btn btn-danger btnDelNews" name="btnDelNews">Delete</a>
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
<!-- End Container fluid  -->

<!-- SoftDelete Student - Modal -->
<div id="deleteNews" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="vcenter" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vcenter">Delete News</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h4>You are going to delete this news.</h4>
                <p>Are you sure you want to delete this news?</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-danger" id="target-delete-button">Delete</a>
                <button type="button" class="btn btn-info waves-effect" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<script src="<?= base_url('assets');?>/libs/jquery/dist/jquery.min.js"></script>

<script>
    $('.btnDelNews').click(function() {
        var id = $(this).attr("data-news-id");
        var link = "<?= base_url('Admin/News/destroy/') ?>";
        $('#target-delete-button').attr("href", link+id);
    });
</script>