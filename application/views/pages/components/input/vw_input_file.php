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
                <div class="file-input">
                    <input type="file"
                           class="form-control file-pj <?= isset($required) && !empty($required)  ? $required : '' ?>"
                           id="<?= isset($file_id) && !empty($file_id)  ? $file_id : '' ?>"
                           name="file[<?= isset($file_id) && !empty($file_id)  ? $file_id : '' ?>]"/>
                    <input type="hidden"
                           id="<?= isset($id) && !empty($id)  ? $id : '' ?>"
                           name="<?= isset($name) && !empty($name) ? $name : '' ?>" />
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $(document).on('change', ':file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);

            if($("#MATRICES_CREATION_TYPE").val() == 1) {
                if($("#MATRICES_INIT").val() != "" && $("#MATRICES_DOC_REF").val() != "")
                    $("#btn-valid-matrices").prop('disabled', false);
            }
            else if($("#MATRICES_CREATION_TYPE").val() == 2) {
                if($("#MATRICES_DOC_REF").val() != "")
                    $("#btn-valid-matrices").prop('disabled', false);
            }

        });
        $(document).ready( function() {
            $(':file').on('fileselect', function(event, numFiles, label) {
                var input = $(this).parents('.file-input').find(':hidden'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) console.log(log);
                }
            });
        });
    });
</script>