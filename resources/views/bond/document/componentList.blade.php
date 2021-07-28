<table>
    <thead>
        <th>Vínculo</th>
        <th>Nome</th>
        <th>Tipo</th>
    </thead>
    <tbody>
        @foreach ($documents as $document)
            <tr>
                <td>{{ $document->bond->employee->name . '-' . $document->bond->role->name . '-' . $document->bond->course->name }}
                </td>
                <td><a href={{ route('documents.show', ['id' => $document->id, 'type' => 'BondDocument', 'htmlTitle' => $document->original_name]) }} target="_blank">{{ $document->original_name }}</a></td>
                <td>{{ $document->documentType->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
