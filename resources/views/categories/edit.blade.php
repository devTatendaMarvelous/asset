@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>
    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Name:</label>
        <input type="text" name="name" value="{{ $category->name }}" required>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('categories.index') }}">Back to list</a>
@endsection