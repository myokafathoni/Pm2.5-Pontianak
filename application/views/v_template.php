<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <!--
    <html>
    -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link rel="icon" type="image/png" href="<?php  echo base_url() ?>assets/images/brantas.png"/>

        <title>
            <?php 
            echo $this->config->item("web_title");
            if (isset($title)) {
                echo " - " . $title . "\n";
            }
            ?>
        </title>

        <?php  if ($this->config->item("use_jquery")) { ?>
            <script type="text/javascript" src="<?php  echo base_url() ?>assets/js/libs/jquery-1.6.2.min.js"></script>
            <?php 
        }
        ?>

        <link href="<?php  echo base_url() ?>assets/css/c11f8f1b6c157a7a1ee04039d038c282336416b9.css" rel="stylesheet" type="text/css" />
        <script src="<?php  echo base_url(); ?>assets/js/libs/modernizr-2.0.6.min.js"></script>
        <script src="<?php  echo base_url(); ?>assets/js/8f71c247c4dadc837fe569208a7a1dc0f7625c46.js"></script>

    </head>


    <?php 
    if (isset($content)) {
        echo $content;
    }
    ?>

</html>