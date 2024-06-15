<div id='title-bar'>
    <ul id='breadcrumbs'>
        <li><a href="<?php  echo base_url(); ?>" title='home'><span id='bc-home'></span></a></li>
        <li>HOME</li>
    </ul>
</div>
<div class="shadow-bottom shadow-titlebar">
</div>
<div id='main-content'>
    <div class='container_12'>
        <div class='grid_12'>
            <div class='grid_12'>
                <div class='block-border'>
                    <div class='block-header'>
					<center>
                        <h1 align="center">
						PREDICTION OF PM2.5 POLLUTANTS CONCENTRATION USING THE FUZZY TIME SERIES METHOD
						</h1>
						
                        <span></span>
                    </div>
                    <div class='block-content'>
						<table>
						<tr>
						<td rowspan='4' style="width:60px;align:center;"><img height="60px" src="<?=base_url();?>assets/images/logo.png" ></td>
						
						<td><b>INFORMATION SYSTEMS</b></td>
						</tr>
						<tr>
						<td><b>Institut Teknologi Telkom Purwokerto</b></td>
						</tr>
						</table>
                    </div>
                    <div class='block-content'>
                        <center>
                        <img src="<?php echo base_url();?>assets/images/forest_fire.png" width="100%" height="250px" valign="center">
                        </center>
                    </div> 
					<div class='block-content'>
                        <strong>
                            <table border="0">
                                <tr><td>Username </td><td> : </td><td> <?php  echo $this->session->userdata("username"); ?></td></tr>
                                <tr><td>Nama </td><td> : </td><td> <?php  echo $this->session->userdata("nama"); ?></td></tr>
                                <tr><td>Jenis User </td><td> : </td><td> <?php  echo $this->session->userdata("nama_group"); ?></td></tr>
                                <tr><td>Browser & OS </td><td> : </td><td> <? echo $_SERVER["HTTP_USER_AGENT"]; ?></td></tr></td></tr>
                            </table>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>