<select name="<?php echo esc_attr( $name ); ?>"
	<?php echo MWF_Functions::generate_input_attribute( 'id', $id ); ?>
	<?php echo MWF_Functions::generate_input_attribute( 'class', $class ); ?>
>
	<?php foreach ( $children as $option_value => $option_label ) : ?>
		<?php
			if ( strpos( $option_label, '/optgroup-' ) === 0 ) {
				echo '</optgroup>';
				continue;
			}
			if ( strpos( $option_label, 'optgroup-' ) === 0 ) {
				echo '<optgroup label="' . esc_html( substr( $option_label, strpos( $option_label, '-' ) + 1 ) ) . '">';
				continue;
			}
		?>
		<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $option_value, $value, true ); ?> <?php echo $option_label == '選択してください' ? 'disabled selected' : ''; ?>>
			<?php echo esc_html( $option_label ); ?>
		</option>
	<?php endforeach; ?>
</select>