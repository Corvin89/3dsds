<?php
$prefix_serg = "clients_";

$info_box_serg = array(
	'id' => 'URL_Clients',
	'title' => 'Custom Fields',
	'page' => 'clients',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	array(
			'name' => 'URL_Clients',
			'desc' => '',
			'id' => 'URL_Clients',
			'type' => 'text',
			'std' => ''
		),

	)
);

add_action('admin_menu', 'event_add_box_serg');

// Add meta box
function event_add_box_serg() {
    global $info_box_serg;
    $meta_box = $info_box_serg;
	add_meta_box($meta_box['id'], $meta_box['title'], 'event_show_box_info_serg', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

function event_show_box_info_serg() {
    global $info_box_serg;
    event_show_box($info_box_serg, 'event_meta_box_info_nonce_serg');
}

function event_show_box_serg($meta_box, $nonce) {
	global $post;

	// Use nonce for verification
	echo '<input type="hidden" name="'.$nonce.'" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br />', $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
			case 'datepicker':
				echo '<input type="text" class="datepicker" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br />', $field['desc'];
				break;
		}
		echo 	'<td>',
			'</tr>';
	}

	echo '</table>';
}