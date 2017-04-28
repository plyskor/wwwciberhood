<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->balance ){ ?>

<script type="text/javascript">
   $(document).ready(function() {
      $("#b_eliminar_balance").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Estas seguro de que deseas eliminar este balance?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = '<?php echo $fsc->url();?>&delete=<?php echo urlencode($fsc->balance->codbalance); ?>';
               }
            }
         });
      });
   });
</script>

<div class="container-fluid">
   <form action="<?php echo $fsc->balance->url();?>" method="post" class="form">
      <div class="row">
         <div class="col-sm-6">
            <div class="btn-group">
               <a href="<?php echo $fsc->url();?>" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  <span class="hidden-xs">&nbsp;Todos</span>
               </a>
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->balance->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
         </div>
         <div class="col-sm-6 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a id="b_eliminar_balance" class="btn btn-sm btn-danger" href="#">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-sm hidden-xs">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="button" onclick="this.disabled=true;this.form.submit();">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
                  <span class="hidden-xs">&nbsp;Guardar</span>
               </button>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-12">
            <div class="page-header">
               <h1>
                  <span class="glyphicon glyphicon-wrench"></span>
                  Balance <?php echo $fsc->balance->codbalance;?>

               </h1>
               <p class="help-block">
                  <?php if( $fsc->balance->naturaleza=='A' ){ ?>

                  <span class="label label-success">Activo</span>
                  <?php }elseif( $fsc->balance->naturaleza=='P' ){ ?>

                  <span class="label label-info">Pasivo</span>
                  <?php }elseif( $fsc->balance->naturaleza=='PG' ){ ?>

                  <span class="label label-warning">Pérdidas y ganancias</span>
                  <?php }else{ ?>

                  <span class="label label-default"><?php echo $fsc->balance->naturaleza;?></span>
                  <?php } ?> &nbsp;
                  <?php echo $fsc->balance->descripcion1;?>

               </p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-3">
            <div class="form-group">
               Naturaleza:
               <select name="naturaleza" class="form-control">
                  <?php $loop_var1=$fsc->all_naturalezas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $key1==$fsc->balance->naturaleza ){ ?>

                     <option value="<?php echo $key1;?>" selected=""><?php echo $value1;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                     <?php } ?>

                  <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               Descripción:
               <input type="text" name="descripcion" value="<?php echo $fsc->balance->descripcion1;?>" class="form-control" autocomplete="off"/>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               Descripción 2:
               <input type="text" name="descripcion2" value="<?php echo $fsc->balance->descripcion2;?>" class="form-control" autocomplete="off"/>
            </div>
         </div>
         <div class="col-sm-3">
            <div class="form-group">
               Descripción 3:
               <input type="text" name="descripcion3" value="<?php echo $fsc->balance->descripcion3;?>" class="form-control" autocomplete="off"/>
            </div>
         </div>
      </div>
   </form>
   <form action="<?php echo $fsc->balance->url();?>" method="post" class="form">
      <div class="row">
         <div class="col-sm-6">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">Cuentas en balance</h3>
               </div>
               <div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Cuenta</th>
                           <th></th>
                        </tr>
                     </thead>
                     <?php $loop_var1=$fsc->cuentas; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr>
                        <td><?php echo $value1->codcuenta;?></td>
                        <td class="text-right">
                           <?php if( $fsc->allow_delete ){ ?>

                           <a href="<?php echo $fsc->balance->url();?>&rm_cuenta=<?php echo $value1->id;?>" title="Eliminar">
                              <span class="glyphicon glyphicon-trash"></span>
                           </a>
                           <?php } ?>

                        </td>
                     </tr>
                     <?php } ?>

                     <tr class="info">
                        <td>
                           <input type="text" name="nueva_cuenta" class="form-control" placeholder="cuenta" autocomplete="off"/>
                        </td>
                        <td class="text-right">
                           <button type="submit" class="btn btn-sm btn-primary">
                              <span class="glyphicon glyphicon-plus-sign"></span>
                              <span class="hidden-xs">&nbsp; Nueva</span>
                           </button>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-sm-6">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">Cuentas en balance abreviado</h3>
               </div>
               <div class="table-responsive">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Cuenta</th>
                           <th></th>
                        </tr>
                     </thead>
                     <?php $loop_var1=$fsc->cuentas_a; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr>
                        <td><?php echo $value1->codcuenta;?></td>
                        <td class="text-right">
                           <?php if( $fsc->allow_delete ){ ?>

                           <a href="<?php echo $fsc->balance->url();?>&rm_cuenta_a=<?php echo $value1->id;?>" title="Eliminar">
                              <span class="glyphicon glyphicon-trash"></span>
                           </a>
                           <?php } ?>

                        </td>
                     </tr>
                     <?php } ?>

                     <tr class="info">
                        <td>
                           <input type="text" name="nueva_cuenta_a" class="form-control" placeholder="cuenta" autocomplete="off"/>
                        </td>
                        <td class="text-right">
                           <button type="submit" class="btn btn-sm btn-primary">
                              <span class="glyphicon glyphicon-plus-sign"></span>
                              <span class="hidden-xs">&nbsp; Nueva</span>
                           </button>
                        </td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </form>
</div>
<?php }else{ ?>

<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
         <div class="page-header">
            <h1>
               <span class="glyphicon glyphicon-wrench"></span> Balances contables
               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
               <a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal_nuevo_balance">
                  <span class="glyphicon glyphicon-plus"></span> Nuevo
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
               Estos son los códigos de balance que definen cómo FacturaScripts genera
               los informes contables. Puedes hacer clic en cada uno de ellos para añadir
               o quitar cuentas.
            </p>
            <a href="#naturaleza_A" class="label label-success">A = Activo</a>
            <a href="#naturaleza_P" class="label label-info">P = Pasivo</a>
            <a href="#naturaleza_PG" class="label label-warning">PG = Pérdidas y ganancias</a>
            <a href="#naturaleza_IG" class="label label-default">IG = Ingresos y gastos</a>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>Código</th>
                     <th>Naturaleza</th>
                     <th>Descripción</th>
                     <th>Descripción 2</th>
                     <th>Descripción 3</th>
                  </tr>
               </thead>
               <!--<?php $naturaleza=$this->var['naturaleza']='';?>-->
               <?php $loop_var1=$fsc->all_balances(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <tr class="clickableRow" href="<?php echo $value1->url();?>">
                  <td>
                     <?php if( $value1->naturaleza!=$naturaleza ){ ?>

                     <a name="naturaleza_<?php echo $value1->naturaleza;?>"></a>
                     <!--<?php $naturaleza=$this->var['naturaleza']=$value1->naturaleza;?>-->
                     <?php } ?>

                     <a href="<?php echo $value1->url();?>"><?php echo $value1->codbalance;?></a>
                  </td>
                  <td<?php if( $value1->naturaleza=='A' ){ ?> class="success"<?php }elseif( $value1->naturaleza=='P' ){ ?> class="info"<?php }elseif( $value1->naturaleza=='PG' ){ ?> class="warning"<?php } ?>>
                     <?php echo $value1->naturaleza;?>

                  </td>
                  <td><?php echo $value1->descripcion1;?></td>
                  <td><?php echo $value1->descripcion2;?></td>
                  <td><?php echo $value1->descripcion3;?></td>
               </tr>
               <?php }else{ ?>

               <tr class="warning">
                  <td colspan="5">
                     Sin resultados. ¿Has importado el plan contable?
                  </td>
               </tr>
               <?php } ?>

            </table>
         </div>
      </div>
   </div>
</div>

<form action="<?php echo $fsc->url();?>" method="post" class="form">
   <div class="modal fade" id="modal_nuevo_balance">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">Nuevo balance contable</h4>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  Código:
                  <input type="text" name="ncodbalance" class="form-control" maxlength="15" required="" autocomplete="off" autofocus=""/>
               </div>
               <div class="form-group">
                  Naturaleza:
                  <select name="naturaleza" class="form-control">
                     <?php $loop_var1=$fsc->all_naturalezas(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $key1;?>"><?php echo $value1;?></option>
                     <?php } ?>

                  </select>
               </div>
               <div class="form-group">
                  Descripción:
                  <input type="text" name="descripcion" class="form-control" required="" autocomplete="off"/>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-sm btn-primary">
                  <span class="glyphicon glyphicon-floppy-disk"></span>&nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>

