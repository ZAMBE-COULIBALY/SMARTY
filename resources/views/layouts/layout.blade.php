@extends('shared.layout')
@section('dashboardm')
    menu-open
@endsection
@section('dashboard')
active
@endsection
@section('style')
<style>

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #160f55;
        padding: 0 25px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
@endsection
@section('content')
<div class="content flex-center">
    <div class="title m-b-md links">
   <a href="" > <strong>NSIA ASSURANCE SMARTY</strong></a>
</div>
</div>
@endsection
