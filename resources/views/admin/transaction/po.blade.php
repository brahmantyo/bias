@extends('app')
@section('content-header')
<ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i>Home</a></li>
    <li class="active"><i class="fa fa-users"></i>Purchase Order</li>
</ol>
@endsection
 
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="box">
			<div class="box-header">
		    	<span><h1><i class="fa fa-user-secret"></i>Purchase Order</h1></span>
		    	<hr>
		 	</div>
		 	<div class="box-body table-responsive">
		 		@if ($errors->has())
                    @foreach ($errors->all() as $error)
                        <div class='bg-danger alert'>{{ $error }}</div>
                    @endforeach
                @endif
		        <table class="table table-condensed table-striped table-bordered table-hover no-margin">
		            <thead>
		                <tr>
		                    <th>Id PO</th>
		                    <th>Tgl PO</th>
		                    <th>Supplier</th>
		                    <th>Approved By</th>
		                    <th width="200"></th>
		                </tr>
		            </thead>
		 
		            <tbody>
		                @foreach ($po as $p)
		                <tr>
		                    <td>{{ $p->idpo }}</td>
		                    <td>{{ $p->tglpo }}</td>
		                    <td>{{ $p->nama }}</td>
		                    <td>{{ $p->approvedby }}</td>
		                    <td>
		                        <a id="detail" href="/admin/po/{{ str_replace('/','-',$p->idpo) }}" class="btn btn-success pull-right" style="margin-right: 3px;">Detail</a>
<!-- 		                        {!! Form::open(['url' => '/admin/po/' . str_replace('/','-',$p->idpo), 'method' => 'DELETE']) !!}
		                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
		                        {!! Form::close() !!} -->
		                    </td>
		                </tr>
		                @endforeach
		            </tbody>
		        </table>
   			    <div class="pull-right">{!! $po->render() !!}</div>
		    </div>
	 	</div>
	</div>
</div>


<script type="text/javascript">
	$('a:contains("Detail")').fancybox({
		type : 'iframe',
		href : this.value,
		autoSize: false,
		width: 1024,
		height: 800,
		openSpeed: 1,
		closeSpeed: 1,
		ajax : {
			dataType : 'html',
		},
		afterClose : function(){ window.location.replace('/admin/po') },
	});

</script>
@endsection