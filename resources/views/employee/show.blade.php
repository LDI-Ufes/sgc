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
                    @component('employee.componentEmployeeDetails',  compact('employee'))@endcomponent
                </div>
            </div>
        </main>
    </section>
@endsection
