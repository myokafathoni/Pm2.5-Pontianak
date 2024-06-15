<!--<script type="text/javascript" src="<? echo base_url().'assets/themes/grape/js/jquery.gdocsviewer.min.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.embed').gdocsViewer({width: 700, height: 600});
	$('#embedURL').gdocsViewer();
});
</script>-->
<!--
<br>
<a href="<?php echo $file_url; ?>" class="embed">Download</a>


<br>
<iframe src="http://docs.google.com/viewer?url=<?php echo urlencode($file_url); ?>&embedded=true" width="1024" height="600" style="border: none;"></iframe>
-->

<br>
<a href="<?php echo $file_url; ?>" target="_blank" class="embed">Download File</a>
<iframe src="<?php echo base_url(); ?>assets/plugins/pdfjs/web/viewer.html?file=<?php echo base_url(); ?>/assets/files/<?php echo $file; ?>" width="1024" height="600" style="border: none;"></iframe>

