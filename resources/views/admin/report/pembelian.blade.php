<!doctype html>
<html>
<head>
    <meta charset="UTF-8">  
	<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Basic DataGrid - jQuery EasyUI Mobile Demo</title>  
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/easyui/themes/metro/easyui.css')}}">  
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/easyui/themes/mobile.css')}}">  
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/easyui/themes/icon.css')}}">  
    <script type="text/javascript" src="{{ asset('/plugins/easyui/jquery.min.js')}}"></script>  
    <script type="text/javascript" src="{{ asset('/plugins/easyui/jquery.easyui.min.js')}}"></script> 
    <script type="text/javascript" src="{{ asset('/plugins/easyui/jquery.easyui.mobile.js')}}"></script> 
</head>
<body>
    <table id="dg" data-options="header:'#hh',singleSelect:true,border:false,fit:true,fitColumns:true,scrollbarSize:0">  
        <thead>  
            <tr>  
                <th data-options="field:'id',width:80">Item ID</th>  
                <th data-options="field:'tgl',width:100">Tgl</th>  
                <th data-options="field:'kasir',width:80">Kasir</th>  
                <th data-options="field:'cabang',width:80">Cabang</th>  
            </tr>
        </thead>  
    </table>

	<script>
		$(function(){
			$('#dg').datagrid({
				method:'get',
				url:'/admin/penjualan/jual'

			});
		});
	</script>
</body>	
</html>
