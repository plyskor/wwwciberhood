<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<?php if( $fsc->suser ){ ?>

<script type="text/javascript">
   function fs_marcar_todo()
   {
      $("#f_user_pages input[name='enabled[]']").prop('checked', true);
      $("#f_user_pages input[name='allow_delete[]']").prop('checked', true);
   }
   function fs_marcar_nada()
   {
      $("#f_user_pages input[name='enabled[]']").prop('checked', false);
      $("#f_user_pages input[name='allow_delete[]']").prop('checked', false);
   }
   function check_allow_delete(counter)
   {
      if( $("#enabled_"+counter).is(':checked') )
      {
         $("#allow_delete_"+counter).prop('checked', true);
      }
      else
      {
         $("#allow_delete_"+counter).prop('checked', false);
      }
   }
   $(document).ready(function() {
      $("#b_eliminar_usuario").click(function(event) {
         event.preventDefault();
         bootbox.confirm({
            message: '¿Realmente desea eliminar el usuario?',
            title: '<b>Atención</b>',
            callback: function(result) {
               if (result) {
                  window.location.href = 'index.php?page=admin_users&delete=<?php echo $fsc->suser->nick;?>';
               }
            }                
         });
      });
      $("#b_nuevo_agente").click(function(event) {
         event.preventDefault();
         $("#modal_nuevo_agente").modal('show');
         document.f_nuevo_agente.nnombre.focus();
      });
   });
</script>

<form class="form" role="form" id="f_user_pages" action="<?php echo $fsc->url();?>" method="post">
   <input type="hidden" name="modupages" value="TRUE"/>
   <div class="container-fluid">
      <div class="row">
         <div class="col-xs-6">
            <div class="btn-group">
               <a class="btn btn-sm btn-default" href="index.php?page=admin_users">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                  <span class="hidden-xs">&nbsp; Usuarios</span>
               </a>
               <a class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>" title="recargar la página">
                  <span class="glyphicon glyphicon-refresh"></span>
               </a>
            </div>
            <div class="btn-group">
            <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

               <?php if( $value1->type=='button' ){ ?>

               <a href="index.php?page=<?php echo $value1->from;?>&snick=<?php echo $fsc->suser->nick;?><?php echo $value1->params;?>" class="btn btn-sm btn-default"><?php echo $value1->text;?></a>
               <?php } ?>

            <?php } ?>

            </div>
            <a class="btn btn-sm btn-success" href="index.php?page=admin_users#nuevo" title="Nuevo usuario">
               <span class="glyphicon glyphicon-plus"></span>
            </a>
         </div>
         <div class="col-xs-6 text-right">
            <div class="btn-group">
               <?php if( $fsc->allow_delete ){ ?>

               <a href="#" id="b_eliminar_usuario" class="btn btn-sm btn-danger">
                  <span class="glyphicon glyphicon-trash"></span>
                  <span class="hidden-xs hidden-sm">&nbsp;Eliminar</span>
               </a>
               <?php } ?>

               <?php if( $fsc->suser->enabled ){ ?>

               <a id="b_desactivar_usuario" class="btn btn-sm btn-warning" href="<?php echo $fsc->url();?>&senabled=0">
                  <span class="glyphicon glyphicon-lock"></span>
                  <span class="hidden-xs">&nbsp;Desactivar</span>
               </a>
               <?php }else{ ?>

               <a id="b_activar_usuario" class="btn btn-sm btn-default" href="<?php echo $fsc->url();?>&senabled=1">
                  <i class="fa fa-check" aria-hidden="true"></i>
                  <span class="hidden-xs">&nbsp;Activar</span>
               </a>
               <?php } ?>

               <button class="btn btn-sm btn-primary" type="submit" onclick="this.disabled=true;this.form.submit();">
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
                  <i class="fa fa-user" aria-hidden="true"></i>
                  Usuario <small><?php echo $fsc->suser->nick;?></small>
               </h1>
               <?php if( !$fsc->suser->enabled ){ ?>

               <p class="help-block">
                  <span class="label label-danger">
                     <span class="glyphicon glyphicon-lock"></span> desactivado
                  </span>
                  &nbsp;el usuario está desactivado, no podrá acceder al sistema.
                  Pulsa el <b>botón activar</b> si quieres activarlo de nuevo.
               </p>
               <?php } ?>

            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-2">
            <div class="form-group">
               Nick:
               <input class="form-control" type="text" name="snick" value="<?php echo $fsc->suser->nick;?>" disabled="disabled"/>
               <div class="checkbox">
                  <label>
                     <input type="checkbox" name="sadmin" value="TRUE"<?php if( $fsc->suser->admin ){ ?> checked=""<?php } ?>/>
                     Administrador
                  </label>
               </div>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Contraseña:
               <input class="form-control" type="password" name="spassword" maxlength="32" placeholder="nueva contraseña"/>
               <input class="form-control" type="password" name="spassword2" maxlength="32" placeholder="repite la contraseña"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Email:
               <?php if( FS_DEMO ){ ?>

               <input type="text" name="email" class="form-control" autocomplete="off"/>
               <?php }else{ ?>

               <input type="text" name="email" value="<?php echo $fsc->suser->email;?>" class="form-control" autocomplete="off"/>
               <?php } ?>

            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->agente->url();?>">Empleado</a>:
               <select name="scodagente" class="form-control">
               <?php if( $fsc->user->admin ){ ?>

                  <option value="">Ninguno</option>
                  <option value="">------</option>
                  <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->suser->codagente==$value1->codagente ){ ?>

                     <option value="<?php echo $value1->codagente;?>" selected=""><?php echo $value1->get_fullname();?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->codagente;?>"><?php echo $value1->get_fullname();?></option>
                     <?php } ?>

                  <?php } ?>

               <?php }else{ ?>

                  <?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->suser->codagente==$value1->codagente ){ ?>

                     <option value="<?php echo $value1->codagente;?>" selected=""><?php echo $value1->get_fullname();?></option>
                     <?php } ?>

                  <?php } ?>

               <?php } ?>

               </select>
               <?php if( $fsc->user->admin ){ ?>

               <p class="help-block">
                  <a id="b_nuevo_agente" href="#">Crear un nuevo empleado y asignarlo a este usuario</a>
               </p>
               <?php } ?>

            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Página de inicio:
               <select name="udpage" class="form-control">
               <?php $loop_var1=$fsc->suser->get_menu(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <?php if( $value1->show_on_menu ){ ?>

                     <?php if( $value1->name==$fsc->suser->fs_page ){ ?>

                     <option value="<?php echo $value1->name;?>" selected=""><?php echo $value1->folder;?> - <?php echo $value1->title;?></option>
                     <?php }else{ ?>

                     <option value="<?php echo $value1->name;?>"><?php echo $value1->folder;?> - <?php echo $value1->title;?></option>
                     <?php } ?>

                  <?php } ?>

               <?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Estilo visual:
               <select name="css" class="form-control">
                  <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $value1->type=='css' ){ ?>

                     <option value="<?php echo $value1->text;?>"<?php if( $value1->text==$fsc->suser->css ){ ?> selected=""<?php } ?>><?php echo $value1->name;?></option>
                     <?php } ?>

                  <?php }else{ ?>

                  <option value="view/css/bootstrap-yeti.min.css">yeti</option>
                  <?php } ?>

               </select>
            </div>
         </div>
      </div>
   </div>
   
   <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
         <li role="presentation" class="active">
            <a href="#autorizar" aria-controls="autorizar" role="tab" data-toggle="tab">
               <i class="fa fa-check-square" aria-hidden="true"></i>
               <span class="hidden-xs">&nbsp;Autorizar</span>
            </a>
         </li>
         <li role="presentation">
            <a href="#historial" aria-controls="historial" role="tab" data-toggle="tab">
               <i class="fa fa-history" aria-hidden="true"></i>
               <span class="hidden-xs">&nbsp;Historial</span>
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
         <div role="tabpanel" class="tab-pane active" id="autorizar">
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th class="text-left">Página</th>
                        <th class="text-left">Menú</th>
                        <th class="text-center">Ver / Modificar</th>
                        <th></th>
                        <th class="text-center">Permiso de eliminación</th>
                     </tr>
                  </thead>
                  <?php if( $fsc->suser->admin ){ ?>

                  <tr class="success">
                     <td colspan="5">
                        <span class="glyphicon glyphicon-ok"></span> &nbsp;
                        Los administradores tienen acceso a cualquier página.
                     </td>
                  </tr>
                  <?php }elseif( !$fsc->user->admin ){ ?>

                     <?php $loop_var1=$fsc->all_pages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr<?php if( $value1->enabled ){ ?> class="<?php if( $value1->allow_delete ){ ?>success<?php }else{ ?>warning<?php } ?>"<?php } ?>>
                        <td><?php echo $value1->name;?></td>
                        <td>
                           <?php if( $value1->important ){ ?>

                           <span class="glyphicon glyphicon-star"></span> » <?php echo $value1->title;?>

                           <?php }elseif( $value1->show_on_menu ){ ?>

                           <span class="text-capitalize"><?php echo $value1->folder;?></span> » <?php echo $value1->title;?>

                           <?php }else{ ?>

                           -
                           <?php } ?>

                        </td>
                        <td class="text-center">
                           <?php if( $value1->enabled ){ ?>

                           <span class="glyphicon glyphicon-check"></span>
                           <?php }else{ ?>

                           <span class="glyphicon glyphicon-lock"></span>
                           <?php } ?>

                        </td>
                        <td class="text-center"></td>
                        <td class="text-center">
                           <?php if( $value1->allow_delete ){ ?>

                           <span class="glyphicon glyphicon-check"></span>
                           <?php }else{ ?>

                           <span class="glyphicon glyphicon-lock"></span>
                           <?php } ?>

                        </td>
                     </tr>
                     <?php } ?>

                  <?php }else{ ?>

                     <?php $loop_var1=$fsc->all_pages(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <tr<?php if( $value1->enabled ){ ?> class="<?php if( $value1->allow_delete ){ ?>success<?php }else{ ?>warning<?php } ?>"<?php } ?>>
                        <td><?php echo $value1->name;?></td>
                        <td>
                           <?php if( $value1->important ){ ?>

                           <span class="glyphicon glyphicon-star"></span> » <?php echo $value1->title;?>

                           <?php }elseif( $value1->show_on_menu ){ ?>

                           <span class="text-capitalize"><?php echo $value1->folder;?></span> » <?php echo $value1->title;?>

                           <?php }else{ ?>

                           -
                           <?php } ?>

                        </td>
                        <td class="text-center">
                           <input type="checkbox" id="enabled_<?php echo $counter1;?>" name="enabled[]" value="<?php echo $value1->name;?>" onclick="check_allow_delete('<?php echo $counter1;?>')"<?php if( $value1->enabled ){ ?> checked=""<?php } ?>/>
                        </td>
                        <td class="text-center">
                           <?php if( $counter1==0 ){ ?>

                           <div class="btn-group">
                              <button class="btn btn-xs btn-default" type="button" onclick="fs_marcar_todo()" title="Marcar todo">
                                 <span class="glyphicon glyphicon-check"></span>
                              </button>
                              <button class="btn btn-xs btn-default" type="button" onclick="fs_marcar_nada()" title="Desmarcar todo">
                                 <span class="glyphicon glyphicon-unchecked"></span>
                              </button>
                           </div>
                           <?php } ?>

                        </td>
                        <td class="text-center">
                           <input type="checkbox" id="allow_delete_<?php echo $counter1;?>" name="allow_delete[]" value="<?php echo $value1->name;?>"<?php if( $value1->allow_delete ){ ?> checked=""<?php } ?> title="el usuario tiene permisos para eliminar en esta página"/>
                        </td>
                     </tr>
                     <?php } ?>

                  <?php } ?>

               </table>
            </div>
         </div>
         <div role="tabpanel" class="tab-pane" id="historial">
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th class="text-left">Último login</th>
                        <th class="text-left">IP</th>
                        <th class="text-left">Navegador</th>
                     </tr>
                  </thead>
                  <tr>
                     <td><?php echo $fsc->suser->show_last_login();?></td>
                     <td><?php echo $fsc->suser->last_ip;?></td>
                     <td><?php echo $fsc->suser->last_browser;?></td>
                  </tr>
               </table>
            </div>
            <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-8">
                     <p class="help-block">
                        <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        &nbsp; Puedes ver más detalles desde Admin &gt; Información del sistema.
                     </p>
                  </div>
                  <div class="col-sm-4 text-right">
                     <a href="index.php?page=admin_info" class="btn btn-xs btn-default">
                        <span class="glyphicon glyphicon-book" aria-hidden="true"></span>
                        <span class="hidden-xs">&nbsp; Historial completo</span>
                     </a>
                  </div>
               </div>
            </div>
            <div class="table-responsive">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th class="text-left">Tipo</th>
                        <th></th>
                        <th class="text-left">Detalle</th>
                        <th class="text-left">IP</th>
                        <th class="text-right">Fecha</th>
                     </tr>
                  </thead>
                  <?php $loop_var1=$fsc->user_log; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                  <tr<?php if( $value1->alerta ){ ?> class="danger"<?php } ?>>
                     <td><?php echo $value1->tipo;?></td>
                     <td class="text-right">
                     <?php if( $value1->alerta ){ ?>

                     <span class="glyphicon glyphicon-warning-sign" aria-hidden="true" title="Podría ser importante"></span>
                     <?php } ?>

                  </td>
                     <td><?php echo $value1->detalle;?></td>
                     <td><?php echo $value1->ip;?></td>
                     <td class="text-right"><?php echo $value1->fecha;?></td>
                  </tr>
                  <?php }else{ ?>

                  <tr class="warning">
                     <td colspan="5">Sin resultados.</td>
                  </tr>
                  <?php } ?>

               </table>
            </div>
         </div>
         <?php $loop_var1=$fsc->extensions; $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

            <?php if( $value1->type=='tab' ){ ?>

            <div role="tabpanel" class="tab-pane" id="ext_<?php echo $value1->name;?>">
               <iframe src="index.php?page=<?php echo $value1->from;?><?php echo $value1->params;?>&snick=<?php echo $fsc->suser->nick;?>" width="100%" height="2000" frameborder="0"></iframe>
            </div>
            <?php } ?>

         <?php } ?>

      </div>
   </div>
</form>

<form class="form-horizontal" role="form" name="f_nuevo_agente" action="<?php echo $fsc->url();?>" method="post">
   <div class="modal" id="modal_nuevo_agente">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title">
                  <span class="glyphicon glyphicon-user"></span> &nbsp; Nuevo empleado
               </h4>
               <p class="help-block">Se creará un empleado y se asignará a este usuario.</p>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label for="nnombre" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="nnombre" autocomplete="off" required=""/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="napellidos" class="col-sm-2 control-label">Apellidos</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="napellidos" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="ndnicif" class="col-sm-2 control-label"><?php  echo FS_CIFNIF;?></label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="ndnicif" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="ntelefono" class="col-sm-2 control-label">Teléfono</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="ntelefono" autocomplete="off"/>
                  </div>
               </div>
               <div class="form-group">
                  <label for="nemail" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                     <input class="form-control" type="text" name="nemail" autocomplete="off"/>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button class="btn btn-sm btn-primary" type="submit">
                  <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp; Guardar
               </button>
            </div>
         </div>
      </div>
   </div>
</form>
<?php }else{ ?>

<div class="thumbnail">
   <img src="<?php  echo FS_PATH;?>view/img/fuuu_face.png" alt="fuuuuu"/>
</div>
<?php } ?>


<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>