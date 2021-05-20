@include('flash::message')

@section('title','terceros')

@section('contenido')

<div class="panel panel-primary">

    <div class="panel-heading">Reporte Terceros [ {{ $rango->ini->toDateString().' - '.$rango->end->toDateString()}} ]
        <button id="btn_exc_terceros" class="btn btn-warning"><b>Exportar</b></button>
    </div>
</div>

<div>
    <table id="datatable" class="table table-bordered" style="font-size:12px">
        <thead>
            <tr>
                <th>    Identificación                          </th>
                <th>    Dígito de verificación                  </th>
                <th>    Código Sucursal                         </th>
                <th>    Tipo identificación                     </th>
                <th>    Tipo                                    </th>
                <th>    Razón social                            </th>
                <th>    Nombres del tercero                     </th>
                <th>    Apellidos del tercero                   </th>
                <th>    Nombre comercial                        </th>
                <th>    Dirección                               </th>
                <th>    Código pais                             </th>
                <th>    Código departamento/estado              </th>
                <th>    Código ciudad                           </th>
                <th>    Indicativo teléfono principal           </th>
                <th>    Teléfono principal                      </th>
                <th>    Extensión teléfono principal            </th>
                <th>    Tipo de regimen IVA                     </th>
                <th>    Código Responsabilidad fiscal           </th>
                <th>    Código Postal                           </th>
                <th>    Nombre contacto principal               </th>
                <th>    Apellidos contacto principal            </th>
                <th>    Indicativo teléfono contacto principal  </th>
                <th>    Teléfono contacto principal             </th>
                <th>    Extensión teléfono contacto principal   </th>
                <th>    Correo electrónico contacto principal   </th>
                <th>    Identificación del cobrador             </th>
                <th>    Identificación del vendedor             </th>
                <th>    Otros                                   </th>
                <th>    Clientes                                </th>
                <th>    Proveedor                               </th>
                <th>    Teñéfono                                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>    {{ $item['identificacion'] }}                   </td>
                <td>    {{ $item['digito_verificacion'] }}              </td>
                <td>    {{ $item['codigo_sucursal'] }}                  </td>
                <td>    {{ $item['tipo_identificacion'] }}              </td>
                <td>    {{ $item['tipo'] }}                             </td>   
                <td>    {{ $item['razon_social'] }}                     </td>
                <td>    {{ $item['nombre_tercero'] }}                   </td>
                <td>    {{ $item['apellidos_tercero'] }}                </td>
                <td>    {{ $item['nombre_comercial'] }}                 </td>
                <td>    {{ $item['direccion'] }}                        </td>
                <td>    {{ $item['codigo_pais'] }}                      </td>
                <td>    {{ $item['codigo_depto'] }}                     </td>
                <td>    {{ $item['codigo_ciudad'] }}                    </td>
                <td>    {{ $item['indicativo_tel_principal'] }}         </td>
                <td>    {{ $item['tel_principal'] }}                    </td>
                <td>    {{ $item['ext_tel_principal'] }}                </td>
                <td>    {{ $item['tipo_regimen_iva'] }}                 </td>
                <td>    {{ $item['codigo_responsabilidad_fiscal'] }}    </td>
                <td>    {{ $item['codigo_postal'] }}                    </td>
                <td>    {{ $item['nombre_contacto_principal'] }}        </td>
                <td>    {{ $item['apellidos_contacto_principal'] }}     </td>
                <td>    {{ $item['indicativo_tel_contacto_principal'] }}</td>
                <td>    {{ $item['tel_contacto_principal'] }}           </td>
                <td>    {{ $item['ext_tel_contacto_principal'] }}       </td>
                <td>    {{ $item['correo_contacto_principal'] }}        </td>
                <td>    {{ $item['identificacion_cobrador'] }}          </td>
                <td>    {{ $item['identificacion_vendedor'] }}          </td>
                <td>    {{ $item['otros'] }}                            </td>   
                <td>    {{ $item['clientes'] }}                         </td>
                <td>    {{ $item['proveedor'] }}                        </td>
                <td>    {{ $item['estado'] }}                           </td>
            
            </tr>
            @endforeach

        </tbody>
    </table>

</div>

<script>
    $( document ).ready(function() {

    $('#datatable').dataTable( {
        'paging':false,
        'ordering':true,
        'scrollY': 400,
        "scrollCollapse": true,
        "scrollX": true,
        "searching": true

    });

    });


    $('#btn_exc_terceros').click(function(){
        $('#datatable').table2excel({
            name: 'Reporte',
            filename: "{{'terceros'.$rango->ini->toDateString().'-a-'.$rango->end->toDateString().'.xls'}}"
        });
    });

</script>

@endsection

@include('templates.main2')


















