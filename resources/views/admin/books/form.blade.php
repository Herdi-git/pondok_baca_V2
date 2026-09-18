@extends('admin.layout')
@section('title', $book->exists ? 'Edit Buku' : 'Tambah Buku')
@section('content')
<h1>{{ $book->exists ? 'Edit Buku' : 'Tambah Buku' }}</h1>
@if($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ $formAction }}">@csrf @if($book->exists) @method('PUT') @endif
<label>Judul<input name="title" value="{{ old('title', $book->title) }}" required></label><label>Penulis<input name="author" value="{{ old('author', $book->author) }}" required></label>
<label>Kategori<select name="category" required>@foreach(['fiksi','non-fiksi','sains','anak','sejarah'] as $category)<option value="{{ $category }}" @selected(old('category', $book->category) === $category)>{{ $category }}</option>@endforeach</select></label>
<label>Status<select name="status" required>@foreach(['available','borrowed'] as $status)<option value="{{ $status }}" @selected(old('status', $book->status ?: 'available') === $status)>{{ $status }}</option>@endforeach</select></label>
<label>Warna punggung<input name="spine_color" value="{{ old('spine_color', $book->spine_color) }}" placeholder="#A63D2F"></label><button type="submit">Simpan</button> <a href="{{ route('admin.books.index') }}">Batal</a></form>
@endsection