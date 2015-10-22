<?php
Form::macro('bsubmit', function($label)
{
	$output = '
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">'.$label.'</button>
        </div>
    </div>';
    return $output;
});