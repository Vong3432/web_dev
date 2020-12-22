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
            <h2 class="pageheader-title">Add Product</h2>
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
                    <div class="card-body">
                        <form id="validationform" method="POST" action="{{ url('/products/store') }}" data-parsley-validate="" novalidate="" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <input type="hidden" value="POST" name="_method"> 
                     
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Name</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="text" required="" name="product_name" placeholder=" " class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Price</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" required="" min="0"  name="product_price" placeholder=" " class="form-control">
                                </div>
                            </div>

                           

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Quantity</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" required="" min="0" name="product_quantity" placeholder=" " class="form-control">
                                </div>
                            </div>   
                                                     
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Weight in (KG)</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" required="" min="0" name="product_weight" placeholder="" class="form-control">
                                </div>
                            </div>                          

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Category</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <select class="form-control" id="product_category" name="product_category">
                                        @foreach ($products_cates as $products_cate)
                                         <option value="{{$products_cate->id}}">{{$products_cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                           
                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Discount Rate</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="number" required="" min="0" max="100" name="product_discount_rate" placeholder=" " class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Tags</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="text" required="" name="product_tags" placeholder="Using , to sepeate (eg: Tags 1, Tags 2)" class="form-control">
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Image</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <input type="file" required="" name="images[]" placeholder=" " class="form-control" multiple>
                                </div>
                            </div> 

                            <div class="form-group row">
                                <label class="col-12 col-sm-3 col-form-label text-sm-right">Product Description</label>
                                <div class="col-12 col-sm-8 col-lg-6">
                                    <textarea required="" class="form-control" name=product_desc></textarea>
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