<?php
Form::macro('ipassword', function($name,$label,$placeholder='',$value='',$required=true)
{
    if($required){
        $required = '<span>*</span>';
    }

	$output = '
	<div class="form-group">
        <div class="col-sm-2">
            <label for="'.$name.'" class="control-label">'.$label.$required.'</label>
        </div>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="'.$name.'" name="'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'" />
        </div>
    </div>';
    return $output;
});