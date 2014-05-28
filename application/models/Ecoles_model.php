<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ecoles_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getOnlyEcoles()
	{
		$req = 'SELECT ecole_id, ecole_nom, ecole_couleur
		FROM ecoles
		ORDER BY ecole_nom';
		$query = $this->db->query($req);
		return $query->result();
	}

	public function getEcoles()
	{
		$req = 'SELECT ecole_id, ecole_nom, ecole_couleur, p_sport
		FROM ecoles
		LEFT JOIN participations ON p_ecole = ecole_id
		ORDER BY ecole_nom';
		$query = $this->db->query($req);
		return $query->result();
	}

	// Ajoute un sport
	public function ajouter($nom, $couleur)
	{
		$req = 'INSERT INTO ecoles (ecole_nom,ecole_couleur) VALUES (?,?)';
		return $this->db->query($req, array($nom,$couleur));
	}

	// Modifie un sport
	public function modifier($id, $nom, $couleur)
	{
		$req = 'UPDATE ecoles SET ecole_nom = ?, ecole_couleur = ? WHERE ecole_id = ?';
		return $this->db->query($req, array($nom,$couleur,$id));
	}

	// Supprime un sport
	public function supprimer($id)
	{
		$req = 'DELETE FROM ecoles WHERE ecole_id = ?';
		return $this->db->query($req, array($id));
	}

}