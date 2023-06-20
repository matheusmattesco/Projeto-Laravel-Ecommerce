@extends('site\layout')
@section('title', 'Essa é a pagina HOME')
@section('conteudo')
    
@for ($i = 0; $i <= 10; $i++)
    valor atual é {{ $i }} <br>
@endfor  

@foreach ($frutas as $fruta)
    {{ $fruta }} <br>
@endforeach

@include('includes\mensagem', ['titulo' => 'Mensagem de sucesso!'])

@component('components.sidebar')
    @slot('paragrafo')
        Texto qualquer vindo do slot
    @endslot
@endcomponent


@endsection