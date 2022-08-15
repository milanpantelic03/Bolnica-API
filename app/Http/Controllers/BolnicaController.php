<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dijagnoze;
use App\Models\Pacijenti;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BolnicaController extends Controller
{
    public function prikaziSveDijagnoze(){
        $dijagnoze = Dijagnoze::all();
        return $dijagnoze;
    }
    public function prikaziDijagnozuPoBrojuKartona($broj_kartona){
        $dijagnoze = Dijagnoze::where("broj_kartona", $broj_kartona)->get();
        return $dijagnoze;
    }
    public function prikaziPacijenta($broj_kartona){
            $pacijent = Pacijenti::where("broj_kartona", $broj_kartona)->get();
            return $pacijent;

    }

    public function prikaziPacijente(){
            $pacijenti = Pacijenti::all();
            return $pacijenti; 

    }
    
    public function kreirajPacijenta(Request $req){
        $kreirajPacijenta = new Pacijenti();

        $kreirajPacijenta ->ime = $req -> ime;
        $kreirajPacijenta ->prezime = $req -> prezime;
        $kreirajPacijenta ->broj_kartona = time() + rand(10.000, 20.000) + rand(125, 980);

        $kreirajPacijenta -> save();
        return ["Uspesan post request"];      
    }

    public function kreirajDijagnozu(Request $req){
        $kreirajDijagnozu = new Dijagnoze();

        if(Pacijenti::where("broj_kartona", $req -> broj_kartona)->exists()){
            $kreirajDijagnozu = new Dijagnoze();

            $kreirajDijagnozu -> naziv_bolesti = $req -> naziv_bolesti;
            $kreirajDijagnozu -> trenutna_terapija = $req -> trenutna_terapija;
            $kreirajDijagnozu -> broj_kartona = $req -> broj_kartona;
            $kreirajDijagnozu -> stanje_pacijenta = $req -> stanje_pacijenta;

            $kreirajDijagnozu -> save();

        }else{
            return "Ne postoji osoba sa ovim brojem kartona!";

        }
    }
    public function obrisiDijagnozu($id){

            if(Dijagnoze::findOrFail($id)->exists()){

                $obrisiDijagnozu = Dijagnoze::findOrFail($id);
                $obrisiDijagnozu -> delete();
                
                return "Dijagnoza pod id- jem {$id} je obrisana!";

            }else{
                
            }

    }
    public function izmeniDijagnozu(Request $req, $id){

        if(Dijagnoze::where("id", $id) -> exists()){
            $naziv_bolesti = $req -> naziv_bolesti;
            $trenutna_terapija = $req -> trenutna_terapija;
            $stanje_pacijenta = $req -> stanje_pacijenta;
    
            if($naziv_bolesti == null or $trenutna_terapija == null or $stanje_pacijenta == null){
                $dijagnoza = Dijagnoze::where("id",$id)->get();
            }
    
            if($naziv_bolesti == null){
                $naziv_bolesti = $dijagnoza[0]["naziv_bolesti"];
            }
            if($trenutna_terapija == null){
                $trenutna_terapija = $dijagnoza[0]["trenutna_terapija"];
            }
            if($stanje_pacijenta == null) {
                $stanje_pacijenta = $dijagnoza[0]["stanje_pacijenta"];
            }
    
            $izmeniDijagnozu = Dijagnoze::where("id", $id)->update([
                "naziv_bolesti" => $naziv_bolesti,
                "trenutna_terapija" => $trenutna_terapija,
                "stanje_pacijenta" => $stanje_pacijenta
            ]);

        }else{
            return "Dijagnoza sa ovim id-jem NE POSTOJI";

        }

    }
    public function izmeniPacijenta(Request $req, $broj_kartona){

        if(Pacijenti::where("broj_kartona", $broj_kartona)->exists()){
            $ime_db = $req -> ime;
            $prezime_db = $req -> prezime;
    
            if($ime_db == null or $prezime_db == null){
                $pacijent = Pacijenti::where("broj_kartona", $broj_kartona)->get();
    
            }
            if($ime_db == null){
                $ime_db = $pacijent[0]["ime"];
            }
            if($prezime_db == null){
                $prezime_db =$pacijent[0]["prezime"];
            }
    
                $izmeniPacijenta = Pacijenti::where("broj_kartona",$broj_kartona)->update([
                    "ime"=> $ime_db,
                    "prezime" => $prezime_db
                ]);
        }else{
            return "Pacijent sa ovim brojem kartona NE POSTOJI!";

        }



    }
    public function obrisiPacijenta($broj_kartona){

         
            $cek = Pacijenti::where("broj_kartona",$broj_kartona)->exists();
            if($cek){

                $obrisiPacijenta = Pacijenti::where("broj_kartona",$broj_kartona);
                $obrisiPacijenta -> delete();
    
                $obrisiDijagnozu = Dijagnoze::where("broj_kartona",$broj_kartona);
                $obrisiDijagnozu -> delete();
    
                return "Pacijent sa brojem kartona: {$broj_kartona} je obrisan, kao i sve njegove dijagnoze!";

            }else{
                return "Pacijent sa ovim brojem kartona NE POSTOJI";
            }
    }

    //
}
