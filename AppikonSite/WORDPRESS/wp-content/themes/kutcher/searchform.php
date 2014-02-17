<div class="search">
    <form method="get" action="<?php echo home_url("/"); ?>">
        <input type="text" onblur="if(this.value=='')this.value='<?php _e('To search type and hit enter', 'kutcher'); ?>';" onfocus="if(this.value=='<?php _e('To search type and hit enter', 'kutcher'); ?>')this.value='';" value="<?php _e('To search type and hit enter', 'kutcher'); ?>" class="text" name="s" id="s" />
    </form>
</div>