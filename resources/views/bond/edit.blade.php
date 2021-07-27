@extends('layouts.basic')

@section('title', 'Editar Vínculo')

@section('content')
    <section>
        <strong>Editar Vínculo</strong>
    </section>
    <section id="pageContent">
        <main role="main">
            <form action="{{ route('bonds.update', $bond->id) }}" method="POST">
                @method('PATCH')
                @component('bond.componentBondForm',  compact('employees', 'roles', 'courses', 'poles', 'bond'))@endcomponent
                <button type="submit">Atualizar</button> <button type="button" onclick="history.back()">Cancelar</button>
                @error('noStore')
                    <div class="error">> {{ $message }}</div>
                @enderror
                <br /><br />
            </form>
        </main>
    </section>
@endsection