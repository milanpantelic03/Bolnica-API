## Bolnica API

Bolnica API je bekend projekat nastao u php frameworku Laravel. Obrađuje GET, POST, DELETE I PATCH requestove i omogućava zamišljenom frontendu da komunicira sa
mySQL bazom podataka koja je srž celog API- ja! Za lakši pregled API - ja napravio sam frontend interfejs koristeći JavaScript, HTML i CSS koji se nalazi na index stranici URL-a <a href = "https://bolnica-api.herokuapp.com/"> OVDE </a>, međutim, ako želite spisak svih ENDPOINTOVA sastavio sam listu:

## Endpoints:
- (GET) <a href = "https://bolnica-api.herokuapp.com/api/pacijenti">https://bolnica-api.herokuapp.com/api/pacijenti</a>   -> Izbacuje listu svih pacijenata u bazi podataka koji se izvlace iz posebne tabele "pacijenti"
- (GET) <a href = "https://bolnica-api.herokuapp.com/api/dijagnoze">https://bolnica-api.herokuapp.com/api/dijagnoze</a>   -> Izbacuje listu svih dijagnoza u bazi podataka koje se izvlace iz posebne table "dijagnoze". Dijagnoze su logički povezane sa pacijentima putem BROJA KARTONA, koji se pri kreiranju pacijenta POST requestom automatski generiše i ubacuje u tabelu "pacijenti", a kasnije služi kao dopuna endpointu POST requesta za kreiranje dijagnoza, da bi backend logički povezao dijagnozu i pacijenta!
- (GET) <a>https://bolnica-api.herokuapp.com/api/pacijenti/{broj_kartona} </a> -> Izbacuje pacijenta sa specifičnim brojem kartona
- (GET) <a>https://bolnica-api.herokuapp.com/api/dijagnoze/{broj_kartona} </a> -> Izbacuje sve dijagnoze pacijenta sa dodatim brojem kartona

- (POST) <a>https://bolnica-api.herokuapp.com/api/pacijenti</a>  -> Kreira pacijenta tako što iz requesta izvlaci "ime" i "prezime", a BROJ kartona se automatski kreira i skladišti u bazu podataka radi logičkog povezivanja sa tabelom "dijagnoze"!
- (POST) <a>https://bolnica-api.herokuapp.com/api/dijagnoze</a>  -> Kreira dijagnozu tako što iz requesta izvlači "naziv_bolesti", "trenutna_terapija", "stanje_pacijenta", i "broj_kartona". Broj kartona dalje u bekendu prolazi kroz proveru da li pacijent sa tim brojem kartona postoji, ako postoji dijagnoza će biti kreirana i spakovana u bazu podataka!

- (DELETE) <a>https://bolnica-api.herokuapp.com/api/pacijenti/{broj_kartona}</a> -> Briše pacijenta sa unetim brojem kartona u endpoint
- (DELETE) <a>https://bolnica-api.herokuapp.com/api/dijagnoze/{id}</a> -> Briše dijagnozu čiji je id unet u {id}, id dijagnoze se može izvući GET requestom ka dijagnozama

- (PATCH) <a>https://bolnica-api.herokuapp.com/api/pacijenti/{broj_kartona}</a> -> Menja "ime" i "prezime" ili i "ime" i "prezime" pacijenta u zavisnosti šta pošaljete u PATCH requestu preko broja kartona
- (PATCH)<a>https://bolnica-api.herokuapp.com/api/dijagnoze/{id}</a> -> Menja parametre dijagnoze targetovane preko id-ja, Parametri: "naziv_bolesti", "trenutna_terapija", "stanje_pacijenta", BROJ KARTONA nije moguće izmeniti jer je on konstantan za svakog pacijenta.

## Deploy:
Za deploy ovog projekta koristio sam heroku, kojeg sam konfigurisao da prati izmene main brancha ovog repozitorijuma!
