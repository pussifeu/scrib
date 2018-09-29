<div class="row">
    <div class="<?= isset($col_md_div) ? $col_md_div : 'col-md-6' ?>">
        <div class="form-group">
            <label class="<?= isset($col_lg_label) && !empty($col_lg_label) ? $col_lg_label : 'col-lg-6' ?> control-label"><?= isset($label) ? $label : '' ?>
                :
                <?php if(isset($required) && !empty($required)) : ?>
                    <span class="text-danger">*</span>
                <?php endif;?>
            </label>
            <div class="<?= isset($col_lg_element) && !empty($col_lg_element) ? $col_lg_element : 'col-lg-6' ?> control-div">
                <select class="selectpicker <?= isset($required) && !empty($required) ? $required : '' ?>"
                onchange="onchangeFunction(this,'<?= isset($onchange) && !empty($onchange) ? $onchange : '' ?>')"
                id="<?= isset($id) && !empty($id) ? $id : '' ?>"
                data-live-search="true"
                name="<?= isset($name) && !empty($name) ? $name : '' ?>">
                    <?php if(sizeof($options) > 0) :?>
                        <?php foreach ($options as $key => $val) : ?>
                            <?php if($key == '0') :?>
                                <option value="" <?php if(!isset($value) || empty($value)) echo 'selected' ?>><?= $val ?></option>
                            <?php else:?>
                                <option value="<?= $key ?>" <?php if(isset($value) && !empty($value) && $value == $key) echo 'selected' ?>><?= $val ?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
            </div>
        </div>
    </div>
</div>
