@extends('admin.layout')
@section('title', 'Kelola Buku')
@section('content')
<div class="actions"><h1 style="flex:1">Katalog Buku</h1><a class="button" href="{{ route('admin.books.create') }}">Tambah buku</a></div>
<form method="GET" class="actions" style="margin-bottom:18px"><input name="q" value="{{ $search }}" placeholder="Cari judul, penulis, atau kategori" aria-label="Cari buku"><button type="submit">Cari</button>@if($search !== '')<a href="{{ route('admin.books.index') }}">Reset</a>@endif</form>
<table><thead><tr><th>Judul</th><th>Penulis</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr></thead><tbody>@forelse($books as $book)<tr><td>{{ $book->title }}</td><td>{{ $book->author }}</td><td>{{ $book->category }}</td><td>{{ $book->status }}</td><td class="actions"><a href="{{ route('admin.books.edit', $book) }}">Edit</a><form class="inline" method="POST" action="{{ route('admin.books.destroy', $book, absolute: false) }}">@csrf @method('DELETE')<button type="submit" onclick="return confirm('Hapus buku ini?')">Hapus</button></form></td></tr>@empty<tr><td colspan="5">Belum ada buku.</td></tr>@endforelse</tbody></table>
{{ $books->links() }}
@endsection