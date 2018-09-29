<!-- CONTENT-WRAPPER SECTION END-->
<div class="container">
    <footer>
            <div class="row pull-right">
                <div class="col-md-12 ">
                    &copy; EDF <?= date('Y') ?>
                </div>

            </div>
    </footer>
</div>


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js?refresh=' . DATE_NOW) ?>"></script>


<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url('assets/vendor/metisMenu/metisMenu.min.js?refresh=' . DATE_NOW) ?>"></script>

<!-- Bootstrap select JavaScript -->
<script src="<?php echo base_url('assets/vendor/bootstrap-select-size/js/bootstrap-select.min.js?refresh=' . DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap-select-size/dist/picker.min.js?refresh=' . DATE_NOW) ?>"></script>


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]-->
<script src="<?php echo base_url('assets/vendor/html5shiv/html5shiv.js?refresh=' . DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/vendor/html5shiv/respond.min.js?refresh=' . DATE_NOW) ?>"></script>


<!-- Custom Theme JavaScript -->
<script>
    var BASE_URL = "<?= base_url() ?>";
    var BASE_URL_CONNAISEUR = "<?= base_url().'connaisseur/' ?>";
</script>
<script src="<?php echo base_url('assets/dist/js/init.js?refresh=' . DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/dist/js/scrib.js?refresh=' . DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/dist/js/function.js?refresh=' . DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/dist/js/bootstrap-editable.min.js?refresh=' . DATE_NOW) ?>"></script>

<!-- DataTables JavaScript -->
<script src="<?php echo base_url('assets/vendor/datatables/js/jquery.dataTables.min.js?refresh=' . DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.min.js?refresh=' . DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.js?refresh=' . DATE_NOW) ?>"></script>


<!-- Form Helpers -->
<script src="<?php echo base_url('assets/vendor/formHelpers/dist/js/bootstrap-formhelpers.js?refresh=' . DATE_NOW) ?>"></script>

<!-- Validation JavaScript -->
<script src="<?php echo base_url('assets/vendor/jquery-validation-1.16.0/jquery.validate.min.js?refresh='.DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/vendor/jquery-validation-1.16.0/additional-methods.min.js?refresh='.DATE_NOW) ?>"></script>
<script src="<?php //echo base_url('assets/dist/js/validation/login.js?refresh='.DATE_NOW) ?>"></script>
<script src="<?php echo base_url('assets/dist/js/validation/create.js?refresh='.DATE_NOW) ?>"></script>
</body>

</html>