@extends('layouts.app')

@section('content')
<br>
<br>
<br>
<br>
<br>
<div class="mt-5">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <form action="/blog" method="POST">
        @csrf
        <textarea name="bl">Next, use our Get Started docs to setup Tiny!</textarea>
        <input type="hidden" name="asas" value="123">
        <input type="submit">
    </form>
@endsection

{{-- <script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
<script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>
<script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
<script>
    Laraberg.init('blog', { sidebar: true, laravelFilemanager: true });
</script>
</div> --}}
