@extends('layouts.admin.app')

@section('title', 'Welcome to Snack666')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('/admin/assets/vendor/datatables/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/admin/assets/vendor/datatables/css/buttons.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/admin//assets/vendor/datatables/css/select.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/admin/assets/vendor/datatables/css/fixedHeader.bootstrap4.css')}}">
@endsection

@section('navbar')
@parent
<!-- <p>Navbar</p> -->
@endsection

@section('content')
<div class="row">
    <!-- ============================================================== -->
    <!-- basic table  -->
    <!-- ============================================================== -->

    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Orders Table</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{date('Y/m/d H:i:s', strtotime($order->created_at))}}</td>
                                <td>{{date('Y/m/d H:i:s', strtotime($order->updated_at))}}</td>
                                <td>
                                    <select class="form-control" name="status" id="{{$order->id}}-orderStatusSelect">
                                        <option value="PENDING" {{$order->status == "PENDING" ? 'selected' : ''}}>Pending</option>
                                        <option value="DELIVERING" {{$order->status == "DELIVERING" ? 'selected' : ''}}>Delivering</option>
                                        <option value="DELIVERED" {{$order->status == "DELIVERED" ? 'selected' : ''}}>Delivered</option>
                                        <option value="REJECTED" {{$order->status == "REJECTED" ? 'selected' : ''}}>Rejected</option>
                                    </select>
                                </td>
                                <td>{{$order->user->name}}</td>
                                <td>
                                @foreach($order->products as $oProduct)
                                    {{$oProduct->name}} <br />                        
                                @endforeach
                                </td>

                                <td>
                                    <button onclick="updateStatus('{{$order->id}}')" class="mt-2 btn btn-primary">Update Status</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!-- <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Products</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot> -->
                    </table>
                </div>
            </div>
        </div>
        <div class="messages"></div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic table  -->
    <!-- ============================================================== -->
</div>
@endsection

@section('js')
<script src="{{asset('/admin/assets/vendor/multi-select/js/jquery.multi-select.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/admin/assets/vendor/datatables/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="{{asset('/admin/assets/vendor/datatables/js/data-table.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>

<script>
    function updateStatus(orderID) {
        var selectedStatus = $(`#${orderID}-orderStatusSelect`).val();
        
        $.ajax({
            url: "api/orders" + '/' + orderID + '?status=' + selectedStatus,
            type: 'PUT',
            data: {},
            success: function(res) {
                console.log(res);
                var successAlert = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${res.message}
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>`;

                $('.messages').html(successAlert);
            },
            error: function(err) {                

                var error = err.responseJSON;
                console.log(error)

                var errAlert = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${error.message}
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>`;

                $('.messages').html(errAlert);
            }
        })
        
    }
</script>
@endsection