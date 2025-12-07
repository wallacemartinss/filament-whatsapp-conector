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

    // Notifications
    'success_title' => 'Message Sent!',
    'success_body' => 'Your WhatsApp message has been sent successfully.',
    'error_title' => 'Failed to Send',
    'missing_required_fields' => 'Instance ID and phone number are required.',
    'unsupported_type' => 'Unsupported message type.',
];
