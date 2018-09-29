<div class="container">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success notification">
            <p><?php echo $this->session->flashdata('success'); ?></p>
        </div>
    <?php elseif ($this->session->flashdata('error')) : ?>
        <div class="alert alert-danger notification">
            <p><?php echo $this->session->flashdata('error'); ?></p>
        </div>
    <?php endif; ?>
</div>
