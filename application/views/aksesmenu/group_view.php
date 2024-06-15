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
<script>
function ubah(vnilai,vtipe,vgroup,vmenu,vparent)
{
		
		$.ajax({
			url:'<?php echo base_url();?>aksesmenu/simpan',
			type:'POST',
			data:{nilai:vnilai,tipe:vtipe,kode_group:vgroup,kode_menu:vmenu,kode_parent:vparent},
			success: function(data){
				location.href="<?php echo $_SERVER['PHP_SELF'];?>";
			}			
		});	
}
</script>
<form action="<?php echo base_url();?>aksesmenu/simpan" method="POST">
<div class="inline">
Group 
<select onchange="location.href='<?php echo base_url();?>aksesmenu/edit/'+this.value">
<option value="">-pilih-</option>
{rgroup}
<option value="{kode_group}" {cek}>{nama_group}</option>
{/rgroup}
</select>
</div>
	<table class="table table-bordered tablesorter table-striped">
		<thead>
			<tr>
				<th rowspan="2">Menu</th>
			</tr>
		</thead>
		<tbody>
			{result}
			<tr>
				<td>{space}
				<label class="checkbox inline">
				<input id="{kode_parent}" type="checkbox" onchange="ubah(this.checked,'menu','{kode_group}','{kode_menu}','{kode_parent}')" id="inlineCheckbox1" {value}>{nama_menu}
				</label>
				</td>	
			</tr>
			{/result}
		</tbody>
	</table>
</form>
</div>

	  </div>
	</div>
   </div>
</div>
