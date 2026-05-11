<?php

declare(strict_types=1);

return [
    'send_message' => 'Enviar Mensagem WhatsApp',
    'modal_heading' => 'Enviar Mensagem WhatsApp',
    'modal_description' => 'Envie uma mensagem para um número do WhatsApp.',
    'send' => 'Enviar Mensagem',

    // Form fields
    'instance' => 'Instância',
    'instance_helper' => 'Selecione a instância do WhatsApp para enviar a mensagem.',
    'number' => 'Número de Telefone',
    'number_helper' => 'Digite o número com código do país (ex: 5511999999999).',
    'type' => 'Tipo de Mensagem',
    'message' => 'Mensagem',
    'message_placeholder' => 'Digite sua mensagem aqui...',
    'caption' => 'Legenda',
    'caption_placeholder' => 'Legenda opcional para a mídia...',
    'media' => 'Arquivo de Mídia',
    'media_helper' => 'Faça upload do arquivo a ser enviado.',

    // Location fields
    'latitude' => 'Latitude',
    'longitude' => 'Longitude',
    'location_name' => 'Nome do Local',
    'location_name_placeholder' => 'ex: Meu Escritório',
    'location_address' => 'Endereço',
    'location_address_placeholder' => 'ex: Rua Principal, 123, Cidade',

    // Contact fields
    'contact_name' => 'Nome do Contato',
    'contact_number' => 'Telefone do Contato',

    // Interativos (Botões / CTA / PIX compartilhados)
    'interactive_section' => 'Conteúdo da Mensagem',
    'interactive_description' => 'Corpo',
    'interactive_title' => 'Título',
    'interactive_footer' => 'Rodapé',

    // Botões de resposta
    'reply_buttons' => 'Botões (máx. 3)',
    'button_text' => 'Texto do Botão',
    'button_id' => 'ID do Botão',

    // Botões CTA
    'cta_buttons' => 'Botões CTA (máx. 2)',
    'cta_buttons_helper' => 'Botões CTA não podem ser misturados com botões de resposta ou PIX.',
    'button_type' => 'Tipo',
    'button_type_reply' => 'Resposta',
    'button_type_url' => 'URL',
    'button_type_call' => 'Ligar',
    'button_type_copy' => 'Copiar',
    'button_value' => 'Valor',
    'button_value_helper' => 'URL, telefone ou texto a copiar conforme o tipo do botão.',

    // PIX
    'pix_section' => 'PIX',
    'pix_key' => 'Chave PIX',
    'pix_key_type' => 'Tipo de Chave',
    'pix_key_random' => 'Aleatória',
    'pix_name' => 'Nome do Recebedor',
    'pix_currency' => 'Moeda',
    'pix_amount' => 'Valor',
    'pix_amount_helper' => 'Opcional. Deixe em branco para o destinatário informar o valor.',

    // Lista
    'list_section' => 'Lista',
    'list_title' => 'Título da Lista',
    'list_description' => 'Descrição',
    'list_button_text' => 'Texto do Botão',
    'list_button_text_placeholder' => 'Ver opções',
    'list_footer' => 'Rodapé',
    'list_sections' => 'Seções',
    'list_section_title' => 'Título da Seção',
    'list_section_rows' => 'Itens',
    'list_row_title' => 'Título do Item',
    'list_row_id' => 'ID do Item',
    'list_row_description' => 'Descrição do Item',

    // Carrossel
    'carousel_section' => 'Carrossel',
    'carousel_message' => 'Mensagem',
    'carousel_cards' => 'Cards',
    'carousel_image_url' => 'URL da Imagem',
    'carousel_image_helper' => 'Opcional. Um único card sem imagem utiliza o native flow para compatibilidade com iOS.',
    'carousel_header' => 'Cabeçalho',
    'carousel_footer' => 'Rodapé',
    'carousel_body' => 'Corpo',
    'carousel_buttons' => 'Botões do Card',

    // Notifications
    'success_title' => 'Mensagem Enviada!',
    'success_body' => 'Sua mensagem WhatsApp foi enviada com sucesso.',
    'error_title' => 'Falha ao Enviar',
    'missing_required_fields' => 'ID da instância e número de telefone são obrigatórios.',
    'unsupported_type' => 'Tipo de mensagem não suportado.',
];
