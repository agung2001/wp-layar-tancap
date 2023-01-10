<?php

namespace LayarTancap\Helper;

!defined( 'WPINC ' ) or die;

/**
 * Helper library for Fab plugins
 *
 * @package    Fab
 * @subpackage Fab\Includes
 */

trait Option {

    /** Array Merge Recursive */
    public function ArrayMergeRecursive(array $array1, array $array2){
        $merged = $array1;
        foreach ($array2 as $key => & $value) {
            if (is_array($value) && isset($merged[$key]) && is_array($merged[$key])) {
                $merged[$key] = $this->ArrayMergeRecursive($merged[$key], $value);
            } else if (is_numeric($key)) {
                if (!in_array($value, $merged)) {
                    $merged[] = $value;
                }
            } else {
                $merged[$key] = $value;
            }
        }
        return $merged;
    }

    /** Transform Boolean Value */
    public function transformBooleanValue($data){
        if(is_array($data)){
            foreach($data as $key => &$value){
                if( is_array($value) ){ $value = $this->transformBooleanValue( $value ); }
                else { $value = ($value==='true' || $value==='1') ? 1 : 0; }
            }
        } else { $data = ($data==='true' || $data ==='1') ? 1 : 0; }
        return $data;
    }

}
