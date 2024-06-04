<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Color</th>
        <th>Serial</th>
        <th>Identicador</th>
        <th>Imagen Frontal</th>
        <th>Imagen Posterior</th>
        <th>Oficios Vinculados</th>
        <th>Observación</th>
        @if(auth()->user()->role == 100)
            <th>Auditoria</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($bienes as $bien)
        <tr>
            <td>{{ $bien->id}}</td>
            <td>{{ $bien->tipo->nombre }}</td>
            <td>{{ $bien->marca->nombre }}</td>
            <td>{{ $bien->modelo->nombre }}</td>
            <td>{{ $bien->color->nombre }}</td>
            <td>
                @if($bien->serial)
                    [{{ $bien->serial }}]
                @endif
            </td>
            <td>{{ $bien->identificador }}</td>
            <td>{{ $bien->frontal }}</td>
            <td>{{ $bien->posterior }}</td>
            <td>
                @if($bien->oficios)
                    @foreach($bien->oficios as $oficio)
                        [{{ $oficio }}]
                    @endforeach
                @endif
            </td>
            <td>{{ $bien->adicional }}</td>
            @if(auth()->user()->role == 100)
                <td>{!! $bien->auditoria !!}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
