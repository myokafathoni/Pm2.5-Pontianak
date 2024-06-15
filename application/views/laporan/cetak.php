<style>
table th{
	vertical-align: top;
}
</style>
LAPORAN PERTANGGAL {tgl1} SAMPAI {tgl2} 
<table border="1" width="100%" cellpadding="1" cellspacing="2" align="center" class="head_laporankelas" style=" border-collapse:collapse;">
	<tr>
		<th>
			No.
		</th>
		<th>
			No Surat
		</th>
		<th>
			Sifat
		</th>
		<th>
			Tanggal Surat
		</th>
		<th>
			Tanggal Terima
		</th>
		<th>
			Pengirim
		</th>
		<th>
			Subjek
		</th>
		<th>
			Penerima
		</th>
		<th>
			Telah Didisposisi ke
		</th>
	</tr>
	{result}
	<tr>
		<td>{no}</td>
		<td>{no_surat}</td>
		<td>{nama_sifat}</td>
		<td>{tglsurat}</td>
		<td>{tglterima}</td>
		<td>{pengirim}</td>
		<td>{subjek}</td>
		<td>{nama_unit}</td>
		<td>{ke}</td>
	</tr>
	{/result}
</table>