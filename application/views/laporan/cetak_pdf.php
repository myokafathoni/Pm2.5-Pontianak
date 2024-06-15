<style>
table th{
	vertical-align: top;
}
</style>
LAPORAN HARIAN PERTANGGAL {tgl1} SAMPAI {tgl2} PT. SARI ADITIYA LOKA 2/3
<table border="1" width="100%" cellpadding="1" cellspacing="2" align="center" class="head_laporankelas" style=" border-collapse:collapse;">
	<tr>
		<th>No</th>
		<th>Antrian</th>
		<th>No Plat</th>
		<th>Driver</th>
		<th>No Telepon</th>
		<th>KUD</th>
		<th>Afdeling</th>
		<th>Nama Kebun</th>
		<th>Foto Tiba</th>
		<th>Foto Masuk Bongkar Loading</th>
		<th>Foto Lapor Keluar</th>
	</tr>
	{result}
	<tr>
		<td>{no}</td>
		<td>{no_antrian}</td>
		<td>{no_flat}</td>
		<td>{driver}</td>
		<td>{no_telp}</td>
		<td>{kud}</td>
		<td>{afdeling}</td>
		<td>{nama_kebun}</td>
		<td><img width="100" src='<?php echo base_url();?>assets/uploads/antrian/{fotoa}'></td>
		<td><img width="100" src='<?php echo base_url();?>assets/uploads/borload/{fotob}'></td>
		<td><img width="100" src='<?php echo base_url();?>assets/uploads/lapkel{fotoc}'></td>
	</tr>
	{/result}
</table>