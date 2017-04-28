<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("header") . ( substr("header",-1,1) != "/" ? "/" : "" ) . basename("header") );?>


<div class="container-fluid">
   <form name="listado_general" action="<?php echo $fsc->url();?>" method="post" class="form">
      <div class="row">
         <div class="col-sm-12">
	         <div class="page-header">
	            <h1>
                  <i class="fa fa-area-chart" aria-hidden="true"></i> Informe de <?php  echo FS_ALBARANES;?>

	               <a class="btn btn-xs btn-default" href="<?php echo $fsc->url();?>" title="Recargar la página">
	                  <span class="glyphicon glyphicon-refresh"></span>
	               </a>
	            </h1>
	         </div>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-2">
            <div class="form-group">
               Desde:
               <input class="form-control datepicker" type="text" name="desde" value="<?php echo $fsc->desde;?>" autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               Hasta:
               <input class="form-control datepicker" type="text" name="hasta" value="<?php echo $fsc->hasta;?>" autocomplete="off" onchange="this.form.submit()"/>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->agente->url();?>">Empleado</a>:
					<select name="codagente" class="form-control" onchange="this.form.submit()">
                  <option value="">Todos</option>
						<option value="">------</option>
						<?php $loop_var1=$fsc->agente->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->codagente==$value1->codagente ){ ?>

		               <option value="<?php echo $value1->codagente;?>" selected=""><?php echo $value1->get_fullname();?></option>
		               <?php }else{ ?>

		               <option value="<?php echo $value1->codagente;?>"><?php echo $value1->get_fullname();?></option>
		               <?php } ?>

						<?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->serie->url();?>" class="text-capitalize"><?php  echo FS_SERIE;?></a>:
               <select class="form-control" name="codserie" onchange="this.form.submit()">
                  <option value="">Todas</option>
						<option value="">-----</option>
						<?php $loop_var1=$fsc->serie->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->codserie==$value1->codserie ){ ?>

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
               <a href="<?php echo $fsc->divisa->url();?>">Divisa</a>:
					<select name="coddivisa" class="form-control" onchange="this.form.submit()">
                  <?php $loop_var1=$fsc->divisa->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->coddivisa==$value1->coddivisa ){ ?>

		               <option value="<?php echo $value1->coddivisa;?>" selected=""><?php echo $value1->descripcion;?></option>
		               <?php }else{ ?>

		               <option value="<?php echo $value1->coddivisa;?>"><?php echo $value1->descripcion;?></option>
		               <?php } ?>

						<?php } ?>

               </select>
            </div>
         </div>
         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->forma_pago->url();?>">Forma de pago</a>:
					<select name="codpago" class="form-control" onchange="this.form.submit()">
                  <option value="">Todas</option>
						<option value="">------</option>
						<?php $loop_var1=$fsc->forma_pago->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->codpago==$value1->codpago ){ ?>

		               <option value="<?php echo $value1->codpago;?>" selected=""><?php echo $value1->descripcion;?></option>
		               <?php }else{ ?>

		               <option value="<?php echo $value1->codpago;?>"><?php echo $value1->descripcion;?></option>
		               <?php } ?>

						<?php } ?>

               </select>
            </div>
         </div>
         <?php if( $fsc->multi_almacen ){ ?>

         <div class="col-sm-2">
            <div class="form-group">
               <a href="<?php echo $fsc->almacen->url();?>">Almacén</a>:
               <select name="codalmacen" class="form-control" onchange="this.form.submit()">
                  <option value="">Todos</option>
						<option value="">------</option>
						<?php $loop_var1=$fsc->almacen->all(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                     <?php if( $fsc->codalmacen==$value1->codalmacen ){ ?>

		               <option value="<?php echo $value1->codalmacen;?>" selected=""><?php echo $value1->nombre;?></option>
		               <?php }else{ ?>

		               <option value="<?php echo $value1->codalmacen;?>"><?php echo $value1->nombre;?></option>
		               <?php } ?>

						<?php } ?>

               </select>
            </div>
         </div>
         <?php }else{ ?>

         <input type="hidden" name="codalmacen" value=""/>
         <?php } ?>

      </div>
   </form>
   <div class="row">
      <div class="col-sm-12">
         <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
               <a href="#mensual" aria-controls="mensual" role="tab" data-toggle="tab">Mensual</a>
            </li>
            <li role="presentation">
               <a href="#desgloses" aria-controls="desgloses" role="tab" data-toggle="tab">Desgloses</a>
            </li>
            <li role="presentation">
               <a href="#empleados" aria-controls="empleados" role="tab" data-toggle="tab">Empleados</a>
            </li>
         </ul>
         <br/>
      </div>
   </div>
   <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="mensual">
         <div class="row">
            <div class="col-sm-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title"><span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> por mes</h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_albaranes_mes" style="height: 350px;"></canvas>
                     <p class="help-block">Se muestran valores <b>netos</b>, es decir, sin impuestos.</p>
                  </div>
               </div>
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title"><span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> por año</h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_albaranes_anyo" style="height: 350px;"></canvas>
                     <p class="help-block">Se muestran valores <b>netos</b>, es decir, sin impuestos.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="desgloses">
         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de compras por estado
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_estados"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_estados(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de ventas por estado
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_estados"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_estados('albaranescli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
         <?php if( $fsc->multi_almacen ){ ?>

         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de compras por almacén
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_almacenes"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_almacenes(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de ventas por almacén
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_almacenes"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_almacenes('albaranescli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
         <?php } ?>

         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de compras por <?php  echo FS_SERIE;?>

                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_series"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_series(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de ventas por <?php  echo FS_SERIE;?>

                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_series"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_series('albaranescli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de compras por formas de pago
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_formas_pago"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_formas_pago(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de ventas por formas de pago
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_formas_pago"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_formas_pago('albaranescli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <td><?php echo $value1['txt'];?></td>
                           <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div role="tabpanel" class="tab-pane" id="empleados">
         <div class="row">
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de compras por Empleado
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_compras_agentes"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_agentes(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <?php if( $value1['txt']=='Ninguno' ){ ?>

                              <td class="warning">Ninguno</td>
                              <td class="warning text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                           <?php }else{ ?>

                              <td><?php echo $value1['txt'];?></td>
                              <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                           <?php } ?>

                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
            <div class="col-sm-6">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h3 class="panel-title">
                        <span class="text-capitalize"><?php  echo FS_ALBARANES;?></span> de ventas por Empleado
                     </h3>
                  </div>
                  <div class="panel-body">
                     <canvas id="chart_ventas_agentes"></canvas>
                  </div>
                  <div class="table-responsive">
                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>Campo</th>
                              <th class="text-right">Total</th>
                           </tr>
                        </thead>
                        <?php $loop_var1=$fsc->stats_agentes('albaranescli'); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

                        <tr>
                           <?php if( $value1['txt']=='Ninguno' ){ ?>

                              <td class="warning">Ninguno</td>
                              <td class="warning text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                           <?php }else{ ?>

                              <td><?php echo $value1['txt'];?></td>
                              <td class="text-right"><?php echo $fsc->show_precio($value1['total']);?></td>
                           <?php } ?>

                        </tr>
                        <?php }else{ ?>

                        <tr class="warning">
                           <td colspan="2">Sin resultados.</td>
                        </tr>
                        <?php } ?>

                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script src="<?php  echo FS_PATH;?>view/js/chart.bundle.min.js"></script>
<script type="text/javascript">
   $(document).ready(function () {
      
      /// definimos unos colores para usar
      var default_colors = [
         "rgba(255, 99, 132,0.8)","rgba(54, 162, 235,0.8)",'#3366CC','#DC3912','#FF9900',
         '#109618','#990099','#3B3EAC','#0099C6','#DD4477','#66AA00','#B82E2E','#316395',
         '#994499','#22AA99','#AAAA11','#6633CC','#E67300','#8B0707','#329262','#5574A6',
         '#3B3EAC'
      ];
      
      /// cargamos los datos de los pedios por mes
      var albaranes_mes_labels = [];
      var albaranes_mes_data = [
         [],[]
      ];
      <?php $loop_var1=$fsc->stats_months(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      albaranes_mes_labels.push("<?php echo $value1['month'];?>");
      albaranes_mes_data[0].push("<?php echo $value1['total_pro'];?>");
      albaranes_mes_data[1].push("<?php echo $value1['total_cli'];?>");
      <?php } ?>

      
      /// esto es un apaño para evitar los problemas de charts.js con tabs en bootstrap
      var ctx2 = document.getElementById('chart_albaranes_mes').getContext('2d');
      ctx2.canvas.height = 150;
      
      var chart2 = new Chart(ctx2, {
            type: 'line',
            data: {
               labels: albaranes_mes_labels,
               datasets: [
                  {
                     label: 'compras',
                     backgroundColor: "rgba(255, 99, 132,0.8)",
                     data: albaranes_mes_data[0]
                  },
                  {
                     label: 'ventas',
                     backgroundColor: "rgba(54, 162, 235,0.8)",
                     data: albaranes_mes_data[1]
                  }
               ]
            }
         }
      );
      
      /// cargamos los datos de los pedios por mes
      var albaranes_anyo_labels = [];
      var albaranes_anyo_data = [
         [],[]
      ];
      <?php $loop_var1=$fsc->stats_years(); $counter1=-1; if($loop_var1) foreach( $loop_var1 as $key1 => $value1 ){ $counter1++; ?>

      albaranes_anyo_labels.push("<?php echo $value1['year'];?>");
      albaranes_anyo_data[0].push("<?php echo $value1['total_pro'];?>");
      albaranes_anyo_data[1].push("<?php echo $value1['total_cli'];?>");
      <?php } ?>

      
      /// esto es un apaño para evitar los problemas de charts.js con tabs en bootstrap
      var ctx3 = document.getElementById('chart_albaranes_anyo').getContext('2d');
      ctx3.canvas.height = 150;
      
      var chart3 = new Chart(ctx3, {
            type: 'line',
            data: {
               labels: albaranes_anyo_labels,
               datasets: [
                  {
                     label: 'compras',
                     backgroundColor: "rgba(255, 99, 132,0.8)",
                     data: albaranes_anyo_data[0]
                  },
                  {
                     label: 'ventas',
                     backgroundColor: "rgba(54, 162, 235,0.8)",
                     data: albaranes_anyo_data[1]
                  }
               ]
            }
         }
      );
      
      /// cargamos el queso del desglose por serie de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_series();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_series');?>

      
      /// cargamos el queso del desglose por serie de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_series('albaranescli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_series');?>

      
      <?php if( $fsc->multi_almacen ){ ?>

      /// cargamos el queso del desglose por almacén de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_almacenes();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_almacenes');?>

      
      /// cargamos el queso del desglose por almacén de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_almacenes('albaranescli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_almacenes');?>

      <?php } ?>

      
      /// cargamos el queso del desglose por forma de pago de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_formas_pago();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_formas_pago');?>

      
      /// cargamos el queso del desglose por forma de pago de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_formas_pago('albaranescli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_formas_pago');?>

      
      /// cargamos el queso del desglose por estado de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_estados();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_estados');?>

      
      /// cargamos el queso del desglose por estado de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_estados('albaranescli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_estados');?>

      
      /// cargamos el queso del desglose por empleado de las compras
      <!--<?php $data=$this->var['data']=$fsc->stats_agentes();?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_compras_agentes');?>

      
      /// cargamos el queso del desglose por empleado de las ventas
      <!--<?php $data=$this->var['data']=$fsc->stats_agentes('albaranescli');?>-->
      <?php echo $fsc->generar_chart_pie_js($data, 'chart_ventas_agentes');?>

   });
</script>

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("footer") . ( substr("footer",-1,1) != "/" ? "/" : "" ) . basename("footer") );?>