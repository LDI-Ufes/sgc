@csrf
<div class="mb-3">
    <label for="inputName1" class="form-label">Nome*</label>
    <input name="name" type="text" id="inputName1" class="form-control" placeholder="Nome do Polo"
        value="{{ isset($pole) ? $pole->name : old('name') }}" />
    @error('name')
        <div class="text-danger">> {{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="inputDescription1" class="form-label">Descrição</label>
    <input name="description" type="text" id="inputDescription1" class="form-control" placeholder="Descrição"
        value="{{ isset($pole) ? $pole->description : old('description') }}" />
    @error('description')
        <div class="text-danger">> {{ $message }}</div>
    @enderror
</div>
