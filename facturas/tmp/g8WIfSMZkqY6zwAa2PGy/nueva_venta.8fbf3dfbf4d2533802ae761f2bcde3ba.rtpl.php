<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->cliente_s ){ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript" src="<?php echo $fsc->get_js_location('nueva_venta.js');?>"></script>
<script type="text/javascript">
   fs_nf0 = <?php  echo FS_NF0;?>;
   fs_nf0_art = <?php  echo FS_NF0_ART;?>;
   all_impuestos = <?php echo json_encode($fsc->impuesto->all()); ?>;
   default_impuesto = '<?php echo $fsc->default_items->codimpuesto();?>';
   all_series = <?php echo json_encode($fsc->serie->all()); ?>;
   all_direcciones = <?php echo json_encode($fsc->cliente_s->get_direcciones()); ?>;
   cliente = <?php echo json_encode($fsc->cliente_s); ?>;
   nueva_venta_url = '<?php echo $fsc->url();?>';

   $(document).ready(function() {
      usar_serie();
      usar_almacen();
      usar_divisa();
      recalcular();
   });
</script>

<form id="f_new_albaran" class="form" name="f_new_albaran" action="<?php echo $fsc->url();?>" method="post">
   <input type="hidden" name="petition_id" value="<?php echo $fsc->random_string();?>"/>
   <input type="hidden" id="numlineas" name="numlineas" value="0"/>
   <input type="hidden" name="cliente" value="<?php echo $fsc->cliente_s->codcliente;?>"/>
   <input type="hidden" name="redir"/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-6">
            <h1 style="margin-top: 5px; margin-bottom: 0px;">
               <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
               <a href="<?php echo $fsc->cliente_s->url();?>"><?php echo $fsc->cliente_s->razonsocial;?></a>
               <?php if( $fsc->cliente_s->razonsocial!=$fsc->cliente_s->nombre ){ ?>

               <small>
                  <a href="#" onclick="bootbox.alert({message: 'Cliente conocido como: <?php echo $fsc->cliente_s->nombre;?>',title: '<b>Atención</b>'});">
                     <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                  </a>
               </small>
               <?php } ?>

            </h1>
            <?php $loop_var1=$fsc->grupo->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->codgrupo==$fsc->cliente_s->codgrupo ){ ?>

               <p class="help-block">
                  <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>&nbsp;
                  <a href="<?php echo $value1->url();?>"><?php echo $value1->nombre;?></a> &nbsp;
                  <?php if( $value1->codtarifa ){ ?>

                  <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                  tarifa <?php echo $value1->codtarifa;?>

                  <?php }else{ ?>

                  <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
                  ninguna tarifa asignada.
                  <?php } ?>

               </p>
               <?php } ?>

            <?php } ?>

         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
               <select name="serie" class="form-control" id="codserie" onchange="usar_serie();recalcular();">
               <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->codserie==$fsc->cliente_s->codserie ){ ?>

                  <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                  <?php }elseif( $value1->is_default() AND is_null($fsc->cliente_s->codserie) ){ ?>

                  <option value="<?php echo $value1->codserie;?>" selected=""><?php echo $value1->descripcion;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->almacen->url();?>">Almacén</a>:
               <select name="almacen" class="form-control" id="codalmacen" onchange="usar_almacen()">
               <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->is_default() ){ ?>

                  <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                  <?php } ?>

               <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
               <select name="divisa" class="form-control" id="coddivisa" onchange="usar_divisa()">
               <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->is_default() ){ ?>

                  <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
                  <?php }else{ ?>

                  <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
                  <?php } ?>

               <?php } ?>

               </select>
            </div>
         </div>
      </div>
   </div>

   <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active">
            <a href="#lineas" aria-controls="lineas" role="tab" data-toggle="tab">
               <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
               <span class="hidden-xs">&nbsp;Líneas</span>
            </a>
         </li>
         <li role="presentation">
            <a href="#detalles" aria-controls="detalles" role="tab" data-toggle="tab">
               <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
               <span class="hidden-xs">&nbsp;Detalles</span>
            </a>
         </li>
         <li role="presentation">
            <a href="#envio" aria-controls="envio" role="tab" data-toggle="tab">
               <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
               <span class="hidden-xs">&nbsp;Envío</span>
            </a>
         </li>
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <li role="presentation">
               <a href="#ext_<?php echo $value1->name;?>" aria-controls="ext_<?php echo $value1->name;?>" role="tab" data-toggle="tab"><?php echo $value1->text;?></a>
            </li>
            <?php } ?>

         <?php } ?>

      </ul>
      <div class="tab-content">
         <div role="tabpanel" class="tab-pane active" id="lineas">
            <div class="table-responsive">
               <table class="table table-condensed">
                  <thead>
                     <tr>
                        <th class="text-left" width="180">Referencia</th>
                        <th class="text-left">Descripción</th>
                        <th class="text-right" width="90">Cantidad</th>
                        <th width="50"></th>
                        <th class="text-right" width="110">Precio</th>
                        <th class="text-right" width="90">Dto. %</th>
                        <th class="text-right" width="130">Neto</th>
                        <th class="text-right" width="115"><?php  echo FS_IVA;?></th>
                        <th class="text-right recargo" width="115">RE %</th>
                        <th class="text-right irpf" width="115"><?php  echo FS_IRPF;?> %</th>
                        <th class="text-right" width="140">Total</th>
                     </tr>
                  </thead>
                  <tbody id="lineas_albaran"></tbody>
                  <tbody>
                     <tr class="info">
                        <td><input id="i_new_line" class="form-control" type="text" placeholder="Buscar para añadir..." autocomplete="off"/></td>
                        <td colspan="3">
                           <a href="#" class="btn btn-sm btn-default" title="Añadir sin buscar" onclick="return add_linea_libre()">
                              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                           </a>
                        </td>
                        <td colspan="2">
                           <div class="form-control text-right">Totales</div>
                        </td>
                        <td>
                           <div id="aneto" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
                        </td>
                        <td>
                           <div id="aiva" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
                        </td>
                        <td class="recargo">
                           <div id="are" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
                        </td>
                        <td class="irpf">
                           <div id="airpf" class="form-control text-right" style="font-weight: bold;"><?php echo $fsc->show_numero(0);?></div>
                        </td>
                        <td>
                           <input type="text" name="atotal" id="atotal" class="form-control text-right" style="font-weight: bold;"
                                  value="0" onchange="recalcular()" autocomplete="off"/>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
         <div role="tabpanel" class="tab-pane" id="detalles">
            <div class="container-fluid" style="margin-top: 10px;">
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Nombre del cliente:
                        <input class="form-control" type="text" name="nombrecliente" value="<?php echo $fsc->cliente_s->razonsocial;?>" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        <?php echo $fsc->cliente_s->tipoidfiscal;?>:
                        <input class="form-control" type="text" name="cifnif" value="<?php echo $fsc->cliente_s->cifnif;?>" maxlength="20" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-2"></div>
                  <div class="col-sm-2">
                     <div class="form-group">
                        <a href="<?php echo $fsc->agente->url();?>">Empleado</a>:
                        <select name="codagente" class="form-control">
                           <option value="<?php echo $fsc->agente->codagente;?>"><?php echo $fsc->agente->get_fullname();?></option>
                           <?php if( $fsc->user->admin ){ ?>

                              <option value="<?php echo $fsc->agente->codagente;?>">-----</option>
                              <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codagente;?>"><?php echo $value1->get_fullname();?></option>
                              <?php } ?>

                           <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Tasa de conversión (1€ = X)
                        <input type="text" name="tasaconv" class="form-control" placeholder="(predeterminada)" autocomplete="off"/>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <h3>
                        <span class="glyphicon glyphicon-road" aria-hidden="true"></span>
                        &nbsp;Dirección de facturación:
                     </h3>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Direcciones del cliente:
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                           </span>
                           <select name="coddir" class="form-control" onchange="usar_direccion();">
                              <?php $loop_var1=$fsc->cliente_s->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( $value1->id==$fsc->direccion->id ){ ?>

                                 <option value="<?php echo $value1->id;?>" selected=""><?php echo $value1->descripcion;?></option>
                                 <?php }else{ ?>

                                 <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                                 <?php } ?>

                              <?php } ?>

                              <?php if( $fsc->direccion ){ ?>

                              <option value="">------</option>
                              <option value="nueva">Guardar como nueva</option>
                              <?php }else{ ?>

                              <option value="nueva" selected="">Guardar como nueva</option>
                              <?php } ?>

                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <a href="<?php echo $fsc->pais->url();?>">País</a>:
                        <select class="form-control" name="codpais">
                        <?php if( $fsc->direccion ){ ?>

                           <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codpais;?>"<?php if( $value1->codpais==$fsc->direccion->codpais ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php }else{ ?>

                           <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codpais;?>"<?php if( $value1->is_default() ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                        <?php if( $fsc->direccion ){ ?>

                        <input id="ac_provincia" class="form-control" type="text" name="provincia" value="<?php echo $fsc->direccion->provincia;?>"/>
                        <?php }else{ ?>

                        <input id="ac_provincia" class="form-control" type="text" name="provincia"/>
                        <?php } ?>

                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Ciudad:
                        <?php if( $fsc->direccion ){ ?>

                        <input class="form-control" type="text" name="ciudad" value="<?php echo $fsc->direccion->ciudad;?>"/>
                        <?php }else{ ?>

                        <input class="form-control" type="text" name="ciudad"/>
                        <?php } ?>

                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Código Postal:
                        <?php if( $fsc->direccion ){ ?>

                        <input class="form-control" type="text" name="codpostal" value="<?php echo $fsc->direccion->codpostal;?>" maxlength="10" autocomplete="off"/>
                        <?php }else{ ?>

                        <input class="form-control" type="text" name="codpostal" maxlength="10" autocomplete="off"/>
                        <?php } ?>

                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        Dirección:
                        <?php if( $fsc->direccion ){ ?>

                        <input class="form-control" type="text" name="direccion" value="<?php echo $fsc->direccion->direccion;?>" autocomplete="off"/>
                        <?php }else{ ?>

                        <input class="form-control" type="text" name="direccion" placeholder="Calle ..." autocomplete="off"/>
                        <?php } ?>

                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                        <?php if( $fsc->direccion ){ ?>

                        <input class="form-control" type="text" name="apartado" value="<?php echo $fsc->direccion->apartado;?>" maxlength="10" autocomplete="off"/>
                        <?php }else{ ?>

                        <input class="form-control" type="text" name="apartado" maxlength="10" autocomplete="off"/>
                        <?php } ?>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div role="tabpanel" class="tab-pane" id="envio">
            <div class="container-fluid" style="margin-top: 10px;">
               <div class="row">
                  <div class="col-sm-2">
                     <div class="form-group">
                        Nombre:
                        <input type="text" name="envio_nombre" class="form-control" placeholder="(opcional)" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Apellidos:
                        <input type="text" name="envio_apellidos" class="form-control" placeholder="(opcional)" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <a href="<?php echo $fsc->agencia->url();?>">Agencia de transporte</a>:
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
                           </span>
                           <select name="envio_codtrans" class="form-control">
                              <option value="">Ninguna</option>
                              <option value="">------</option>
                              <?php $loop_var1=$fsc->agencia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codtrans;?>"><?php echo $value1->nombre;?></option>
                              <?php } ?>

                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-4">
                     <div class="form-group">
                        Código de seguimiento:
                        <input type="text" name="envio_codigo" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-3">
                     <div class="form-group">
                        Direcciones del cliente:
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                           </span>
                           <select name="envio_coddir" class="form-control" onchange="usar_direccion_envio();">
                              <option value="">Ninguna</option>
                              <option value="">------</option>
                              <?php $loop_var1=$fsc->cliente_s->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( $value1->domenvio ){ ?>

                                 <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                                 <option value="">------</option>
                                 <?php } ?>

                              <?php } ?>

                              <?php $loop_var1=$fsc->cliente_s->get_direcciones(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                                 <?php if( !$value1->domenvio ){ ?>

                                 <option value="<?php echo $value1->id;?>"><?php echo $value1->descripcion;?></option>
                                 <?php } ?>

                              <?php } ?>

                              <option value="">------</option>
                              <option value="nueva">Guardar como nueva</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <a href="<?php echo $fsc->pais->url();?>">País</a>:
                        <select class="form-control" name="envio_codpais">
                        <?php if( $fsc->direccion ){ ?>

                           <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codpais;?>"<?php if( $value1->codpais==$fsc->direccion->codpais ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php }else{ ?>

                           <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codpais;?>"<?php if( $value1->is_default() ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <span class="text-capitalize"><?php  echo FS_PROVINCIA;?></span>:
                        <input type="text" name="envio_provincia" id="ac_provincia2" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Ciudad:
                        <input type="text" name="envio_ciudad" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        Código Postal:
                        <input type="text" name="envio_codpostal" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        Dirección:
                        <input type="text" name="envio_direccion" class="form-control" placeholder="Calle ..." autocomplete="off"/>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <div class="form-group">
                        <span class="text-capitalize"><?php  echo FS_APARTADO;?></span>:
                        <input type="text" name="envio_apartado" class="form-control" autocomplete="off"/>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
               <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&cod=<?php echo $fsc->cliente_s->codcliente;?>" width="100%" height="2000" frameborder="0"></iframe>
            </div>
            <?php } ?>

         <?php } ?>

      </div>
   </div>

   <div class="container-fluid" style="margin-top: 10px;">
      <div class="row">
         <div class="col-sm-6">
            <button class="btn btn-sm btn-default" type="button" onclick="window.location.href='<?php echo $fsc->url();?>';">
               <span class="glyphicon glyphicon-refresh"></span>&nbsp; Reiniciar
            </button>
         </div>
         <div class="col-sm-6 text-right">
            <button class="btn btn-sm btn-primary" type="button" onclick="$('#modal_guardar').modal('show');">
               <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar...
            </button>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <br/>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-6">
            <div class="form-group">
               Observaciones:
               <textarea class="form-control" name="observaciones" rows="6"></textarea>
            </div>
         </div>
         <div class="col-sm-6">
            <p class="help-block">
               Ajusta los precios fácilmente introduciendo primero la cantidad
               y luego el total, se calculará el precio automaticamente.
               También puedes ajustar el total de cada línea en cualquier momento,
               se recalcula el descuento para ajustarse al precio final de la línea.
            </p>
            <p class="help-block">
               <a href="#" class="label label-default" onclick="irpf=21;recalcular();" title="Mostrar <?php  echo FS_IRPF;?>">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; <?php  echo FS_IRPF;?>

               </a>&nbsp;
               pulsa este botón para añadir <?php  echo FS_IRPF;?> al documento, o bien usa una serie que tenga <?php  echo FS_IRPF;?>.
            </p>
            <p class="help-block">
               <a href="#" class="label label-default" onclick="cliente.recargo=true;recalcular();" title="Mostrar Recargo de Equivalencia">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>&nbsp; RE
               </a>&nbsp;
               pulsa este botón para añadir recargo de equivalencia al documento, o bien activa el recargo de
               equivalencia en el cliente.
            </p>
         </div>
      </div>
   </div>

   <div class="modal fade" id="modal_guardar">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Guardar como...</h4>
               <p class="help-block">
                  Puedes programar ventas usando el plugin
                  <a href="https://www.facturascripts.com/plugin/albaranes_programados" target="_blank">albaranes programados</a>.
               </p>
            </div>
            <div class="modal-body">
               <?php $loop_var1=$fsc->tipos_a_guardar(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <div class="radio">
                  <label>
                     <input type="radio" name="tipo" value="<?php echo $value1['tipo'];?>"<?php if( $value1['tipo']==$fsc->tipo ){ ?> checked="checked"<?php } ?>/>
                     <?php echo $value1['nombre'];?>

                  </label>
               </div>
               <?php } ?>

               <div class="row">
                  <div class="col-sm-6">
                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                           </span>
                           <input type="text" name="fecha" class="form-control datepicker" value="<?php echo $fsc->today();?>" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="form-group">
                        <div class="input-group">
                           <span class="input-group-addon">
                              <span class="glyphicon glyphicon-time"></span>
                           </span>
                           <input type="text" name="hora" class="form-control" value="<?php echo $fsc->hour();?>" autocomplete="off"/>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <span class='text-capitalize'><?php  echo FS_NUMERO2;?>:</span>
                  <input class="form-control" type="text" name="numero2" autocomplete="off"/>
                  <p class="help-block">
                     Puedes usar este campo como desées. Incluso puedes cambiarle el nombre
                     desde Admin &gt; Panel de control &gt; Avanzado.
                  </p>
               </div>
               <div class="form-group">
                  <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
                  <select name="forma_pago" class="form-control">
                  <?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->cliente_s->codpago==$value1->codpago ){ ?>

                     <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
                     <?php } ?>

                  <?php } ?>

                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <div class="pull-left">
                  <div class="checkbox">
                     <label>
                        <input type="checkbox" name="stock" value="TRUE" checked="checked"/>
                        Descontar de stock
                     </label>
                  </div>
               </div>
               <div class="btn-group">
                  <button class="btn btn-sm btn-primary" type="button" onclick="this.disabled=true;this.form.submit();" title="Guardar y volver a empezar">
                     <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
                  </button>
                  <button class="btn btn-sm btn-info" type="button" onclick="this.disabled=true;document.f_new_albaran.redir.value='TRUE';this.form.submit();" title="Guardar y ver documento">
                     <span class="glyphicon glyphicon-eye-open"></span>
                  </button>
               </div>
            </div>
         </div>
      </div>
   </div>
</form>

<div class="modal" id="modal_articulos">
   <div class="modal-dialog" style="width: 99%; max-width: 1000px;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Buscar artículos</h4>
            <p class="help-block">
               <span class="glyphicon glyphicon-info-sign"></span>
               Coloca el puntero sobre un precio para ver la fecha en la que fue actualizado.
            </p>
         </div>
         <div class="modal-body">
            <form id="f_buscar_articulos" name="f_buscar_articulos" action="<?php echo $fsc->url();?>" method="post" class="form">
               <input type="hidden" name="codcliente" value="<?php echo $fsc->cliente_s->codcliente;?>"/>
               <input type="hidden" name="codalmacen"/>
               <input type="hidden" name="coddivisa"/>
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="input-group">
                           <input class="form-control" type="text" name="query" autocomplete="off"/>
                           <span class="input-group-btn">
                              <button class="btn btn-primary" type="submit">
                                 <span class="glyphicon glyphicon-search"></span>
                              </button>
                           </span>
                        </div>
                        <label class="checkbox-inline">
                           <input type="checkbox" name="con_stock" value="TRUE" onchange="buscar_articulos()"/>
                           sólo con stock
                        </label>
                     </div>
                     <div class="col-sm-4">
                        <select class="form-control" name="codfamilia" onchange="buscar_articulos()">
                           <option value="">Cualquier familia</option>
                           <option value="">------</option>
                           <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        </select>
                     </div>
                     <div class="col-sm-4">
                        <select class="form-control" name="codfabricante" onchange="buscar_articulos()">
                           <option value="">Cualquier fabricante</option>
                           <option value="">------</option>
                           <?php $loop_var1=$fsc->fabricante->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codfabricante;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        </select>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <ul class="nav nav-tabs" id="nav_articulos" style="display: none;">
            <li id="li_mis_articulos">
               <a href="#" id="b_mis_articulos">Mi catálogo</a>
            </li>
            <li id="li_nuevo_articulo">
               <a href="#" id="b_nuevo_articulo">
                  <span class="glyphicon glyphicon-plus"></span>&nbsp; Nuevo
               </a>
            </li>
         </ul>
         <div id="search_results"></div>
         <div id="nuevo_articulo" class="modal-body" style="display: none;">
            <form name="f_nuevo_articulo" action="<?php echo $fsc->url();?>" method="post" class="form">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           Referencia:
                           <div class="input-group">
                              <input class="form-control" type="text" name="referencia" maxlength="18" autocomplete="off"/>
                              <span class="input-group-btn" title="Borrar">
                                 <button class="btn btn-default" type="button" onclick="document.f_nuevo_articulo.referencia.value='';document.f_nuevo_articulo.descripcion.focus();">
                                    <span class="glyphicon glyphicon-edit"></span>
                                 </button>
                              </span>
                           </div>
                           <p class="help-block">Dejar en blanco para asignar una referencia automática.</p>
                        </div>
                     </div>
                     <div class="col-sm-8">
                        <div class="form-group">
                           Descripción:
                           <textarea name="descripcion" rows="1" class="form-control"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           Código de barras:
                           <div class="input-group">
                              <span class="input-group-addon">
                                 <span class="glyphicon glyphicon-barcode"></span>
                              </span>
                              <input class="form-control" type="text" name="codbarras" maxlength="18" autocomplete="off"/>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <a href="<?php echo $fsc->familia->url();?>">Familia</a>:
                           <select name="codfamilia" class="form-control">
                              <option value="">Ninguna</option>
                              <option value="">------</option>
                              <?php $loop_var1=$fsc->familia->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codfamilia;?>"><?php echo $value1->nivel;?><?php echo $value1->descripcion;?></option>
                              <?php } ?>

                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           <a href="<?php echo $fsc->fabricante->url();?>">Fabricante</a>:
                           <select name="codfabricante" class="form-control">
                              <option value="">Ninguno</option>
                              <option value="">------</option>
                              <?php $loop_var1=$fsc->fabricante->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codfabricante;?>"><?php echo $value1->nombre;?></option>
                              <?php } ?>

                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="form-group">
                           <a href="<?php echo $fsc->impuesto->url();?>"><?php  echo FS_IVA;?></a>:
                           <select name="codimpuesto" class="form-control">
                              <?php $loop_var1=$fsc->impuesto->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                              <option value="<?php echo $value1->codimpuesto;?>"<?php if( $value1->is_default() ){ ?> selected=""<?php } ?>><?php echo $value1->descripcion;?></option>
                              <?php } ?>

                           </select>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="form-group">
                           Precio de venta:
                           <input type="text" name="pvp" value="0" class="form-control" autocomplete="off"/>
                        </div>
                     </div>
                     <div class="col-sm-4 text-right">
                        <br/>
                        <button class="btn btn-sm btn-primary" type="submit" onclick="new_articulo();return false;">
                           <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar y seleccionar
                        </button>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <label class="checkbox-inline">
                           <input type="checkbox" name="secompra" value="TRUE" checked=""/> Se compra
                        </label> &nbsp;
                        <label class="checkbox-inline">
                           <input type="checkbox" name="sevende" value="TRUE" checked=""/> Se vende
                        </label> &nbsp;
                        <label class="checkbox-inline">
                           <input type="checkbox" name="nostock" value="TRUE"/> No controlar stock
                        </label> &nbsp;
                        <label class="checkbox-inline">
                           <input type="checkbox" name="publico" value="TRUE"/>
                           <span class="glyphicon glyphicon-globe"></span> Público
                        </label>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<?php }elseif( !$fsc->user->get_agente() ){ ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <span class="glyphicon glyphicon-exclamation-sign"></span>
               No tienes un empleado asociado
            </h1>
         </div>
         <p class="help-block">
            No tienes un emleado asociado a tu <a href="<?php echo $fsc->user->url();?>">usuario</a>.
            Habla con el administrador para que te asigne un empleado.
         </p>
         <p class="help-block">
            Si crees que es un error de FacturaScripts, haz clic en el botón de ayuda,
            arriba a la derecha, e infórmanos del error.
         </p>
      </div>
   </div>
</div>
<?php }else{ ?>

<script type="text/javascript" src="<?php echo $fsc->get_js_location('provincias.js');?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
      $("#modal_cliente").modal('show');
      document.f_nueva_venta.ac_cliente.focus();

      $("#ac_cliente").autocomplete({
         serviceUrl: '<?php echo $fsc->url();?>',
         paramName: 'buscar_cliente',
         onSelect: function (suggestion) {
            if(suggestion)
            {
               if(document.f_nueva_venta.cliente.value != suggestion.data)
               {
                  document.f_nueva_venta.cliente.value = suggestion.data;
               }
            }
         }
      });
   });
</script>

<div class="modal" id="modal_cliente">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
               <span class="glyphicon glyphicon-search"></span>
               &nbsp; Selecciona el cliente
            </h4>
            <p class="help-block">
               Busca y selecciona el cliente o bien crea uno nuevo usando
               el recuadro en azul. Además, puedes cambiar las
               <a href="index.php?page=ventas_clientes_opciones">opciones para nuevos clientes</a>.
            </p>
         </div>
         <div class="modal-body">
            <form name="f_nueva_venta" action="<?php echo $fsc->url();?>" method="post" class="form">
               <input type="hidden" name="cliente"/>
               <div class="form-group">
                  <div class="input-group">
                     <input class="form-control" type="text" name="ac_cliente" id="ac_cliente" placeholder="Buscar" autocomplete="off"/>
                     <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
                           <span class="glyphicon glyphicon-share-alt"></span>
                        </button>
                     </span>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-body bg-info">
            <form action="<?php echo $fsc->url();?>" method="post" class="form-horizontal">
               <input type="hidden" name="cliente"/>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                     <input type="text" name="nuevo_cliente" class="form-control" placeholder="Nuevo cliente" autocomplete="off" required=""/>
                  </div>
               </div>
               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_cifnif_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label"><?php  echo FS_CIFNIF;?></label>
                  <div class="col-sm-3">
                     <select name="nuevo_tipoidfiscal" class="form-control">
                        <?php $tiposid=$this->var['tiposid']=fs_tipos_id_fiscal();?>

                        <?php $loop_var1=$tiposid; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1;?>"><?php echo $value1;?></option>
                        <?php } ?>

                     </select>
                  </div>
                  <div class="col-sm-7">
                     <?php if( $fsc->nuevocli_setup['nuevocli_cifnif_req'] ){ ?>

                     <input type="text" name="nuevo_cifnif" class="form-control" maxlength="20" autocomplete="off" required=""/>
                     <?php }else{ ?>

                     <input type="text" name="nuevo_cifnif" class="form-control" maxlength="20" autocomplete="off"/>
                     <?php } ?>

                     <label class="checkbox-inline">
                        <input type="checkbox" name="personafisica" value="TRUE" checked=""/> Persona física (no empresa)
                     </label>
                  </div>
               </div>
               <?php if( $fsc->grupo->all() ){ ?>

               <div class="form-group">
                  <label class="col-sm-2 control-label">Grupo</label>
                  <div class="col-sm-10">
                     <select name="codgrupo" class="form-control">
                        <option value="">Ninguno</option>
                        <option value="">------</option>
                        <?php $loop_var1=$fsc->grupo->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <?php if( $value1->codgrupo==$fsc->nuevocli_setup['nuevocli_codgrupo'] ){ ?>

                           <option value="<?php echo $value1->codgrupo;?>" selected=""><?php echo $value1->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value1->codgrupo;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                     </select>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_telefono1'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_telefono1_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Teléfono 1</label>
                  <div class="col-sm-10">
                     <input type="text" name="nuevo_telefono1" class="form-control" autocomplete="off"<?php if( $fsc->nuevocli_setup['nuevocli_telefono1_req'] ){ ?> required=""<?php } ?>/>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_telefono2'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_telefono2_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Teléfono 2</label>
                  <div class="col-sm-10">
                     <input type="text" name="nuevo_telefono2" class="form-control" autocomplete="off"<?php if( $fsc->nuevocli_setup['nuevocli_telefono2_req'] ){ ?> required=""<?php } ?>/>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_email'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_email_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">E-mail</label>
                  <div class="col-sm-10">
                     <input type="text" name="nuevo_email" class="form-control" autocomplete="off"<?php if( $fsc->nuevocli_setup['nuevocli_email_req'] ){ ?> required=""<?php } ?>/>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_pais'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_pais_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">
                     <a href="<?php echo $fsc->pais->url();?>">País</a>
                  </label>
                  <div class="col-sm-10">
                     <select class="form-control" name="nuevo_pais">
                     <?php $loop_var1=$fsc->pais->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1->codpais;?>"<?php if( $value1->is_default() ){ ?> selected=""<?php } ?>><?php echo $value1->nombre;?></option>
                     <?php } ?>

                     </select>
                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_provincia'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_provincia_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label text-capitalize"><?php  echo FS_PROVINCIA;?></label>
                  <div class="col-sm-10">
                     <?php if( $fsc->nuevocli_setup['nuevocli_provincia_req'] ){ ?>

                     <input type="text" name="nuevo_provincia" id="ac_provincia" class="form-control" autocomplete="off" required=""/>
                     <?php }else{ ?>

                     <input type="text" name="nuevo_provincia" value="<?php echo $fsc->empresa->provincia;?>" id="ac_provincia" class="form-control" autocomplete="off"/>
                     <?php } ?>

                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_ciudad'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_ciudad_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Ciudad</label>
                  <div class="col-sm-10">
                     <?php if( $fsc->nuevocli_setup['nuevocli_ciudad_req'] ){ ?>

                     <input type="text" name="nuevo_ciudad" class="form-control" required=""/>
                     <?php }else{ ?>

                     <input type="text" name="nuevo_ciudad" value="<?php echo $fsc->empresa->ciudad;?>" class="form-control"/>
                     <?php } ?>

                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_codpostal'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_codpostal_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Código Postal</label>
                  <div class="col-sm-10">
                     <?php if( $fsc->nuevocli_setup['nuevocli_codpostal_req'] ){ ?>

                     <input type="text" name="nuevo_codpostal" class="form-control" required=""/>
                     <?php }else{ ?>

                     <input type="text" name="nuevo_codpostal" value="<?php echo $fsc->empresa->codpostal;?>" class="form-control"/>
                     <?php } ?>

                  </div>
               </div>
               <?php } ?>

               <?php if( $fsc->nuevocli_setup['nuevocli_direccion'] ){ ?>

               <div class="form-group<?php if( $fsc->nuevocli_setup['nuevocli_direccion_req'] ){ ?> has-warning<?php } ?>">
                  <label class="col-sm-2 control-label">Dirección</label>
                  <div class="col-sm-10">
                     <?php if( $fsc->nuevocli_setup['nuevocli_direccion_req'] ){ ?>

                     <input type="text" name="nuevo_direccion" class="form-control" autocomplete="off" required=""/>
                     <?php }else{ ?>

                     <input type="text" name="nuevo_direccion" value="C/ " class="form-control" autocomplete="off"/>
                     <?php } ?>

                  </div>
               </div>
               <?php } ?>

               <div class="text-right">
                  <button class="btn btn-sm btn-primary" type="submit">
                     <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar y seleccionar
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>Paso 1:</h1>
         </div>
         <p>Selecciona el cliente al que quieres realizar la venta.</p>
         <a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_cliente">
            <span class="glyphicon glyphicon-search"></span>&nbsp; Selecciona el cliente
         </a>
         <div class="page-header">
            <h2>Paso 2:</h2>
         </div>
         <p>Introduce línea a línea todos los artículos de la venta.</p>
         <div class="page-header">
            <h2>Paso 3:</h2>
         </div>
         <p>Pulsa el botón guardar.</p>
      </div>
   </div>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

