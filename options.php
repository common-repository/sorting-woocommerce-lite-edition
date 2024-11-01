<?php if( !empty( $_GET['settings-updated'] ) ): ?>
	<div class="updated fade">
		<p>
			Settings saved.
		</p>
	</div>
<?php endif; ?>
<div class="wrap">
	<table class="widefat fixed">
        <thead>
            <tr>
                <th>Info</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <center>
                      <p>If you like the plugin, consider Donating. 
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="9PHTXEZUSVC9G">
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                            <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                        </form>
                    </p>  
                    </center>
                </td>
            </tr>
            <tr>
                <td>
                    <div>
                        <center>
                        <h3>Check out the <a href="http://www.galalaly.me/index.php/product/sorting-woocommerce/" target="_blank">Sorting WooCommerce by Custom Attributes PRO plugin</a>.</h3>
                        <p>The plugin gives you complete control over sorting the products in your WooCommerce shop page and the sorting dropdown list.</p>
                        <img src="<?php echo sorting_woocommerce_lite_url; ?>/sorting-woocommerce-thumbnail.png" />
                        </center>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                	<center>
                    	Should you have any questions, please don't hesitate to contact me: contact@galalaly.me
                	</center>
                </td>
            </tr>
        </tbody>
    </table>
    <h2>Sorting WooCommerce Lite</h2>
    <p>The lite version allows you to override the labels in the dropdown menu of the sorting.</p>
    <form action="options.php" method="POST">
    	<?php settings_fields('sorting-woocommerce-lite-options-group'); ?>
		<table class="form-table">
			<?php foreach( $this->defaults as $key => $default_label ): ?>
	        <tr valign="top">
	        <th scope="row"><?php echo $default_label; ?></th>
	        <?php
	        	$current_label = $default_label;
	        	if( ! empty( $this->labels[ $key ]['label'] ) ) {
	        		$current_label = $this->labels[ $key ]['label'];
	        	}
	        ?>
	        <td><input type="text" name="sorting-woocommerce-lite-options[<?php echo $key; ?>][label]" value="<?php echo $current_label; ?>" /></td>
	        </tr>
	        <tr valign="top">
	    		<th scope="row"></th>
	    		<?php
	    			$checked = '';
	    			if( !empty( $this->labels[ $key ]['hide'] ) ) {
	    				$checked = 'checked';
	    			}
	    		?>
	    		<td><input type="checkbox" name="sorting-woocommerce-lite-options[<?php echo $key; ?>][hide]" <?php echo $checked; ?> /> Hide</td>
	    	</tr>
	    	<?php endforeach; ?>
	    	<tr valign="top">
	    		<th scope="row"></th>
	    		<td><input type="submit" class="button button-primary" value="Save" /></td>
	    	</tr>
	    </table>
    </form>
</div>