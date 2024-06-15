<link '<?php echo base_url(); ?>assets/plugins/timepicker/jquery-ui-timepicker-addon.css' rel="stylesheet" type="text/css" />
<script src='<?php echo base_url(); ?>assets/plugins/timepicker/jquery-ui-timepicker-addon.js'></script>
<script>	
$(document).ready(function() {	
		$('#waktu').datetimepicker({
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm:ss"
		});
		});
		</script>
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
                            <input id='id' name='id' maxlength='1' <?php echo @$block;?> type='hidden' value="<?php  echo set_value('id', isset($data['id']) ? $data['id'] : ''); ?>"/>
					<div class='_50'>
                        <p>
                            <label for='waktu'>Waktu</label>
                            <input id='waktu' name='waktu' class='required' type='text' value="<?php  echo set_value('waktu', isset($data['waktu']) ? $data['waktu'] : ''); ?>"/>
                        </p>
                    </div>
					<div class='_50'>
                        <p>
                            <label for='waktu'>Nilai</label>
                            <input id='waktu' name='nilai' class='required' type='text' value="<?php  echo set_value('nilai', isset($data['nilai']) ? $data['nilai'] : ''); ?>"/>
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
