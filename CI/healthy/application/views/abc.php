<ul id="navigation" class="navigation">
    
    <li class="sub top">
        <a href="#">♦ My Account </a>
        <ul class="navigation" >
            <li class="sub top" style="border-bottom: none;" >
                <a href="#">♦ My Account</a>
                <ul>
                    <li class="current">
                        <a href="#">♦ My Account</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>

    <li class="sub <?php if ($menuindex[0] == 1) echo "active"; ?> top">
        <a href="<?php echo $baseDir ?>/admin/caccount/myaccount">♦ My Account</a>
    </li>


    <li <?php if(!perm_is_admin($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 1) echo "active"; ?> top">
        <a href="#">♦ Common<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li class="<?php if ($menuindex[0] == 1 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/exercise">Exercise</a>
            </li>
            <li class="<?php if ($menuindex[0] == 1 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/food">Food</a>
            </li>
            <li class="<?php if ($menuindex[0] == 1 && $menuindex[1] == 3) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/exerciseinfo">Exercise Info</a>
            </li>
            <li class="<?php if ($menuindex[0] == 1 && $menuindex[1] == 4) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/extarget">Exercise Target</a>
            </li>
            <li class="<?php if ($menuindex[0] == 1 && $menuindex[1] == 5) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/policy">Agreement and Policy</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_is_admin($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 2) echo "active"; ?> top">
        <a href="#">♦ Center<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ccenter/register">Register</a>
            </li>
            <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ccenter/lists">Center List</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_above_center($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 3) echo "active"; ?> top">
        <a href="#">♦ Trainer<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li class="<?php if ($menuindex[0] == 3 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ctrainer/register">Register</a>
            </li>
            <li class="<?php if ($menuindex[0] == 3 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ctrainer/lists">Trainer List</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 4) echo "active"; ?> top">
        <a href="#">♦ Member<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li <?php if(!perm_above_center($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 4 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cmember/register">Register</a>
            </li>
            <li <?php if(!perm_above_center($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 4 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cmember/lists">Member List</a>
            </li>
            <li class="<?php if ($menuindex[0] == 4 && $menuindex[1] == 3) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cmember/exercises">Exercises</a>
            </li>

        </ul>
    </li>
    <li <?php if(!perm_above_center($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 5) echo "active"; ?> top">
        <a href="#">♦ Equipment<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li class="<?php if ($menuindex[0] == 5 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cequipment/register">Register</a>
            </li>
            <li class="<?php if ($menuindex[0] == 5 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cequipment/lists">Equipment List</a>
            </li>
        </ul>
    </li>
    </li>
        <a href="<?php echo $baseDir ?>/admin/caccount/myaccount">♦ My Account</a>


    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 7) echo "active"; ?> top">
        <a href="#">♦ Group <img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 7 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cgroup/lists">Group List</a>
            </li>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 7 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cgroup/groupregister">Add new Group</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 8) echo "active"; ?> top">
        <a href="#">♦ Workout <img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 8 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cworkout/lists">Workout List</a>
            </li>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 8 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cworkout/workoutregister">Add new Workout</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 9) echo "active"; ?> top">
        <a href="#">♦ Assign workout <img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 9 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cassign/lists_group">Assign group</a>
            </li>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 9 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cassign/lists_member">Assign member</a>
            </li>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 9 && $menuindex[1] == 3) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cassign/lists_center">Assign center</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_is_admin($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 10) echo "active"; ?> top">
        <a href="#">♦ Category<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li class="<?php if ($menuindex[0] == 10 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ccategory/lists_category">List Category</a>
            </li>
        </ul>
        <ul>
            <li class="<?php if ($menuindex[0] == 10 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ccategory/categoryregister">Add new Category</a>
            </li>
        </ul>
    </li>
</ul>