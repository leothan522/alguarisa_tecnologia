<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Serial</th>
        <th>Color</th>
        <th>Identicador</th>
        <th>Observación</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bienes as $bien)
        <tr>
            <td>{{ $bien->id}}</td>
            <td>{{ $bien->tipo->nombre }}</td>
            <td>{{ $bien->marca->nombre }}</td>
            <td>{{ $bien->modelo->nombre }}</td>
            <td>
                @if($bien->serial)
                    [{{ $bien->serial }}]
                @endif
            </td>
            <td>{{ $bien->color->nombre }}</td>
            <td>{{ $bien->identificador }}</td>
            <td>{{ $bien->adicional }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
