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

      public function SendMessage(string $title,string $message,int $priority = 0)
		{
			curl_setopt_array($ch = curl_init(), array(
			CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => array(
					"token" => $this->ReadPropertyString('ApplicationToken'),
					"user" => $this->ReadPropertyString('UserToken'),
					"device" => $this->ReadPropertyString('DeviceToken'),
					"title" => $title,
					"message" => $message,
					"priority" => $priority,
					"retry" => 30,
					"expire" => 120
					),
				CURLOPT_SAFE_UPLOAD => true,
				CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			return true;
		}
		
		public function SendMessageUrl(string $title,string $message,string $url ="", string $urlTitle ="",int $priority = 0)
		{
			curl_setopt_array($ch = curl_init(), array(
			CURLOPT_URL => "https://api.pushover.net/1/messages.json",
			CURLOPT_POSTFIELDS => array(
					"token" => $this->ReadPropertyString('ApplicationToken'),
					"user" => $this->ReadPropertyString('UserToken'),
					"device" => $this->ReadPropertyString('DeviceToken'),
					"title" => $title,
					"message" => $message,
					"url" => $url,
					"url_title" => $urlTitle,
					"priority" => $priority,
					"retry" => "30",
					"expire" => "120"
					),
				CURLOPT_SAFE_UPLOAD => true,
				CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			return true;
		}
		
		
		public function GlancesClear()
		{
			curl_setopt_array($ch = curl_init(), array(
			CURLOPT_URL => "https://api.pushover.net/1/glances.json",
			CURLOPT_POSTFIELDS => array(
					"token" => $this->ReadPropertyString('ApplicationToken'),
					"user" => $this->ReadPropertyString('UserToken'),
					"device" => $this->ReadPropertyString('DeviceToken'),
					"title" => "",
					"text" => "",
					"subtext" => "",
					"count" => "",
					"percent" => ""
					),
				CURLOPT_SAFE_UPLOAD => true,
				CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			return true;
			
		}
		
		public function Glances(string $title,string $text, string $subtext)
		{
			curl_setopt_array($ch = curl_init(), array(
			CURLOPT_URL => "https://api.pushover.net/1/glances.json",
			CURLOPT_POSTFIELDS => array(
					"token" => $this->ReadPropertyString('ApplicationToken'),
					"user" => $this->ReadPropertyString('UserToken'),
					"device" => $this->ReadPropertyString('DeviceToken'),
					"title" => $title,
					"text" => $text,
					"subtext" => $subtext
					),
				CURLOPT_SAFE_UPLOAD => true,
				CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			return true;
		}
		public function GlancesCount(int $count)
		{
			curl_setopt_array($ch = curl_init(), array(
			CURLOPT_URL => "https://api.pushover.net/1/glances.json",
			CURLOPT_POSTFIELDS => array(
					"token" => $this->ReadPropertyString('ApplicationToken'),
					"user" => $this->ReadPropertyString('UserToken'),
					"device" => $this->ReadPropertyString('DeviceToken'),
					"count" => $count,
					"percent" => "",
					),
				CURLOPT_SAFE_UPLOAD => true,
				CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			return true;
		}
		public function GlancesPercent(int $percent)
		{
			if($percent<0 || $percent>100) return false;
			
			curl_setopt_array($ch = curl_init(), array(
			CURLOPT_URL => "https://api.pushover.net/1/glances.json",
			CURLOPT_POSTFIELDS => array(
					"token" => $this->ReadPropertyString('ApplicationToken'),
					"user" => $this->ReadPropertyString('UserToken'),
					"device" => $this->ReadPropertyString('DeviceToken'),
					"percent" => $percent,
					"count" => "",
					),
				CURLOPT_SAFE_UPLOAD => true,
				CURLOPT_RETURNTRANSFER => true,
				));
			curl_exec($ch);
			curl_close($ch);
			return true;
		}
		
    }
