@extends('layouts.basic')

@section('title', 'Cursos')

@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb border-top border-bottom bg-light">
        <li class="breadcrumb-item">Sistema</li>
        <li class="breadcrumb-item active" aria-current="page">Listar Cursos</li>
    </ol>
</nav>
    <section id="pageContent">
        <main role="main">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-xxl-8">
                    @include('_components.alerts')

                    {{-- local para os filtros --}}
                    @component(
                        '_components.filters_form', 
                        [
                            'filters' =>$filters,
                            'options' => [
                                [ 'label'=>'Nome', 'value'=>'nameContains', 'selected'=>true],
                                [ 'label'=>'Descrição', 'value'=>'descriptionContains'],
                                [ 'label'=>'Tipo', 'value'=>'courseTypeNameContains'],
                                [ 'label'=>'Início (=)', 'value'=>'beginExactly'],
                                [ 'label'=>'Início (>=)' , 'value'=>'beginBigOrEqu'],
                                [ 'label'=>'Início (<=)', 'value'=>'beginLowOrEqu'],
                                [ 'label'=>'Fim (=)', 'value'=>'endExactly'],
                                [ 'label'=>'Fim (>=)' , 'value'=>'endBigOrEqu'],
                                [ 'label'=>'Fim (<=)', 'value'=>'endLowOrEqu'],
                            ]
                        ]
                    )@endcomponent
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>@sortablelink('name', 'Nome')</th>
                                <th>@sortablelink('description', 'Descrição')</th>
                                <th>@sortablelink('courseType.name', 'Tipo do Curso')</th>
                                <th>@sortablelink('begin', 'Início')</th>
                                <th>@sortablelink('end', 'Fim')</th>
                                <th class="text-center">Ações</th>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->description }}</td>
                                        <td>{{ $course->courseType->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($course->begin)->isoFormat('DD/MM/Y') }}</td> 
                                        <td>{{ \Carbon\Carbon::parse($course->end)->isoFormat('DD/MM/Y') }}</td>
                                        <td class="text-center"><div class="d-inline-flex">
                                            @can('course-update')
                                                <a href="{{ route('courses.edit', $course) }}" data-bs-toggle="tooltip" title="Editar curso" class="btn btn-primary btn-sm">
                                                    <i class="bi-pencil-fill"></i>
                                                </a>&nbsp;
                                            @endcan
                                            @can('course-destroy')
                                                <form name="{{ 'formDelete' . $course->id }}" action="{{ route('courses.destroy', $course) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="button" data-bs-toggle="tooltip" title="Excluir curso" 
                                                        onclick="{{ 'if(confirm(\'Tem certeza que deseja excluir esse curso?\')) document.forms[\'formDelete' . $course->id . '\'].submit();' }}" class="btn btn-danger btn-sm">
                                                        <i class="bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br />
                    {!! $courses->links() !!}
                    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar para o Início</a>
                    @can('course-store')
                        <a href="{{ route('courses.create') }}" class="btn btn-warning">Cadastrar novo Curso</a>
                    @endcan
                    <br /><br />
                </div>
            </div>
        </main>
    </section>
@endsection

@section('scripts')
    @component('_components.filters_script', ['filters' =>$filters] )@endcomponent
    <script src="{{ asset('js/enable_tooltip_popover.js') }}"></script>
@endsection