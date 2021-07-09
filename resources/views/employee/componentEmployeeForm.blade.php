@csrf

Nome*: <input name="name" type="text" placeholder="Nome" value="{{ $employee->name ?? old('name') }}" />
@error('name')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
CPF*: <input name="cpf" type="text" placeholder="CPF" value="{{ $employee->cpf ?? old('cpf') }}" />
@error('cpf')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Profissão*: <input name="job" type="text" placeholder="Profissão" value="{{ $employee->job ?? old('job') }}" />
@error('job')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Gênero*: <select name="genders">
    <option value="">Selecione um gênero</option>
    @foreach ($genders as $gender)
        <option value="{{ $gender->id }}" {{ $employee->gender_id == $gender->id ? 'selected' : '' }}>
            {{ $gender->name }}</option>
    @endforeach
</select>
@error('gender')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Data de Nascimento*: <input name="birthday" type="date" value="{{ $employee->birthday ?? old('birthday') }}" />
@error('birthday')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
UF Nascimento*: <select name="birthStates">
    <option value="">Selecione uma UF</option>
    @foreach ($birthStates as $birthState)
        <option value="{{ $birthState->id }}"
            {{ $employee->birth_state_id == $birthState->id ? 'selected' : '' }}>{{ $birthState->name }}</option>
    @endforeach
</select>
@error('birthStates')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Cidade de Nascimento*: <input name="birthCity" type="text" placeholder="Cidade"
    value="{{ $employee->birth_city ?? old('birthCity') }}" />
@error('birthCity')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Número do Documento*: <input name="idNumber" type="text" placeholder="Número"
    value="{{ $employee->id_number ?? old('idNumber') }}" />
@error('idNumber')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Tipo de Documento*: <select name="idTypes">
    <option value="">Selecione um tipo</option>
    @foreach ($idTypes as $idType)
        <option value="{{ $idType->id }}" {{ $employee->id_type_id == $idType->id ? 'selected' : '' }}>
            {{ $idType->name }}</option>
    @endforeach
</select>
@error('idTypes')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Data de Expedição*: <input name="idIssueDate" type="date"
    value="{{ $employee->id_issue_date ?? old('idIssueDate') }}" />
@error('idIssueDate')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Orgão Expedidor*: <input name="idIssueAgency" type="text" placeholder="Orgão"
    value="{{ $employee->id_issue_agency ?? old('idIssueAgency') }}" />
@error('idIssueAgency')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Estado Civil*: <select name="maritalStatuses">
    <option value="">Selecione um Estado Civil</option>
    @foreach ($maritalStatuses as $maritalStatus)
        <option value="{{ $maritalStatus->id }}"
            {{ $employee->marital_status_id == $maritalStatus->id ? 'selected' : '' }}>{{ $maritalStatus->name }}
        </option>
    @endforeach
</select>
@error('maritalStatuses')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Nome cônjuge: <input name="spouseName" type="text" placeholder="Nome"
    value="{{ $employee->spouse_name ?? old('spouseName') }}" />
@error('spouseName')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Nome do pai: <input name="fatherName" type="text" placeholder="Nome"
    value="{{ $employee->father_name ?? old('fatherName') }}" />
@error('fatherName')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Nome da mãe*: <input name="motherName" type="text" placeholder="Nome"
    value="{{ $employee->mother_name ?? old('motherName') }}" />
@error('motherName')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Logradouro*: <input name="addressStreet" type="text" placeholder="Logradouro"
    value="{{ $employee->address_street ?? old('addressStreet') }}" />
@error('addressStreet')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Complemento: <input name="addressComplement" type="text" placeholder="Complemento"
    value="{{ $employee->address_complement ?? old('addressComplement') }}" />
@error('addressComplement')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Número: <input name="addressNumber" type="text" placeholder="Número"
    value="{{ $employee->address_number ?? old('addressNumber') }}" />
@error('addressNumber')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Bairro: <input name="addressDistrict" type="text" placeholder="Bairro"
    value="{{ $employee->address_district ?? old('addressDistrict') }}" />
@error('addressDistrict')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
CEP*: <input name="addressPostalCode" type="text" placeholder="CEP"
    value="{{ $employee->address_postal_code ?? old('addressPostalCode') }}" />
@error('addressPostalCode')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
UF*: <select name="addressStates">
    <option value="">Selecione uma UF</option>
    @foreach ($addressStates as $addressState)
        <option value="{{ $addressState->id }}"
            {{ $employee->address_state_id == $addressState->id ? 'selected' : '' }}>{{ $addressState->name }}
        </option>
    @endforeach
</select>
@error('addressStates')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Cidade*: <input name="addressCity" type="text" placeholder="Cidade"
    value="{{ $employee->address_city ?? old('addressCity') }}" />
@error('addressCity')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Código de Área*: <input name="areaCode" type="text" placeholder="Código"
    value="{{ $employee->area_code ?? old('areaCode') }}" />
@error('areaCode')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Telefone*: <input name="phone" type="text" placeholder="Telefone" value="{{ $employee->phone ?? old('phone') }}" />
@error('phone')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Celular*: <input name="mobile" type="text" placeholder="Celular" value="{{ $employee->mobile ?? old('mobile') }}" />
@error('mobile')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
Email*: <input name="email" type="email" placeholder="Email" value="{{ $employee->email ?? old('email') }}" />
@error('email')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
<button type="submit">Cadastrar</button>
@error('noStore')
    <div class="error">> {{ $message }}</div>
@enderror
<br /><br />
