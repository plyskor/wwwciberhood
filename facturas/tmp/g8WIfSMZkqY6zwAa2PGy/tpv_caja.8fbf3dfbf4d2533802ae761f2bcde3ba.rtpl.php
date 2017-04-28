<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<script type="text/javascript">
   function cerrar_caja(id)
   {
      bootbox.confirm({
         message: '¿Realmente desea cerrar el arqueo '+id+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&cerrar='+id;
            }
         }
      });
   }
   function delete_caja(id)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar el arqueo '+id+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&delete='+id;
            }
         }
      });
   }
   function delete_terminal(id)
   {
      bootbox.confirm({
         message: '¿Realmente desea eliminar el terminal '+id+'?',
         title: '<b>Atención</b>',
         callback: function(result) {
            if (result) {
               window.location.href = '<?php echo $fsc->url();?>&deletet='+id+'#terminales';
            }
         }
      });
   }
   $(document).ready(function() {
      if(window.location.hash.substring(1) == 'terminales')
      {
         $('#tab_cajas a[href="#terminales"]').tab('show');
      }
   });
</script>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <i class="fa fa-desktop" aria-hidden="true"></i>&nbsp;
               Arqueos y terminales
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
               <span class="btn-group">
               <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->type=='button' ){ ?>

                  <a href="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>" class="btn btn-xs btn-default"><?php echo $value1->text;?></a>
                  <?php } ?>

               <?php } ?>

               </span>
            </h1>
            <p class="help-block">
               Llamamos terminal al conjunto de PC + impresora de tickets + cajón
               portamonedas. Puedes crear todos los terminales que quieras en la pestaña terminales.
               Cada vez que usas un terminal se genera un <b>arqueo</b> con los datos
               del dinero inicial, final, el número de tickets, etc...
            </p>
         </div>
      </div>
   </div>
</div>

<div id="tab_cajas" role="tabpanel">
   <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
         <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
            <span class="hidden-xs">&nbsp;Arqueos</span>
         </a>
      </li>
      <li role="presentation">
         <a href="#terminales" aria-controls="terminales" role="tab" data-toggle="tab">
            <i class="fa fa-desktop" aria-hidden="true"></i>
            <span class="hidden-xs">&nbsp;Terminales</span>
         </a>
      </li>
   </ul>
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th class="text-left">ID</th>
                     <th class="text-left">Terminal</th>
                     <th class="text-left">Empleado</th>
                     <th class="text-center">Fecha inicial</th>
                     <th class="text-right">Dinero inicial</th>
                     <th class="text-center">Fecha fin</th>
                     <th class="text-right">Diferencia</th>
                     <th class="text-right">Tickets</th>
                     <th class="text-right">Acciones</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->resultados; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr<?php if( $value1->abierta() ){ ?> class="warning"<?php } ?>>
                  <td><?php echo $value1->id;?></td>
                  <td><?php echo $value1->fs_id;?></td>
                  <td><?php if( $value1->agente ){ ?><?php echo $value1->agente->get_fullname();?><?php }else{ ?>-<?php } ?></td>
                  <td class="text-center"><?php echo $value1->fecha_inicial;?></td>
                  <td class="text-right"><?php echo $fsc->show_precio($value1->dinero_inicial);?></td>
                  <td class="text-center"><?php echo $value1->show_fecha_fin();?></td>
                  <td class="text-right"><?php echo $fsc->show_precio($value1->diferencia());?></td>
                  <td class="text-right"><?php echo $value1->tickets;?></td>
                  <td class="text-right">
                     <?php if( $fsc->allow_delete ){ ?>

                     <div class="btn-group">
                        <?php if( $value1->abierta() ){ ?>

                        <a href="#" class="btn btn-xs btn-warning" title="Cerrar arqueo" onclick="cerrar_caja('<?php echo $value1->id;?>')">
                           <span class="glyphicon glyphicon-lock"></span>
                        </a>
                        <?php } ?>

                        <a href="#" class="btn btn-xs btn-danger" title="Eliminar" onclick="delete_caja('<?php echo $value1->id;?>')">
                           <span class="glyphicon glyphicon-trash"></span>
                        </a>
                     </div>
                     <?php } ?>

                  </td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="9">Ningún arqueo en el historial.</td>
               </tr>
               <?php } ?>

            </table>
         </div>
         <ul class="pager">
            <?php if( $fsc->anterior_url()!='' ){ ?>

            <li class="previous">
               <a href="<?php echo $fsc->anterior_url();?>">
                  <span class="glyphicon glyphicon-chevron-left"></span>&nbsp; Anteriores
               </a>
            </li>
            <?php } ?>

            <?php if( $fsc->siguiente_url()!='' ){ ?>

            <li class="next">
               <a href="<?php echo $fsc->siguiente_url();?>">
                  Siguientes &nbsp;<span class="glyphicon glyphicon-chevron-right"></span>
               </a>
            </li>
            <?php } ?>

         </ul>
      </div>
      <div role="tabpanel" class="tab-pane" id="terminales">
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th width="90">ID</th>
                     <th>Almacén</th>
                     <th>Serie</th>
                     <th>Código Cliente</th>
                     <th width="145">Caracteres por linea</th>
                     <th>Comando corte</th>
                     <th>Comando apertura</th>
                     <th width="90">nº tickets</th>
                     <th></th>
                     <th class="text-right" width="120">Acciones</th>
                  </tr>
               </thead>
               <?php $loop_var1=$fsc->terminales; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <form action="<?php echo $fsc->url();?>#terminales" method="post" class="form">
                  <input type="hidden" name="idt" value="<?php echo $value1->id;?>">
                  <tr<?php if( !$value1->disponible() ){ ?> class="warning"<?php } ?>>
                     <td><div class="form-control"><?php echo $value1->id;?></div></td>
                     <td>
                        <select name="codalmacen" class="form-control">
                        <?php $loop_var2=$fsc->almacen->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                           <?php if( $value1->codalmacen==$value2->codalmacen ){ ?>

                           <option value="<?php echo $value2->codalmacen;?>" selected=""><?php echo $value2->nombre;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value2->codalmacen;?>"><?php echo $value2->nombre;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </td>
                     <td>
                        <select name="codserie" class="form-control">
                        <?php $loop_var2=$fsc->serie->all(); $counter2=-1; if($loop_var2) foreach( $loop_var2 as $key2 => $value2 ){ $counter2++; ?>

                           <?php if( $value1->codserie==$value2->codserie ){ ?>

                           <option value="<?php echo $value2->codserie;?>" selected=""><?php echo $value2->descripcion;?></option>
                           <?php }else{ ?>

                           <option value="<?php echo $value2->codserie;?>"><?php echo $value2->descripcion;?></option>
                           <?php } ?>

                        <?php } ?>

                        </select>
                     </td>
                     <td>
                        <input type="text" name="codcliente" value="<?php echo $value1->codcliente;?>" class="form-control" maxlength="6" placeholder="Código" autocomplete="off"/>
                     </td>
                     <td><input type="number" name="anchopapel" value="<?php echo $value1->anchopapel;?>" class="form-control" autocomplete="off"/></td>
                     <td>
                        <input type="text" name="comandocorte" value="<?php echo $value1->comandocorte;?>" class="form-control" autocomplete="off"/>
                        <label class="checkbox-inline">
                           <?php if( $value1->sin_comandos ){ ?>

                           <input type="checkbox" name="sin_comandos" value="TRUE" checked=""/>
                           <?php }else{ ?>

                           <input type="checkbox" name="sin_comandos" value="TRUE"/>
                           <?php } ?>

                           Desactivar comandos
                        </label>
                     </td>
                     <td><input type="text" name="comandoapertura" value="<?php echo $value1->comandoapertura;?>" class="form-control" autocomplete="off"/></td>
                     <td><input type="number" name="num_tickets" value="<?php echo $value1->num_tickets;?>" class="form-control" autocomplete="off"/></td>
                     <td class="text-center">
                        <?php if( !$value1->disponible() ){ ?>

                        <a href="#terminales" class="btn btn-sm btn-warning" onclick="bootbox.alert({message: 'Terminal en uso. Puedes cerrarlo desde la pestaña historial.',title: '<b>Atención</b>'});">
                           <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        </a>
                        <?php } ?>

                     </td>
                     <td class="text-right">
                        <div class="btn-group">
                           <?php if( $fsc->allow_delete ){ ?>

                           <a href="#" class="btn btn-sm btn-danger" title="Eliminar" onclick="delete_terminal('<?php echo $value1->id;?>')">
                              <span class="glyphicon glyphicon-trash"></span>
                           </a>
                           <?php } ?>

                           <button class="btn btn-sm btn-primary" type="submit" title="Guardar" onclick="this.disabled=true;this.form.submit();">
                              <span class="glyphicon glyphicon-floppy-disk"></span>
                           </button>
                        </div>
                     </td>
                  </tr>
               </form>
               <?php } ?>

               <form action="<?php echo $fsc->url();?>#terminales" method="post" class="form">
                  <input type="hidden" name="nuevot" value="TRUE"/>
                  <tr class="info">
                     <td><input type="text" name="idt" class="form-control" autocomplete="off" placeholder="Nuevo" disabled="disabled"/></td>
                     <td>
                        <select name="codalmacen" class="form-control">
                           <?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
                           <?php } ?>

                        </select>
                     </td>
                     <td>
                        <select name="codserie" class="form-control">
                           <?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                           <option value="<?php echo $value1->codserie;?>"><?php echo $value1->descripcion;?></option>
                           <?php } ?>

                        </select>
                     </td>
                     <td><input type="text" name="codcliente" class="form-control" maxlength="6" placeholder="Código" autocomplete="off"/></td>
                     <td>
                        <input type="number" name="anchopapel" value="<?php echo $fsc->terminal->anchopapel;?>" class="form-control" autocomplete="off"/>
                        <p class="help-block">Nº de caracteres que caben en una linea.</p>
                     </td>
                     <td>
                        <input type="text" name="comandocorte" value="<?php echo $fsc->terminal->comandocorte;?>" class="form-control" autocomplete="off"/>
                        <label class="checkbox-inline">
                           <?php if( $fsc->terminal->sin_comandos ){ ?>

                           <input type="checkbox" name="sin_comandos" value="TRUE" checked=""/>
                           <?php }else{ ?>

                           <input type="checkbox" name="sin_comandos" value="TRUE"/>
                           <?php } ?>

                           Desactivar comandos
                        </label>
                     </td>
                     <td><input type="text" name="comandoapertura" value="<?php echo $fsc->terminal->comandoapertura;?>" class="form-control" autocomplete="off"/></td>
                     <td><input type="number" name="num_tickets" value="<?php echo $fsc->terminal->num_tickets;?>" class="form-control" autocomplete="off"/></td>
                     <td></td>
                     <td class="text-right">
                        <div class="btn-group">
                           <button class="btn btn-sm btn-primary" type="submit" title="Guardar" onclick="this.disabled=true;this.form.submit();">
                              <span class="glyphicon glyphicon-plus-sign"></span>
                              <span class="hidden-xs">&nbsp;Nuevo</span>
                           </button>
                        </div>
                     </td>
                  </tr>
               </form>
            </table>
         </div>
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
                  <div class="page-header">
                     <h2>
                        <i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp; Ayuda
                     </h2>
                     <p class="help-block">
                        Para el correcto funcionamiento de la impresora es necesario
                        especificar bien sus comandos. Aquí tienes los comandos de algunas
                        de las impresoras que hemos probado. Si tienes una impresora que no está
                        en la lista, no significa que no pueda funcionar, simplemente que nunca
                        la hemos usado.
                        <br/>
                        Y <b>recuerda</b> que es necesario ejecutar el
                        <a target="_blank" href="https://www.facturascripts.com/descargar?remoteprinter=TRUE">Remote printer</a>
                        para poder imprimir tickets.
                     </p>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Impresora</th>
                              <th>Comando de corte</th>
                              <th>Comando de apertura</th>
                           </tr>
                        </thead>
                        <tr>
                           <td>Samsung Bixolon</td>
                           <td>27.105</td>
                           <td>27.112.48</td>
                        </tr>
                        <tr>
                           <td>Epson TM-T20II</td>
                           <td>27.109</td>
                           <td>27.112.48.55.121</td>
                        </tr>
                        <tr>
                           <td>Okipos</td>
                           <td>29.86.66.100</td>
                           <td>27.112.48</td>
                        </tr>
                        <tr class="warning">
                           <td colspan="3">
                              <span class="glyphicon glyphicon-info-sign"></span> Si aun así
                              no consigues imprimir nada o tienes problemas, puedes
                              <b>desactivar los comandos</b> de la impresora en la configuración
                              del terminal.
                           </td>
                        </tr>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

