<?php

declare(strict_types=1);

return [
    'send_message' => 'Send WhatsApp Message',
    'modal_heading' => 'Send WhatsApp Message',
    'modal_description' => 'Send a message to a WhatsApp number.',
    'send' => 'Send Message',

    // Form fields
    'instance' => 'Instance',
    'instance_helper' => 'Select the WhatsApp instance to send the message from.',
    'number' => 'Phone Number',
    'number_helper' => 'Enter the phone number with country code (e.g., 5511999999999).',
    'type' => 'Message Type',
    'message' => 'Message',
    'message_placeholder' => 'Type your message here...',
    'caption' => 'Caption',
    'caption_placeholder' => 'Optional caption for the media...',
    'media' => 'Media File',
    'media_helper' => 'Upload the file to be sent.',

    // Location fields
    'latitude' => 'Latitude',
    'longitude' => 'Longitude',
    'location_name' => 'Location Name',
    'location_name_placeholder' => 'e.g., My Office',
    'location_address' => 'Address',
    'location_address_placeholder' => 'e.g., 123 Main St, City',

    // Contact fields
    'contact_name' => 'Contact Name',
    'contact_number' => 'Contact Phone',

    // Interactive (Buttons / CTA / PIX shared)
    'interactive_section' => 'Message Content',
    'interactive_description' => 'Body',
    'interactive_title' => 'Title',
    'interactive_footer' => 'Footer',

    // Reply buttons
    'reply_buttons' => 'Buttons (max 3)',
    'button_text' => 'Button Text',
    'button_id' => 'Button ID',

    // CTA buttons
    'cta_buttons' => 'CTA Buttons (max 2)',
    'cta_buttons_helper' => 'CTA buttons cannot be mixed with reply or PIX buttons.',
    'button_type' => 'Type',
    'button_type_reply' => 'Reply',
    'button_type_url' => 'URL',
    'button_type_call' => 'Call',
    'button_type_copy' => 'Copy',
    'button_value' => 'Value',
    'button_value_helper' => 'URL, phone number or text to copy depending on the button type.',

    // PIX
    'pix_section' => 'PIX',
    'pix_key' => 'PIX Key',
    'pix_key_type' => 'Key Type',
    'pix_key_random' => 'Random',
    'pix_name' => 'Receiver Name',
    'pix_currency' => 'Currency',
    'pix_amount' => 'Amount',
    'pix_amount_helper' => 'Optional. Leave blank to let the recipient type the amount.',

    // List
    'list_section' => 'List',
    'list_title' => 'List Title',
    'list_description' => 'Description',
    'list_button_text' => 'Button Label',
    'list_button_text_placeholder' => 'View options',
    'list_footer' => 'Footer',
    'list_sections' => 'Sections',
    'list_section_title' => 'Section Title',
    'list_section_rows' => 'Rows',
    'list_row_title' => 'Row Title',
    'list_row_id' => 'Row ID',
    'list_row_description' => 'Row Description',

    // Carousel
    'carousel_section' => 'Carousel',
    'carousel_message' => 'Message',
    'carousel_cards' => 'Cards',
    'carousel_image_url' => 'Image URL',
    'carousel_image_helper' => 'Optional. Single-card-without-image falls back to native flow for iOS compatibility.',
    'carousel_header' => 'Header',
    'carousel_footer' => 'Footer',
    'carousel_body' => 'Body',
    'carousel_buttons' => 'Card Buttons',

    // Notifications
    'success_title' => 'Message Sent!',
    'success_body' => 'Your WhatsApp message has been sent successfully.',
    'error_title' => 'Failed to Send',
    'missing_required_fields' => 'Instance ID and phone number are required.',
    'unsupported_type' => 'Unsupported message type.',
];
