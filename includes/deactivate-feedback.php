<?php 
$reasons = array(
    		1 => '<li><label><input type="radio" name="websten_disable_reason" value="temporary"/>' . __('It is only temporary', 'web_stories_enhancer') . '</label></li>',
		2 => '<li><label><input type="radio" name="websten_disable_reason" value="stopped showing super related posts"/>' . __('I stopped showing Super related posts on my site', 'web_stories_enhancer') . '</label></li>',
		3 => '<li><label><input type="radio" name="websten_disable_reason" value="missing feature"/>' . __('I miss a feature', 'web_stories_enhancer') . '</label></li>
		<li><input type="text" name="websten_disable_text[]" value="" placeholder="Please describe the feature"/></li>',
		4 => '<li><label><input type="radio" name="websten_disable_reason" value="technical issue"/>' . __('Technical Issue', 'web_stories_enhancer') . '</label></li>
		<li><textarea name="websten_disable_text[]" placeholder="' . __('Can we help? Please describe your problem', 'web_stories_enhancer') . '"></textarea></li>',
		5 => '<li><label><input type="radio" name="websten_disable_reason" value="other plugin"/>' . __('I switched to another plugin', 'web_stories_enhancer') .  '</label></li>
		<li><input type="text" name="websten_disable_text[]" value="" placeholder="Name of the plugin"/></li>',
		6 => '<li><label><input type="radio" name="websten_disable_reason" value="other"/>' . __('Other reason', 'web_stories_enhancer') . '</label></li>
		<li><textarea name="websten_disable_text[]" placeholder="' . __('Please specify, if possible', 'web_stories_enhancer') . '"></textarea></li>',
    );
shuffle($reasons);
?>


<div id="websten-reloaded-feedback-overlay" style="display: none;">
    <div id="websten-reloaded-feedback-content">
	<form action="" method="post">
	    <h3><strong><?php _e('If you have a moment, please let us know why you are deactivating:', 'web_stories_enhancer'); ?></strong></h3>
	    <ul>
                <?php 
                foreach ($reasons as $reason){
                    echo $reason;
                }
                ?>
	    </ul>
	    <?php if ($email) : ?>
    	    <input type="hidden" name="websten_disable_from" value="<?php echo $email; ?>"/>
	    <?php endif; ?>
	    <input id="websten-reloaded-feedback-submit" class="button button-primary" type="submit" name="websten_disable_submit" value="<?php _e('Submit & Deactivate', 'web_stories_enhancer'); ?>"/>
	    <a class="button"><?php _e('Only Deactivate', 'web_stories_enhancer'); ?></a>
	    <a class="websten-feedback-not-deactivate" href="#"><?php _e('Don\'t deactivate', 'web_stories_enhancer'); ?></a>
	</form>
    </div>
</div>