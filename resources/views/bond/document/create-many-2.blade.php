@extends('layouts.basic')

@section('title', 'Revisão de Importação')

@section('content')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb border-top border-bottom bg-light">
        <li class="breadcrumb-item">Colaboradores</li>
        <li class="breadcrumb-item">Importar Documentos de Vínculo</li>
        {{-- {{dd($bondDocuments)}} --}}
        <li class="breadcrumb-item active" aria-current="page">
            Revisão de Importação: 
            {{ $bondDocuments->first()->bond->employee->name }}
            {{ ' - ' . $bondDocuments->first()->bond->role->name }}
            {{ $bondDocuments->first()->bond->course ? ' - ' . $bondDocuments->first()->bond->course->name : '' }}
        </li>
    </ol>
</nav>
    <section id="pageContent">
        <main role="main">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-xxl-8">
                    @include('_components.alerts')
                    <br />
                    <form action={{ route('bondDocuments.storeManyFase02') }} method="POST">
                        @csrf
                        <input type="hidden" name="bondDocumentsCount" value="{{ count($bondDocuments) }}">
                        <input type="hidden" name="bond_id" value="{{ $bondDocuments->first()->bond_id }}">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th>Nome do arquivo</th>
                                    <th>Tipo de documento</th>
                                </thead>
                                <tbody>
                                    @foreach ($bondDocuments as $key => $bondDocument)
                                        <input type="hidden" name="fileName_{{ $key }}" value="{{ $bondDocument->original_name }}">
                                        <input type="hidden" name="filePath_{{ $key }}" value="{{ $bondDocument->tmp_file_path }}" />
                                        <tr>
                                            <td title="{{ $bondDocument->original_name }}">{{ $bondDocument->original_name }}</td>
                                            <td><select name="documentTypes_{{ $key }}" id="documentTypes_{{ $key }}" class="form-select">
                                                    <option value="">Selecione o tipo de documento</option>
                                                    @foreach ($documentTypes as $documentType)
                                                        <option value="{{ $documentType->id }}">
                                                            {{ $documentType->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-primary">Importar</button>
                        <button type="button" onclick="history.back()" class="btn btn-secondary">Cancelar</button>
                    </form>
                </div>
            </div>
        </main>
    </section>
@endsection