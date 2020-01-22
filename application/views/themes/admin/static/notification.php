<?php if ($this->session->flashdata()){ ?>
<div class="row">
    <div class="col-12">
        <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success') ?>
        </div>
        <?php } ?>

        <?php if($this->session->flashdata('error')){ ?>
        <div class="alert alert-danger" role="alert">
        <?php echo $this->session->flashdata('error') ?>
        </div>
        <?php } ?>

        <?php if($this->session->flashdata('info')){ ?>
        <div class="alert alert-info" role="alert">
        <?php echo $this->session->flashdata('info') ?>
        </div>
        <?php } ?>

        <?php if($this->session->flashdata('warning')){ ?>
        <div class="alert alert-warning" role="alert">
        <?php echo $this->session->flashdata('warning') ?>
        </div>
        <?php } ?>

        <!-- installer directory still there? -->
        <?php if ($this->session->flashdata('installer')){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $this->session->flashdata('installer') ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>