<nav class="navbar  bg-success" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:10px">

  	<div class="btn-group d-flex d-inline ">
    	<button type="button" class="btn btn-sm btn-success btn-block"><i class="fa fa-home"></i>
			<a class="lo text-white" href="mail_room_dashboard.php">Dashboard</a>
		</button>
    </div>
    <div class="v-divider"></div>
    <div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle active" data-toggle="dropdown">
		<i class="fa fa-check"></i>	Acknowledge Manifest</button>
      <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
      	<a class="dropdown-item" href="mail_room_ack_from_registry.php"><i class="fa fa-certificate"></i>		From Registry</a>
		<div class="dropdown-divider"></div>
      	<a class="dropdown-item" href="mail_room_ack_from_trustees.php"><i class="fa fa-handshake-o"></i>		From Incorporated Trustees</a>
		<div class="dropdown-divider"></div>
      	<a class="dropdown-item" href="mail_room_ack_from_bn.php"><i class="fa fa-money"></i>	From Business Names</a>
      </div>
    </div>
    <span class="v-divider"></span>
	<div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-motorcycle"></i>	Despatch to Courier</button>
      <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
      	<a class="dropdown-item" href="mail_room_despatch_registry_to_courier.php"><i class="fa fa-certificate"></i>		Companies Certificates & CTCs</a>
		<div class="dropdown-divider"></div>
      	<a class="dropdown-item" href="mail_room_despatch_trustees_to_courier.php"><i class="fa fa-handshake-o"></i>		Incorporated Trustees Certificates & CTCs</a>
		<div class="dropdown-divider"></div>
      	<a class="dropdown-item" href="mail_room_despatch_bn_to_courier.php"><i class="fa fa-money"></i>	Business Names Certificates & CTCs</a>
      </div>
    </div>
	<span class="v-divider"></span>
	<div class="btn-group d-flex">
    	<button type="button" class="btn btn-sm btn-success btn-block dropdown-toggle" data-toggle="dropdown">
		<i class="fa fa-binoculars"></i>	View Manifest Records</button>
      <div class="dropdown-menu" style="font-family:'Trebuchet MS', Arial, Helvetica, sans-serif; font-size:14px">
      	<a class="dropdown-item" href="#"><i class="fa fa-certificate"></i>	Registry</a>
        <div class="dropdown-divider"></div>
      	<a class="dropdown-item" href="#"><i class="fa fa-handshake-o"></i>	Incorporated Trustees</a>
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
    	<button type="button" class="btn btn-success btn-sm btn-block" ><i class="fa fa-sign-out"></i>
			<a class="lo text-white" href="../signout.php">Logout</a>
		</button>
    </div>

   </nav>