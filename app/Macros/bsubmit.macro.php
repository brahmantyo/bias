<?php
Form::macro('bsubmit', function($label,$buttons=[])
{
	$addonbtn = '';
	foreach ($buttons as $key => $value) {
		switch ($key) {
			case 'back':
				$addonbtn .= ' <button type="button" onclick="history.back()" class="btn btn-success">'.$value.'</button>';
				break;
			case 'close':
				$addonbtn .= ' <button type="button" onclick="open(location, \'_self\').close()" class="btn btn-success">'.$value.'</button>';
				break;
		}
	}
	$output = '
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">'.$label.'</button>'.$addonbtn
        .'</div>
    </div>';
    return $output;
});