<?php if (isset($this->alertError) AND $this->alertError) { ?>
    <div class="alert alert-danger" role="alert">
        <?= $this->alertError ?>
    </div>
<?php } ?>

<?php if (isset($this->alertSuccess) AND $this->alertSuccess) { ?>
    <div class="alert alert-success" role="alert">
        <?= $this->alertSuccess ?>
    </div>
<?php } ?>
