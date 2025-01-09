<div class="table-responsive mailbox-messages" style="max-height: calc(100vh - {{ $size ?? 365 }}px)">

    <table class="table table-hover table-striped">
        <tbody wire:loading.class="invisible">
        @if($oficios->isNotEmpty())
            @foreach($oficios as $oficio)
                <tr>
                    <td class="mailbox-name text-nowrap">
                        <a href="#" class="text-uppercase" wire:click.prevent="show('{{ $oficio->rowquid }}')">
                            {{ $oficio->numero }}
                        </a>
                    </td>
                    <td class="d-none d-sm-table-cell mailbox-subject text-nowrap text-truncate" style="width: 60%; max-width: 150px">

                        @if(!empty($oficio->dirigido))
                            <b>{{ $this->getReceptor(json_decode($oficio->dirigido)) }}</b>
                        @else
                            <b>[Dirigido a]</b> - [Con Copia a]
                        @endif

                        @if(!empty($oficio->copia))
                            - {{ $this->getReceptor(json_decode($oficio->copia)) }}
                        @endif
                    </td>
                    <td class="text-right">
                        <small class="text-nowrap">
                            @if($oficio->repetido)
                                <i class="far fa-copy"></i>
                            @endif
                            <span class="d-none d-sm-inline">Equipos: {{ cerosIzquierda(formatoMillares($oficio->equipos, 0)) }}</span>
                            <span class="d-sm-none">Eq: {{ cerosIzquierda(formatoMillares($oficio->equipos, 0)) }}</span>
                        </small>
                    </td>
                    <td class="mailbox-attachment">
                        @if($oficio->pdf)
                            <i class="fas fa-paperclip"></i>
                        @endif
                    </td>
                    <td class="mailbox-date text-center">
                        {{ getFecha($oficio->fecha) }}
                    </td>
                </tr>
            @endforeach
        @else
            @if($keyword)
                <tr>
                    <td colspan="4" class="mailbox-subject text-center">
                        Sin Resultados.
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="4" class="mailbox-subject text-center">
                        Sin Registros Guardados.
                    </td>
                </tr>
            @endif
        @endif
        </tbody>
    </table>

</div>
