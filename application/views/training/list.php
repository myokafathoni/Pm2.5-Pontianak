<script>
	<?php  echo $js_dtbl;?>
</script>
<div id='title-bar'>
			<ul id='breadcrumbs'>
				<li><a href="<?php  echo $home; ?>" title='<?php  echo $modul; ?>'><span id='bc-home'></span></a></li>
				<li><a href="#"> <?php  echo $modul; ?></a></li>
                <li><?php  echo $title; ?></li>
			</ul>
		</div>
		<div class="shadow-bottom shadow-titlebar">
		</div>
<div id='main-content'>
    <div class='container_12'>
        <div class='grid_12'>
			
        </div>
        <div class='grid_12'>
            <div class='block-border' id="tab-panel-1">
			
                <div class='block-header' style='width:100%'>
		
				
				
				<ul class="tabs"> 
				<li class="active"><a href="#tab-1">UOD & Partition UOD & Re-divide Interval</a></li>
				<li><a href="#tab-2">Fuzzy Set</a></li> 
				<li><a href="#tab-3">Fuzzifikasi</a></li> 
				<li><a href="#tab-4">Fuzzy Logical Relation</a></li> 
				<li><a href="#tab-5">Fuzzy Logical Relation Groups</a></li> 
				<li><a href="#tab-6">Pembobotan</a></li> 
				</ul>
				<div style="text-align:left;margin-left:10px;">
				
				
				<a style="margin-top:6px;margin-left:5px;float:left;" href="<?php echo base_url();?>training/execute" class="button blue">PROSES</a>
			
				
				
				
				</div>
                
				</div>
                <div class='block-content'>
					<div class="block-content tab-container"> 
					<?php echo $content; ?>
					</div>
						
                </div>
            </div>
        </div>
        <div class="clear height-fix">
        </div>
    </div>
</div>
