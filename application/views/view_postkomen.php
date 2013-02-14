<html>
<?php 
require_once APPPATH."/views/head.php";
?>
    <body>
        <!-- Home -->
        <div>
            <div data-theme="a" data-role="header">
                <h3>
                    Header
                </h3>
            </div>
            <div data-role="content">
                <div style="">
                        <img style="width: 288px; height: 100px" src="<?php echo base_url()?>images/banner.jpg" />
                    </div>
                <?php foreach($data1['ret_val'] as $row)	{?>
                <h3>
                    <?php echo $row->value->judul ; ?>
                </h3>
                <h5>
                    <?php echo $row->value->isi ; ?>
                </h5>
                <div>
                    <a href="<?php echo base_url();?>index.php/home/update_post?noblog=<?php echo ($row->value->noblog)?>" data-transition="fade">
                        Ubah
                    </a> | <a href="<?php echo base_url();?>index.php/home/delete_post?noblog=<?php echo ($row->value->noblog)?>" data-transition="fade">
                        hapus
                    </a><hr>
                </div>
                <?php } ?> 
                <?php foreach($data2['ret_val_comment'] as $rows) {?>
                <h5>
                    <?php echo $rows->value->user ; ?> :
                    <i><?php echo $rows->value->isi ; ?></i><br>
                    <a href="<?php echo base_url();?>index.php/home/delete_comment?id=<?php echo ($rows->value->_id)?>&amp;rev=<?php echo $rows->value->_rev ?>&amp;noblog=<?php echo $rows->value->noblog ?>">hapus</a>
                </h5>
                <?php } ?><hr>
                <?php echo form_open(base_url().'index.php/home/komen?noblog='.$data1['ret_val']['0']->value->noblog); ?>
                <div data-role="fieldcontain">
                    <fieldset data-role="controlgroup">
                        <label for="textarea1">
                            Komen
                        </label>
                        <textarea name="comment" id="textarea1" placeholder=""></textarea>
                    </fieldset>
                </div>
                <?php form_close() ?>	
                <input type="submit" data-theme="b" value="Submit" />
                <a href="<?php echo base_url()?>index.php/home" data-role="button">Kembali</a>
            </div>
            <?php 
            require_once APPPATH."/views/footer.php";
            ?>
        </div>
    </body>
</html>
