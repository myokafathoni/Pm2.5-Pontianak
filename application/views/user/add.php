<div id='title-bar'>
			<ul id='breadcrumbs'>
				<li><a href="<?php  echo $home; ?>" title='<?php  echo $modul; ?>'><span id='bc-home'></span></a></li>
				<li><a href="#"> <?php  echo $modul; ?></a></li>
				<li><a href="#"> <?php  echo $title; ?></a></li>
                <li><?php  echo $subtitle; ?></li>
			</ul>
		</div>
		<div class="shadow-bottom shadow-titlebar">
		</div>
<div id='main-content'>
    <div class='container_12'>
        <div class='grid_12'>
            <h1><?php  echo $modul; ?></h1>
        </div>
        <div class='grid_12'>
            <div class='block-border'>
                <div class='block-header'>
                    <h1><?php  echo $subtitle; ?></h1>
                    <span></span>
                </div>
                <form id='validate-form' class="block-content form" action="<?php  echo base_url() . $act; ?>" method='post'>
					<div class='_100'>
                        <p>
                            <label for='username'>Username</label>
                            <input id='username' name='username' <?php echo @$block;?> class='required' type='text' value="<?php  echo set_value('username', isset($data['username']) ? $data['username'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_100'>
                        <p>
                            <label for='nama'>Nama</label>
                            <input id='nama' name='nama' class='required' type='text' value="<?php  echo set_value('nama', isset($data['nama']) ? $data['nama'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_100'>
                        <p>
                            <label for='password'>Password</label>
                            <input id='password' name='password' class='required' type='password' value="<?php  echo set_value('password', isset($data['password']) ? $data['password'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_100'>
                        <p>
                            <label for='email'>Email</label>
                            <input id='email' name='email' class='required' type='text' value="<?php  echo set_value('email', isset($data['email']) ? $data['email'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_100'>
                        <p>
                            <label for='telp'>Telp</label>
                            <input id='telp' name='telp' class='required' type='text' value="<?php  echo set_value('telp', isset($data['telp']) ? $data['telp'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_25'>
                        <p>
                            <label for='type_tamu'>Group</label>
                            <select name="kode_group">
                                <?php
                                if ($group->num_rows() > 0) {
                                    foreach ($group->result() as $row) {
                                    if (isset($data['kode_group']) && $data['kode_group'] == $row->kode_group) {
                                ?>
                                    <option value="<? echo $row->kode_group; ?>" selected><? echo $row->nama_group; ?></option>	
								<?php
								} else { 
								?>
                                    <option value="<? echo $row->kode_group; ?>"><? echo $row->nama_group; ?></option>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </select>							
							</p>
                    </div>
                    <div class='clear'>
                    </div>
                    <div class='block-actions'>
                        <ul class='actions-left'>
                            <li><input type='submit' class='button' value="Submit"></li>
							<li><a data-toggle="tooltip" href="<?php  echo $home; ?>" title="hapus" class="button red">Batal</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
