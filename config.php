<?php
/**
 * UI for Example Caldera Forms Processor
 *
 * Using the UI generator is way simpler than reverse engineering UI markup and provides for better forward-compatibility
 */
//echo Caldera_Forms_Processor_UI::config_fields( my_processor_contact_form_owner_processor_fields() );
?>
<div class="caldera-config-group">
	<label for="owner_whatsapp_number-{{_id}}">
		<?php esc_html_e('Number', 'caldera-forms'); ?>
	</label>
	<div class="caldera-config-field">
		<input
            id="owner_whatsapp_number-{{_id}}"
            type="text" class="block-input field-config magic-tag-enabled required" name="{{_name}}[owner_whatsapp_number]" value="{{owner_whatsapp_number}}"
        />
	</div>
</div>
<div class="caldera-config-group">
	<label for="whatsapp_message-{{_id}}">
		<?php esc_html_e('Message', 'caldera-forms'); ?>
	</label>
	<div class="caldera-config-field">
		<textarea
            id="whatsapp_message-{{_id}}"
            rows="6" class="block-input field-config required magic-tag-enabled" name="{{_name}}[whatsapp_message]">{{whatsapp_message}}</textarea>
	</div>
</div>
