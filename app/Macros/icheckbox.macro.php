<?php
Form::macro('icheckbox', function($name,$label,$checked,$description)
{
    $checkbox="";
    if($checked){
        $checkbox .= '<input type="checkbox" checked="checked" name="'.$name.'" value="1" />'; 
    } else {
        $checkbox .= '<input type="checkbox" name="'.$name.'" value="1"/>';

    }

	$output = '
	<div class="form-group">
        <div class="col-sm-2">
            <label for="'.$name.'" class="control-label">'.$label.'</label>
        </div>
        <div class="col-sm-10">
            <div class="checkbox">
                <label>'.$checkbox.' '.$description.'</label>
            </div>

        </div>
    </div>';
    return $output;
});

Form::macro('icheckboxgroup', function($name,$label,$options,$values)
{
    $checkbox = '';
    foreach ($options as $key => $value) {
        if(in_array($key, $values)){
            $checkbox .= '
                            <div class="checkbox">
                                <label><input type="checkbox" checked="checked" name="'.$name.'[]" value="'.$key.'"/>'.$value.'</label>
                            </div>';           
        } else {
            $checkbox .= '
                            <div class="checkbox">
                                <label><input type="checkbox" name="'.$name.'[]" value="'.$key.'"/>'.$value.'</label>
                            </div>';
        }
    }


    $output = '
    <div class="form-group">
        <div class="col-sm-2">
            <label for="'.$name.'" class="control-label">'.$label.'</label>
        </div>
        <div class="col-sm-10">
            '.$checkbox.'
        </div>
    </div>';
    return $output;
});