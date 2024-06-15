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
                            <label for='nama_group'>Kode Group</label>
                            <input id='nama_group' name='kode_group' <?php echo @$block;?> class='required' type='text' value="<?php  echo set_value('kode_group', isset($data['kode_group']) ? $data['kode_group'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_100'>
                        <p>
                            <label for='nama_group'>Nama Group</label>
                            <input id='nama_group' name='nama_group' class='required' type='text' value="<?php  echo set_value('nama_group', isset($data['nama_group']) ? $data['nama_group'] : ''); ?>"/>
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
