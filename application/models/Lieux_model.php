<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lieux_model extends CI_Model
{
	protected $all;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->all = -1;
	}
	
	// Retourne les détails concernant un seul lieu
	public function getLieu($id)
	{
		$where = ($id != $this->all) ? 'WHERE lieu_id = '.intval($id) : '';
		
		$requete = '
		SELECT lieu_id, lieu_nom, lieu_adresse, lieu_gmap, lieu_lat, lieu_lg
		FROM lieux
		'.$where.' ORDER BY lieu_nom';
		$query = $this->db->query($requete);

		if ($id != $this->all)
			return $query->result()[0];
		else
			return $query->result();
	}

	// Retourne la liste de tous les lieux référencés
	public function getLieux()
	{
		return $this->getLieu($this->all);
	}

	// Ajoute un lieu
	public function ajouter($nom, $adresse, $gmap, $lat, $lg)
	{
		$req = 'INSERT INTO lieux (lieu_nom,lieu_adresse,lieu_gmap,lieu_lat,lieu_lg) VALUES (?,?,?,?,?)';
		return $this->db->query($req, array($nom,$adresse,$gmap,$lat,$lg));
	}

	// Modifie un lieu
	public function modifier($id, $nom, $adresse, $gmap, $lat, $lg)
	{
		$req = 'UPDATE lieux SET lieu_nom = ?, lieu_adresse = ?, lieu_gmap = ?, lieu_lat = ?, lieu_lg = ? WHERE lieu_id = ?';
		return $this->db->query($req, array($nom,$adresse,$gmap,$lat,$lg,$id));
	}

	// Supprime un lieu
	public function supprimer($id)
	{
		$req = 'DELETE FROM lieux WHERE lieu_id = ?';
		return $this->db->query($req, array($id));
	}
}