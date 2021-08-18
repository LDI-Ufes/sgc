@extends('layouts.basic')

@section('title', 'Atribuições de papel')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb border-top border-bottom bg-light">
            <li class="breadcrumb-item">Sistema</li>
            <li class="breadcrumb-item active" aria-current="page">Listar Atribuições de Papel</li>
        </ol>
    </nav>
    <section id="pageContent">
        <main role="main">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-xxl-8">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <span style="color: green; font-weight: bold">{{ $message }}</span>
                        </div>
                    @endif

                    {{-- filtros --}}
                    {{-- @component(
                        '_components.filters_form', 
                        [
                            'filters' => $filters,
                            'options' => [
                                ['label' => 'E-mail', 'value' => 'email_contains', 'selected' => true], 
                                ['label' => 'Tipo', 'value' => 'usertype_name_contains'], 
                                ['label' => 'Ativo', 'value' => 'active_exactly'], 
                                ['label' => 'Colaborador', 'value' => 'employee_name_contains']
                            ],
                        ]
                    )@endcomponent --}}
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>Colaborador</th>
                                <th>Papel</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th class="text-center">Ações</th>
                            </thead>
                            <tbody>
                                @foreach ($userTypeAssignments as $userTypeAssignment)
                                    <tr>
                                        <td>{{ $userTypeAssignment->user->email }}</td>
                                        <td>{{ $userTypeAssignment->userType->name }} {{ $userTypeAssignment->course ? "(".$userTypeAssignment->course->name.")": '' }}</td>
                                        <td>{{ $userTypeAssignment->begin }}</td>
                                        <td>{{ $userTypeAssignment->end ?? "..." }}</td>
                                        <td class="text-center"><div class="d-inline-flex">
                                            {{-- <a href="{{ route('users.edit', $user) }}" data-bs-toggle="tooltip" title="Editar usuário" class="btn btn-primary btn-sm">
                                                <i class="bi-pencil-fill"></i>
                                            </a>&nbsp;
                                            <form name="{{ 'formDelete' . $user->id }}" action="{{ route('users.destroy', $user) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" data-bs-toggle="tooltip" title="Excluir usuário" 
                                                    onclick="{{ 'if(confirm(\'Tem certeza que deseja excluir esse usuário?\')) document.forms[\'formDelete' . $user->id . '\'].submit();' }}" class="btn btn-danger btn-sm">
                                                    <i class="bi-trash-fill"></i>
                                                </button>
                                            </form></div> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br />
                    {!! $userTypeAssignments->links() !!}

                    @if(sizeof($userTypeAssignments) <= 0)
                        <p>Sem resultados para exibir.</p>
                    @endif
                    <br />

                    <button type="button" onclick="history.back()" class="btn btn-secondary">Voltar</button>
                    <br />

                </div>
            </div>
        </main>
    </section>
@endsection

@section('scripts')
    {{-- @component('_components.filters_script', ['filters' => $filters])@endcomponent --}}
    <script src="{{ asset('js/enable_tooltip_popover.js') }}"></script>
@endsection