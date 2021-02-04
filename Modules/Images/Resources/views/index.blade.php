@extends('images::layouts.master')

@section('content')
    <h1>Hello Image Uploader</h1>

    <form action="{{ route('images.upload') }}" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg" />
        <input type="submit" value="Upload Image" name="submit">

        {{ csrf_field() }}
    </form>

    <p>
        This view is loaded from module: {!! config('images.name') !!}
    </p>
@endsection
