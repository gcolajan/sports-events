<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sports_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	// Retourne la liste des sports
	public function getSports()
	{
		$requete = 'SELECT sport_id, sport_nom, sport_type, sport_showRes, sport_showRank, sport_typeRank, ts_id, ts_type
		FROM sports
		LEFT JOIN types_sports ON sport_type = ts_id
		ORDER BY sport_nom';
		$query = $this->db->query($requete);
		return $query->result();
	}

	// Retourne un sport
	public function getSport($id)
	{
		$requete = 'SELECT sport_id, sport_nom, sport_type, sport_showRes, sport_showRank, sport_typeRank
		FROM sports
		WHERE sport_id = ?';
		$query = $this->db->query($requete, array($id));
		return $query->result()[0];
	}

	// Retourne les différents types de sport
	public function getTypes()
	{
		$requete = 'SELECT ts_id, ts_type
		FROM types_sports
		ORDER BY ts_type';
		$query = $this->db->query($requete);
		return $query->result();
	}

	// Ajoute un sport
	public function ajouter($nom, $type, $showRes, $showRank, $typeRank)
	{
		$req = 'INSERT INTO sports (sport_nom,sport_type,sport_showRes,sport_showRank,sport_typeRank) VALUES (?,?,?,?,?)';
		return $this->db->query($req, array($nom, $type, $showRes, $showRank, $typeRank));
	}

	// Modifie un sport
	public function modifier($id, $nom, $type, $showRes, $showRank, $typeRank)
	{
		$req = 'UPDATE sports SET sport_nom = ?, sport_type = ?, sport_showRes = ?, sport_showRank = ?, sport_typeRank = ? WHERE sport_id = ?';
		return $this->db->query($req, array($nom, $type, $showRes, $showRank, $typeRank, $id));
	}

	// Modifie les droits liés à l'affichage d'un sport
	public function modifierDroits($id, $classement, $matchs)
	{
		$req = 'UPDATE sports SET sport_showRes = ?, sport_showRank = ? WHERE sport_id = ?';
		return $this->db->query($req, array($matchs, $classement, $id));
	}

	// Supprime un sport
	public function supprimer($id)
	{
		$req = 'DELETE FROM sports WHERE sport_id = ?';
		return $this->db->query($req, array($id));
	}
}