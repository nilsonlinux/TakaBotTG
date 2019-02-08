<?php

// CORE DEL BOT

// NON FINITO

// PROSSIMAMENTE DISPONIBILE LA WIKI SU GITHUB
// NON MODIFICARE QUESTO FILE, A MENO CHE TU NON
// ABBIA BUONE BASI DI PROGRAMMAZIONE PHP.

class TakaBot
{

	public function __construct($input)
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, [
            CURLOPT_POST           => true,
            CURLOPT_FORBID_REUSE   => true,
            CURLOPT_RETURNTRANSFER => true,
            ]);
        $this->input = $input;
        $this->update = json_decode($this->input, true);
        if (!empty($this->update)) {
            $this->chat_id = $this->update['message']['chat']['id'];
            $this->user_id = $this->update['message']['from']['id'];
            $this->is_bot = $this->update['message']['from']['is_bot'];
            $this->first_name = htmlspecialchars($this->update['message']['from']['first_name']);
            $this->last_name = htmlspecialchars($this->update['message']['from']['last_name']);
            $this->username = htmlspecialchars($this->update['message']['from']['username']);
            $this->type = $this->update['message']['chat']['type'];
            $this->document = $this->update['message']['document'];
            $this->photo = $this->update['message']['photo'];
            $this->video = $this->update['message']['video'];
            $this->location = $this->update['message']['location'];
            if ($this->type == 'supergroup' or $this->type == 'group' or $this->type == 'channel') {
                $this->title = $this->update['message']['chat']['title'];
                if ($this->type == 'group') {
                    $this->all_members_are_administrators = $this->update['message']['chat']['all_members_are_administrators'];
                }
            }
            if (isset($this->photo)) {
                $this->photo_name = $this->update['message']['photo']['file_name'];
                $this->photo_mime_type = $this->update['message']['photo']['mime_type'];
                $this->photo_file_id = $this->update['message']['photo'][0]['file_id'];
                $this->photo_file_size = $this->update['message']['photo']['file_size'];
            }
            if (isset($this->document)) {
                $this->document_name = $this->update['message']['document']['file_name'];
                $this->document_mime_type = $this->update['message']['document']['mime_type'];
                $this->document_file_id = $this->update['message']['document']['file_id'];
                $this->document_file_size = $this->update['message']['document']['file_size'];
            }
            if (isset($this->video)) {
                $this->video_name = $this->update['message']['video']['file_name'];
                $this->video_mime_type = $this->update['message']['video']['mime_type'];
                $this->video_file_id = $this->update['message']['video']['file_id'];
                $this->video_file_size = $this->update['message']['video']['file_size'];
            }
            if (isset($this->location)) {
                $this->longitude = $this->update['message']['location']['longitude'];
                $this->latitude = $this->update['message']['location']['latitude'];
            }
            $this->text = $this->update['message']['text'];
            $this->message_id = $this->update['message']['message_id'];
            $this->reply_to_message = $this->update['message']['reply_to_message'];
            if (isset($this->reply_to_message)) {
                $this->reply_to_message_text = $this->update['message']['reply_to_message']['text'];
                $this->reply_to_message_id = $this->update['message']['reply_to_message']['message_id'];
                $this->reply_to_message_first_name = $this->update['message']['reply_to_message']['from']['first_name'];
                $this->reply_to_message_last_name = $this->update['message']['reply_to_message']['from']['last_name'];
                $this->reply_to_message_username = $this->update['message']['reply_to_message']['from']['username'];
                $this->reply_to_message_user_id = $this->update['message']['reply_to_message']['from']['id'];
                $this->reply_to_message_language_code = $this->update['message']['reply_to_message']['from']['language_code'];
                $this->reply_to_message_is_bot = $this->update['message']['reply_to_message']['from']['is_bot'];
                if (isset($this->update['message']['reply_to_message']['photo'])) {
                    $this->reply_photo = $this->update['message']['reply_to_message']['photo'];
                    $this->reply_photo_file_id = $this->update['message']['reply_to_message']['photo'][0]['file_id'];
                    $this->reply_photo_caption = $this->update['message']['reply_to_message']['caption'];
                }
                if (isset($this->update['message']['reply_to_message']['document'])) {
                    $this->reply_document = $this->update['message']['reply_to_message']['document'];
                    $this->reply_document_file_id = $this->update['message']['reply_to_message']['document']['file_id'];
                    $this->reply_document_caption = $this->update['message']['reply_to_message']['caption'];
                }
                if (isset($this->update['message']['reply_to_message']['video'])) {
                    $this->reply_video = $this->update['message']['reply_to_message']['video'];
                    $this->reply_video_file_id = $this->update['message']['reply_to_message']['video']['file_id'];
                    $this->reply_video_caption = $this->update['message']['reply_to_message']['caption'];
                }
            }
            if (isset($this->update['channel_post'])) {
                $this->chat_id = $this->update['channel_post']['chat']['id'];
                $this->text = $this->update['channel_post']['text'];
                $this->message_id = $this->update['channel_post']['message_id'];
                $this->reply_to_message_id = $this->update['channel_post']['reply_to_message']['message_id'];
                $this->reply_to_message_title = htmlspecialchars($this->update['channel_post']['reply_to_message']['chat']['title']);
                $this->type = $this->update['channel_post']['chat']['type'];
                $this->author = $this->update['channel_post']['author_signature'];
                $this->date = $this->update['channel_post']['date'];
            } else {
                if (isset($this->update['edited_message'])) {
                    $this->text = $this->update['edited_message']['text'];
                    $this->edited_message_id = $this->update['edited_message']['message_id'];
                    $this->user_id = $this->update['edited_message']['from']['id'];
                    $this->is_bot = $this->update['edited_message']['from']['is_bot'];
                    $this->first_name = htmlspecialchars($this->update['message']['from']['first_name']);
                    $this->last_name = htmlspecialchars($this->update['message']['from']['last_name']);
                    $this->username = htmlspecialchars($this->update['message']['from']['username']);
                    $this->language_code = $this->update['edited_message']['from']['language_code'];
                    $this->chat_id = $this->update['edited_message']['chat']['id'];
                    $this->type = $this->update['edited_message']['chat']['type'];
                    $this->author = $this->update['edited_message']['author_signature']; //e pensare che volevi subito la risposta
                    if ($this->type == 'supergroup' or $this->type == 'group') {
                        $this->title = htmlspecialchars($this->update['edited_message']['chat']['title']);
                        if ($this->type == 'group') {
                            $this->all_members_are_administrators = $this->update['edited_message']['chat']['all_members_are_administrators'];
                        }
                    }
                    $this->reply_to_message_id = $this->update['edited_message']['message']['reply_to_message']['message_id'];
                    $this->reply_to_message_first_name = htmlspecialchars($this->update['edited_message']['message']['reply_to_message']['from']['first_name']);
                    $this->reply_to_message_last_name = htmlspecialchars($this->update['edited_message']['message']['reply_to_message']['from']['last_name']);
                    $this->reply_to_message_username = htmlspecialchars($this->update['edited_message']['message']['reply_to_message']['from']['username']);
                    $this->reply_to_message_user_id = $this->update['edited_message']['message']['reply_to_message']['from']['id'];
                    $this->reply_to_message_language_code = $this->update['edited_message']['message']['reply_to_message']['from']['language_code'];
                    $this->reply_to_message_is_bot = $this->update['edited_message']['message']['reply_to_message']['from']['is_bot'];
                    $this->date = $this->update['edited_message']['date'];
                    $this->edit_date = $this->update['edited_message']['edit_date'];
                    $this->location = $this->update['edited_message']['location'];
                    if (isset($this->location)) {
                        $this->edited_longitude = $this->update['edited_message']['location']['longitude'];
                        $this->edited_latitude = $this->update['edited_message']['location']['latitude'];
                    }
                }
                if (isset($this->update['edited_channel_post'])) {
                    $this->text = $this->update['edited_channel_post']['text'];
                    $this->edited_message_id = $this->update['edited_channel_post']['message_id'];
                    $this->user_id = $this->update['edited_channel_post']['from']['id'];
                    $this->is_bot = $this->update['edited_channel_post']['from']['is_bot'];
                    $this->first_name = htmlspecialchars($this->update['edited_channel_post']['from']['first_name)']);
                    $this->last_name = htmlspecialchars($this->update['edited_channel_post']['from']['last_name']);
                    $this->username = htmlspecialchars($this->update['edited_channel_post']['from']['username']);
                    $this->language_code = $this->update['edited_channel_post']['from']['language_code'];
                    $this->chat_id = $this->update['edited_channel_post']['chat']['id'];
                    $this->type = $this->update['edited_channel_post']['chat']['type'];
                    $this->author = $this->update['edited_channel_post']['author_signature'];
                    $this->date = $this->update['edited_channel_post']['date'];
                    $this->edit_date = $this->update['edited_channel_post']['edit_date'];
                    $this->reply_to_message_id = $this->update['edited_channel_post']['message']['reply_to_message']['message_id'];
                    $this->reply_to_message_first_name = htmlspecialchars($this->update['edited_channel_post']['message']['reply_to_message']['from']['first_name']);
                    $this->reply_to_message_last_name = htmlspecialchars($this->update['edited_channel_post']['message']['reply_to_message']['from']['last_name']);
                    $this->reply_to_message_username = htmlspecialchars($this->update['edited_channel_post']['message']['reply_to_message']['from']['username']);
                    $this->reply_to_message_user_id = $this->update['edited_channel_post']['message']['reply_to_message']['from']['id'];
                    $this->reply_to_message_language_code = $this->update['edited_channel_post']['message']['reply_to_message']['from']['language_code'];
                    $this->reply_to_message_is_bot = $this->update['edited_channel_post']['message']['reply_to_message']['from']['is_bot'];
                    $this->location = $this->update['edited_channel_post']['location'];
                    if (isset($this->location)) {
                        $this->edited_longitude = $this->update['edited_channel_post']['location']['longitude'];
                        $this->edited_latitude = $this->update['edited_channel_post']['location']['latitude'];
                    }
                }
                $this->cbdata = $this->update['callback_query'];
                if (isset($this->cbdata)) {
                    $this->message_id = $this->update['callback_query']['message']['message_id'];
                    $this->chat_id = $this->update['callback_query']['message']['chat']['id'];
                    $this->user_id = $this->update['callback_query']['from']['id'];
                    $this->cbdata_text = $this->update['callback_query']['data'];
                    $this->first_name = htmlspecialchars($this->update['callback_query']['from']['first_name']);
                    $this->last_name = htmlspecialchars($this->update['callback_query']['from']['last_name']);
                    $this->username = htmlspecialchars($this->update['callback_query']['from']['username']);
                    $this->is_bot = $this->update['callback_query']['from']['is_bot'];
                    $this->language_code = $this->update['callback_query']['from']['language_code'];
                    $this->type = $this->update['callback_query']['message']['chat']['type'];
                    if ($this->type == 'supergroup' or $this->type == 'group') {
                        $this->title = $this->update['callback_query']['message']['chat']['title'];
                    }
                    $this->cbid = $this->update['callback_query']['id'];
                    $this->author = $this->update['callback_query']['author_signature'];
                    $this->reply_to_message_id = $this->update['callback_query']['message']['reply_to_message']['message_id'];
                    $this->reply_to_message_first_name = htmlspecialchars($this->update['callback_query']['message']['reply_to_message']['from']['first_name']);
                    $this->reply_to_message_last_name = htmlspecialchars($this->update['callback_query']['message']['reply_to_message']['from']['last_name']);
                    $this->reply_to_message_username = htmlspecialchars($this->update['callback_query']['message']['reply_to_message']['from']['username']);
                    $this->reply_to_message_user_id = $this->update['callback_query']['message']['reply_to_message']['from']['id'];
                    $this->reply_to_message_language_code = $this->update['callback_query']['message']['reply_to_message']['from']['language_code'];
                    $this->reply_to_message_is_bot = $this->update['callback_query']['message']['reply_to_message']['from']['is_bot'];
                }
            }
        }
    }

    public function impostazioni($impostazioni = ['disable_web_page_preview' => 'false', 'parse_mode' => 'HTML'])
    {
        $this->settings = $impostazioni;
    }

    public function isAdmin($userID)
    {
    	if($userID == null){
    		//TO-DO
    	}
    	foreach($this->settings["admin"] as $admin){
    		if($userID == $admin){
    			return true;
    		}
    	}
    }

    private function richiesta($link, $data = [])
    {
        curl_setopt_array($this->curl, [
            CURLOPT_URL        => 'https://api.telegram.org/bot'.$this->token.$link,
            CURLOPT_POSTFIELDS => $data,
        ]);

        return curl_exec($this->curl);
    }

    public function infoBot($info)
    {
        $get = json_decode(self::richiesta('/getme'), true);
        if ($info == 'username') {
            return $get['result']['username'];
        } elseif ($info == 'nome') {
            return $get['result']['first_name'];
        } elseif ($info == 'id') {
            return $get['result']['id'];
        }
    }

    public function inviaMessaggio($chatID, $text, $reply_markup = false, $button_type = 'inline', $reply_to_message_id = null, $parse_mode = null, $disable_web_page_preview = null)
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'                  => $chatID,
            'text'                     => $text,
            'parse_mode'               => $parse_mode,
            'reply_to_message_id'      => $reply_to_message_id,
            'disable_web_page_preview' => $this->settings['disable_web_page_preview'],
        ];
        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return json_decode(self::richiesta('/sendMessage', $args), true);
    }

    public function inviaFoto($chatID, $foto, $didascalia = null, $reply_markup = false, $parse_mode = null, $reply_to_message_id = null, $disable_notification = false, $button_type = 'inline')
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'              => $chatID,
            'photo'                => $foto,
            'caption'              => $didascalia,
            'parse_mode'           => $parse_mode,
            'disable_notification' => $disable_notification,
            'reply_to_message_id'  => $reply_to_message_id,
        ];

        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return self::richiesta('/SendPhoto', $args);
    }

    public function inviaAudio($chatID, $audio, $didascalia = null, $reply_to_message_id = null, $reply_markup = false, $parse_mode = null, $durata = null, $artista = null, $titolo = null, $disable_notification = false)
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'              => $chatID,
            'audio'                => $audio,
            'caption'              => $didascalia,
            'reply_to_message_id'  => $reply_to_message_id,
            'duration'             => $durata,
            'performer'            => $artista,
            'title'                => $titolo,
            'disable_notification' => $disable_notification,
            'parse_mode'           => $parse_mode,
        ];
        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return self::richiesta('/sendAudio', $args);
    }

    public function inviaFile($chatID, $file, $didascalia = null, $reply_to_message_id = null, $reply_markup = false, $thumb = null, $parse_mode = null, $disable_notification = false)
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'              => $chatID,
            'document'             => $file,
            'thumb'                => $thumb,
            'caption'              => $didascalia,
            'parse_mode'           => $parse_mode,
            'reply_to_message_id'  => $reply_to_message_id,
            'disable_notification' => $disable_notification,
        ];
        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return self::richiesta('/sendDocument', $args);
    }

    public function inviaVideo($chatID, $video, $didascalia = false, $reply_markup = false, $reply_to_message_id = false, $parse_mode = false, $support_streaming = true, $thumb = false, $width = false, $height = false, $disable_notification = false)
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'              => $chatID,
            'video'                => $video,
            'caption'              => $didascalia,
            'parse_mode'           => $parse_mode,
            'reply_to_message_id'  => $reply_to_message_id,
            'support_streaming'    => $support_streaming,
            'thumb'                => $thumb,
            'width'                => $width,
            'height'               => $height,
            'disable_notification' => $disable_notification,
        ];
        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return self::richiesta('/sendVideo', $args);
    }

    public function inviaVideoMessaggio($chatID, $video, $didascalia = false, $reply_markup = false, $reply_to_message_id = false, $parse_mode = false, $support_streaming = true, $thumb = false, $width = false, $height = false, $disable_notification = false)
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'              => $chatID,
            'video_note'           => $video,
            'caption'              => $didascalia,
            'parse_mode'           => $parse_mode,
            'reply_to_message_id'  => $reply_to_message_id,
            'thumb'                => $thumb,
            'disable_notification' => $disable_notification,
        ];
        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return self::richiesta('/sendVideoNote', $args);
    }

    public function inviaGIF($chatID, $gif, $didascalia = false, $reply_markup = false, $reply_to_message_id = false, $parse_mode = false, $thumb = false, $width = false, $height = false, $disable_notification = false)
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'              => $chatID,
            'animation'            => $gif,
            'caption'              => $didascalia,
            'parse_mode'           => $parse_mode,
            'reply_to_message_id'  => $reply_to_message_id,
            'thumb'                => $thumb,
            'width'                => $width,
            'height'               => $height,
            'disable_notification' => $disable_notification,
        ];
        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return self::richiesta('/sendAnimation', $args);
    }

    public function inviaVocale($chatID, $vocale, $didascalia = false, $reply_markup = false, $reply_to_message_id = false, $parse_mode = false, $durata = null, $thumb = false, $width = false, $height = false, $disable_notification = false)
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'              => $chatID,
            'voice'				   => $vocale,
            'caption'              => $didascalia,
            'duration'             => $durata,
            'parse_mode'           => $parse_mode,
            'reply_to_message_id'  => $reply_to_message_id,
            'disable_notification' => $disable_notification,
        ];
        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return self::richiesta('/sendVoice', $args);
    }

    public function inviaAlbum($chatID, $media, $didascalia = false, $reply_markup = false, $reply_to_message_id = false, $disable_notification = false)
    {
        if ($parse_mode == null) {
            $parse_mode = $this->settings['parse_mode'];
        }
        $args = [
            'chat_id'              => $chatID,
            'media'				   => $media,
            'reply_to_message_id'  => $reply_to_message_id,
            'disable_notification' => $disable_notification,
        ];
        if ($reply_markup) {
            if ($button_type == 'inline') {
                $reply_markup = json_encode(['inline_keyboard' => $reply_markup]);
                $args['reply_markup'] = $reply_markup;
            } elseif ($button_type == 'button') {
                $reply_markup = json_encode(['keyboard' => $reply_markup, 'resize_keyboard' => true]);
                $args['reply_markup'] = $reply_markup;
            }
        }

        return self::richiesta('/sendMediaGroup', $args);
    }

}