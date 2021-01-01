@extends('layouts.admin.app')

@section('title', 'Welcome to Snack666')

@section('navbar')
@parent
<!-- <p>Navbar</p> -->
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Edit Coupon Details</h2>
            <!-- <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p> -->
            <!-- <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Forms</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Validations</li>
                    </ol>
                </nav>
            </div> -->
        </div>
        <div class="row">
            <!-- ============================================================== -->
            <!-- valifation types -->
            <!-- ============================================================== -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Fill in the blanks</h5>

                    {{-- Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- /Error --}}

                    <div class="card-body">
                        <form id="validationform" data-parsley-validate="" novalidate="" action="{{ route('coupons.update',$coupon->id) }}" method="POST">
                        @csrf

                        @method('PUT')
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Code<span style="color: red">*</span></label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="text" name="code" value="{{ $coupon->code }}" placeholder="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Type<span style="color: red">*</span></label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="text" name="type" value="{{ $coupon->type }}" placeholder="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Value</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" name="value" value="{{ $coupon->value }}" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Percent Off</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" name="percent_off" value="{{ $coupon->percent_off }}" placeholder="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right"></label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <span style="color: red" class="pull-left">* required</span>
                                </div>
                            </div>
                            
                            <div class="form-group row text-right">
                                <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('/admin/assets/vendor/parsley/parsley.js')}}"></script>
<script>
    $('#form').parsley();
</script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
@endsection