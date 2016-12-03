<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user->nombres." ".$user->prim_apellido; ?></div>
                    <div class="email"><?php echo $user->email; ?></div>
                    <div class="email"><?php echo $user_type->des_tipo_usuario; ?></div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">

                <?php
                    function isSite()
                    {
                        $url = $_SERVER['PHP_SELF'];
                        $sites = func_get_args();
                        foreach($sites as $site)
                        {
                            if(strpos($url, $site)) return true;
                        }
                        return false;
                    }
                ?>

                <ul class="list">
                    <li class="header">Menú Principal</li>
                    <li <?php if (isSite('index.php')) echo 'class="active"'; ?>>
                        <a href="../pages/index.php">
                            <i class="material-icons">home</i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li <?php if (isSite('new_docente.php', 'new_alumno.php','new_acudiente.php' )) echo 'class="active"'; ?>>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person_add</i>
                            <span>Nuevo</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if (isSite('new_docente.php')) echo 'class="active"'; ?>>
                                <a href="../pages/new_docente.php">Docente</a>
                            </li>
                            <li <?php if (isSite('new_alumno.php')) echo 'class="active"'; ?>>
                                <a href="../pages/new_alumno.php">Alumno</a>
                            </li>
                            <li <?php if (isSite('new_acudiente.php')) echo 'class="active"'; ?>>
                                <a href="../pages/new_acudiente.php">Acudiente</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="header">Otro Menú</li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-red">donut_large</i>
                            <span>Important</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-amber">donut_large</i>
                            <span>Warning</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="material-icons col-light-blue">donut_large</i>
                            <span>Information</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2016 <a href="javascript:void(0);">NotaApp</a>.
                </div>
                <div class="version">
                    <b>Version: </b> 1.0.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        
    </section>