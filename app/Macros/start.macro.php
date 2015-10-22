<?php

Form::macro('loginForm',function ($name, $url, $title = null, $btnSubmit = 'Login', $errors = null) {
	$openForm = Form::open(['name'=>$name,'id'=>$name,'url'=>$url,'class'=>'form-vertical']);
	$closeForm = Form::close();
	$submit = Form::submit($btnSubmit,['class'=>'btn btn-info form-control']);
	$css = asset('/css/form.css');
	$username = Form::loginUsername('name','User ID',$errors);
	$password = Form::loginPassword('password','Password',$errors);

    $item = <<<HTML
	<link href="$css" rel="stylesheet" type="text/css" />

    $openForm
	<fieldset class="panel panel-primary">
		<legend class="panel-heading">$title</legend>
		<div class="panel-body">
			$username
			$password
    		<div class="form-group">
    			<div class="col-md-4"></div>
    			<div class="col-md-8">$submit</div>
    		</div>
		</div>
	</fieldset>
    $closeForm
HTML;

        return $item;
});

Form::macro('loginUsername',function($name,$title,$errors = null){
	$label = Form::label($name,$title,['class'=>'control-label required col-md-12']);
	$input = Form::text($name,old($name),['placeholder'=>$title,'class'=>'form-control','required']);
	$errClass = isset($errors)?($errors->has($name) ? 'has-error' : ''):'';
	$errPHP = isset($errors)?($errors->first($name, '<p class="help-block">:message</p>')):'';

	$item = <<<HTML
	<div class="form-group $errClass required">
		$label
		<div class="col-md-12">
			$input
			$errPHP
		</div>
	</div>
HTML;
	return $item;
});
Form::macro('loginPassword',function($name,$title,$errors = null){
	$label = Form::label($name,$title,['class'=>'control-label required col-md-12']);
	$input = Form::input('password',$name,old($name),['placeholder'=>$title,'class'=>'form-control','required']);
	$errClass = isset($errors)?($errors->has($name) ? 'has-error' : ''):'';
	$errPHP = isset($errors)?($errors->first($name, '<p class="help-block">:message</p>')):'';

	$item = <<<HTML
	<div class="form-group $errClass required">
		$label
		<div class="col-md-12">
			$input
			$errPHP
		</div>
	</div>
HTML;
	return $item;
});