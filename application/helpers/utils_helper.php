<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * function to secure field on post, pour eviter l'injection de dependence
 */
if (!function_exists('secureFields')) {
    function secureFields($name)
    {
        $CI =& get_instance();
        if (isset($name)) {
            if ($CI->input->post($name) == '') {
                return $CI->input->post($name);
            } else {
                return htmlentities($CI->input->post($name));
            }
        }
    }
}

/**
 * function to load view and pass data
 */
if (!function_exists('loadViewElement')) {
    function loadViewElement($params, $path)
    {
        $data = array();
        $CI =& get_instance();
        if (isset($params) && !empty($params)) {
            if (sizeof($params) != 0) {
                foreach ($params as $key => $value) {
                    $data[$key] = $value;
                }
            }
        }
        $CI->load->view($path, $data);
    }
}

/**
 * function to pretty json
 */
if (!function_exists('json_pretty')) {
    function json_pretty($data, $prettyFalse = true)
    {
        if ($prettyFalse)
            return json_encode($data, JSON_PRETTY_PRINT);
        else
            return json_encode($data);
    }
}

/**
 * function get value bye key
 */
if (!function_exists('get_value_by_name')) {
    function get_value_by_name($datas, $name)
    {
        if (isset($datas) && !empty($datas)) {
            foreach ($datas as $key => $value) {
                if ($name == $key) {
                    return $value;
                }
            }
        } else {
            return false;
        }
    }
}
/**
 * Function permet de supprimer un dossier avec son contenu
 */
if (!function_exists('deleteDirectory')) {
    function deleteDirectory($dirPath)
    {

        if (!is_dir($dirPath)) {
            return;
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);

        foreach ($files as $file) {
            if (is_dir($file)) {
                $this->deleteDirectory($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}

/**
 * Function permet de supprimer un dossier avec son contenu
 */
if (!function_exists('getDirectoryContent')) {
    function getDirectoryContent($dirPath)
    {
        if (!is_dir($dirPath)) {
            return;
        }
        return array_slice(scandir($dirPath), 2);
    }
}

/**
 *
 */
if (!function_exists('getLotsByPerimeter')) {
    function getLotsByPerimeter($perimeterId)
    {
        $CI = get_instance();
        $CI->load->model('lotsModel');
        $lots = $CI->lotsModel->getLotByPerimeterId($perimeterId);
        return $lots;
    }
}
/**
 *
 */
if (!function_exists('normalize')) {
    function normalize($string)
    {
        $inchar = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
        $outchar = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
        $newstring = str_replace($inchar, $outchar, $string);
        return $newstring;
    }
}

/**
 *
 */
if (!function_exists('normalizeToUpper')) {
    function normalizeToUpper($string)
    {
        $inchar = explode(",", "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
        $outchar = explode(",", "c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
        $newstring = str_replace($inchar, $outchar, $string);
        return strtoupper($newstring);
    }
}