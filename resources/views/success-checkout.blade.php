@extends('layouts.app')

@section('title', 'Welcome to Snack666')

@section('navbar')
@parent
<!-- <p>Navbar</p> -->
@endsection

@section('headJS')
<script src="https://js.stripe.com/v3/"></script>
@endsection

@section('css')
<style>
    .card {
        max-width: 500px;
        border: none;
        box-shadow: 4px 4px 30px rgba(0,0,0,.125);
        padding: 2em;
        margin: 0 auto;
        min-height: 50vh;
        display: flex;
        flex-flow: column;
        justify-content: center;
        text-align: center;
    }
</style>
@endsection

@section('content')

<!-- Start Checkout -->
<section class="shop checkout section" style="min-height: 100vh; display: flex; flex-flow: column; justify-content: center;">
    <div class="container">
        <div class="card">
            <img class="mt-auto mx-auto" style="object-fit: cover; max-width: 150px" src="https://img.icons8.com/clouds/2x/26e07f/checked-2.png" />
            <h3 class="">Pay successfully!</h3>
            <p class="mt-2">
                Thank you for ordering! If you have any questions, please email
                <a href="mailto:snack666@gmail.com">snack666@gmail.com</a>.
            </p>
            <a href="{{ route('orders.self') }}" class="mt-auto">View order</a>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->


@endsection