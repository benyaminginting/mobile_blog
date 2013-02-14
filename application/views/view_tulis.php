<html>
    <?php 
    require_once APPPATH."/views/head.php";
    ?>
    <body>
	<div data-role="page" id="page1">
    <div data-theme="a" data-role="header">
        <h3>
            Tulis Blog
        </h3>
    </div>
    <div data-role="content">
        <div style="">
                        <img style="width: 288px; height: 100px" src="<?php echo base_url()?>images/banner.jpg" />
                    </div>
        <?php echo form_open(base_url().'index.php/home/nulis_blog'); ?>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <label for="textinput1">
                    Judul
                </label>
                <input name="judul" id="textinput1" placeholder="" value="" type="text">
            </fieldset>
        </div>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <label for="textarea1">
                    Isi
                </label>
                <textarea name="isi" id="textarea1" placeholder=""></textarea>
            </fieldset>
        </div>
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <label for="textinput2">
                    tags
                </label>
                <input name="tags" id="textinput2" placeholder="" value="" type="text">
            </fieldset>
        </div>
        <input type="submit" name="simpan" data-theme="b"  value="simpan">
        <a href="<?php echo base_url()?>index.php/home" data-role="button">Kembali</a>
    </div>
    <?php form_close() ?>

    <?php 
    require_once APPPATH."/views/footer.php";
    ?>
</div>
    </body>
</html>