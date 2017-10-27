<section class="vbox"> 
    <header class="bg-light lter b-b header clearfix">
        <?php
            if ( ! empty($link_back))
            {
                foreach($link_back as $links)
                {
                    echo $links;
                }
            }
        ?> 
        <p class="h4"><?=$title_box?> : <?php echo set_value('judul_memo', isset($default['judul_memo']) ? $default['judul_memo'] : ''); ?></p>
    </header> 
    <section class="scrollable">  
        <div class="hbox stretch">
            <!-- content -->
            <div class="vbox"> 
                <section class="paper" id="memo-detail">
                    <textarea type="text" class="form-control"><?php echo set_value('isi_memo', isset($default['isi_memo']) ? $default['isi_memo'] : ''); ?></textarea>
                </section> 
            </div>
        </div>
    </section> 
</section> 

