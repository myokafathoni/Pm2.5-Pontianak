<div id='header-surround'>
    <header id='header'>
        <p class="logo">
		<b>
        </b>
        </p> 

<!--<a href="javascript:void(0);" onclick="$('#info-dialog').dialog({ modal: true });"><span class="btn-info"></span></a>-->
<script>
function pilih(isi)
{
$('#info-dialog').html('<center><img align="center" width="300" height:"300" src="<?php echo base_url(); ?>/assets/files/'+isi+'" style="border: none;">');
$('#info-dialog').dialog({ modal: true,width:600,height:450 });
return false;
}
function pilihpdf(isi)
{
$('#info-dialog').html('<br><iframe src="<?php echo base_url(); ?>assets/plugins/pdfjs/web/viewer.html?file=<?php echo base_url(); ?>/assets/files/'+isi+'" width="1000" height="500" style="border: none;"></iframe> ');
$('#info-dialog').dialog({ modal: true,width:1024,height:600 });
return false;
}
function peta(isi)
{
$('#info-dialog').html('<br><iframe src="<?php echo base_url(); ?>pohon/detailpeta/'+isi+'" width="1000" height="500" style="border: none;"></iframe> ');
$('#info-dialog').dialog({ modal: true,width:1000,height:600 });
return false;
}
</script>
<div scrollleft="0" scrolltop="0" class="ui-dialog-content ui-widget-content" id="info-dialog" style="display:none;width: 800px; min-height: 0px; height: 378px;"></div>		
        <div id='user-info'>
            <p>
                <span class='messages'>YOU LOG IN AS <?php  echo $this->session->userdata("nama"); ?></span>
                <a href="<?php  echo base_url() . 'login/logout'; ?>" class="button red">Logout</a>
            </p>
        </div>
    </header>
</div>