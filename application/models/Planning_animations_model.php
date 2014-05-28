<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planning_animations_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	// Retourne les détails concernant une animations
	public function getAnimation($id)
	{
		$requete = '
		SELECT pa_id, pa_horaire, pa_duree, pa_nom, pa_description,
		lieu_id, lieu_nom, lieu_adresse, lieu_gmap
		FROM planning_animations
		LEFT JOIN lieux ON lieu_id = pa_lieu
		WHERE pa_id = '.intval($id);
		$query = $this->db->query($requete);

		return $query->result()[0];
	}

	// Retourne la liste des animations
	public function getAnimations()
	{
		$requete = '
		SELECT pa_id, pa_horaire, pa_duree, pa_nom,
		lieu_id, lieu_nom
		FROM planning_animations
		LEFT JOIN lieux ON lieu_id = pa_lieu
		ORDER BY pa_horaire';
		$query = $this->db->query($requete);

		return $query->result();
	}

	// Ajoute une animation
	public function ajouter($lieu, $horaire, $duree, $nom, $desc)
	{
		$requete = 'INSERT INTO planning_animations (pa_lieu, pa_horaire, pa_duree, pa_nom, pa_description) VALUES (?,?,?,?,?)';
		return $this->db->query($requete, array($lieu, $horaire, $duree, $nom, $desc));
	}

	// Modifie une animation
	public function modifier($id, $lieu, $horaire, $duree, $nom, $desc)
	{
		$requete = 'UPDATE planning_animations SET pa_lieu = ?, pa_horaire = ?, pa_duree = ?, pa_nom = ?, pa_description = ? WHERE pa_id = ?';
		return $this->db->query($requete, array($lieu, $horaire, $duree, $nom, $desc, $id));
	}

	// Supprime une animation
	public function supprimer($id)
	{
		$requete = 'DELETE FROM planning_animations WHERE pa_id = ?';
		return $this->db->query($requete, array($id));
	}

}