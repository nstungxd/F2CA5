<ul id="navigation" class="navigation">
    
<!--    <li class="sub top">
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
    </li>-->

    <li class="sub <?php if ($menuindex[0] == 1) echo "active"; ?> top">
        <a href="<?php echo $baseDir ?>/admin/caccount/myaccount">♦ My Account</a>
    </li>
    
    <li <?php if(!perm_is_admin($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 2) echo "active"; ?> top">
        <a href="#">♦ Common<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul class="navigation">
            <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ccategory/lists_category">Category</a>
            </li>
            <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/exercise">Exercise</a>
            </li>
            <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 3) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/exerciseinfo">Exercise Info</a>
            </li>
            <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 4) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/extarget">Exercise Target</a>
            </li>
            <li <?php if(!perm_above_center($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 2 &&$menuindex[1] == 5) echo "activesub"; ?> top" style="border-bottom: none;">
                <a href="#">Equipment<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
                <ul>
                    <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 5&& $menuindex[2] == 2) echo "current";?>">
                        <a href="<?php echo $baseDir ?>/admin/cequipment/lists">Equipment List</a>
                    </li>
                    <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 5&& $menuindex[2] == 1) echo "current";?>">
                        <a href="<?php echo $baseDir ?>/admin/cequipment/register">Add Equipment</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 6) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/food">Food</a>
            </li>
            <li class="<?php if ($menuindex[0] == 2 && $menuindex[1] == 7) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/common/policy">Agreement and Policy</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_is_admin($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 3) echo "active"; ?> top">
        <a href="#">♦ Center<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li class="<?php if ($menuindex[0] == 3 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ccenter/lists">Center List</a>
            </li>
            <li class="<?php if ($menuindex[0] == 3 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ccenter/register">Add Center</a>
            </li>

        </ul>
    </li>
    <li <?php if(!perm_above_center($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 4) echo "active"; ?> top">
        <a href="#">♦ Trainer<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li class="<?php if ($menuindex[0] == 4 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ctrainer/lists">Trainer List</a>
            </li>
            <li class="<?php if ($menuindex[0] == 4 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/ctrainer/register">Add Trainer</a>
            </li>

        </ul>
    </li>
    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 5) echo "active"; ?> top">
        <a href="#">♦ Member<img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 5 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cmember/lists">Member List</a>
            </li>
            <li <?php if(!perm_is_admin($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 5 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cmember/register">Add Member</a>
            </li>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?>  class="<?php if ($menuindex[0] == 5 && $menuindex[1] == 3) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cmember/exercises">Exercises</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 6) echo "active"; ?> top">
        <a href="#">♦ Group <img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 6 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cgroup/lists">Group List</a>
            </li>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 6 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cgroup/groupregister">Create Group</a>
            </li>
        </ul>
    </li>
    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 7) echo "active"; ?> top">
        <a href="#">♦ Workout <img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
        <ul class="navigation">
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 7 && $menuindex[1] == 1) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cworkout/lists">Workout List</a>
            </li>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 7 && $menuindex[1] == 2) echo "current";?>">
                <a href="<?php echo $baseDir ?>/admin/cworkout/workoutregister">Create Workout</a>
            </li>
            <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="sub <?php if ($menuindex[0] == 7) echo "activesub"; ?> top" style="border-bottom: none;">
                <a href="#">Assign workout <img src="<?php echo $baseDir ?>/www/_layout/images/back-nav-sub-pin.png" alt="" /></a>
                <ul>
                    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 7 && $menuindex[1] == 4) echo "current";?>">
                        <a href="<?php echo $baseDir ?>/admin/cassign/lists_group">Assign group</a>
                    </li>
                    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 7 && $menuindex[1] == 5) echo "current";?>">
                        <a href="<?php echo $baseDir ?>/admin/cassign/lists_member">Assign member</a>
                    </li>
                    <li <?php if(!perm_above_trainer($permission)) echo "style='display:none;'" ?> class="<?php if ($menuindex[0] == 7 && $menuindex[1] == 6) echo "current";?>">
                        <a href="<?php echo $baseDir ?>/admin/cassign/lists_center">Assign center</a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
</ul>