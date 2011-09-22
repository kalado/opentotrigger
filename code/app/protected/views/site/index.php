

<h1>Dashboard Elements</h1>

<ul class="dash">

    <li class="fade_hover tooltip" title="Write a new article">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/2.png" alt="" />
            <span>New article</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Check your notes">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/3.png" alt="" /> 
            <span>My Notes</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Manage Users (3 new users)">
        <span class="bubble">3</span>
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/54.png" alt="" />
            <span>Users</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Website Statistics">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/81.png" alt="" />
            <span>Statistics</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Your server's information">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/21.png" alt="" />
            <span>Server Info</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="No new warnings">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/25.png" alt="" />
            <span>Warnings</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Latest Downloads">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/36.png" alt="" />
            <span>Downloads</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="View all Listings">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/42.png" alt="" />
            <span>Listings</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Manage user gallery">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/27.png" alt="" />
            <span>Gallery</span>
        </a>
    </li>

    <li class="fade_hover tooltip dialog_link" title="47 new messages!">
        <span class="bubble">47</span>
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/75.png" alt="" />
            <span>Inbox</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Add / Remove Contacts">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/123.png" alt="" />
            <span>Contacts</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Time Schedule">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/14.png" alt="" />
            <span>Schedule</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="17 new purchases">
        <span class="bubble">17</span>
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/80.png" alt="" />
            <span>Earnings</span>
        </a>
    </li>

    <li class="fade_hover tooltip" title="Lorem Ipsum">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/18.png" alt="" />
            <span>Media</span>
        </a>
    </li>

    <li class="fade_hover tooltip dialog_link" title="End current session">
        <a href="#">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/dashboard/118.png" alt="" />
            <span>Logout</span>
        </a>
    </li>

</ul> <!-- end dashboard items -->

<div id="dialog" title="Modals with Hello!">  
    <h2>Hello! This is a modal window!</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc egestas, est volutpat auctor fermentum, urna lectus lobortis urna, eu aliquam libero justo vitae tortor.</p>
    <p>Vivamus ornare lacus ac sapien placerat congue eu a felis. Duis lobortis turpis non arcu accumsan imperdiet. Sed quis porta metus. Cras placerat orci et orci ornare pulvinar. Aenean tristique malesuada molestie. Vestibulum pretium nulla eu metus faucibus at congue quam mollis. Donec elit risus, varius eleifend commodo id, tincidunt vitae magna. Nunc fringilla mi a diam aliquam aliquet</p>
</div> 

<hr />

<h1>Tabs and statistics</h1>
<div style="clearboth"></div>

<div class="tabs" style="width:870px;">
    <div class="ui-widget-header">
        <span>Website Statistics</span>
        <ul>
            <li><a href="#tabs-1">Lines</a></li>
            <li><a href="#tabs-2">Bars</a></li>
            <li><a href="#tabs-3">Area</a></li>
        </ul>
    </div>

    <div id="tabs-1">
        <table class="stats line">

            <thead>
                <tr>
                    <td></td>
                    <th scope="col">01.12</th>
                    <th scope="col">02.12</th>
                    <th scope="col">03.12</th>
                    <th scope="col">04.12</th>
                    <th scope="col">05.12</th>
                    <th scope="col">06.12</th>
                    <th scope="col">07.12</th>
                    <th scope="col">08.12</th>
                    <th scope="col">09.12</th>
                    <th scope="col">10.12</th>
                    <th scope="col">11.12</th>
                    <th scope="col">12.12</th>
                    <th scope="col">13.12</th>
                    <th scope="col">14.12</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th scope="row">Page views</th>
                    <td>10</td>
                    <td>37</td>
                    <td>81</td>
                    <td>121</td>
                    <td>124</td>
                    <td>148</td>
                    <td>112</td>
                    <td>200</td>
                    <td>130</td>
                    <td>192</td>
                    <td>40</td>
                    <td>70</td>
                    <td>20</td>
                    <td>60</td>
                </tr>
                <tr>
                    <th scope="row">Subscribers</th>
                    <td>3</td>
                    <td>5</td>
                    <td>15</td>
                    <td>20</td>
                    <td>18</td>
                    <td>30</td>
                    <td>23</td>
                    <td>17</td>
                    <td>5</td>
                    <td>9</td>
                    <td>13</td>
                    <td>15</td>
                    <td>11</td>
                    <td>14</td>
                </tr>
            </tbody>
        </table>
    </div> <!-- end of first tab -->
    <div id="tabs-2">
        <table class="stats bar">
            <thead>
                <tr>
                    <td></td>
                    <th scope="col">01.12</th>
                    <th scope="col">02.12</th>
                    <th scope="col">03.12</th>
                    <th scope="col">04.12</th>
                    <th scope="col">05.12</th>
                    <th scope="col">06.12</th>
                    <th scope="col">07.12</th>
                    <th scope="col">08.12</th>
                    <th scope="col">09.12</th>
                    <th scope="col">10.12</th>
                    <th scope="col">11.12</th>
                    <th scope="col">12.12</th>
                    <th scope="col">13.12</th>
                    <th scope="col">14.12</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th scope="row">Page views</th>
                    <td>10</td>
                    <td>37</td>
                    <td>81</td>
                    <td>121</td>
                    <td>124</td>
                    <td>148</td>
                    <td>112</td>
                    <td>200</td>
                    <td>130</td>
                    <td>192</td>
                    <td>40</td>
                    <td>70</td>
                    <td>20</td>
                    <td>60</td>
                </tr>
                <tr>
                    <th scope="row">Subscribers</th>
                    <td>3</td>
                    <td>5</td>
                    <td>15</td>
                    <td>20</td>
                    <td>18</td>
                    <td>30</td>
                    <td>23</td>
                    <td>17</td>
                    <td>5</td>
                    <td>9</td>
                    <td>13</td>
                    <td>15</td>
                    <td>11</td>
                    <td>14</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="tabs-3">
        <table class="stats area">
            <thead>
                <tr>
                    <td></td>
                    <th scope="col">01.12</th>
                    <th scope="col">02.12</th>
                    <th scope="col">03.12</th>
                    <th scope="col">04.12</th>
                    <th scope="col">05.12</th>
                    <th scope="col">06.12</th>
                    <th scope="col">07.12</th>
                    <th scope="col">08.12</th>
                    <th scope="col">09.12</th>
                    <th scope="col">10.12</th>
                    <th scope="col">11.12</th>
                    <th scope="col">12.12</th>
                    <th scope="col">13.12</th>
                    <th scope="col">14.12</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th scope="row">Page views</th>
                    <td>10</td>
                    <td>37</td>
                    <td>81</td>
                    <td>121</td>
                    <td>124</td>
                    <td>148</td>
                    <td>112</td>
                    <td>200</td>
                    <td>130</td>
                    <td>192</td>
                    <td>40</td>
                    <td>70</td>
                    <td>20</td>
                    <td>60</td>
                </tr>
                <tr>
                    <th scope="row">Subscribers</th>
                    <td>3</td>
                    <td>5</td>
                    <td>15</td>
                    <td>20</td>
                    <td>18</td>
                    <td>30</td>
                    <td>23</td>
                    <td>17</td>
                    <td>5</td>
                    <td>9</td>
                    <td>13</td>
                    <td>15</td>
                    <td>11</td>
                    <td>14</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="clearboth"></div>

<hr />

<h1>Tables, Sortable Tables, Paginators</h1>

<table class="normal tablesorter">
    <thead>
        <tr>
            <th>Select</th>
            <th>No</th>
            <th>User Image</th>
            <th>Full Name</th>
            <th>Subscription type</th>
            <th>Joined date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr class="odd">
            <td><input type="checkbox" class="iphone" /></td>
            <td>211</td>
            <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/avatar.png" alt="" /></td>
            <td>Johnatan Doe</td>
            <td>6 months membership</td>
            <td>09-12-2011</td>
            <td>
                <a href="#" title="Edit this user" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Pencil.png" alt="" /></a> 
                <a href="#" title="Preferences" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Preferences.png" alt="" /></a>
                <a href="#" title="Delete this user" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Trash.png" alt="" /></a>
            </td>
        </tr>
        <tr>
            <td><input type="checkbox" checked="checked" class="iphone" /></td>
            <td>107</td>
            <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/avatar.png" alt="" /></td>
            <td>Johnatan Doe</td>
            <td>1 month membership</td>
            <td>09-12-2011</td>
            <td>
                <a href="#" title="Edit this user" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Pencil.png" alt="" /></a> 
                <a href="#" title="Preferences" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Preferences.png" alt="" /></a>
                <a href="#" title="Delete this user" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Trash.png" alt="" /></a>
            </td>
        </tr>
        <tr class="odd">
            <td><input type="checkbox" class="iphone" /></td>
            <td>34</td>
            <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/avatar.png" alt="" /></td>
            <td>Johnatan Doe</td>
            <td>9 months membership</td>
            <td>09-12-2011</td>
            <td>
                <a href="#" title="Edit this user" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Pencil.png" alt="" /></a> 
                <a href="#" title="Preferences" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Preferences.png" alt="" /></a>
                <a href="#" title="Delete this user" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Trash.png" alt="" /></a>
            </td>
        </tr>
        <tr>
            <td><input type="checkbox" class="iphone" /></td>
            <td>48</td>
            <td><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/avatar.png" alt="" /></td>
            <td>Johnatan Doe</td>
            <td>3 months membership</td>
            <td>09-12-2011</td>
            <td>
                <a href="#" title="Edit this user" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Pencil.png" alt="" /></a> 
                <a href="#" title="Preferences" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Preferences.png" alt="" /></a>
                <a href="#" title="Delete this user" class="tooltip table_icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/img/trigger/adm/icons/actions_small/Trash.png" alt="" /></a>
            </td>
        </tr>
    </tbody>
</table>

<a href="tables.html" class="button_link">View more</a>

<hr />

<h1>Notifications Boxes</h1>

<div class="notification warning"> 
    <span></span> 
    <div class="text"> 
        <p><strong>Warning!</strong> This is a warning notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla varius eros et risus suscipit vehicula.</p> 
    </div> 
</div> 

<div class="notification info"> 
    <span></span> 
    <div class="text"> 
        <p><strong>Info!</strong> This is a info notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla varius eros et risus suscipit vehicula.</p> 
    </div> 
</div> 

<div class="notification download"> 
    <span></span> 
    <div class="text"> 
        <p><strong>Download!</strong> This is a download notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla varius eros et risus suscipit vehicula.</p> 
    </div> 
</div> 

<a href="notifications.html" class="button_link" >View more</a>
<hr />

<h1>Column Snippets, Sortable portlets</h1>

<div class="sortable">
    <div class="one_third column">
        <div class="portlet">
            <div class="portlet-header">Maecenas ornare tortor</div>
            <div class="portlet-content" style="display: block;">
                <p>Donec sed tellus eget sapien fringilla nonummy. Mauris a ante.
                    Suspendisse quam sem, consequat at, commodo vitae, feugiat in, nunc.
                    Morbi imperdiet augue quis tellus. Lorem ipsum dolor sit amet. Quisque
                    aliquam. Donec faucibus.</p>
            </div>
        </div>
    </div>

    <div class="one_third column">
        <div class="portlet">
            <div class="portlet-header">Maecenas ornare tortor</div>
            <div class="portlet-content" style="display: block;">
                <p>Proin tincidunt, velit vel porta elementum, magna diam molestie
                    sapien, non aliquet massa pede eu diam. Aliquam iaculis. Proin
                    tincidunt, velit vel porta elementum, magna diam molestie sapien, non
                    aliquet massa pede eu diam. Aliquam iaculis.</p>
            </div>
        </div>
    </div>

    <div class="one_third last column">
        <div class="portlet">
            <div class="portlet-header">Maecenas ornare tortor</div>
            <div class="portlet-content" style="display: block;">
                <p>Proin tincidunt, velit vel porta elementum, magna diam molestie
                    sapien, non aliquet massa pede eu diam. Aliquam iaculis. Proin
                    tincidunt, velit vel porta elementum, magna diam molestie sapien, non
                    aliquet massa pede eu diam. Aliquam iaculis.</p>
            </div>
        </div>
    </div>
    <hr />

    <div class="two_third column">
        <div class="portlet">
            <div class="portlet-header">Maecenas ornare tortor</div>
            <div class="portlet-content" style="display: block;">
                <p>Suspendisse quam sem, consequat at, commodo vitae, feugiat in, nunc.
                    Donec sed tellus eget sapien fringilla nonummy. Mauris a ante.
                    Suspendisse quam sem, consequat at, commodo vitae, feugiat in, nunc.
                    Morbi imperdiet augue quis tellus. Lorem ipsum dolor sit amet. Quisque
                    aliquam. Donec faucibus. Mauris a ante. Suspendisse quam sem, consequat
                    at, commodo vitae, feugiat in, nunc. Morbi imperdiet augue quis
                    tellus.</p>
            </div>
        </div>
    </div>

    <div class="one_third last column">
        <div class="portlet">
            <div class="portlet-header">Maecenas ornare tortor</div>
            <div class="portlet-content" style="display: block;">
                <p>Lorem ipsum dolor sit amet. Quisque aliquam. Donec faucibus. Donec
                    sed tellus eget sapien fringilla nonummy. Mauris a ante. Suspendisse
                    quam sem, consequat at, commodo vitae, feugiat in, nunc.</p>
            </div>
        </div>
    </div>

</div> <!-- sortable end -->
<div class="clearboth"></div>
<a href="columns.html" class="button_link" >View more</a>
<hr />


<div class="clearboth"></div>

