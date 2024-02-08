<?php
///template/global/menu.php
?>
        <!-- ========== Horizontal Menu Start ========== -->
        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                        <?php if ($rbac->checkPermissionPartByName('user')) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboards"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="uil-dashboard"></i><?php echo (_lang['dashboard']); ?><div class="arrow-down"></div>
                                </a>
                                <?php if ($rbac->checkPermissionPartByName('user')) { ?>
                                <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                    <a href="./user" class="dropdown-item"><?php echo (_lang['user']); ?></a>
                                </div>
                                <?php } ?>
                            </li>
                            <?php } ?>
                            <?php if ($rbac->checkPermissionPartByName('access') or
                             $rbac->checkPermissionPartByName('user_stracture') or 
                             $rbac->checkPermissionPartByName('user_operation')) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboards"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="uil-arrows-shrink-h"></i><?php echo (_lang['access']); ?><div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                                <?php if ($rbac->checkPermissionPartByName('access')) { ?>
                                    <a href="./user_access" class="dropdown-item"><?php echo (_lang['access']); ?></a>
                                    <?php } ?>
                                    <?php if ($rbac->checkPermissionPartByName('user_stracture')) { ?>
                                    <a href="./user_stracture" class="dropdown-item"><?php echo (_lang['user_stracture']); ?></a>
                                    <?php } ?>
                                    <?php if ($rbac->checkPermissionPartByName('user_operation')) { ?>
                                    <a href="./user_operation" class="dropdown-item"><?php echo (_lang['user_operation']); ?></a>
                                    <?php } ?>
                                </div>
                            </li>
                            <?php } ?>
                            <?php if ($rbac->checkPermissionPartByName('activity') or
                             $rbac->checkPermissionPartByName('company') or
                             $rbac->checkPermissionPartByName('unit') or
                             $rbac->checkPermissionPartByName('tag') or
                             $rbac->checkPermissionPartByName('users') or 
                             $rbac->checkPermissionPartByName('admins') or
                             $rbac->checkPermissionPartByName('users_groups') or
                             $rbac->checkPermissionPartByName('users_parts') or
                             $rbac->checkPermissionPartByName('users_subparts') or
                             $rbac->checkPermissionPartByName('roles') or
                             $rbac->checkPermissionPartByName('operations')) { ?>

                            <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="uil-game-structure"></i> <?php echo (_lang['systems']); ?><div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                    <?php if ($rbac->checkPermissionPartByName('activity') or
                             $rbac->checkPermissionPartByName('company') or
                             $rbac->checkPermissionPartByName('unit') or
                             
                             $rbac->checkPermissionPartByName('tag')) { ?>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <?php echo (_lang['structure']); ?><div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                            <?php if ($rbac->checkPermissionPartByName('activity')) { ?>
                                                <a href="./activity" class="dropdown-item"> <?php echo (_lang['activity']); ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('company')) { ?>
                                                <a href="./company" class="dropdown-item"> <?php echo (_lang['company']); ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('unit')) { ?>
                                                <a href="./unit" class="dropdown-item"> <?php echo (_lang['unit']); ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('tag')) { ?>
                                                <a href="./tag" class="dropdown-item"><?php echo (_lang['tag']); ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if ($rbac->checkPermissionPartByName('users') or
                             $rbac->checkPermissionPartByName('admins')) { ?>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-error" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <?php echo (_lang['members']); ?><div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-error">
                                            <?php if ($rbac->checkPermissionPartByName('users')) { ?>
                                                <a href="./users" class="dropdown-item"><?php echo (_lang['users']); ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('admins')) { ?>
                                                <a href="./admins" class="dropdown-item"><?php echo (_lang['admins']); ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if (
                             $rbac->checkPermissionPartByName('users_groups') or
                             $rbac->checkPermissionPartByName('users_parts') or
                             $rbac->checkPermissionPartByName('users_subparts') or
                             $rbac->checkPermissionPartByName('roles') or
                             $rbac->checkPermissionPartByName('operations')) { ?>
                                        <div class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-error" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <?php echo (_lang['parts']); ?><div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-error">
                                            <?php if ($rbac->checkPermissionPartByName('users_groups')) { ?>
                                                <a href="./users_groups" class="dropdown-item"><?php echo (_lang['users_groups']); ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('users_parts')) { ?>
                                                <a href="./users_parts" class="dropdown-item"><?php echo (_lang['users_parts']); ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('users_subparts')) { ?>
                                                <a href="./users_subparts" class="dropdown-item"><?php echo (_lang['users_subparts']); ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('roles')) { ?>
                                                <a href="./roles" class="dropdown-item"><?php echo (_lang['roles']); ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('operations')) { ?>
                                                <a href="./operations" class="dropdown-item"><?php echo (_lang['operations']); ?></a>
                                                <?php } ?>
                                            </div>
                                            
                                        </div>
                                        <?php } ?>

                                        

                                    </div>

                                    
                                </li>

            <?php } ?>

            <?php if ($rbac->checkPermissionPartByName('documents')  ) { ?>
                                
                            <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="uil-briefcase"></i><?php echo (_lang['requests']); ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-apps">
                                    <?php if ($rbac->checkPermissionPartByName('documents')) { ?>
                                                <a href="./remittance" class="dropdown-item"> <?php echo _lang['documents']; ?></a>
                                                <?php } ?>
                                                

                                        
                                    </div>
                                </li>
                            

                        </ul>
                            <?php } ?>


                            <?php if ($rbac->checkPermissionPartByName('provinces') or
            $rbac->checkPermissionPartByName('federations') ) { ?>
                                
                            <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="uil-moneybag-alt"></i><?php echo (_lang['organization']); ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-apps">
                                    <?php if ($rbac->checkPermissionPartByName('provinces')) { ?>
                                                <a href="./provinces" class="dropdown-item"> <?php echo _lang['provinces']; ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('federations')) { ?>
                                                <a href="./federations" class="dropdown-item"> <?php echo _lang['federations']; ?></a>
                                                <?php } ?>
                                               
                                        

                                        
                                    </div>
                                </li>
                            

                        </ul>
                            <?php } ?>

                            <?php if ($rbac->checkPermissionPartByName('user_position') or
            $rbac->checkPermissionPartByName('user_achievements') ){ ?>
                                
                            <ul class="navbar-nav">

                        <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="uil-moneybag-alt"></i><?php echo (_lang['user']); ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-apps">
                                    <?php if ($rbac->checkPermissionPartByName('user_position')) { ?>
                                                <a href="./user_position" class="dropdown-item"> <?php echo _lang['user_position']; ?></a>
                                                <?php } ?>
                                                <?php if ($rbac->checkPermissionPartByName('banks')) { ?>
                                                <a href="./user_achievements" class="dropdown-item"> <?php echo _lang['user_achievements']; ?></a>
                                                <?php } ?>
                                                
                                               

                                        
                                    </div>
                                </li>
                            

                        </ul>
                            <?php } ?>

    
   
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ========== Horizontal Menu End ========== -->
        <div class="content-page">