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
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">News Form</h4>
                    <!-- <h5 class="card-subtitle"> </h5> -->
					<?= $this->session->flashdata('message');?>
                    <?php echo form_open_multipart('admin/news/store');?>
                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('id')?>">
                        <div class="form-group mt-4 row">
                            <label for="example-text-input" class="col-2 col-form-label">Author</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="username" name="username" value="<?= $this->session->userdata('name')?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-month-input2" class="col-2 col-form-label">Category</label>
                            <div class="col-10">
                                <select class="custom-select col-12" id="category" name="category" value="<?= set_value('category')?>" required>
                                    <option selected="" value="">Choose Category...</option>
                                    <option value="Academic">Academic</option>
                                    <option value="Announcement">Announcement</option>
                                    <option value="Registration">Registration</option>
                                    <option value="Event">Event</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Title</label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="title" name="title" value="<?= set_value('title')?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Content</label>
                            <div class="col-10">
                                <textarea class="form-control" name="content" id="summernote" required><?= set_value('content')?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-datetime-local-input" class="col-2 col-form-label">Image</label>
                            <div class="col-10">
                                <input type="file" id="file_path" name="file_path" size="1000">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-password-input" class="col-2 col-form-label"></label>
                            <div class="col-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

