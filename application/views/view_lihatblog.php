<!DOCTYPE html>
<html>
<?php 
require_once APPPATH."/views/head.php";
?>
    <body>
        <!-- Home -->
        <div>
            <div data-theme="a" data-role="header">
                <h3>
                    Agate Blog's
                </h3>
            </div>
            <div data-role="content">
                <a href="benyamin hahah">
                    <div style="">
                        <img style="width: 288px; height: 100px" src="<?php echo base_url()?>images/banner.jpg" />
                    </div>
                </a>
                <h2>
                    <?php echo $data1['ret_val']['0']->value->judul; ?>
                </h2>
                <h5> 
                    <?php echo $data1['ret_val']['0']->value->isi; ?>

                </h5>
                <h6>Tags : <i><?php echo $data1['ret_val']['0']->value->tags; ?></i>
                </h6>
                <div>
                    <a href="<?php echo base_url();?>index.php/home/delete_post?noblog=<?php echo ($data1['ret_val']['0']->value->noblog)?>" data-transition="fade">
                        hapus
                    </a> | <a href="<?php echo base_url();?>index.php/home/lihat_post_komen?emit=<?php echo ($data1['ret_val']['0']->value->noblog)?>" data-transition="fade">
                        Comment (<?php echo $data2['noblog']['0']; ?>)
                    </a>
                </div>
                <ul data-role="listview" data-divider-theme="b" data-inset="true">
                    <li data-role="list-divider" role="heading">
                        Postingan Lain
                    </li> <?php $j=0; foreach($data1['ret_val'] as $row) { ?>
                    <li data-theme="c">
                        <a href="<?php echo base_url();?>index.php/home/lihat_post_komen?emit=<?php echo ($row->value->noblog)?>" data-transition="slide">
                            <?php echo $row->value->judul; ?><br>
                            (<?php echo $data2['noblog'][$j]; ?>) comment
                        </a>
                    </li>
                    <?php $j++; } ?>
                </ul>
                <a href="<?php echo base_url()?>index.php/home/tulis" data-role="button">Tulis Blog</a>
            </div>

            <?php 
            require_once APPPATH."/views/footer.php";
            ?>
        </div>

    </body>
</html>