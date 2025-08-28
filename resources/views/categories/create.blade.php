@extends('layouts.app')

@section('content')
    <h1>Create Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label>Name:</label>
        <input type="text" name="name" required>
        <button type="submit">Save</button>
    </form>
    <a href="{{ route('categories.index') }}">Back to list</a>
@endsection