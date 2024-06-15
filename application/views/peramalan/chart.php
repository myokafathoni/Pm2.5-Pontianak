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
				
                <div style="text-align:right;margin-right:10px;"><h4><?php  echo $title; ?></h4></div>
                </div>
          
		  
<div class='block-content'>



<style type='text/css'>
div.highcharts-container{
z-index:99;
}
</style>

<?php 
$titik = "";
$kode1 = "";
$kode2 = "";
foreach($output as $row)
{

$titik .= $row['titik'].",";
$kode1 .= $row['kode1'].",";
$kode2 .= $row['kode2'].",";
}
?>

<script>
$(function () {
     $('#<?php echo $id;?>').highcharts({
        title: {
            text: '',
            x: -20
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: [<?php echo $titik;?>]
        },
		plotOptions: {
            spline: {
                lineWidth: 2,
				states: {
                    hover: {
                        lineWidth: 3
                    }
                },
                marker: {
                    enabled: true
                },
            },
            line: {
                lineWidth: 1,
				enableMouseTracking: false,
                marker: {
                    enabled: false
                },
            }
        },
        yAxis: {
			min: 0,
			max: 600,
			tickInterval: 50,
            title: {
				style: {
					color: 'black', 
					fontWeight: 'bold' 
				},
                text: 'Konsentrasi PM<sub>10</sub> (u gram/m3)'
            },
			min: 0,
            minorGridLineWidth: 0,
            gridLineWidth: 0,
            alternateGridColor: null,
			plotBands: [
			{ // Baik
                from: 0,
                to: 15,
				color: '#00FF00'
				/*
				label: {
                    text: 'Baik',
					align: 'right',
					x: -5,
					y: 0,
                    style: {
                        color: 'black', 
						fontWeight: 'bold' 
                    }
                },
				*/
            },
			{ // Sedang
                from: 16,
                to: 65,
				color: 'blue'
            },
			{ // Tidak Sehat
                from: 66,
                to: 150,
				color: 'yellow'
           },
			{ // Sangat Tidak Sehat
                from: 151,
                to: 250,
				color: 'red'
           },
			{ // Berbahaya
                from: 250,
                to: 800,
				color: 'black'
            }]        
		},  
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'center',
            verticalAlign: 'top',
            borderWidth: 0
        },
        series: [{
            name: 'NILAI AKTUAL',
			 type: 'spline',
			color: 'White',
            data: [<?php echo $kode1;?>]
        }, {
            name: 'NILAI PREDIKSI',
			 type: 'spline',
			color: '#B2C9F0',
            data: [<?php echo $kode2;?>]
        }]
    });
	
});

</script>

<script src="<?php echo base_url();?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/js/exporting.js"></script>
<table width="100%">
<tr>
<td width="80%">
<div  id="<?php echo $id;?>"  style="width: 100%;margin-right:5px; height: 300%;"></div>
</td>
<td>
<table>
		<tr><td><div>
					<img class="img" src="<?php echo base_url();?>assets/images/pm25-berbahaya.jpg" data-toggle="modal" >
		</div></td></tr>
		<tr><td><div>
					<img class="img" src="<?php echo base_url();?>assets/images/pm25-sangattidaksehat.jpg" data-toggle="modal" >
		</div></td></tr>
		<tr><td><div>
					<img class="img" src="<?php echo base_url();?>assets/images/pm25-tidaksehat.jpg" data-toggle="modal" >
		</div></td></tr>
		<tr><td><div>
					<img class="img" src="<?php echo base_url();?>assets/images/pm25-sedang.jpg" data-toggle="modal" >
		</div></td></tr>
		<tr><td><div>
					<img class="img" src="<?php echo base_url();?>assets/images/pm25_baik.jpg" data-toggle="modal" >
		</div></td></tr>
		</tr>
	</table>

</td>
</tr>
</table>
</div>

            </div>
        </div>
        <div class="clear height-fix">
        </div>
    </div>
</div>
<style>
.img {
width:162px;
padding-left:-30px;
}
</style>



