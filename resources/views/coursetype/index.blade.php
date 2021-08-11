@extends('layouts.basic')

@section('title', 'Tipos de Cursos')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb border-top border-bottom bg-light">
            <li class="breadcrumb-item"><a href="{{ route('system') }}">Sistema</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listar Tipos de Cursos</li>
        </ol>
    </nav>
    <section id="pageContent">
        <main role="main">

            {{-- filtros --}}
            @component(
                '_components.filters_form', 
                [
                    'filters' =>$filters,
                    'options' => [
                        [ 'label'=>'Nome', 'value'=>'name_contains', 'selected'=>true],
                        [ 'label'=>'Descrição', 'value'=>'description_contains']
                    ]
                ]
            )@endcomponent

            <table class="table table-striped table-hover">
                <thead>
                    <th>Nome</th>
                    <th>Descrição</th>
                </thead>
                <tbody>
                    @foreach ($courseTypes as $courseType)
                        <tr>
                            <td>{{ $courseType->name }}</td>
                            <td>{{ $courseType->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" onclick="history.back()" class="btn btn-secondary">Voltar</button>
            <br /><br />
        </main>
    </section>
@endsection

@section('scripts')
    @component('_components.filters_script', ['filters' =>$filters] )@endcomponent
@endsection
