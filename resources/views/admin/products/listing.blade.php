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
        @include('admin.inc.messages')
        <div class="card">
            <h5 class="card-header">View All Products</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Images</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Tags</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                @foreach(explode('|',$product->images) as $image)
                                <img width="50px" src="{{asset('products_images/').'/'.$image }}"> <br /> 
                                @endforeach  
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->desc }}</td>
                                <td>{{ $product->tags }}</td>
                                <td><span style="color:red"><strike>RM {{ $product->price }}</strike></span><br/>({{ $product->discount_rate }}%)<br/>RM {{ $product->sprice }} </td>
                                <td>
                                    <select class="form-control" name="status" id="{{$product->id}}-productStatusSelect" onchange="updateStatus('{{$product->id}}')">
                                        <option value="1" {{$product->status == "1" ? 'selected' : ''}}>Listed</option>
                                        <option value="-1" {{$product->status == "-1" ? 'selected' : ''}}>Unlisted</option>
                                    </select>
                                </td>
                                

                                <td>
                                    <button onclick="window.location='{{ url('products/edit/'.$product->id) }}'" class="mt-2 btn btn-primary"><i class="fas fa-edit"></i></button>
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
    function updateStatus(productID) {
        var selectedStatus = $(`#${productID}-productStatusSelect`).val();
    
        $.ajax({
            url: "products/status" + '/' + productID + '?status=' + selectedStatus,
            type: 'POST',
            data: { "_token":"{{ csrf_token() }}","status": selectedStatus},
            success: function(res) {
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