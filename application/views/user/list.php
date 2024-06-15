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
            <h1><?php  echo $modul; ?></h1>
			
        </div>
        <div class='grid_12'>
            <div class='block-border'>
                <div class='block-header'>
				<a style="margin-top:10px;margin-left:5px;float:left;" href="<?php  echo base_url() . $link_add; ?>" class="button blue">Tambah Data</a>
                <div style="text-align:right;margin-right:10px;"><h4><?php  echo $title; ?></h4></div>
                </div>
                <div class='block-content'>
                    <table id='<?php echo $id_table;?>' class='table'>
                        <thead>
                            <tr>
								
                                <th>
                                    Username
                                </th>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    No Telp
                                </th>
                                <th>
                                    Group
                                </th>
								<th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clear height-fix">
        </div>
    </div>
</div>
