  <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Call Center</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <form>

                        <input type="hidden" name="_token"  value="{{csrf_token()}}" id="token">
                        <input type="hidden" id="id">

                        <!--****************************************-->
                        <div class="panel panel-default">
                            <div class="panel-heading">Información del Cliente</div>
                            <div class="panel-body">

                                <div class="form-group">
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <label>Cliente</label>
                                    <input type="text" class="form-control input-sm" id="nombre" style="border: none;" value="" readonly>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label>Documento</label>
                                    <input type="text" class="form-control input-sm" id="documento" style="border: none;" readonly>
                                </div>
                                </div>

                                <div class="form-group">

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>Movil</label>
                                    <input type="text" class="form-control input-sm" id="movil" style="border: none;" readonly>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label>Fijo</label>
                                    <input type="text" class="form-control input-sm" id="fijo" style="border: none;" readonly>
                                </div>

                                </div>
                            </div>
                            </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Notificación al Cliente</div>
                            <div class="panel-body">

                                <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="radio">
                                        <label style="margin-right:10px;">
                                            <input type="radio" name="efectiva" id="optionsRadios1" value="1">
                                            Efectiva
                                        </label>

                                        <label>
                                            <input type="radio" name="efectiva" id="optionsRadios2" value="0" checked>
                                            No efectiva
                                        </label>
                                    </div>
                                    
                                </div>
                                </div>

                                <div class="form-group">
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <label>Motivo de la llamada *:</label>
                                    <select class="form-control input-sm" name="criterio" id="criterio">
                                    <option value="" disabled selected hidden="">- -</option>
                                    @foreach($criterios as $criterio)
                                        <option value="{{$criterio->id}}" id="criterio_id">{{$criterio->criterio}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    <label for="">Agenda :</label>
                                    <input type="text" class="form-control" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="agenda" name="agenda">
                                </div>
                                </div>

                                <div class="form-group">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label>Observaciones *</label>
                                    <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder='Escriba acá las observaciones'></textarea>
                                </div>
                                </div>

                            </div>
                        </div>
                        <!--****************************************-->

                        <center>
                            <a href="#"  class = 'btn btn-danger' id="salir" OnClick='Salir();'>Salir</a>
                            <a href="#"  class = 'btn btn-default' id="info" OnClick='Info();' data-toggle="tooltip" data-placement="top" title="Información del crédito">Info</a>
                            <a href="#"  class = 'btn btn-primary' id="aceptar" OnClick='Aceptar();'>Aceptar</a>
                        </center>

                        </form>

                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
