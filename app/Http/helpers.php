<?php
/**
 * Created by PhpStorm.
 * User: bashet
 * Date: 13/06/2018
 * Time: 02:51
 */

if( ! function_exists('get_card_select') ){
    function get_card_select($records){
        $html ='<select id="carouselchoose" class="form-control chosen-select">';

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

if( ! function_exists('symbol') ){
    function symbol($text) {
        $text=nl2br($text);
        $text=str_replace('{T}','<i class="ms ms-tap ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{0}','<i class="ms ms-0 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{1}','<i class="ms ms-1 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{2}','<i class="ms ms-2 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{3}','<i class="ms ms-3 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{4}','<i class="ms ms-4 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{5}','<i class="ms ms-5 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{6}','<i class="ms ms-6 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{7}','<i class="ms ms-7 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{8}','<i class="ms ms-8 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{9}','<i class="ms ms-9 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{10}','<i class="ms ms-10 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{11}','<i class="ms ms-11 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{12}','<i class="ms ms-12 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{13}','<i class="ms ms-13 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{14}','<i class="ms ms-14 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{15}','<i class="ms ms-15 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{16}','<i class="ms ms-16 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{17}','<i class="ms ms-17 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{18}','<i class="ms ms-18 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{19}','<i class="ms ms-19 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{20}','<i class="ms ms-20 ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{X}','<i class="ms ms-x ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{Y}','<i class="ms ms-y ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{Z}','<i class="ms ms-z ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{W}','<i class="ms ms-w ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{B}','<i class="ms ms-b ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{U}','<i class="ms ms-u ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{R}','<i class="ms ms-r ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{G}','<i class="ms ms-g ms-cost ms-shadow"></i>&nbsp;',$text);

        $text=str_replace('{C}','<i class="ms ms-bp ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{R/P}','<i class="ms ms-rp ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{W/P}','<i class="ms ms-wp ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{B/P}','<i class="ms ms-bp ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{G/P}','<i class="ms ms-gp ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{U/P}','<i class="ms ms-up ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{E}','<i class="ms ms-e"></i>&nbsp;',$text);

        $text=str_replace('{B/R}','<i class="ms ms-br ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{R/B}','<i class="ms ms-rb ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{G/R}','<i class="ms ms-gr ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{R/G}','<i class="ms ms-rg ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{U/R}','<i class="ms ms-ur ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{R/U}','<i class="ms ms-ru ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{W/R}','<i class="ms ms-wr ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{R/W}','<i class="ms ms-rw ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{G/W}','<i class="ms ms-gw ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{W/G}','<i class="ms ms-wg ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{G/B}','<i class="ms ms-gb ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{B/G}','<i class="ms ms-bg ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{G/U}','<i class="ms ms-gu ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{U/G}','<i class="ms ms-ug ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{W/U}','<i class="ms ms-wu ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{U/W}','<i class="ms ms-uw ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{W/B}','<i class="ms ms-wb ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{B/W}','<i class="ms ms-bw ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{B/U}','<i class="ms ms-bu ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        $text=str_replace('{U/B}','<i class="ms ms-ub ms-split ms-cost ms-shadow"></i>&nbsp;',$text);
        return $text;
    }
}

if( ! function_exists('get_status_id_by_name')){
    function get_status_id_by_name($name){
        $id = 0;
        $status = \App\Status::where('name', '=', $name)->get()->first();

        if($status){
            $id = $status->id;
        }

        return $id;
    }
}

