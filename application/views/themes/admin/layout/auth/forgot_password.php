<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-4">
            <h4 class="text-center mb-4">Please fill your valid email address</h4>
            <?php if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger"><?=$this->session->flashdata('error')?></div>
            <?php } ?>
            <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success"><?=$this->session->flashdata('success')?></div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <?php echo form_open($form_action, ['id' => 'form_forgot_password']) ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" name="identity" placeholder="Email" required>
                        </div>

                        <div class="row">
                            <div class="col pr-2">
                                <button type="submit" class="btn btn-block btn-primary">Send Request</button>
                                <a href="<?=site_url('admin/auth')?>" class="btn btn-block btn-secondary">Back to login</a>
                            </div>                           
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>