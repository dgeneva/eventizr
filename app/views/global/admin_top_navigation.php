<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <a class="brand" href="/">Eventizr</a>

		<ul class="nav pull-right">
		  <li class="dropdown">
		    <a href="#"class="dropdown-toggle"data-toggle="dropdown">Account<b class="caret"></b></a>
		    <ul class="dropdown-menu">
					<?php
					if ($this->er_session->logged_in){
						echo '<li>'.anchor("account/manage/edit_account","My Account").'</li>';
						echo '<li>'.anchor("account/manage/edit_password","Change Password").'</li>';
						echo '<li class="divider"></li>';
						echo '<li>'.anchor("account/connect/logout","Logout").'</li>';
					}else{
						echo '<li>'.anchor("account/connect/login","Login").'</li>';
					}
					?>
		    </ul>
		  </li>
		
		</ul>
		
		<ul class="nav pull-right">
		  <li class="dropdown">
		    <a href="#"class="dropdown-toggle"data-toggle="dropdown">Manage<b class="caret"></b></a>
		    <ul class="dropdown-menu">
		      	<li class=""><a href="#">Home</a></li>
		        <li class=""><a href="#">Home</a></li>
				<li class=""><a href="#">Home</a></li>
				<li class=""><a href="#">Home</a></li>
		    </ul>
		  </li>
			<li class="divider-vertical"></li>
		</ul>
		
    </div>
  </div>
</div>