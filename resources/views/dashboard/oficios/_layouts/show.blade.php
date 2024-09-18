<div class="card card-navy <!--card-outline-->">
    <div class="card-header">
        <h3 class="card-title">Ver Oficio</h3>

        <div class="card-tools">
            <a href="#" class="btn btn-tool" title="Anterior"><i class="fas fa-chevron-left"></i></a>
            <a href="#" class="btn btn-tool" title="Siguente"><i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="mailbox-read-info">
            <h5>Yilda Ledezma</h5>
            <h6>
                Cc: Anakari Castro <br>
                Cc: Anakari Castro <br>
                <span class="mailbox-read-time float-right">15 Feb. 2015 11:03 PM</span>
            </h6>
        </div>
        <!-- /.mailbox-read-info -->
        {{--<div class="mailbox-controls with-border text-center">
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Borrar">
                <i class="far fa-trash-alt"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Editar">
                <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" title="Imprimir">
                <i class="fas fa-print"></i>
            </button>
        </div>--}}
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
            @if($pdf)
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{asset('ViewerJS/#../storage/pdf/etiqueta.pdf')}}" allowfullscreen></iframe>
                </div>
            @endif
        </div>
        <!-- /.mailbox-read-message -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer bg-white">
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                    <tr>
                        <th>Equipos</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <img src="{{ asset('img/img_placeholder.png') }}" alt="Product 1" class="img-circle img-size-32 mr-2">
                        </td>
                        <td>
                            <span class="text-uppercase">CAMARA HIK VISION DS-2CE16D0T-IRF , Serial: f88938629 , Identificador: alg-bn-0554</span>
                        </td>
                        <td class="text-center">
                            <a href="#" class="text-muted">
                                <i class="fas fa-search"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        {{--<ul class="mailbox-attachments d-flex align-items-stretch clearfix">
            <li>
                <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>1,245 KB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                        </span>
                </div>
            </li>
            <li>
                <span class="mailbox-attachment-icon has-img">
                    <img src="{{ asset('img/logo_gobernacion.png') }}" alt="Attachment"></span>

                <div class="mailbox-attachment-info">
                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                    <span class="mailbox-attachment-size clearfix mt-1">
                          <span>2.67 MB</span>
                          <a href="#" class="btn btn-default btn-sm float-right"><i
                                  class="fas fa-cloud-download-alt"></i></a>
                        </span>
                </div>
            </li>
        </ul>--}}
    </div>
    <!-- /.card-footer -->
    <div class="card-footer">
        <div class="float-right">
            <button type="button" class="btn btn-default btn-sm">
                <i class="fas fa-edit"></i> Editar
            </button>
        </div>
        <button type="button" class="btn btn-default btn-sm">
            <i class="fas fa-trash-alt"></i> Eliminar
        </button>
        {{--<button type="button" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</button>--}}
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->
