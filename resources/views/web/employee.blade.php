@extends('layouts.basic')

@section('title', 'Colaboradores')

@section('content')
    <section>
        <strong>Colaboradores</strong>
    </section>
    <section id="pageContent">
        <main role="main">
            <nav>
                Colaboradores
                <ul>
                    <li><a href="{{ route('employees.index') }}">Listar Colaboradores</a></li>
                    <li><a href="{{ route('employees.create') }}">Cadastrar Colaboradores</a></li>
                </ul><br />
            </nav>
            <br /><br />
        </main>
    </section>
@endsection