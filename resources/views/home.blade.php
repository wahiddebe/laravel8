@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('create') }}" class="btn btn-success btn-sm mb-2">Create Post</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Desc</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @foreach ($data as $data)
                    <tr>
                        <th scope="row">{{ ++$no }}</th>
                        <td>{{ $data->title }}</td>
                        <td>{{ $data->slug }}</td>
                        <td>{!! Str::limit( strip_tags( $data->desc ), 50 ) !!}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
