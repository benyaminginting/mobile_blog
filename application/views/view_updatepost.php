<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <title>Update Postingan
        </title>
        <link rel="stylesheet" href="<?php echo base_url()?>css/jquery.mobile-1.2.0.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>css/my.css" />
        <script src="<?php echo base_url()?>js/jquery.min.js">
        </script>
        <script src="<?php echo base_url()?>js/jquery.mobile-1.2.0.min.js">
        </script>
        <script src="<?php echo base_url()?>js/my.js">
        </script>
        <!-- User-generated css -->
        <style>
        </style>
        <!-- User-generated js -->
        <script>
            try {

    $(function() {

    });

  } catch (error) {
    console.error("Your javascript has an error: " + error);
  }
        </script>
    </head>
    <body>
	<div>
    <div data-theme="a" data-role="header">
        <h3>
            Ubah Postingan
        </h3>
    </div>
    <div data-role="content">
        <div style="">
                        <img style="width: 288px; height: 100px" src="<?php echo base_url()?>images/banner.jpg" />
                    </div>
        <?php echo form_open(base_url().'index.php/home/diupdate'); ?>
		<?php foreach ($ret_val as $data) { ?>
		<div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <label for="textinput1">
                    Judul
                </label>
                				<?php echo form_hidden ('rev', $data->value->_rev); ?>
								<?php echo form_hidden ('id', $data->value->_id); ?>
                                <?php echo form_hidden ('create_date', date("F j, Y, g:i a")); ?>
                                <?php echo form_hidden ('noblog', $data->value->noblog); ?>
                                <?php echo form_hidden ('type', $data->value->type); ?>
                <input name="judul" id="textinput1" placeholder=""  value="<?php echo $data->value->judul; ?>" type="text">
            </fieldset>
        </div>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <label for="textarea1">
                    Isi
                </label>
                <textarea name="isi" id="textarea1"  placeholder=""><?php echo $data->value->isi; ?></textarea>
            </fieldset>
        </div>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <label for="textinput2">
                    tags
                </label>
                <input name="tags" id="textinput2" placeholder="" value="<?php echo $data->value->tags; ?>" type="text">
            </fieldset>
        </div>
        <input type="submit" name="simpan" data-theme="b"  value="simpan">
        <a href="<?php echo base_url()?>index.php/home" data-role="button">Kembali</a>
    </div>
	<?php } ?>
	<?php form_close() ?>

    <div data-theme="a" data-role="footer" data-position="fixed">
        <h3>
            Agate Gamepon Team
        </h3>
    </div>
</div>
    </body>
</html>