<?php


    class Pushover extends IPSModule
    {
        public function Create()
        {
            parent::Create();

            $this->RegisterPropertyString('ApplicationToken', '');
            $this->RegisterPropertyString('UserToken', '');
            $this->RegisterPropertyString('DeviceToken', '');
        }

        public function ApplyChanges()
        {
            parent::ApplyChanges();
        }

        public function SendMessage(string $title, string $message, int $priority = 0)
        {
            return $this->SendMessageComplete($title, $message, '', '', $priority);
        }

        public function SendMessageHtml(string $title, string $message, int $priority = 0)
        {
            return $this->SendMessageComplete($title, $message, '', '', $priority, 1);
        }

        public function SendMessageUrl(string $title, string $message, string $url = '', string $urlTitle = '', int $priority = 0)
        {
            return $this->SendMessageComplete($title, $message, $url, $urlTitle, $priority);
        }

        public function SendMessageComplete(string $title, string $message, string $url = '', string $urlTitle = '', int $priority = 0, int $html = 0, int $retry = 30, int $expire = 3600, string $sound = '')
        {
            curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL        => 'https://api.pushover.net/1/messages.json',
            CURLOPT_POSTFIELDS => [
                    'token'     => $this->ReadPropertyString('ApplicationToken'),
                    'user'      => $this->ReadPropertyString('UserToken'),
                    'device'    => $this->ReadPropertyString('DeviceToken'),
                    'title'     => $title,
                    'message'   => $message,
                    'url'       => $url,
                    'url_title' => $urlTitle,
                    'priority'  => $priority,
                    'html'  	   => $html,
                    'sound'  	  => $sound,
                    'retry'     => $retry,
                    'expire'    => $expire,
                    ],
                CURLOPT_SAFE_UPLOAD    => true,
                CURLOPT_RETURNTRANSFER => true,
                ]);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response);
            if ($responseObject == null) {
                return false;
            }
            if ($responseObject->{'status'} == 1) {
                $this->SetStatus(102);

                return true;
            }
            if (property_exists($responseObject, 'user') && $responseObject->{'user'} == 'invalid') {
                $this->SetStatus(201);
            }
            if (property_exists($responseObject, 'token') && $responseObject->{'token'} == 'invalid') {
                $this->SetStatus(202);
            }

            IPS_LogMessage('Pushover', implode($responseObject->{'errors'}, ' ; '));

            return false;
        }

        public function SendMessageAttachment(string $title, string $message, string $attachment, int $priority = 0)
        {
            return $this->SendMessageAttachmentComplete($title, $message, $attachment);
        }

        public function SendMessageAttachmentComplete(string $title, string $message, string $attachment, string $url = '', string $urlTitle = '', int $priority = 0, int $html = 0, int $retry = 30, int $expire = 3600, string $sound = '')
        {
            $attachment = realpath($attachment);
            if (!file_exists($attachment)) {
                IPS_LogMessage('Pushover', 'file not found: '.$attachment);

                return false;
            }

            $cfile = new CURLFile($attachment);

            $post = [
                    'attachment'    => $cfile,
                    'token'     	   => $this->ReadPropertyString('ApplicationToken'),
                    'user'      	   => $this->ReadPropertyString('UserToken'),
                    'device'    	   => $this->ReadPropertyString('DeviceToken'),
                    'title'     	   => $title,
                    'message'   	   => $message,
                    'url'       	   => $url,
                    'url_title' 	   => $urlTitle,
                    'priority'  	   => $priority,
                    'html'  	   	   => $html,
                    'sound'  	  	   => $sound,
                    'retry'     	   => $retry,
                    'expire'    	   => $expire,
                    ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.pushover.net/1/messages.json');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response);
            if ($responseObject == null) {
                return false;
            }
            if ($responseObject->{'status'} == 1) {
                $this->SetStatus(102);

                return true;
            }
            if (property_exists($responseObject, 'user') && $responseObject->{'user'} == 'invalid') {
                $this->SetStatus(201);
            }
            if (property_exists($responseObject, 'token') && $responseObject->{'token'} == 'invalid') {
                $this->SetStatus(202);
            }

            IPS_LogMessage('Pushover', implode($responseObject->{'errors'}, ' ; '));

            return false;
        }

        public function GlancesClear()
        {
            curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL        => 'https://api.pushover.net/1/glances.json',
            CURLOPT_POSTFIELDS => [
                    'token'   => $this->ReadPropertyString('ApplicationToken'),
                    'user'    => $this->ReadPropertyString('UserToken'),
                    'device'  => $this->ReadPropertyString('DeviceToken'),
                    'title'   => '',
                    'text'    => '',
                    'subtext' => '',
                    'count'   => '',
                    'percent' => '',
                    ],
                CURLOPT_SAFE_UPLOAD    => true,
                CURLOPT_RETURNTRANSFER => true,
                ]);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response);
            if ($responseObject == null) {
                return false;
            }
            if ($responseObject->{'status'} == 1) {
                $this->SetStatus(102);

                return true;
            }
            if (property_exists($responseObject, 'user') && $responseObject->{'user'} == 'invalid') {
                $this->SetStatus(201);
            }
            if (property_exists($responseObject, 'token') && $responseObject->{'token'} == 'invalid') {
                $this->SetStatus(202);
            }

            IPS_LogMessage('Pushover', implode($responseObject->{'errors'}, ' ; '));

            return false;
        }

        public function Glances(string $title, string $text, string $subtext)
        {
            curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL        => 'https://api.pushover.net/1/glances.json',
            CURLOPT_POSTFIELDS => [
                    'token'   => $this->ReadPropertyString('ApplicationToken'),
                    'user'    => $this->ReadPropertyString('UserToken'),
                    'device'  => $this->ReadPropertyString('DeviceToken'),
                    'title'   => $title,
                    'text'    => $text,
                    'subtext' => $subtext,
                    ],
                CURLOPT_SAFE_UPLOAD    => true,
                CURLOPT_RETURNTRANSFER => true,
                ]);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response);
            if ($responseObject == null) {
                return false;
            }
            if ($responseObject->{'status'} == 1) {
                $this->SetStatus(102);

                return true;
            }
            if (property_exists($responseObject, 'user') && $responseObject->{'user'} == 'invalid') {
                $this->SetStatus(201);
            }
            if (property_exists($responseObject, 'token') && $responseObject->{'token'} == 'invalid') {
                $this->SetStatus(202);
            }

            IPS_LogMessage('Pushover', implode($responseObject->{'errors'}, ' ; '));

            return false;
        }

        public function GlancesCount(int $count)
        {
            curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL        => 'https://api.pushover.net/1/glances.json',
            CURLOPT_POSTFIELDS => [
                    'token'   => $this->ReadPropertyString('ApplicationToken'),
                    'user'    => $this->ReadPropertyString('UserToken'),
                    'device'  => $this->ReadPropertyString('DeviceToken'),
                    'count'   => $count,
                    'percent' => '',
                    ],
                CURLOPT_SAFE_UPLOAD    => true,
                CURLOPT_RETURNTRANSFER => true,
                ]);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response);
            if ($responseObject == null) {
                return false;
            }
            if ($responseObject->{'status'} == 1) {
                $this->SetStatus(102);

                return true;
            }
            if (property_exists($responseObject, 'user') && $responseObject->{'user'} == 'invalid') {
                $this->SetStatus(201);
            }
            if (property_exists($responseObject, 'token') && $responseObject->{'token'} == 'invalid') {
                $this->SetStatus(202);
            }

            IPS_LogMessage('Pushover', implode($responseObject->{'errors'}, ' ; '));

            return false;
        }

        public function GlancesPercent(int $percent)
        {
            if ($percent < 0 || $percent > 100) {
                return false;
            }

            curl_setopt_array($ch = curl_init(), [
            CURLOPT_URL        => 'https://api.pushover.net/1/glances.json',
            CURLOPT_POSTFIELDS => [
                    'token'   => $this->ReadPropertyString('ApplicationToken'),
                    'user'    => $this->ReadPropertyString('UserToken'),
                    'device'  => $this->ReadPropertyString('DeviceToken'),
                    'percent' => $percent,
                    'count'   => '',
                    ],
                CURLOPT_SAFE_UPLOAD    => true,
                CURLOPT_RETURNTRANSFER => true,
                ]);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseObject = json_decode($response);
            if ($responseObject == null) {
                return false;
            }
            if ($responseObject->{'status'} == 1) {
                $this->SetStatus(102);

                return true;
            }
            if (property_exists($responseObject, 'user') && $responseObject->{'user'} == 'invalid') {
                $this->SetStatus(201);
            }
            if (property_exists($responseObject, 'token') && $responseObject->{'token'} == 'invalid') {
                $this->SetStatus(202);
            }

            IPS_LogMessage('Pushover', implode($responseObject->{'errors'}, ' ; '));

            return false;
        }
    }
