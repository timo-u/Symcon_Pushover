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
TUPO_SendMessage(12345,"Title","Message",0
```

#### Nachrichten mit URL Senden
```php
TUPO_SendMessageUrl(12345,"Title","Message","https://google.de","Link zu google",0);
```

#### Glances Text senden
```php
TUPO_Glances(23345,"Title","Text","subtext");
```
#### Glances Zähler setzen
```php
TUPO_GlancesCount(12345,-49);
```
#### Glances Prozentwert setzen (0 bis 100)
```php
TUPO_GlancesPercent(12345,98);
```
#### Glances Zurücksetzen
```php
TUPO_Glances(23345,"Title","Text","subtext");
```