### Pushover


#### Einstellungen der Geräte-Instanz

##### Application Token 
Token der Anwendung 

##### User Token 
Token des Users, an den die Nachricht gesendet werden soll

##### Device Token 
Token um ein Bestimmtes Gerät anzusprechen


#### Nachrichten Senden mit Priorität 0
```php
TUPO_SendMessage(12345/*instanz-ID*/,"Title","Message",0);
```

#### Nachrichten mit URL Senden
```php
TUPO_SendMessageUrl(12345/*instanz-ID*/,"Title","Message","https://google.de","Link zu google",0);
```

#### Nachrichten im HTML-Format senden
```php
SendMessageUrl(12345/*instanz-ID*/,"Title",'<b>Text</b>',"https://google.de","URL-Title",0/* priority */)
```


#### Nachrichten mit allen Parametern senden
```php
TUPO_SendMessageComplete(12345/*instanz-ID*/,"Title",'Text',"https://google.de","URL-Title",0/* priority */,0/* content is HTML */,30 /* retry */,60 /* expire */,'pianobar' /* sound */ );
```

#### Glances Text senden
```php
TUPO_Glances(12345/*instanz-ID*/,"Title","Text","subtext");
```
#### Glances Zähler setzen
```php
TUPO_GlancesCount(12345/*instanz-ID*/,-49);
```
#### Glances Prozentwert setzen (0 bis 100)
```php
TUPO_GlancesPercent(12345/*instanz-ID*/,98);
```
#### Glances Zurücksetzen
```php
TUPO_Glances(12345/*instanz-ID*/,"Title","Text","subtext");
```



