<nav class="navbar  bg-success" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:10px">

  	<div class="btn-group d-flex d-inline ">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fa fa-home"></i>
			<a class="lo text-white" href="courier_dashboard.php">Dashboard</a>
		</button>
    </div>
    <div class="v-divider"></div>
    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block active">
		<i class="fa fa-check-circle"></i><a class="lo text-white" href="courier_acknowledge_incoming_batches.php">	Acknowledge Incoming batches</a>	
		</button>
    </div>
    <span class="v-divider"></span>
	<div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-send"></i>	Void</button>
      <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
      	<a class="dropdown-item" href="#"><i class="fa fa-envelope-open"></i>	Void</a>
      </div>
    </div>
	<span class="v-divider"></span>
	<div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-binoculars"></i>	Void</button>
      <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
      	<a class="dropdown-item" href="#"><i class="fa fa-certificate"></i>	Void</a>
        <div class="dropdown-divider"></div>
      	<a class="dropdown-item" href="#"><i class="fa fa-handshake-o"></i>	Void</a>
      </div>
    </div>
	<div class="v-divider"></div>
    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-success btn-block btn-sm"><i class="fa fa-bar-chart"></i>	Full Statistics</button>
    </div>
    <form class="form-inline my-2 my-lg-0 ml-auto">
           <div class="input-group">                    
                    <input type="text" class="form-control" placeholder="Search" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-light btn-block"><i class="fa fa-search"></i></button>
                    </div>
           </div>
    </form>
    <div class="v-divider"></div>
    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-success btn-sm btn-block" href="signout.php"><i class="fa fa-sign-out"></i>
			<a class="lo text-white" href="signout.php">Logout</a>
		</button>
    </div>

   </nav>