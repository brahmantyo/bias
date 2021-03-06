<?php namespace App;
use App\Money;
class Helpers {

    public static function assoc_merge(array $a, array $b)
    {
        $r = array();

        foreach ($a as $key => $val) {
            if (array_key_exists($key, $b) && is_array($val) == is_array($b[$key])) {
                if (is_array($val)) {
                    $r[$key] = assoc_merge($a[$key], $b[$key]); // merge array
                } else {
                    $r[$key] = array($val, $b[$key]); // merge entry
                }
            } else {
                $r[$key] = $val; // just copy
            }
        }
        return $r + $b; // add whatever we missed
    }

	public static function awsomeFilterLabel($label,$content){
		return '<span class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-success btn-md disabled">'.$label.'</button>
                    </div>
                    <input class="form-control input-md" type="text" disabled value="'.$content.'"></input>
                </span>';
	}
    public static function currency($value,$decimal=0,$country=NULL,$vat=FALSE){
        switch($country){
            case "id" : $money = new Money("Rp ",$decimal,0.1,",","."); break;
            case "us" : $money = new Money("$ ",$decimal,0.2,".",","); break;
            default : $money = new Money("");
        }
        if(!$decimal){$money->setDecimal(0);}else{$money->setDecimal($decimal);}
        if(strip_tags(!isset($_POST['export']))){
            return $money->display($value);
        } else {
            return $value;
        }
    }
    
    public static function number($number,$decimal=0){
        return number_format($number,$decimal,",",".");
    }

    public static function number_parser($number,$lang='id_ID'){
        switch($lang){
            case 'id_ID' : {
                                $tmp = explode(',',$number);
                                if(count($tmp)>1){
                                    return $tmp[0].'.'.$tmp[1];
                                } else {
                                    return $tmp[0];
                                }                
                            };break;
            case 'en_US' : {
                                $tmp = explode('.',$number);
                                if(count($tmp)>1){
                                    return $tmp[0].','.$tmp[1];
                                } else {
                                    return $tmp[0];
                                }                
                            };break;
        }

    }
    
    public static function dateToMySqlSystem($date){
        /*//$result = date_create_from_format("d-m-Y",$date);
        $result = date_create_from_format("d-m-Y",$date);
        //return $result->format("Y-m-d");
        return date_create($result, "Y-m-d");*/
        return !$date?'-':\Carbon\Carbon::parse($date)->format('Y-m-d');
    }
    
    public static function dateFromMySqlSystem($date){
        /*$result = date_create_from_format("Y-m-d",$date);
        //return $result->format("d-m-Y");
        return date_format($result,"d-m-Y");*/
        return !$date?'-':\Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public static function month($month,$format='s'){
        switch($month){
            case '1' : {
                    switch($format){
                        case 's' : return 'Jan';break;
                        case 'l' : return 'Januari';break;
                    }
                }
            case '2' : {
                    switch($format){
                        case 's' : return 'Feb';break;
                        case 'l' : return 'Februari';break;
                    }
                }
            case '3' : {
                    switch($format){
                        case 's' : return 'Mar';break;
                        case 'l' : return 'Maret';break;
                    }
                }
            case '4' : {
                    switch($format){
                        case 's' : return 'Apr';break;
                        case 'l' : return 'April';break;
                    }
                }
            case '5' : {
                    switch($format){
                        case 's' : return 'Mei';break;
                        case 'l' : return 'Mei';break;
                    }
                }
            case '6' : {
                    switch($format){
                        case 's' : return 'Jun';break;
                        case 'l' : return 'Juni';break;
                    }
                }
            case '7' : {
                    switch($format){
                        case 's' : return 'Jul';break;
                        case 'l' : return 'Juli';break;
                    }
                }
            case '8' : {
                    switch($format){
                        case 's' : return 'Ags';break;
                        case 'l' : return 'Agustus';break;
                    }
                }
            case '9' : {
                    switch($format){
                        case 's' : return 'Sep';break;
                        case 'l' : return 'September';break;
                    }
                }
            case '10' : {
                    switch($format){
                        case 's' : return 'Okt';break;
                        case 'l' : return 'Oktober';break;
                    }
                }
            case '11' : {
                    switch($format){
                        case 's' : return 'Nov';break;
                        case 'l' : return 'November';break;
                    }
                }
            case '12' : {
                    switch($format){
                        case 's' : return 'Des';break;
                        case 'l' : return 'Desember';break;
                    }
                }
        }
        return $month;
    }
}