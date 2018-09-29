<?php
    $vwInput = 'pages/components/input/vw_input';
    $vwSelect = 'pages/components/select/vw_select';
    $vwInputTel = 'pages/components/input/vw_input_tel';
    $id = $this->uri->segment(3);
    $version = $this->uri->segment(4);

    if (isset($datas['fields'])) {
        $fields = $datas['fields'];
        $references = is_array($fields['document-references']) ? $fields['document-references'] : [];
        $perimeters = is_array($fields['document-perimeters']) ? $fields['document-perimeters'] : [];
        $dirReferences = $fields['document-directory'];
        $docType = $fields['document-type'];
    }
?>