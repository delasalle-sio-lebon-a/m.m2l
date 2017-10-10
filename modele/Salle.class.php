<?php
// Projet Réservations M2L - version web mobile
// fichier : 
// Rôle : 
// Création : 
// Mise à jour : 
class Salle
{
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------- Membres privés de la classe ---------------------------------------
    // ------------------------------------------------------------------------------------------------------
    
    // Rappel : le temps UNIX mesure le nombre de secondes écoulées depuis le 1/1/1970
    // les types des champs timestamp, start_time et end_time découlent des types choisis pour la BDD
    private $id;			// identifiant de la réservation (numéro automatique dans la BDD)
    private $room_name;		// date et heure de la dernière mise à jour de la réservation (format 'Y-m-d H:i:s')
    private $capacity;	// date de début de la réservation (en temps UNIX)
    private $area_name;		// date de fin de la réservation (en temps UNIX)
   	
    
    // ------------------------------------------------------------------------------------------------------
    // ----------------------------------------- Constructeur -----------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    
    public function Salle($unId,$unRoomName, $Capacity, $Area_name) {
        $this->id = $unId;
        $this->room_name = $unRoomName;
        $this->capacity = $Capacity;
        $this->area_name = $Area_name;
        
    }
    
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------------- Getters et Setters ------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    
    public function getId()	{return $this->id;}
    public function setId($unId) {$this->id = $unId;}
        
    public function getRoom_name()	{return $this->room_name;}
    public function setRoom_name($unRoom_name) {$this->room_name = $unRoomname;}
    
    public function getCapacity()	{return $this->capacity;}
    public function setCapacity($Capacity) {$this->capacity = $Capacity;}
    
    public function getAreaName()	{return $this->area_name;}
    public function setAreaName($Area_name) {$this->area_name = $Area_name;}
    
    
 
    
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------------- Méthodes d'instances ----------------------------------------
    // ------------------------------------------------------------------------------------------------------
    
    public function toString() {
        $msg = "Salle : <br>";
        $msg .= "id : " . $this->id . "<br>";
        $msg .= "room_name : " . $this->room_name . "<br>";
        $msg .= "capacité : " . $this->capacity . "<br>";
        $msg .= "Area : " . $this->area_name . "<br>";
        return $msg;
    }
    
} // fin de la classe Salle

class salle
{
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------- Membres privés de la classe ---------------------------------------
    // ------------------------------------------------------------------------------------------------------
    
    // Rappel : le temps UNIX mesure le nombre de secondes écoulées depuis le 1/1/1970
    // les types des champs timestamp, start_time et end_time découlent des types choisis pour la BDD
    private $id;			// identifiant de la réservation (numéro automatique dans la BDD)		// date de fin de la réservation (en temps UNIX)
    private $room_name;		// nom de la salle réservée
    private $capacity;		// 0 = réservation confirmée ; 4 = réservation provisoire
    private $area_name;		// digicode d'accès à la salle pour cette réservation uniquement
    
    // ------------------------------------------------------------------------------------------------------
    // ----------------------------------------- Constructeur -----------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    
    public function Salle($unId, $unRoomName, $Capacity, $Area_name) {
        $this->id = $unId;
        $this->room_name = $unRoomName;
        $this->capacity = $Capacity;
        $this->area_name = $Area_name;
    }
    
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------------- Getters et Setters ------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    
    public function getId()	{return $this->id;}
    public function setId($unId) {$this->id = $unId;}
 
    public function getRoom_name()	{return $this->room_name;}
    public function setRoom_name($unRoom_name) {$this->room_name = $unRoom_name;}
    
    public function getCapacity()	{return $this->capacity;}
    public function setCapacity($Capacity) {$this->capacity = $Capacity;}
    
    public function getArea_name()	{return $this->area_name;}
    public function setArea_name($Area_name) {$this->area_name = $Area_name;}
    
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------------- Méthodes d'instances ----------------------------------------
    // ------------------------------------------------------------------------------------------------------
    
    public function toString() {
        $msg = "Salle : <br>";
        $msg .= "id : " . $this->id . "<br>";
        $msg .= "room_name : " . $this->room_name . "<br>";
        $msg .= "capacity : " . $this->capacity . "<br>";
        $msg .= "area_name : " . $this->area_name . "<br>";
        return $msg;
    }
    
} // fin de la classe Salle



// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!