<div class="row">
    <div class="<?= isset($col_md_div) && !empty($col_md_div) ? $col_md_div : 'col-md-6' ?>">
        <div class="form-group">
            <label class="<?= isset($col_lg_label) && !empty($col_lg_label) ? $col_lg_label : 'col-lg-5' ?> control-label"> <?= isset($label) ? $label : '' ?>
                :
                <?php if(isset($required) && !empty($required)) : ?>
                    <span class="text-danger">*</span>
                <?php endif;?>
            </label>
            <div class="<?= isset($col_lg_element) && !empty($col_lg_element) ? $col_lg_element : 'col-lg-7' ?> control-div">
                <input type="<?= isset($type) && !empty($type) ? $type : '' ?>"
                       class="form-control <?php if($type == 'checkbox') echo 'move-left'?> <?= isset($required) && !empty($required)  ? $required : '' ?>"
                       id="<?= isset($id) && !empty($id)  ? $id : '' ?>"
                       name="<?= isset($name) && !empty($name) ? $name : '' ?>"
                       value="<?= isset($value) && !empty($value) ? $value : '' ?>"
                       placeholder="<?= isset($placeholder) && !empty($placeholder) ? $placeholder : '' ?>">
            </div>
        </div>
    </div>
</div>
