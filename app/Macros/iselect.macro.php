<?php
Form::macro('iselect', function($name,$label,$options=array(),$default,$required=null,$privileges=null,$permission=null)
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
            $arroptions .= '<option value='.$key.' selected="selected">'.$value.'</option>'; 
        }else{
            $arroptions .= '<option value='.$key.'>'.$value.'</option>'; 
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
            <select class="form-control" id="'.$name.'" name="'.$name.'" '.$disabled.'>
                '.$arroptions.'
            </select>
        </div>
    </div>';
    return $output;
});