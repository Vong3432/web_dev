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
            <h5 class="card-header">Basic Table</h5>
{{-- *** --}}
{{-- CHANGE TO IF ELSE --}}
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @elseif ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            {{-- @else
                <div class="alert alert-danger">
                    <ul>
                        No msg 
                    </ul>
                </div> --}}
            @endif

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Product ID</th>
                                <th>Discount Percent</th>
                                {{-- how mamy date from NOW --}}
                                <th>Expires at</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vouchers as $voucher)
                            <tr>
                                <td>{{$voucher->id}}</td>
                                <td>{{$voucher->code}}</td>
                                <td>{{$voucher->model_id}}</td>

                                {{-- <td>{{$voucher->data[3]}}</td> --}}
                                {{-- <td>{{$voucher->data['discount_percent']}}</td> --}}
                                <td>{{$voucher->data}}</td>
                                
                                <td>{{$voucher->expires_at}}</td>
                                {{-- <td>{{$coupon->created_at}}</td>
                                <td>{{$coupon->updated_at}}</td> --}}

                                {{-- <td>{{date('Y/m/d H:i:s', strtotime($order->created_at))}}</td> --}}
                                <td>{{date('Y/m/d H:i:s', strtotime($voucher->created_at))}}</td>
                                <td>{{date('y/m/d h:i:s', strToTime($voucher->updated_at))}}</td>
                                
                                <td>
                                    <form action="{{ route('vouchers.destroy',$voucher->id) }}" method="post">
                                        {{-- <button onclick="updateStatus('{{$order->id}}')" class="mt-2 btn btn-primary">Update Status</button> --}}
                                        {{-- <button class="btn btn-primary mt-2" onclick="updateStatus('{{$coupon->id}}')">Edit</button>
                                        <button class="btn btn-danger mt-2" onclick="updateStatus('{{$coupon->id}}')">Delete</button> --}}
                                        
                                        {{-- <button class="btn btn-primary mt-2" onclick="updateStatus('{{$coupon->id}}')">Edit</button> --}}
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.vouchers.show',$voucher->id) }}">Show</a>
                                        {{-- <a class="btn btn-primary btn-sm" href="{{ route('coupons.edit',$coupon->id) }}">Edit</a> --}}
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.vouchers.edit',$voucher->id) }}">Edit</a>
                                        
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            {{-- <tr>
                                <td>Tiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td>61</td>
                                <td>2011/04/25</td>
                                <td>$320,800</td>
                                <td>$320,800</td>
                            </tr> --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Product ID</th>
                                <th>Discount Percent</th>
                                {{-- how mamy date from NOW --}}
                                <th>Expires at</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
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
@endsection