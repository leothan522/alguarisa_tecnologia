<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tipo</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Color</th>
        <th>Condición</th>
        <th>Serial</th>
        <th>Identicador</th>
        <th>Imagen Frontal</th>
        <th>Imagen Posterior</th>
        <th>Ubicación</th>
        <th>Oficios Vinculados</th>
        <th>Verificado</th>
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
            <td>{{ mb_strtoupper($bien->tipo->nombre) }}</td>
            <td>{{ mb_strtoupper($bien->marca->nombre) }}</td>
            <td>{{ mb_strtoupper($bien->modelo->nombre) }}</td>
            <td>{{ mb_strtoupper($bien->color->nombre) }}</td>
            <td>{{ mb_strtoupper($bien->condicion->nombre) }}</td>
            <td>
                @if($bien->serial)
                    [{{ mb_strtoupper($bien->serial) }}]
                @endif
            </td>
            <td>{{ mb_strtoupper($bien->identificador) }}</td>
            <td>{{ $bien->frontal }}</td>
            <td>{{ $bien->posterior }}</td>
            <td>{{ mb_strtoupper($bien->ubicacion) }}</td>
            <td>
                @if($bien->oficios)
                    @foreach($bien->oficios as $oficio)
                        [{{ $oficio }}]
                    @endforeach
                @endif
            </td>
            <td>
                @if($bien->verificado)
                    SI
                @else
                    NO
                @endif
            </td>
            <td>{{ mb_strtoupper($bien->adicional) }}</td>
            @if(auth()->user()->role == 100)
                <td>{!! $bien->auditoria !!}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
