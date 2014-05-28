<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Equipes_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function getEquipes()
	{
		$requete = '
		SELECT equipe_id, equipe_nom, ecole_nom
		FROM equipes
		LEFT JOIN participations ON p_id = equipe_participation
		LEFT JOIN ecoles ON ecole_id = p_ecole
		ORDER BY ecole_nom, equipe_nom';
		$query = $this->db->query($requete);
		return $query->result();
	}

	public function getEquipesPratiquant($sport)
	{
		$requete = '
		SELECT equipe_id, equipe_nom, equipe_classement, ecole_id, ecole_nom, ecole_couleur
		FROM equipes
		LEFT JOIN participations ON p_id = equipe_participation
		LEFT JOIN ecoles ON ecole_id = p_ecole
		WHERE p_sport = ?
		ORDER BY equipe_classement, ecole_nom, equipe_nom';
		$query = $this->db->query($requete, array($sport));
		return $query->result();
	}

	public function add($participation, $nom)
	{
		$req = 'INSERT INTO equipes (equipe_participation, equipe_nom) VALUES (?,?)';
		$this->db->query($req, array($participation,$nom));
		return $this->db->insert_id();
	}

	public function modifier($id, $participation, $nom) {
		$req = 'UPDATE equipes SET equipe_participation = ?, equipe_nom = ? WHERE equipe_id = ?';
		return $this->db->query($req, array($participation, $nom, $id));
	}

	public function majClassement($assocClassement)
	{
		foreach ($assocClassement as $id => $classement)
		{
			$req = 'UPDATE equipes SET equipe_classement = ? WHERE equipe_id = ?';
			$this->db->query($req, array($classement, $id));
		}
	}

	public function supprimer($id)
	{
		$req = 'DELETE FROM equipes WHERE equipe_id = ?';
		return $this->db->query($req, array($id));
	}
}