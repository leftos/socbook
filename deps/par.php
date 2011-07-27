<?
if (func_num_args()) {
    if (extract($____x = Par::replaceDefaultAndPar(func_get_args(), $____y = Par::getAllParamDefaults($__FUNCTION__, $__CLASS__)), EXTR_IF_EXISTS) != sizeof($____x) ) {
        trigger_error("Invalid PAR variable; check for typo: (" . implode(', ', array_diff(array_keys($____x), array_keys($____y))) . ')', E_USER_WARNING);
    }
}
?>