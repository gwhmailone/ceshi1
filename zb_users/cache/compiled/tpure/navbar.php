<?php  /* Template Name:页头导航栏公共区 */  ?>
<div class="header<?php if ($zbp->Config('tpure')->PostFIXMENUON=='1') { ?> fixed<?php } ?>">
    <div class="wrap">
<?php if ($zbp->Config('tpure')->PostLOGOON == '1') { ?>
        <div class="logo<?php if ($zbp->Config('tpure')->PostLOGOHOVERON=='1') { ?> on<?php } ?>"><a href="<?php  echo $host;  ?>"><img src="<?php if ($zbp->Config('tpure')->PostLOGO) { ?><?php  echo $zbp->Config('tpure')->PostLOGO;  ?><?php }else{  ?><?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/images/logo.svg<?php } ?>" alt="<?php  echo $name;  ?>" /></a></div>
<?php }else{  ?>
        <div class="logo<?php if ($zbp->Config('tpure')->PostLOGOHOVERON=='1') { ?> on<?php } ?>"><h1 class="name"><a href="<?php  echo $host;  ?>"><?php  echo $name;  ?></a></h1></div>
<?php } ?>
        <div class="head">
            <?php if ($zbp->Config('tpure')->PostSIGNON) { ?>
            <div class="account">
                <?php if ($user->ID > 0) { ?>
                <div class="signuser<?php if ($zbp->Config('tpure')->PostSIGNUSERSTYLE == '0') { ?> normal<?php }else{  ?> simple<?php } ?>">
                    <a href="<?php if ($zbp->Config('tpure')->PostSIGNUSERURL) { ?><?php  echo $zbp->Config('tpure')->PostSIGNUSERURL;  ?><?php }else{  ?><?php  echo $host;  ?>zb_system/admin/index.php<?php } ?>" class="uimg"><img src="<?php  echo tpure_MemberAvatar($user);  ?>" alt="<?php  echo $user->StaticName;  ?>"><?php if ($zbp->Config('tpure')->PostSIGNUSERSTYLE == '0') { ?><span class="uname"><?php  echo $user->StaticName;  ?></span><?php } ?></a>
                    <div class="signuserpop">
                        <div class="signusermenu">
                            <?php  echo $zbp->Config('tpure')->PostSIGNUSERMENU;  ?>
                            <a href="<?php  echo BuildSafeCmdURL('act=logout');  ?>"><?php  echo $lang['tpure']['exit'];  ?></a>
                        </div>
                    </div>
                </div>
                <?php }else{  ?>
                <div class="sign"><span><a href="<?php  echo $zbp->Config('tpure')->PostSIGNBTNURL;  ?>"><?php  echo $zbp->Config('tpure')->PostSIGNBTNTEXT;  ?></a></span></div>
                <?php } ?>
            </div>
            <?php } ?>
            <div class="menuico"><span></span><span></span><span></span></div>
            <div class="menu">
                <ul<?php if ($zbp->Config('tpure')->PostSEARCHON=='0') { ?> class="nosch"<?php } ?>>
                    <?php  if(isset($modules['navbar'])){echo $modules['navbar']->Content;}  ?>
                </ul>
<?php if ($zbp->Config('tpure')->PostSEARCHON=='1') { ?>
                    <div class="schico statefixed">
                        <a href="javascript:;"></a>
                        <div class="schfixed">
                            <form method="post" name="search" action="<?php  echo $host;  ?>zb_system/cmd.php?act=search">
                                <input type="text" name="q" placeholder="<?php if ($zbp->Config('tpure')->PostSCHTXT) { ?><?php  echo $zbp->Config('tpure')->PostSCHTXT;  ?><?php }else{  ?><?php  echo $lang['tpure']['schtxt'];  ?><?php } ?>" class="schinput">
                                <button type="submit" class="btn"></button>
                            </form>
                        </div>
                    </div>
<?php } ?>
<?php if ($zbp->Config('tpure')->PostSEARCHON=='1') { ?>
                <form method="post" name="search" action="<?php  echo $host;  ?>zb_system/cmd.php?act=search" class="sch-m">
                    <input type="text" name="q" placeholder="<?php if ($zbp->Config('tpure')->PostSCHTXT) { ?><?php  echo $zbp->Config('tpure')->PostSCHTXT;  ?><?php }else{  ?><?php  echo $lang['tpure']['schtxt'];  ?><?php } ?>" class="schinput">
                    <button type="submit" class="btn"></button>
                </form>
<?php } ?>
            </div>
        </div>
    </div>
</div>