@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-users"></i>Privileges</li>
</ol>
@endsection
 
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-user-secret"></i>Privileges</h1></span>
		 	</div>
		 	<div class="box-body table-responsive">
		 		@if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif
                <div class="well">
                    <div class="row">
                        <div class="col-md-5">
                            <label class="form-label">User Group</label>
                            <select id="group" class="form-control"></select>
                            <label class="form-label">Privileges List</label>
                            <select id="priv" multiple="multiple" class="form-control" style="height:200px"></select>
                            <span class="help-block">Hold CTRL for multiple selecting</span>
                        </div>
                        <div class="col-md-1">
                            <button id="toright">>></button>
                            <button id="toleft"><<</button>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Permission for this group</label>
                            <select id="permission" multiple="multiple" class="form-control" style="height:300px" disabled="disabled">
                            </select>
                        </div>
                    </div>
                </div>
		    </div>
	 	</div>
	</div>
</div>

<script type="text/javascript">
    var $gselect = $('#group');
    var $pselect = $('#priv');
    var $prselect = $('#permission');

    function reload(group)
    {
        $.getJSON('privileges/permissions/'+group,function(data){
            $prselect.html('');
            $("#priv option:selected").removeAttr("selected");
            $.each(data,function(key,val){
            

                $('#priv option[value="'+val.privilegesid+'"]').prop("selected",true);
                $prselect.append('<option value="'+val.privilegesid+'">'+val.privilegesdesc+'</option>');
            });
        });
    }

    $.getJSON('privileges/groups',function(data){
        $gselect.html('');
        $.each(data,function(key,val){
            $gselect.append('<option value="'+val.groupid+'">'+val.groupname+'</option>');
        });
    });

    $.getJSON('privileges/privileges',function(data){
        $pselect.html('');
        $.each(data,function(key,val){
            $pselect.append('<option value="'+val.privilegesid+'">'+val.privilegesdesc+'</option>');
        });
    });

    $('#group').bind('keydown change',function(){
        var box = $(this);
        setTimeout(function() {
            $('#group option:selected').each(function(){
                reload(box.val());
                //reload($(this).val());
            });
        }, 0);
    });

    $('#toright').on('click',function(e){
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
        $('#group option:selected').each(function(){
            groupid = $(this).val();
            $.post('privileges/permissions',{group:groupid,priv:$('#priv').val()},function(){
                reload(groupid);
            });
        });

        
    });


    $(document).ready(function(){
        $('#group').val('1');
        reload(1);
    });
</script>
@endsection