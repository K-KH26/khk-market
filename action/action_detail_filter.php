<?php

/**
 * 세부 검색에 대한 필터링 함수
 */

class DetailFilter
{
    /**세부 검색 필터링 어레이리스트 유효 확인
     * @parm $input_list : 체크리스트
    */
    function detailSearchCheck(array $input_list)
    {
        $get = true;
     
        for ($i=0; $i < sizeof($input_list); $i++) {
            $get = filter_has_var(INPUT_GET, $input_list[$i]);
            if(!$get){ //false Return
             return $get;
            }
        }
        return $get;
    }


    function detailSearchFiltering()
    {
        $filters = array(
            "category" => FILTER_SANITIZE_STRING,
            "detail_category" => FILTER_SANITIZE_STRING,
            "class" => FILTER_SANITIZE_STRING,
            "detail_name" => FILTER_SANITIZE_STRING,
            "detail_level_min" => array(
                'filter' => FILTER_VALIDATE_INT,
                'options' => array(
                    'min_range' => 0,
                    'max_range' => 60
                )
            ),
            "detail_level_max" => array(
                'filter' => FILTER_VALIDATE_INT,
                'options' => array(
                    'min_range' => 0,
                    'max_range' => 60
                )
            ),
            "detail_price_min" => array(
                'filter' => FILTER_VALIDATE_INT,
                'options' => array(
                    'min_range' => 0
                )
            ),
            "detail_price_max" => array(
                'filter' => FILTER_VALIDATE_INT,
                'options' => array(
                    'min_range' => 0
                )
            ),
            "detail_option" => FILTER_SANITIZE_STRING,
            "detail_option_min" => array(
                'filter' => FILTER_VALIDATE_INT,
                'options' => array(
                    'min_range' => 0
                )
            ),
        );

        return $filters;
    
    }

}
