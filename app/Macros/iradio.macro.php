<?php
Form::macro('iradio', function($name,$label,$options=array(),$default,$required=null,$privileges=null,$permission=null)
{
    $disabled='';
    if($privileges)
    {
        $disabled='disabled';
        foreach ($privileges as $priv) {
            if($priv->name===$permission){
                $disabled = '';
            }
        }
    }

    $arroptions = '';
    foreach ($options as $key => $value) {
        if($key==$default){
            $arroptions .= '<label class="btn btn-primary active"<input type="radio"  id="'.$name.'" name="'.$name.'" value="'.$key.'" '.$disabled.'/> '.$value.'</label>'; 
        }else{
            $arroptions .= '<label class="btn btn-primary"><input type="radio"  id="'.$name.'" name="'.$name.'" value="'.$key.'" '.$disabled.'/> '.$value.'</label>'; 
        }
    }
    if($required){
        $required = '<span>*</span>';
    }

	$output = '
	<div class="form-group">
        <div class="col-sm-2">
            <label for="'.$name.'" class="control-label">'.$label.$required.'</label>
        </div>
        <div class="col-sm-10">
            <div class="btn-group" data-toggle="buttons">
                '.$arroptions.'
            </div>

        </div>
    </div>';
    return $output;
});