<?php
/*
Plugin Name: Magento
Plugin URI: http://stunningcodes.co.nf
Description: A plugin to create widgets in WordPress
Version: 1.0
Author: Makas Rock
Author URI: http://stunningcodes.com
*/


add_action('add_meta_boxes','boj_mbe_create');
	
	function boj_mbe_create() {
		add_meta_box( 'boj-meta','My Custom Meta Box','boj_mbe_function','post','normal','high');
	}
	function boj_mbe_function() {
		$boj_mbe_name = get_post_meta( $post-> ID, '_boj_mbe_named', true );
		$boj_mbe_costume = get_post_meta( $post-> ID, '_boj_mbe_costumed', true );
		echo 'Please fill out the information belowd';
	?>
	<p> Name: <input type="text" name="boj_mbe_name" value="<?php echo esc_attr( $boj_mbe_name ); ?> " / > </p>
	<p> Costume:
		<select name="boj_mbe_costume" >
			<option value="vampire" <?php selected( $boj_mbe_costume, 'vampire' ); ?> >Vampire</option>
			<option value="zombie" <?php selected( $boj_mbe_costume,'zombie' ); ?> >Zombie</option >
			<option value="smurf" <?php selected( $boj_mbe_costume, 'smurf' ); ?> >Smurf</option>
		</select>
	</p>
	<?php
	}
	//Nothings done

add_action( 'save_post', 'boj_mbe_save_meta' );

function boj_mbe_save_meta( $post_id ) {
//verify the metadata is set
	if ( isset( $_POST['boj_mbe_name'] ) ) {
	//save the metadata
		update_post_meta( $post_id,'_boj_mbe_name',strip_tags($_POST['boj_mbe_name'] ) );

		update_post_meta( $post_id,'_boj_mbe_costume',strip_tags($_POST['boj_mbe_costume'] ) );

	}
}

?>