
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
<script type='text/javascript'>//<![CDATA[ 

$(function () {
    $('#<?php echo $id;?>').highcharts({
        chart: {
            type: 'area',
			  backgroundColor:'rgba(255, 255, 255, 0.1)'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
     xAxis: {
            categories: ['',<?php echo $titik;?>]
        }
        ,
        yAxis: {
            title: {
                text: ''
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        tooltip: {
            pointFormat: ''
        },
        plotOptions: {
            area: {
                point: [<?php echo $titik;?>],
                marker: {
                    enabled: false,
                    symbol: 'circle',
                    radius: 1,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
            name: '-',
            data: [<?php echo $kode1;?>,0]
        }, {
            name: '-',
            data: [<?php echo $kode2;?>,0]
        }]
    });
});
//]]>  

</script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<div id="<?php echo $id;?>" style="float:left;width: 31%;margin-right:100px; height: 400px;"></div>


