@extends('layouts.basic')

@section('title', 'Exibir Colaborador')

@section('content')
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb border-top border-bottom bg-light">
            <li class="breadcrumb-item">Colaboradores</li>
            <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Listar Colaboradores</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $employee->name }}</li>
        </ol>
    </nav>
    <section id="pageContent">
        <main role="main">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-xxl-8">
                    
                    @include('_components.alerts')

                    <div class="card mb-3">
                        <div class="card-header" data-bs-toggle="collapse" href="#employeePersonalDataContent" role="button" aria-expanded="true" aria-controls="employeePersonalDataContent">
                            <h4 class='mb-0'>Dados pessoais</h4>
                        </div>
                        <div class="collapse show" id="employeePersonalDataContent" >
                            <div class="card-body">
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Nome:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->name ?? '-' }}</div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>CPF:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ isset($employee->cpf) ? preg_replace('~(\d{3})(\d{3})(\d{3})(\d{2})~', '$1.$2.$3-$4', $employee->cpf) : '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Profiss??o:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->job ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>G??nero:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->gender->name ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Data de Nascimento:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->birthday != null ? \Carbon\Carbon::parse($employee->birthday)->isoFormat('DD/MM/Y') : '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>UF Nascimento:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->birthState->uf ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Cidade de Nascimento:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->birth_city ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Tipo de Documento:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->documentType->name ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>N??mero do Documento:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->id_number ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Data de Expedi????o:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->id_issue_date != null ? \Carbon\Carbon::parse($employee->id_issue_date)->isoFormat('DD/MM/Y') : '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Org??o Expedidor:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->id_issue_agency ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Estado Civil:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->maritalStatus->name ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Nome c??njuge:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->spouse_name ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Nome do pai:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->father_name ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Nome da m??e:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->mother_name ?? '-' }}
                                    </div>
                                </div>
                        
                                <div class="">
                                    @can('employee-update', $employee)
                                        <a href="{{ route('employees.edit', $employee->id) }}" data-bs-toggle="tooltip" title="Editar colaborador" class="btn btn-primary btn-sm">
                                            <i class="bi-pencil-fill"></i> Editar dados pessoais
                                        </a>&nbsp;
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header" data-bs-toggle="collapse" href="#employeeContactDataContent" role="button" aria-expanded="true" aria-controls="employeeContactDataContent">
                            <h4 class='mb-0'>Contato e endere??o</h4>
                        </div>
                        <div class="collapse show" id="employeeContactDataContent" >
                            <div class="card-body">
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>C??digo de ??rea:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->area_code ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Telefone:</strong></div>
                                    <div class="col-sm-8 col-lg-9"><a href='tel:{{ $employee->phone }}'>{{ isset($employee->phone) ? preg_replace('~(\d{2})[^\d]{0,7}(\d{4})[^\d]{0,7}(\d{4})~', '($1) $2-$3', $employee->phone) : '-' }}</a>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Celular:</strong></div>
                                    <div class="col-sm-8 col-lg-9"><a href='tel:{{ $employee->mobile }}'>{{ isset($employee->mobile) ? preg_replace('~(\d{2})[^\d]{0,7}(\d{5})[^\d]{0,7}(\d{4})~', '($1) $2-$3', $employee->mobile) : '-' }}</a>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Email:</strong></div>
                                    <div class="col-sm-8 col-lg-9"><a href='mailto:{{ $employee->email }}'>{{ $employee->email ?? '-' }}</a>
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Logradouro:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->address_street ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Complemento:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->address_complement ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>N??mero:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->address_number ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Bairro:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->address_district ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>CEP:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ isset($employee->address_postal_code) ? preg_replace('~(\d{2})(\d{3})(\d{3})~', '$1$2-$3', $employee->address_postal_code) : '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>UF:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->addressState->uf ?? '-' }}
                                    </div>
                                </div>
                                <div class="mb-2 row">
                                    <div class="col-sm-4 col-lg-3"><strong>Cidade:</strong></div>
                                    <div class="col-sm-8 col-lg-9">{{ $employee->address_city ?? '-' }}
                                    </div>
                                </div>

                                <div class="">
                                    @can('employee-update', $employee)
                                        <a href="{{ route('employees.edit', $employee->id) }}" data-bs-toggle="tooltip" title="Editar colaborador" class="btn btn-primary btn-sm">
                                            <i class="bi-pencil-fill"></i> Editar contato e endere??o
                                        </a>&nbsp;
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header" data-bs-toggle="collapse" href="#employeeDocumentListContent" role="button" aria-expanded="true" aria-controls="employeeDocumentListContent">
                            <h4 class='mb-0'>Documentos do colaborador</h4>
                        </div>
                        <div class="collapse show" id="employeeDocumentListContent" >
                            <div class="card-body">
                                @if($employeeDocuments->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>??ltima atualiza????o</th>
                                                <th>Tipo do arquivo</th>
                                                <th>Nome do arquivo</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($employeeDocuments as $employeeDocument)
                                                    <tr>
                                                        <td>
                                                            {{$employeeDocument->document->updated_at 
                                                                ? \Carbon\Carbon::parse($employeeDocument->document->updated_at)->isoFormat('DD/MM/Y hh:mm') 
                                                                : '-'
                                                            }}
                                                        </td>
                                                        <td>{{ $employeeDocument->document->documentType->name }}</td>
                                                        <td>
                                                            <a href="{{ route('documents.show', ['id' => $employeeDocument->document->id, 'type' => 'EmployeeDocument', 'htmlTitle' => $employeeDocument->document->original_name]) }}"
                                                                target="_blank">{{ $employeeDocument->document->original_name }}</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div class="">
                                            <a href="{{ route('employeesDocuments.export', $employee) }}" class="btn btn-primary btn-sm mt-1">
                                                &nbsp;&#8627; Fazer o download de todos os documentos do colaborador (zip)
                                            </a>
                                            <a class="btn btn-primary btn-sm mt-1" href="{{ route('employeesDocuments.index', ['employeeCpfContains[0]' => $employee->cpf]) }}" target="_blank">
                                                Listagem avan??ada...
                                            </a>    
                                        </div>
                                    </div>
                                @else
                                    <p class="mb-0">O colaborador n??o possui documentos cadastrados.</p>
                                    <div class="">
                                        <a class="btn btn-primary btn-sm mt-1" href="{{ route('employeesDocuments.index', ['employeeCpfContains[0]' => $employee->cpf]) }}" target="_blank">
                                            Listagem avan??ada...
                                        </a>    
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header" data-bs-toggle="collapse" href="#bondListContent" role="button" aria-expanded="true" aria-controls="bondListContent">
                            <h4 class='mb-0'>V??nculos ativos</h4>
                        </div>
                        <div class="collapse show" id="bondListContent" >
                            <div class="card-body">
                                @php
                                    $activeBonds = $employee->bonds()->inActivePeriod()->orderBy('begin', 'ASC')->get();
                                @endphp
                                @if($activeBonds->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>In??cio</th>
                                                <th>Fim</th>
                                                <th>Fun????o</th>
                                                <th>Curso</th>
                                                <th>Polo</th>
                                                <th>Volunt??rio</th>
                                                <th>Impedido</th>
                                                <th class="text-center">A????es</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($activeBonds as $bond)
                                                    <tr>
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($bond->begin)->isoFormat('DD/MM/Y') }}
                                                        </td>
                                                        <td>
                                                            {{$bond->end 
                                                                ? \Carbon\Carbon::parse($bond->end)->isoFormat('DD/MM/Y') 
                                                                : '-'
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{ $bond->role->name }}
                                                        </td>
                                                        <td>
                                                            {{ $bond->course? $bond->course->name : '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $bond->pole? $bond->pole->name: '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $bond->volunteer === 1 ? 'Sim' : 'N??o' }}
                                                        </td>
                                                        <td>
                                                            {{ $bond->impediment === 1 ? 'Sim' : 'N??o' }}
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="d-inline-flex">
                                                                @can('bond-show')
                                                                    <a href="{{ route('bonds.show', $bond) }}" data-bs-toggle="tooltip" title="Ver V??nculo" class="btn btn-primary btn-sm">
                                                                        <i class="bi-eye-fill"></i>
                                                                    </a>&nbsp; 
                                                                @endcan
                                                                @can('bond-update', $bond)
                                                                    <a href="{{ route('bonds.edit', $bond->id) }}" data-bs-toggle="tooltip" title="Editar v??nculo" class="btn btn-primary btn-sm">
                                                                        <i class="bi-pencil-fill"></i>
                                                                    </a>&nbsp;
                                                                @endcan
                                                                @can('bond-destroy')
                                                                    <form name="{{ 'formDelete' . $bond->id }}"
                                                                        action="{{ route('bonds.destroy', $bond) }}" method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <button type="button" data-bs-toggle="tooltip" title="Excluir" 
                                                                            onclick="{{ 'if(confirm(\'Tem certeza que deseja excluir esse V??nculo?\')) document.forms[\'formDelete' . $bond->id . '\'].submit();' }}" class="btn btn-danger btn-sm">
                                                                            <i class="bi-trash-fill"></i>
                                                                        </button>
                                                                    </form>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="mb-0">O colaborador n??o possui v??nculos ativos cadastrados.</p>
                                @endif
                                <div class="">
                                    <a class="btn btn-primary btn-sm" href="{{ route('bonds.index', ['employeeCpfContains[0]' => $employee->cpf]) }}" target="_blank">
                                        Listagem avan??ada (com todos os v??nculos)...
                                    </a>    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header" data-bs-toggle="collapse" href="#userListContent" role="button" aria-expanded="true" aria-controls="userListContent">
                            <h4 class='mb-0'>Usu??rios de sistema associados</h4>
                        </div>
                        <div class="collapse show" id="userListContent" >
                            <div class="card-body">
                                @if($employee->users->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>Usu??rio</th>
                                                <th>Ativo</th>
                                                <th>Criado em</th>
                                                <th>??ltima atualiza????o</th>
                                                <th class="text-center" >A????es</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($employee->users as $user)
                                                    <tr>
                                                        <td>
                                                            {{ $user->email }}
                                                        </td>
                                                        <td>
                                                            {{ $user->active === 1 ? 'Sim' : 'N??o' }}
                                                        </td>
                                                        <td>
                                                            {{ (isset($bond) && $user->created_at )
                                                                ? \Carbon\Carbon::parse($bond->end)->isoFormat('DD/MM/Y') 
                                                                : '-'
                                                            }}
                                                        </td>
                                                        <td>
                                                            {{ (isset($bond) && $user->updated_at) 
                                                                ? \Carbon\Carbon::parse($bond->end)->isoFormat('DD/MM/Y') 
                                                                : '-'
                                                            }}
                                                        </td>
                                                        <td class="text-center"><div class="d-inline-flex">
                                                            @can('user-show')
                                                                <a href="{{route('users.show', $user)}}" data-bs-toggle="tooltip" title="Ver usu??rio" class="btn btn-primary btn-sm"><i class="bi-eye-fill"></i></a>&nbsp;
                                                            @endcan
                                                            @can('user-update')
                                                                <a href="{{route('users.edit', $user)}}" data-bs-toggle="tooltip" title="Editar usu??rio" class="btn btn-primary btn-sm"><i class="bi-pencil-fill"></i></a>&nbsp;
                                                            @endcan
                                                            @can('user-destroy')
                                                                <form name="{{ 'formDelete' . $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="button" data-bs-toggle="tooltip" title="Excluir usu??rio" onclick="{{ 'if(confirm(\'Tem certeza que deseja excluir esse usu??rio?\')) document.forms[\'formDelete' . $user->id . '\'].submit();' }}" class="btn btn-danger btn-sm">
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
                                @else
                                    <p class="mb-0">O colaborador n??o possui usu??rios de sistema associados.</p>
                                @endif

                                <div class="">
                                    <a class="btn btn-primary btn-sm mt-1" href="{{ route('users.index', ['employee_id' => $employee->id]) }}" target="_blank">
                                        Listagem avan??ada...
                                    </a>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Lista de Colaboradores</a>
                    <br/>
                </div>
            </div>
        </main>
    </section>
@endsection
