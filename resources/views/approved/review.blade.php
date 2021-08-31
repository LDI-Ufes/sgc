@extends('layouts.basic')

@section('title', 'Revisão de Importação')

@section('content')
    <script>
        function selectAssign(id, valueToSelect) {
            let element = document.getElementById(id);
            element.value = valueToSelect;
        }

        function selectRotateAssign(idPrefix, keyCount, valueToSelect) {
            for (let i = 0; i < keyCount; i++)
                selectAssign(idPrefix + "_" + i, valueToSelect);
        }

        function toggleCheck(keyCount) {
            for (let i = 0; i < keyCount; i++) {
                //alert("check_" + keyCount);
                var box = document.getElementById("check_" + i);
                box.checked = !box.checked;
            }
        }
    </script>
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb border-top border-bottom bg-light">
            <li class="breadcrumb-item">Colaboradores</li>
            <li class="breadcrumb-item">Importar Aprovados</li>
            <li class="breadcrumb-item active" aria-current="page">Revisão de Importação</li>
        </ol>
    </nav>
    <section id="pageContent">
        <main role="main">
            <div class="row">
                <div class="col">
                    @include('_components.alerts')
                    <div class="d-xl-flex float-md-end">
                        <span class="text-danger my-auto">Atribuir em lote&nbsp;</span>
                        <span class="text-danger my-auto d-none d-xl-block"> &rArr;&nbsp;</span>
                        <span class="text-danger my-auto d-inline d-xl-none">&dArr;</span>
                        <select name="courses_mass" id="courses_mass"
                            onchange="selectRotateAssign('courses', {{ count($approveds) }}, document.getElementById('courses_mass').value)"
                            class="form-select w-auto" data-live-search="true">
                            <option value="">Selecione o curso</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        <select name="roles_mass" id="roles_mass"
                            onchange="selectRotateAssign('roles', {{ count($approveds) }}, document.getElementById('roles_mass').value)"
                            class="form-select w-auto" data-live-search="true">
                            <option value="">Selecione a atribuição</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <select name="poles_mass" id="poles_mass"
                            onchange="selectRotateAssign('poles', {{ count($approveds) }}, document.getElementById('poles_mass').value)"
                            class="form-select w-auto" data-live-search="true">
                            <option value="">Selecione o polo</option>
                            @foreach ($poles as $pole)
                                <option value="{{ $pole->id }}">{{ $pole->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col">
                    <span class="text-danger">&dArr; Selecionar/Desselecionar todos</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action={{ route('approveds.massstore') }} method="POST">
                        @csrf
                        <input type="hidden" name="approvedsCount" value="{{ count($approveds) }}">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th><span onclick="toggleCheck({{ count($approveds) }})" style="cursor: pointer;"
                                            class="text-success">&check;</span></th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>DDD</th>
                                    <th>Telefone</th>
                                    <th>Celular</th>
                                    <th>Edital</th>
                                    <th>Curso</th>
                                    <th>Atribuição</th>
                                    <th>Polo</th>
                                </thead>
                                <tbody>
                                    @foreach ($approveds as $key => $approved)
                                        <tr class="p-0">
                                            <td class="py-0 align-middle">
                                                <input type="checkbox" class="form-check-input"
                                                    name="check_{{ $key }}" id="check_{{ $key }}"
                                                    checked="1" />
                                            </td>
                                            <td title="{{ $approved->name }}" class="p-0">
                                                <input type="text" class="form-control w-100"
                                                    name="name_{{ $key }}" value="{{ $approved->name }}" />
                                            </td>
                                            <td title="{{ $approved->email }}" class="p-0">
                                                <input type="text" class="form-control w-100"
                                                    name="email_{{ $key }}" value="{{ $approved->email }}" />
                                            </td>
                                            <td title="{{ $approved->area_code }}" class="p-0">
                                                <input type="text" class="form-control" name="area_{{ $key }}"
                                                    value="{{ $approved->area_code }}" size="2" />
                                            </td>
                                            <td title="{{ $approved->phone }}" class="p-0">
                                                <input type="text" class="form-control" name="phone_{{ $key }}"
                                                    value="{{ $approved->phone }}" size="10" />
                                            </td>
                                            <td title="{{ $approved->mobile }}" class="p-0">
                                                <input type="text" class="form-control" name="mobile_{{ $key }}"
                                                    value="{{ $approved->mobile }}" size="10" />
                                            </td>
                                            <td title="{{ $approved->announcement }}" class="p-0">
                                                <input type="text" class="form-control"
                                                    name="announcement_{{ $key }}"
                                                    value="{{ $approved->announcement }}" size="8" />
                                            </td>
                                            <td class="p-0">
                                                <select name="courses_{{ $key }}"
                                                    id="courses_{{ $key }}" class="form-select"
                                                    data-live-search="true">
                                                    <option value="">Selecione o curso</option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-0">
                                                <select name="roles_{{ $key }}" id="roles_{{ $key }}"
                                                    class="form-select" data-live-search="true">
                                                    <option value="">Selecione a atribuição</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-0"><select name="poles_{{ $key }}"
                                                    id="poles_{{ $key }}" class="form-select"
                                                    data-live-search="true">
                                                    <option value="">Selecione o polo</option>
                                                    @foreach ($poles as $pole)
                                                        <option value="{{ $pole->id }}"
                                                            {{ $pole->id == 1 ? 'selected' : '' }}>{{ $pole->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br />
                        <button type="submit" class="btn btn-primary">Importar</button>&nbsp;<button type="button"
                            class="btn btn-secondary" onclick="history.back()">Cancelar</button>
                    </form>
                </div>
            </div>
            <br />
        </main>
    </section>
@endsection
