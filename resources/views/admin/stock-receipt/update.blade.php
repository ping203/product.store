@extends('layout.admin.index')

@section('breadcrumbs')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><i class="fa fa-indent"></i> Xử lý phiếu nhập kho: {!! $data_warehouse_ph['name'] !!}</h2>
    </div>
    <div class="col-lg-2">

    </div>
</div>
@stop            

@section('content')

<div class="row">

    <div class="col-lg-12 animated fadeInRight">

        @if (count($errors) > 0)
        <div class="ibox-content">
            <div class="alert alert-danger" style="margin-bottom:0px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif


        @if (Session::has('flash_message'))
            <div class="ibox-content">
                <div class="alert alert-success"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_message') !!}
                </div>
            </div>
        @endif

        @if (Session::has('flash_error'))
            <div class="ibox-content">
                <div class="alert alert-danger"  style="margin-bottom:0px;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! Session::get('flash_error') !!}
                </div>
            </div>
        @endif

        <div class="order-detail">
            <div class="btn-flat panel panel-default">
                <div class="panel-heading">
                    <div class="progress-wrap">
                        <strong>Thông tin sản phẩm</strong>
                    </div>
                </div>
                <form name ="postupdate" action="{!! route('admin.stock-receipt.getUpdate',$data_warehouse_ph['id']) !!}" class="form-horizontal" method="POST">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <div class="panel-body pd-0">
                    <div class="order-detail">
                        <table cellspacing="0" class="table order-totals-summary">
                            <thead>
                                <tr><th width="300" class="text-left text-font-size">Mặt hàng</th>
                                <th width="100" class="text-left text-font-size">SL nhập kho</th>
                                <th width="120" class="text-left text-font-size">Giá nhập</th>
                                <!--<th width="40" class="text-center text-font-size">Xóa</th>-->
                            </tr></thead>
                            <tbody>
                            
                                <tr ng-repeat="product in products" class="ng-scope">
                                    <?php
                                    $rows_product = DB::table('product')->select('id','name')->orderBy('name','ASC')->get();
                                    ?>
                                    <td class="table-td-style" width="300">
                                        <input type="text" name="search-input-product" class="form-control search-input-product"  style="width:100%;" autocomplete="off"  placeholder="Tìm kiếm sản phẩm theo tên, mã sản phẩm, barcode..">
                                        <input class="get_warehouse_ph_details_product" type="hidden" name="warehouse_ph_details_product" value="">
                                    </td>
                                    <td class="table-td-style">
                                        <input name="warehouse_ph_details_quantity" type="number" min="0" class="form-control input-sm pd-0 text-center ng-pristine ng-untouched ng-valid ng-valid-min" tabindex="0" aria-invalid="false">
                                    </td>
                                    <td class="table-td-style">
                                        <input name="warehouse_ph_details_price" type="text" class="form-control input-sm pd-0 text-center ng-pristine ng-untouched ng-valid" ng-model="product.pro_price_in" tabindex="0" aria-invalid="false">
                                    </td>
                                    <!--<td class="text-center table-td-style">
                                        <button class="btn btn-xs btn-danger" tabindex="0">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </td>-->
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button  class="btn btn-xs btn-primary ng-scope" type="submit"><i class="fa fa-plus"></i> Thêm sản phẩm vào phiếu</button><!-- end ngIf: !fParams.supplierId -->
                                    </td>
                                    <td colspan="1" class="text-right">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                            <thead>
                            <tr>
                                <th class="footable-visible footable-first-column footable-sortable">Mã phiếu<span class="footable-sort-indicator"></span></th>
                                <th>Tên phiếu</th>
                                <th>Nhà cung cấp</th>
                                <th>Kho hàng</th>
                                <th class="text-right">Ngày nhập kho</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="footable-even" style="display: table-row;">
                                    <td>
                                        <input style="width:100%;" readonly type="text" value="{!! $data_warehouse_ph['code'] !!}">
                                    </td>
                                    <td>
                                        <input style="width:100%;" readonly type="text" value="{!! $data_warehouse['name'] !!}">
                                    </td>
                                    <td>
                                        <input style="width:100%;" readonly type="text" value="{!! $data_suppier['name'] !!}">
                                    </td>
                                    <td>
                                        <input style="width:100%;" readonly type="text" value="{!! $data_warehouse['name'] !!}">
                                    </td>
                                    <td align="right">
                                        <input style="width:100%;" readonly type="text" value="{!! $data_warehouse_ph['created_at'] !!}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="ibox">
                    <div class="ibox-title">
                        <span class="pull-right"></span>
                        <h5>Sản phẩm trong phiếu nhập kho bao gồm: </h5>
                    </div>

                    <form name="postwarhousing" action="{!! route('admin.stock-receipt.getWarehousing',$data_warehouse_ph['id']) !!}" class="form-horizontal" method="POST">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table shoping-cart-table">
                                    <thead>
                                        <tr>
                                            <th width="10">#</th>
                                            <th width="220">Tên sản phẩm</th>
                                            <th width="90">Số lượng</th>
                                            <th width="90">Giá nhập</th>
                                            <th width="120">Thành tiền</th>
                                            <th width="120" class="text-right" width="">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i = 1; 
                                        $total_price = 0; 
                                        ?>

                                        @foreach($warehouse_ph_details as $row)
                                            <tr @if($i%2==0) {{'class="gradeA"'}} @else {{'class="gradeX"'}} @endif>
                                                <td>{!! $i !!}</td>
                                                <td style="text-align:left;">
                                                    {!! $row->product->name !!}<br>
                                                    <span style="font-size:10px;">SKU:</span> 
                                                    <span class="font-stl-ort">{!! $row->product->sku !!}</span>
                                                    <input type="hidden" name="product_id_{!! $i !!}" value="{!! $row->product->id !!}"> 
                                                </td>
                                                <td>
                                                    <input style="width:100%;" readonly type="text" value="{!! $row->quantity !!}">
                                                    <input type="hidden" name="product_quantity_{!! $i !!}" value="{!! $row->quantity !!}"> 
                                                </td>
                                                <td>
                                                    <input style="width:100%;" readonly type="text" value="{!! number_format($row->price) !!} đ">
                                                    <input type="hidden" name="product_price_{!! $i !!}" value="{!! $row->price !!}">
                                                </td>
                                                <td>
                                                    <input style="width:100%;" readonly type="text" value="{!! number_format(($row->quantity) * ($row->price)) !!} đ">         
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{!! URL::route('admin.stock-receipt.getEdit',$row->id) !!}" class="btn-warning btn btn-xs">
                                                            <i class="fa fa-edit "></i>    
                                                            Sửa
                                                        </a>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a href="#" data-toggle="modal" data-target="#confirm-delete" data-href="{!! URL::route('admin.stock-receipt.getDelete',$row->id) !!}" class="btn-danger btn btn-xs btn-delete">
                                                            <i class="fa fa-trash "></i>    
                                                            Xoá
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $i++;$total_price = $total_price + (($row->quantity) * ($row->price));?>
                                        @endforeach
                                         <input type="hidden" name="count_loop_insert" value="{!! ($i - 1) !!}">
                                         <input type="hidden" name="warehouse_ph_id" value="{!! $data_warehouse_ph['id'] !!}">
                                         <input type="hidden" name="warehouse_id" value="{!! $data_warehouse['id'] !!}">
                                    </tbody>
                                </table>
                            </div>

                            <ul class="sortable-list connectList agile-list ui-sortable" id="todo">
                                <li class="success-element" id="task4">
                                    Tổng giá trị : {!! number_format($total_price) !!} đ
                                    <div class="agile-detail">
                                        <i class="fa fa-clock-o"></i> {!! $data_warehouse_ph['created_at'] !!}
                                    </div>
                                </li>
                                @if($data_warehouse_ph['status'] == 0)
                                <li class="info-element" id="task4">
                                    <button type="submit" type="submit" class="btn btn-w-m btn-success">
                                        <i class="fa fa-indent"></i>
                                        Nhập hàng vào kho
                                    </button>
                                    <div class="agile-detail">
                                        <i class="fa fa-edit"></i> Lưu ý: Khi đã chuyển sang trạng thái nhập sản phẩm vào kho, bạn không thể sửa thông tin trên phiếu này!
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b>Xoá dữ liệu Sản phẩm</b>
            </div>
            <div class="modal-body">
                Bạn có muốn xoá dữ liệu này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ thao tác</button>
                <a class="btn btn-danger btn-ok">Xoá dữ liệu</a>
            </div>
        </div>
    </div>
</div>

@stop

@section('script')
<link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

<link href="css/plugins/footable/footable.core.css" rel="stylesheet">

<!-- Data picker -->
<script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
<script src="js/typeahead.bundle.js"></script>
<script src="js/bloodhound.js"></script>
<script src="js/hogan-3.0.1.js"></script>

<!-- Page-Level Scripts -->
<script>
$(document).ready(function() {

    $('#date_added').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('#date_modified').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });
});

$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

   // Search Product
    var engineProduct = new Bloodhound({
        remote: {
            url: '/get-product-auto-complete?search-input-product=%QUERY%',
            wildcard: '%QUERY%'
        },
        datumTokenizer: Bloodhound.tokenizers.whitespace('search-input-product'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engineProduct.initialize();

    $(".search-input-product").typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    }, {
        source: engineProduct.ttAdapter(),
        name: 'productList',
        displayKey: 'name',
        templates: {
            empty: [
                '<div class="empty-message">Không tìm thấy kết quả</div>'
            ].join('\n'),   

            suggestion: function (data) {
                return '<div class="user-search-result">'+data.name+' <br>  Sku: '+ data.sku +'</div>'
            }
        },
        engineProduct: Hogan
    }).on('typeahead:selected', function(event, selection) {
        $('.get_warehouse_ph_details_product').val(selection.id);
    });

});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
</script>

<style>
.wizard {
    margin: 20px auto;
    background: #fff;
}

    .wizard .nav-tabs {
        position: relative;
        margin: 40px auto;
        margin-bottom: 0;
        border-bottom-color: #e0e0e0;
    }

    .wizard > div.wizard-inner {
        position: relative;
    }

.connecting-line {
    height: 2px;
    background: #e0e0e0;
    position: absolute;
    width: 80%;
    margin: 0 auto;
    left: 0;
    right: 0;
    top: 50%;
    z-index: 1;
}

.wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
    color: #555555;
    cursor: default;
    border: 0;
    border-bottom-color: transparent;
}

span.round-tab {
    width: 70px;
    height: 70px;
    line-height: 70px;
    display: inline-block;
    border-radius: 100px;
    background: #fff;
    border: 2px solid #e0e0e0;
    z-index: 2;
    position: absolute;
    left: 0;
    text-align: center;
    font-size: 25px;
}
span.round-tab i{
    color:#555555;
}
.wizard li.active span.round-tab {
    background: #fff;
    border: 2px solid #5bc0de;
    
}
.wizard li.active span.round-tab i{
    color: #5bc0de;
}

span.round-tab:hover {
    color: #333;
    border: 2px solid #333;
}

.wizard .nav-tabs > li {
    width: 25%;
}

.wizard li:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 0;
    margin: 0 auto;
    bottom: 0px;
    border: 5px solid transparent;
    border-bottom-color: #5bc0de;
    transition: 0.1s ease-in-out;
}

.wizard li.active:after {
    content: " ";
    position: absolute;
    left: 46%;
    opacity: 1;
    margin: 0 auto;
    bottom: 0px;
    border: 10px solid transparent;
    border-bottom-color: #5bc0de;
}

.wizard .nav-tabs > li a {
    width: 70px;
    height: 70px;
    margin: 20px auto;
    border-radius: 100%;
    padding: 0;
}

    .wizard .nav-tabs > li a:hover {
        background: transparent;
    }

.wizard .tab-pane {
    position: relative;
    padding-top: 50px;
}

.wizard h3 {
    margin-top: 0;
}

@media( max-width : 585px ) {

    .wizard {
        width: 90%;
        height: auto !important;
    }

    span.round-tab {
        font-size: 16px;
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard .nav-tabs > li a {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }

    .wizard li.active:after {
        content: " ";
        position: absolute;
        left: 35%;
    }
}
</style>
@stop
