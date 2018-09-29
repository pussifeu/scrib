<?php $this->load->view('includes/vw_header'); ?>
<style>
    .login-form {
        margin: 16% auto 0 auto;
        overflow: hidden;
        padding-bottom: 10px;
        width: 35%;
        border: 1px solid #586A7E;
        border-radius: 10px;
        box-shadow: 5px 5px 10px #BBB;
    }
    .login-form .row {
        padding: 10px 10px 0 10px;
    }
    .login-form form {
        -moz-box-shadow: inset 0 10px 10px 0 #e5e5e5;
        -webkit-box-shadow: inset 0 10px 10px 0 #e5e5e5;
        -o-box-shadow: inset 0 10px 10px 0 #e5e5e5;
        box-shadow: inset 0 10px 10px 0 #e5e5e5;
        filter:progid:DXImageTransform.Microsoft.Shadow(color=#f5f5f5, Direction=180, Strength=10);
        padding: 10px 15px;
    }
</style>
<div class="container-login">
    <div id="square">
        <div class="login-form">
            <div class="row">
                <div class="col-md-3">
                    <img src="<?= base_url('assets/img/edf_header_logo.png') ?>" alt="EDF" />
                </div>
                <div class="col-md-6 text-center">
                    <h4 class="text-primary">
                        <b><?= $this->lang->line('label_scrib_authentification')?></b>
                    </h4>
                </div>
                <div class="col-md-3 text-right">
                    <img src="<?= base_url('assets/img/scrib_logo.png') ?>" alt="SCRIB" width="60px"/>
                </div>
            </div>

            <form id="login-form" method="post" style="margin-top:25px" action="<?php echo base_url('login')?>">
                <div class="form-group">
                    <label for="username"><?= $this->lang->line('label_nni')?></label>
                    <input class="form-control" name="login-nni" type="text" autofocus>
                </div>
                <div class="form-group">
                    <label for="password"><?= $this->lang->line('label_sesame_password')?></label>
                    <input class="form-control" name="login-password" type="password" value="">
                </div>
                <button class="btn btn-md btn-primary" id="login-button" style="float: right; font-weight: 700"><?= $this->lang->line('label_connexion')?></button>
            </form>
        </div>
    </div>
</div>