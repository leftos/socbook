<?
// to use; put require_once('par.php'); as first line in function

if (defined('_') && !Par::isDefaultPar(_)) {
    throw new Exception('Cannot define \'_\' as default parameter placeholder!');
}

//define(_, fopen('data://text/plain;base64,', 'r'));
define('_', acos(1.01));

function PAR($arr = array()) {
    if (func_num_args() == 1) {
        return new Par($arr);
    } else {
        $args = func_get_args();
        $new_arr = array();
        for ($cnt = 0; $cnt < sizeof($args); $cnt+=2) $new_arr[$args[$cnt]] = $args[$cnt+1];
        return new PAR($new_arr);
    }
}

class ParNoDefault {}

class Par {
    var $_arr;
    
    function Par($arr) {
        $this->_arr = $arr;
    }
    
    function getArr() {
        return $this->_arr;
    }

    function isDefaultPar($par) {
    //    return ($par == _);    // use if using resource
        return @is_nan($par);
    }
    
    function getCurrentFunction($n = 1) {
        $_x = debug_backtrace(); $_x = $_x[$n+1];
        return $_x;
    }
    
    function getAllParamDefaults($function_name = '', $class_name = '')
    {
        if (!$function_name) {
            $cf = self::getCurrentFunction(2);
            $function_name = $cf['function'];
            $class_name = $cf['class'];
        }
        
        if ($class_name) $p = new ReflectionMethod($class_name, $function_name);
        else $p = new ReflectionFunction($function_name);

        $parameters = $p->getParameters();
        
        foreach ($parameters as $i => $par) {
            $return[$par->getName()] = ($par->isDefaultValueAvailable() ? $par->getDefaultValue() : new ParNoDefault());
        }
        return $return;
        
    }
    
    function replaceDefaultAndPar($arr, $defaults_arr)
    {
        $defaults_arr_keys = array_keys($defaults_arr);
        $defaults_arr_values = array_values($defaults_arr);
        
        $new_arr = array();
        foreach ($arr as $i => $a) {
            if (is_a($a, 'Par')) {
                $new_arr[$defaults_arr_keys[$i]] = $defaults_arr_values[$i];
                
                $tmp = $a->getArr();
                $tmp_arr = array();
                foreach ($defaults_arr_keys as $dak_i => $dak) {
                    if (isset($tmp[$dak])) $tmp_arr[$dak_i] = $tmp[$dak];
                }
                
                $new_arr = Par::blindMerge($new_arr, $_x = Par::blindMerge($tmp, Par::replaceDefaultAndPar($tmp_arr, $defaults_arr)));
                if (is_a($new_arr[$defaults_arr_keys[$i]], 'ParNoDefault')) {
                    trigger_error("No Default Available for \"$defaults_arr_keys[$i]\"", E_USER_WARNING);
                    $new_arr[$defaults_arr_keys[$i]] = null;
                }
            }
            if (Par::isDefaultPar($a)) {
                if (is_a($defaults_arr_values[$i], 'ParNoDefault')) {
                    trigger_error("No Default Available for \"$defaults_arr_keys[$i]\"", E_USER_WARNING);
                    $new_arr[$defaults_arr_keys[$i]] = null;
                } else {
                    $new_arr[$defaults_arr_keys[$i]] = $defaults_arr_values[$i];
                }
            }
        }
        
        return $new_arr;
    }
    
    function blindMerge($array_1, $array_2, $no_clobber = false)
    {
        $new_array = array();
        
        if ($array_1) foreach ($array_1 as $i_1 => $a_1) {
            $new_array[$i_1] = $a_1;
        }
        
        if ($array_2) foreach ($array_2 as $i_2 => $a_2) {
            if (!$no_clobber || !isset($new_array[$i_2])) $new_array[$i_2] = $a_2;
        }
        
        return $new_array;        
    }    
    
}

?>