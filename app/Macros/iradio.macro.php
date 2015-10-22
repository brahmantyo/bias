<?php
Form::macro('iradio', function($name,$label,$options=array(),$default)
{
    $arroptions = '';
    foreach ($options as $key => $value) {
        if($key==$default){
            $arroptions .= '<label class="btn btn-primary active"<input type="radio"  id="'.$name.'" name="'.$name.'" value="'.$key.'" /> '.$value.'</label>'; 
        }else{
            $arroptions .= '<label class="btn btn-primary"><input type="radio"  id="'.$name.'" name="'.$name.'" value="'.$key.'" /> '.$value.'</label>'; 
        }
    }
	$output = '
	<div class="form-group">
        <div class="col-sm-2">
            <label for="'.$name.'" class="control-label">'.$label.'</label>
        </div>
        <div class="col-sm-10">
            <div class="btn-group" data-toggle="buttons">
                '.$arroptions.'
            </div>

        </div>
    </div>';
    return $output;
});