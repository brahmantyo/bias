<?php
Form::macro('icheckbox', function($name,$label,$checked,$description=null,$required=null,$privileges=null,$permission=null)
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

    $checkbox='';
    if($checked){
        $checkbox = 'checked="checked"';
    }

    if($required){
        $required = '<span>*</span>';
    }

	$output = '
	<div class="form-group">
        <div class="col-sm-2">
            <label for="'.$name.'" class="control-label ">'.$label.$required.'</label>
        </div>
        <div class="col-sm-10">
            <div class="checkbox">
                <label><input type="checkbox" '.$checkbox.' name="'.$name.'" value="1" '.$disabled.'/> '.$description.'</label>
            </div>

        </div>
    </div>';
    return $output;
});

Form::macro('icheckboxgroup', function($name,$label,$options,$values,$required=null,$privileges=null,$permission=null)
{
    $disabled='disabled';
    if($privileges)
    {
        foreach ($privileges as $priv) {
            if($priv->name===$permission){
                $disabled = '';
            }
        }
    }

    $checkbox='';

    foreach ($options as $key => $value) {
        if(in_array($key, $values)){
            $checkbox .= '
                            <div class="checkbox">
                                <label><input type="checkbox" checked="checked" name="'.$name.'[]" value="'.$key.'" '.$disabled.'/>'.$value.'</label>
                            </div>';           
        } else {
            $checkbox .= '
                            <div class="checkbox">
                                <label><input type="checkbox" name="'.$name.'[]" value="'.$key.'" '.$disabled.'/>'.$value.'</label>
                            </div>';
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
            '.$checkbox.'
        </div>
    </div>';

    return $output;
});