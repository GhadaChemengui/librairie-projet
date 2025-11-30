@extends('layouts.app')

@section('content')
<h1>Paiement annulé</h1>
<p>Le paiement a été annulé ou échoué.</p>
<a href="{{ route('books.index') }}">Retour</a>
@endsection
