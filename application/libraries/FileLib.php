<?php


class FileLib
{
    private $CI;
    function __construct()
    {
        header('Content-Type: text/html; charset=utf-8');
        $this->CI =& get_instance();
        // Helper
        $this->CI->load->helper('download');
    }

    public function upload($folder = null)
    {
        if (sizeof($_FILES) > 0 && sizeof($_FILES['file']['name']) > 0) {
            for ($i = 1; $i < sizeof($_FILES['file']['name'])+1; $i++) {
                if (isset($_FILES['file']['name'][$i]) && !empty(basename($_FILES['file']['name'][$i]))) {
                    $file = $folder . SEPARATOR . html_entity_decode(basename($_FILES['file']['name'][$i]));
                    move_uploaded_file($_FILES['file']['tmp_name'][$i], $file);
                }
            }
        }
    }
}