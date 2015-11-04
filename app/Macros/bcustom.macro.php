<?php
Form::macro('bcustom', function($label,$id,$buttons=[],$token,$privileges=null,$permission=null)
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
 
	$btn = '';
	foreach ($buttons as $key => $url) {
		switch ($key) {
            case 'v':
                $btn .= '<a  href="'.$url.'/'.$id.'" class="btn btn-success">View</a>';
                break;
            case 'c':
                $btn .= '<a  href="'.$url.'/create" class="btn btn-success">Add</a>';
                break;
            case 'e':
                $btn .= '<a  href="'.$url.'/'.$id.'/edit" class="btn btn-success">Edit</a>';
                break;
            case 'd':
                $btn .= '<form method="POST" action="'.$url.'/'.$id.'" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.$token.'">
                            <input class="btn btn-danger" type="submit" value="Delete">
                         </form>';
                break;
		}
	}
	$output = '
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-primary" '.$disabled.'>'.$label.'</button>'.$addonbtn
        .'</div>
    </div>';
    return $output;
});