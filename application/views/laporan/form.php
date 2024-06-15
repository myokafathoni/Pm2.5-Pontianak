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
                <form  class="block-content form" action="<?php  echo base_url() . $act; ?>" method='post'>
				<br>
				<br>
				
					<div class='_50'>
                        <p>
                            <label for='tgl_surat'>Tanggal Surat (Mulai)</label>
                            <input id='datepicker' name='tgl1' size="50" class='required' type='text' value="<?php  echo set_value('tgl_mulai', isset($data['tgl_mulai']) ? $data['tgl_mulai'] : ''); ?>"/>
                        </p>
                    </div>
					
					<div class='_50'>
                        <p>
                            <label for='tgl_surat'>Tanggal Surat (Sampai)</label>
                            <input id='datepicker1' name='tgl2' size="50" class='required' type='text' value="<?php  echo set_value('tgl_sampai', isset($data['tgl_sampai']) ? $data['tgl_sampai'] : ''); ?>"/>
                        </p>
                    </div>
                    
					<div class='clear'>
                    </div>
                    <div class='block-actions'>
					<ul class='actions-left'>
                            <li><input type='submit' name='type' class='button' value="Excel"></li>
							<li><input type='submit' name='type' class='button red' value="PDF"></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
