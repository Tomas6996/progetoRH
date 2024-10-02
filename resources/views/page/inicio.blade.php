@extends('base.base')
@section('titulo')
    Pagina Inicial
@endsection
@section('gestao')
    @foreach ([1,2,3,4,5,6,7] as $lista)
        <h1>{{$lista}} - {{$nome}}</h1>
    @endforeach
@endsection