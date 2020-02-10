<div class="row">
    <!-- for notification -->
    <div class="col-12" id="notifContent">
        <?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success alert-dismissible" role="alert">
        <?php echo $this->session->flashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <?php } ?>

        <?php if($this->session->flashdata('error')){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
        <?php echo $this->session->flashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <?php } ?>

        <?php if($this->session->flashdata('info')){ ?>
        <div class="alert alert-info alert-dismissible" role="alert">
        <?php echo $this->session->flashdata('info') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <?php } ?>

        <?php if($this->session->flashdata('warning')){ ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
        <?php echo $this->session->flashdata('warning') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
        <?php } ?>

        <!-- installer directory still there? -->
        <?php if ($this->session->flashdata('installer')){ ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <?= $this->session->flashdata('installer') ?>
        </div>
        <?php } ?>
    </div>
</div>