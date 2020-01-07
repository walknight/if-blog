<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-4">
            <h1 class="text-center">If-Blog</h1>
            <p class="text-center">Content Management System (CMS) for Blog</p>
            <?php if($this->session->flashdata('error')){ ?>
            <div class="alert alert-danger"><?=$this->session->flashdata('error')?></div>
            <?php } ?>
            <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success"><?=$this->session->flashdata('success')?></div>
            <?php } ?>
            <div class="card">
                <div class="card-body">
                    <?php echo form_open($form_action, ['id' => 'form_login']) ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="identity" placeholder="Username" value="<?=$identity?>">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="form-check mb-3">
                            <label class="form-check-label">
                                <input type="checkbox" name="remember" class="form-check-input">
                                Remember Me
                            </label>
                        </div>

                        <div class="row">
                            <div class="col pr-2">
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                            </div>
                            <div class="col pl-2">
                                <a class="btn btn-block btn-link" href="<?=site_url('admin/auth/forgot_password')?>">Forgot Password</a>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>