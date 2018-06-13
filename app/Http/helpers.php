<?php
/**
 * Created by PhpStorm.
 * User: bashet
 * Date: 13/06/2018
 * Time: 02:51
 */

if( ! function_exists('get_card_select') ){
    function get_card_select($records){
        $html ='<select id="carouselchoose" class="chosen-select">';

        $block = '';
        $lastblock = '';
        $code = '';
        $name = '';
        $firstcode = '';
        foreach($records as $record) {

            if($firstcode == '') {
                $firstcode = $code;
            }
            $block = $record->block;
            $name = $record->name;
            $code = strtolower($record->code);
            if($block != $lastblock) {
                if($lastblock != '') {
                    $html.= '</optgroup>';
                }
                $html.= '<optgroup label="'.$block.'">';
                $html.= '<option class="ss ss-'.$code.' ss-grad" value="'.$code.'"> '.$name.'</option>';
            } else {
                $html.= '<option class="ss ss-'.$code.' ss-grad" value="'.$code.'"> '.$name.'</option>';
            }
            $lastblock = $block;
        }

        $html.= '</optgroup>';
        $html.= '</select>';

        return $html;
    }
}