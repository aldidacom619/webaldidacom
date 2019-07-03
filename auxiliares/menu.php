 <!-- Navigation -->
 <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background: #FE2E2E;color:#FFFFFF;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="margin-bottom: 0;background: #FE2E2E;color:#FFFFFF;"href="">ALDIDACOM v1.0 - Sistema Contable</a>

    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        
        <!-- /.dropdown -->
        <li>
            <a href="<?php echo base_url()?>usuarios/salir" role="button">Cerrar sesión</a></li>
        
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation" style="margin-bottom: 0; color:#2E9AFE; ">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <span class="input-group-btn">
                            <H5>Usuario: <br><?= $usuario?></H5>
                        </span>
                    </div>                    
                </li>           
                <li>
                    <a href="<?php echo site_url('Inicio');?>"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
                </li>
                <?if(rol_registrado($id_usu,22)){?>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> CONTROL CUENTAS<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <?if(rol_registrado($id_usu,23)){?>
                        <li>
                            <a href="<?php echo site_url('Registrar_cuentas');?>">REGISTRO CUENTAS</a>
                        </li>
                        <?}?>
                        <?if(rol_registrado($id_usu,24)){?>
                        <li>
                            <a href="<?php echo site_url('Modificar_cuentas');?>">MODIFICACION CUENTAS	</a>
                        </li>
                        <?}?>
                        <?if(rol_registrado($id_usu,25)){?>
                        <li>
                            <a href="<?php echo site_url('Baja_cuentas');?>">BAJA CUENTAS</a>
                        </li>
                        <?}?>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <?}?>
              
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i>REGISTRO CONTABLE<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo site_url('Registrar_ingresos');?>">REGISTRO INGRESOS</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('Modificar_ingresos');?>">	MODIFICACION INGRESO</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('Modificar_ingresos');?>">REGISTRO EGRESOS</a>
                        </li>
                        <li>
                            <a href="typography.html">MODIFICACION EGRESOS</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('Eliminar_ingresos');?>">BORAR INGRESOS</a>
                        </li>
                        <li>
                            <a href="grid.html">BORRAR EGRESOS</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i>REPORTE CONSULTAS<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="panels-wells.html">REPORTE INGRESOS</a>
                        </li>
                        <li>
                            <a href="buttons.html">	REPORTE EGRESOS</a>
                        </li>
                        <li>
                            <a href="notifications.html">REGISTRO EGRESOS</a>
                        </li>
                        <li>
                            <a href="typography.html">OTROS</a>
                        </li>                        
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                   
            </ul>
        </div>
        
    </div>
    <!-- /.navbar-static-side -->
</nav>