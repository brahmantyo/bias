@extends('app')

@section('title')
@endsection

@section('head')
<link href="{{ asset('/plugins/easyui/themes/default/easyui.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/easyui/themes/mobile.css') }}" rel="stylesheet" type="text/css" />  
<link href="{{ asset('/plugins/easyui/themes/icon.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ asset('/plugins/easyui/jquery.easyui.min.js') }}"></script>
<script src="{{ asset('/plugins/easyui/jquery.easyui.mobile.js') }}"></script> 
<script src="{{ asset('/plugins/easyui/datagrid-detailview.js') }}"></script>


@endsection

@section('footer')
@endsection

@section('breadcrumb')
@endsection

@section('content')

                        <table id="dj" data-options="singleSelect:true,border:false,fit:false,fitColumns:true,scrollbarSize:0">  
                            <thead>  
                                <tr>  
                                    <th data-options="field:'id',width:80">ID</th>  
                                    <th data-options="field:'tgl',width:100">Tgl</th>  
                                    <th data-options="field:'kasir',width:80">Kasir</th>  
                                    <th data-options="field:'cabang',width:80">Cabang</th>  
                                </tr>
                            </thead>  
                        </table>
                        <table id="dtj" data-options="singleSelect:true,border:false,fit:true,fitColumns:true,scrollbarSize:5">
                            <thead>
                                <tr>
                                    <th data-options="field:'idinduk',width:80">Item ID</th>  
                                    <th data-options="field:'plu',width:100">PLU</th>  
                                    <th data-options="field:'sku',width:80">SKU</th>  
                                    <th data-options="field:'qty',width:80">Qty</th> 
                                </tr>
                            </thead>
                        </table>


<script type="text/javascript">
    $('#dj').datagrid({
        method:'get',
        url:'/admin/penjualan/jual',
        onLoad: function(index,row){
            $('#dtj').datagrid({
                method:'get',
                url:'/admin/penjualan/djual/'+row.id
            });
        },
        onSelect: function(index,row){
            $('#dtj').datagrid('reload'{
                idinduk:row.id
            });
        }
    });


</script>
@endsection