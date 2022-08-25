@extends('layouts.app')

@section('content')
<div class="container">
    <div class="hero-small bg-primary100 text-center p-6 mb-5">
        <h1 class="display-2 fw-semibold py-1">{{ $subtitle }}</h1>
    </div>
    <div class="mt-3 g-3 " style="overflow-x: scroll;">
        {!! $data->deskripsi !!}

    </div>
</div>
@endsection
