<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolnica API</title>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        //svi endpointovi 
        let getAllDijagnoze = "http://localhost:8000/api/dijagnoze";
        let osnovniAPIUrl = "https://localhost:80000/api/"
        function dijagnozePost(){
           
            let broj_kartona = document.querySelector(".broj_kartona").value;
            let ime_bolesti = document.querySelector(".ime_bolesti").value;
            let trenutna_terapija = document.querySelector(".trenutna_terapija").value;
            let stanje_pacijenta = document.querySelector(".stanje_pacijenta").value;

            if(broj_kartona != "" && ime_bolesti != "" && trenutna_terapija != "" && stanje_pacijenta != ""){

                axios.post('/api/dijagnoze', {

                    naziv_bolesti: ime_bolesti,
                    trenutna_terapija: trenutna_terapija,
                    broj_kartona: parseInt(broj_kartona),
                    stanje_pacijenta: stanje_pacijenta
                    })
                    .then(function (response) {
                        if(response.data == "Ne postoji osoba sa ovim brojem kartona!"){
                            alert("Ne postoji osoba sa ovim brojem kartona!");
                            console.log(response);
                        }else{
                            console.log(response);
                            document.querySelector(".uspesanPostReqDij").innerHTML = "<a class = 'linkovi' style = 'font-size:12px;'>Nova dijagnoza uspešno uneta pacijentu sa BROJEM KARTONA: "+broj_kartona+" </a>";
                        }
                    })
                    .catch(function (error) {
                        alert("Greska u unosu");
                        console.log(error);
                    });

            }else{
                alert("Sva polja su obavezna da se popune za uspesno slanje POST requesta dijagnoze!")

            }
        }
        function pacijentPost(){
            let ime_pacijentaa = document.querySelector(".ime_pacijentaa").value;
            let prezime_pacijentaa =document.querySelector(".prezime_pacijentaa").value;

            if(ime_pacijentaa != "" && prezime_pacijentaa != "") {

                axios.post('/api/pacijenti', {

                    ime: ime_pacijentaa,
                    prezime: prezime_pacijentaa
                })
                .then(function (response) {
                    console.log(response);
                    document.querySelector(".uspesanPostReqPac").innerHTML = "<br><a class = 'linkovi' style = 'font-size:12px;'>Uspešno kreiran pacijent sa imenom ("+ime_pacijentaa+") i prezimenom ("+prezime_pacijentaa+") , BROJ KARTONA je takođe generisan! </a>";
                })
                .catch(function (error) {
                    console.log(error);
                });

            }else{
                alert("Ne mozete poslati POST request ako su vam polja prazna!");
            }

        }
        function prikDijagnozu(){
            let broj_kartona = document.querySelector("#dijagnozePoj").value;
            
            if(broj_kartona == ""){
                alert("Posto niste uneli broj kartona po kome cete vrsiti ciljanu pretragu dijagnoza kojima pripada taj broj kartona, uputicemo vas na endpoint svih dijagnoza!");
            }
            window.open('http://localhost:8000/api/dijagnoze/'+broj_kartona, '_blank');
            
        }
        function prikPacijenta(){
            
            let broj_kartona = document.querySelector(".pacijentiGet").value;
            
            if(broj_kartona == ""){
                alert("Posto niste uneli broj kartona po kome cete vrsiti ciljanu pretragu pacijenta kome pripada taj broj kartona, uputicemo vas na endpoint svih pacijenata!");
            }
            window.open('http://localhost:8000/api/pacijenti/'+broj_kartona, '_blank');

        }
        function pacijentiUpdate(){
            let br_kartona = document.querySelector(".br_kartona_up").value;
            let ime_pacijenta = document.querySelector(".ime_pacijenta_up").value;
            let prezime_pacijenta = document.querySelector(".prezime_pacijenta_up").value;

            if(br_kartona == ""){

                alert("Unesi broj kartona pacijenta čije podatke želiš da izmeniš");
            }else{
                if(ime_pacijenta != "" || prezime_pacijenta != ""){

                    axios.patch("api/pacijenti/"+br_kartona,{
                        ime: ime_pacijenta,
                        prezime: prezime_pacijenta

                    }).then(function (res){
                        if(res.data =="Pacijent sa ovim brojem kartona NE POSTOJI!"){

                            alert("Pacijent sa ovim brojem kartona ne postoji");
                        }else{
                            document.querySelector(".uspPaPac").innerHTML = "<br><a class = 'linkovi' style = 'font-size:12px;'>Uspešna izmena ličnih podataka pacijenta! </a>";
                        }

                    })

                }else{
                    alert("Unesi podatak za izmenu barem u jedno polje!");
                }
            }
        }
        function delPacijenti(){
            let br_kar_del = document.querySelector(".brKarDel").value

            if(br_kar_del != ""){

                axios.delete("/api/pacijenti/"+br_kar_del).then(function (response) {

                    if(response.data == "Pacijent sa ovim brojem kartona NE POSTOJI"){

                        alert("Pacijent sa ovim brojem kartona NE POSTOJI");

                    }else{
                    
                        document.querySelector(".uspesanDelReqPac").innerHTML = "<br><a class = 'linkovi' style = 'font-size:12px;'>Uspešno obrisan pacijent sa BROJEM KARTONA: "+br_kar_del+"! </a>";
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });

            }else{
                alert("Za ispunjenje DELETE requesta prvo unesite BROJ KARTONA")
            }
        }
        function delDijagnoze(){
            let id = document.querySelector(".idDel").value;
            if(id != ""){
                axios.delete("/api/dijagnoze/"+id).then(function (response){
                    if(response.data == "Dijagnoza pod ovim id-jem NE POSTOJI"){
                        alert("Dijagnoza pod ovim ID - jem NE POSTOJI!");
                    }
                    else{
                        document.querySelector(".uspesanDelReqDijx").innerHTML = "<center><br><a class = 'linkovi' style = 'font-size:12px;'>Uspešno obrisana dijagnoza pod ID - jem: "+id+" ! </a></center>";
                    }
                }).catch(function (error) {
                    alert("Dijagnoza pod ovim ID - jem NE POSTOJI!");
                });

            }else{
                alert("Unesi ID dijagnoze koju zelis da obrises, mozes pronaci koja dijagnoza ima koji id pozivom GET requesta!");
            }
        }
        function dijagnozeUpdate(){
            let id_up = document.querySelector(".id_up").value;
            let ime_bolesti_up = document.querySelector(".ime_bolesti_up").value;
            let trenutna_terapija_up = document.querySelector(".trenutna_terapija_up").value;
            let stanje_pacijenta_up = document.querySelector(".stanje_pacijenta_up").value;
            if(id_up != ""){
                axios.patch("/api/dijagnoze/"+id_up, {

                    naziv_bolesti: ime_bolesti_up,
                    trenutna_terapija: trenutna_terapija_up,
                    stanje_pacijenta: stanje_pacijenta_up

                }).then(function(res){
                    if(res.data == "Dijagnoza sa ovim id-jem NE POSTOJI"){
                        alert("Dijagnoza sa ovim id-jem NE POSTOJI");
                    }else{
                        document.querySelector(".dijagUp").innerHTML = "<br><a class = 'linkovi' style = 'font-size:12px;'> Uspesno izmenjena dijagnoza!</a>";

                    }
                

                })
            }
            
        }


    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&family=Poppins:wght@500&family=Roboto&display=swap');
        *{
            font-family: 'Roboto', sans-serif;
        }
        a{
            font-size: 24px;

        }
        .endpoint{
            background-color: aliceblue;
            margin-top: 5px;
            border-radius: 20px;
            width: 800px;
            text-align: justify;
            padding: 20px;

           
        }
        .get{
            font-size: 16px;
            height: 37px;           
            border-radius: 16px;
            padding: 5px;
            background-color: rgb(231, 243, 255);
         


        }
        .get:hover{
            
            background-color: rgb(213, 235, 255);


        }
        .endpoint input,textarea{
            width: 130px;
            height: 30px;
            border-radius: 10px;
            font-size: 20px;
            padding: 2px;

        }
   
        .txtarea{

            width: 200px;
            height: 300px;
            resize: none;
        }

        #postt{
            width: 200px;

        }
        #post_req_but{
            
            width: 207px;

        }
        .cnt{
            text-align: center;
        }
        .linkovi{
            background-color: rgb(120, 182, 197);
            font-weight: 700;
            font-size: 40px;
            color: white;
            padding:5px;
        }

    </style>
</head>
<body>
    <center>

    <h1>Bolnica API (GET, POST, DELETE, PATCH)</h1>

    <a style = "font-size: 12px;" class ="linkovi" href = "https://github.com/milanpantelic03/Bolnica-API" target = "_blank">GITHUB LINK KA BACK-END KODU</a>
    <br>
    <p style = "font-size:16px;">Backend and GUI developed by Milan Pantelic: mpantelic.business@gmail.com</p>

    <h2>Get:</h2>

    <div class = "endpoint">
        <a>(GET) </a>  <a href = "http://localhost:8000/api/pacijenti" target= "_blank"> api/pacijenti </a>
        <br>
    </div>

    <div class = "endpoint">
        <a>(GET) </a><a href = "http://localhost:8000/api/dijagnoze" target = "_blank">api/dijagnoze</a>
        <br>
    </div>

    <div class = "endpoint">
        <a>(GET) </a> <a>api/pacijenti/</a>
        <input type = "text" placeholder = "broj kartona" class = "pacijentiGet"/>
        <button class = "get" onclick = "prikPacijenta();">idi na endpoint</button>
    </div>

    <div class = "endpoint">
        <a>(GET) </a> <a>api/dijagnoze/</a>
        <input type = "text" placeholder = "broj kartona" id = "dijagnozePoj"/>
        <button class = "get" onclick = "prikDijagnozu()">idi na endpoint</button> 
    </div>

    <h2>Post:</h2>

    <div class = "endpoint">
        <a>(POST) </a> <a>api/pacijenti/</a>
        <br>

        <div class ="cnt">
            Ime Pacijenta:<br>
            <input type = "text" class = "post_in ime_pacijentaa" id = "postt" >      
            <br>
            Prezime Pacijenta:<br>
            <input type = "text" class = "post_in prezime_pacijentaa" id = "postt">
            <br>
            <br>
            <button class = "get" id="post_req_but" onclick = "pacijentPost()">Kreiraj pacijenta</button>

            <div class = "uspesanPostReqPac">
            </div>

        </div>
        <br>
        <a style = "background-color: rgb(120, 182, 197); font-weight: 700; font-size: 15px; color: white">Broj kartona pacijenta po kome mozete traziti ili upisivati podatke povezane sa kreiranim pacijentom će se sam generisati i upisati u bazu podataka! <a href = "http://localhost:8000/api/pacijenti" style = "background-color: rgb(120, 182, 197); font-weight: 700; font-size: 15px; color: black">OVDE U JSONU PRONAĐITE BROJ KARTONA KREIRANOG PACIJENTA</a>
    </div>


    <div class = "endpoint">
        <a>(POST) </a><a>api/dijagnoze</a>
        <br>
        <div class ="cnt">
            Broj kartona:<br>
            <input type = "text" class = "post_in broj_kartona" id = "postt" >      
            <br>
            Ime bolesti:<br>
            <input type = "text" class = "post_in ime_bolesti" id = "postt">
            <br>
            Trenutna terapija:<br>
            <input type = "text" class = "post_in trenutna_terapija" id = "postt">
            <br>
            Stanje pacijenta:<br>
            <textarea class = "txtarea stanje_pacijenta"></textarea>
            <br>
            <div class = "uspesanPostReqDij">
            </div>
            <button class = "get" id="post_req_but" onclick = "dijagnozePost()">Uputi POST Request</button>
        </div>
        </input>
    </div>
    <h2>Delete:</h2>

    <div class = "endpoint">
        <a>(DELETE) </a><a>api/pacijenti/</a>
        <input type = "text" placeholder = "broj kartona" class = "brKarDel"/>
        <button class = "get" onclick = "delPacijenti();">DELETE request</button>
        <div class = "uspesanDelReqPac">
        </div>
    </div>

    <div class = "endpoint">
        <a>(DELETE) </a><a>api/dijagnoze/</a>
        <input type = "text" placeholder = "id" class ="idDel"/>
        <button class = "get" onclick = "delDijagnoze();">DELETE request</button>
        <div class = "uspesanDelReqDijx">
        </div>
    </div>

    <h2>Patch:</h2>

    <div class = "endpoint">
        <a>(PATCH) </a><a>api/pacijenti/</a>
        <input type = "text" placeholder = "broj kartona" class = "br_kartona_up"/>
        <br>
        <br>
        <div class ="cnt">
            Ime Pacijenta:<br>
            <input type = "text" class = "ime_pacijenta_up" id = "postt">
            <br>
            Prezime Pacijenta:<br>
            <input type = "text" class = "prezime_pacijenta_up" id = "postt">
            <br>
            <a style = "background-color: rgb(120, 182, 197); font-weight: 700; font-size: 15px; color: white">Ako ne zeliš da izmeniš jedno od polja, ostavi ga prazno!</a>
           
             <div class = "uspPaPac">
            
            </div>
            <button class = "get" id="post_req_but" onclick = "pacijentiUpdate()">Update </button>
        
        </div>
    </div>

    <div class = "endpoint">
        <a>(PATCH) </a><a>api/dijagnoze/</a>
        <input type = "text" placeholder = "id" class = "id_up"/>
        <br>
        <div class ="cnt">
            <a style = "background-color: rgb(120, 182, 197); font-weight: 700; font-size: 15px; color: white">Popuni id dijagnoze koji mozes izvuci pozivom (GET) requesta ka dijagnozama <a href = "#" style = "background-color: rgb(120, 182, 197); font-weight: 700; font-size: 15px; color: white">OVDE</a>!</a>   
            <br>
            <a style = "background-color: rgb(120, 182, 197); font-weight: 700; font-size: 15px; color: white">Polja koja ne želiš da izmeniš u dijagnozi čiji si id uneo OSTAVI PRAZNA</a>
            <br>
            <br>

            Ime bolesti:<br>
            <input type = "text" class = "post_in ime_bolesti_up" id = "postt">
            <br>
            Trenutna terapija:<br>
            <input type = "text" class = "post_in trenutna_terapija_up" id = "postt">
            <br>
            Stanje pacijenta:<br>
            <textarea class = "txtarea stanje_pacijenta_up"></textarea>
            <br>
            <a style = "background-color: rgb(120, 182, 197); font-weight: 700; font-size: 15px; color: white">Polja koja ne želiš da izmeniš u dijagnozi čiji si id uneo ostavi PRAZNA</a>
            <br>
            <button class = "get" id="post_req_but" onclick = "dijagnozeUpdate()">Update </button>
            <div class = "dijagUp">
            </div>
        </div>
    </div>
    
    </center>
</body>
</html>