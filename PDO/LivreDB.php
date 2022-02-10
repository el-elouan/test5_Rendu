<?php
require_once "Constantes.php";
require_once "metier/Livre.php";
require_once "MediathequeDB.php";

class LivreDB extends MediathequeDB
{
	private $db; // Instance de PDO
	public $lastId;
	//TODO implementer les fonctions
	public function __construct($db)
	{
		$this->db=$db;
	}
	/**
	 * 
	 * fonction d'Insertion de l'objet Livre en base de donnee
	 * @param Livre $l
	 */
	public function ajout(Livre $l)
	{
		$q = $this->db->prepare('INSERT INTO livre(titre,edition,information,auteur) values(:titre,:edition,:information,:auteur)');
		$q->bindValue(':titre',$l->getTitre());
		$q->bindValue(':edition',$l->getEdition());
		$q->bindValue(':information',$l->getInformation());
		$q->bindValue(':auteur',$l->getAuteur());
		$q->execute();
		$q->closeCursor();
		$q = NULL;
	}
/**
	 * 
	 * fonction d'update de l'objet Livre en base de donnee
	 * @param Livre $l
	 */
	public function update(Livre $l)
	{
		$q = $this->db->prepare('UPDATE livre set auteur=:auteur,information=:information,edition=:edition,titre=:titre where id=:id');

		$q->bindValue(':auteur', $l->getAuteur());
		$q->bindValue(':information', $l->getInformation());
		$q->bindValue(':edition', $l->getEdition());
		$q->bindValue(':titre', $l->getTitre());
		$q->bindValue(':id', $l->getId());
		$q->execute();
		$q->closeCursor();
		$q = NULL;
	}
    /**
     * 
     * fonction de Suppression de l'objet Livre
     * @param Livre $l
     */
	public function suppression(Livre $l){
		$q = $this->db->prepare('delete from livre where id=:id');
		$q->bindValue(':id',$l->getId());	
		$q->execute();	
		$q->closeCursor();
		$q = NULL;
	}
/**
	 * 
	 * Fonction qui retourne toutes les livres
	 * @throws Exception
	 */
	public function selectAll(){
		$query = 'SELECT titre,information,edition,auteur FROM livre';
		$q = $this->db->prepare($query);
		$q->execute();
		
		$result = $q->fetchAll(PDO::FETCH_ASSOC);
		
		//si pas de personnes , on leve une exception
		if(empty($result)){
			throw new Exception(Constantes::EXCEPTION_DB_PERSONNE);
		}
		
				
		//Clore la requete préparée
		$q->closeCursor();
		$q = NULL;
		//retour du resultat
		return $result;
	}
public function selectLivre($id){
	try{
		$query = 'SELECT titre,information,edition,auteur FROM livre  WHERE id = :id';
		$q = $this->db->prepare($query);

	
		$q->bindValue(':id',$id);
	
		$q->execute();
		
		$arrAll = $q->fetch(PDO::FETCH_ASSOC);
		//si pas de personne , on leve une exception

		if(empty($arrAll)){
			throw new Exception(Constantes::EXCEPTION_DB_PERSONNE); 
		
		}
		
		$q->closeCursor();
		$q = NULL;
		//conversion du resultat de la requete en objet personne
		$res= $this->convertPdoPers($arrAll);
		//retour du resultat
		return $res;
	}catch (Exception $e){
		throw new Exception(Constantes::EXCEPTION_DB_LIV_SELECT . $e); 
	}
	}
        /**
	 * 
	 * Fonction qui convertie un PDO Livre en objet Livre
	 * @param $pdoLivr
	 * @throws Exception
	 */
	public function convertPdoLiv($pdoLivr){
	if(empty($pdoLivr)){
		throw new Exception(Constantes::EXCEPTION_DB_CONVERT_LIVR);
	}
	try{
		//conversion du pdo en objet
		$obj=(object)$pdoLivr;
		//print_r($obj);
		//conversion de l'objet en objet personne
		//conversion date naissance en datetime
		$livr=new Livre($obj->titre,$obj->edition,$obj->information, $obj->auteur);
		//affectation de l'id pers
		$livr->setId($obj->id);
	 	return $livr;	
	}catch(Exception $e){
		throw new Exception(Constantes::EXCEPTION_DB_CONVERT_LIVR.$e);
	}
	}
}