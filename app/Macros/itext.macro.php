<?php

Form::macro('itext', function($name,$label,$placeholder='',$value='',$required=null,$privileges=null,$permission=null)
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

    if($required){
        $required = '<span>*</span>';
    }

	$output = '
	<div class="form-group">
        <div class="col-sm-2">
            <label for="'.$name.'" class="control-label">'.$label.$required.'</label>
        </div>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="'.$name.'" name="'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'" '.$disabled.'/>
        </div>
    </div>';
    return $output;

});