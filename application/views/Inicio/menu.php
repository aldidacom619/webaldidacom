 <!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background: #FE2E2E;color:#FFFFFF;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="margin-bottom: 0;background: #FE2E2E;color:#FFFFFF;"href="">ALDIDACOM v1.0 - Sistema Administador</a>

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
            <!--    <li>
                    <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="flot.html">Flot Charts</a>
                        </li>
                        <li>
                            <a href="morris.html">Morris.js Charts</a>
                        </li>
                    </ul>
                </li>-->
                <? foreach($rolescero as $rol):?>
                    <li>
                      <a href="index.html"><i class="fa fa-dashboard fa-fw"></i><?=$rol->opcion?></a>
                    </li>
                <?endforeach?> 
               <? $nivelanterior = 0;  ?>
                <? foreach($roles as $rol):?>
                    <? if ($rol->nivel== 1){?>
                        <? if ($nivelanterior == 2){?>
                            </ul>
                          </li>
                        <?}?>     
                        <li>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><?=$rol->opcion?><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">                                                      
                    <?}?>
                    <? if ($rol->nivel == 2){?>
                        <li>
                            <a href="morris.html"><?=$rol->opcion?></a>
                        </li>
                    <?}?>
                    <? $nivelanterior = $rol->nivel;  ?>
                <?endforeach?>         
                <? if ($nivelanterior == 2){?>
                    </ul>
                  </li>
                <?}?>     
            </ul>
        </div>
        
    </div>
    <!-- /.navbar-static-side -->
</nav>