<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planning_sports_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	// Retourne les détails concernant un évt sportif
	public function getSport($id)
	{
		$requete = '
		SELECT ps_id, ps_horaire, ps_duree, ps_description,
		sport_id, sport_nom,
		lieu_id, lieu_nom, lieu_adresse, lieu_gmap
		FROM planning_sports
		LEFT JOIN lieux ON lieu_id = ps_lieu
		LEFT JOIN sports ON sport_id = ps_sport
		WHERE ps_id = '.intval($id);
		$query = $this->db->query($requete);

		return $query->result()[0];
	}

	// Retourne la liste des évts sportifs
	public function getSports()
	{
		$requete = '
		SELECT ps_id, ps_horaire, ps_duree, ps_description,
		sport_id, sport_nom,
		lieu_id, lieu_nom
		FROM planning_sports
		LEFT JOIN lieux ON lieu_id = ps_lieu
		LEFT JOIN sports ON sport_id = ps_sport
		ORDER BY ps_horaire';
		$query = $this->db->query($requete);

		return $query->result();
	}


	// Ajoute un évènement sportif
	public function ajouter($lieu, $horaire, $duree, $sport, $desc)
	{
		$requete = 'INSERT INTO planning_sports (ps_lieu, ps_horaire, ps_duree, ps_sport, ps_description) VALUES (?,?,?,?,?)';
		return $this->db->query($requete, array($lieu, $horaire, $duree, $sport, $desc));
	}

	// Modifie un évènement sportif
	public function modifier($id, $lieu, $horaire, $duree, $sport, $desc)
	{
		$requete = 'UPDATE planning_sports SET ps_lieu = ?, ps_horaire = ?, ps_duree = ?, ps_sport = ?, ps_description = ? WHERE ps_id = ?';
		return $this->db->query($requete, array($lieu, $horaire, $duree, $sport, $desc, $id));
	}

	// Supprime une animation
	public function supprimer($id)
	{
		$requete = 'DELETE FROM planning_sports WHERE ps_id = ?';
		return $this->db->query($requete, array($id));
	}
}