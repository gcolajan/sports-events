<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Participations_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	// Liste des écoles triées par sports
	public function getSchoolsBySports()
	{
		$requete = 'SELECT p_id, p_classement, ts_id, ts_type, ecole_id, ecole_nom, ecole_couleur, sport_id, sport_nom, sport_showRes, sport_showRank, sport_typeRank
		FROM participations
		LEFT JOIN ecoles ON ecole_id = p_ecole
		RIGHT JOIN sports ON sport_id = p_sport -- Affichera nécessairement 1x chaque sport
		LEFT JOIN types_sports ON sport_type = ts_id
		ORDER BY sport_nom, p_classement';
		$query = $this->db->query($requete);
		return $query->result();
	}

	// Classement via équipes (une fusion avec celle du haut aurait pu être envisagée)
	public function getClassementEquipes()
	{
		$requete = 'SELECT ecole_id, ecole_nom, sport_id, sport_nom, equipe_nom, equipe_classement
		FROM participations
		LEFT JOIN equipes ON equipe_participation = p_id
		LEFT JOIN sports ON sport_id = p_sport
		LEFT JOIN ecoles ON ecole_id = p_ecole
		WHERE equipe_classement <> 0 AND sport_showRank = 1 AND sport_typeRank = 1
		ORDER BY p_sport, equipe_classement';
		$query = $this->db->query($requete);
		return $query->result();
	}

	// Liste des matchs (et résultat) pour une participation
	public function getMatchs($participation)
	{
		$requete = 'SELECT
			eq1.equipe_id AS eq1_id,
			eq1.equipe_nom AS eq1_nom,
			eq1.equipe_participation AS eq1_participation,
			eq2.equipe_id AS eq2_id,
			eq2.equipe_nom AS eq2_nom,
			eq2.equipe_participation AS eq2_participation,
			match_id, match_res1, match_res2
		FROM matchs
		LEFT JOIN equipes AS eq1 ON eq1.equipe_id = match_eq1
		LEFT JOIN equipes AS eq2 ON eq2.equipe_id = match_eq2
		WHERE eq1.equipe_participation = ? OR eq2.equipe_participation = ?
		ORDER BY match_id DESC'; // On récupère le match si une des deux équipes est concernée par la participation
		$query = $this->db->query($requete, array($participation, $participation));
		return $query->result();
	}

	// On récupère tous les matchs relatifs à un sport
	public function getAllMatchs($sport)
	{
		$requete = 'SELECT
			eq1.equipe_id AS eq1_id,
			eq1.equipe_nom AS eq1_nom,
			eq1.equipe_participation AS eq1_participation,
			eq2.equipe_id AS eq2_id,
			eq2.equipe_nom AS eq2_nom,
			eq2.equipe_participation AS eq2_participation,
			match_id, match_res1, match_res2
		FROM matchs
		LEFT JOIN equipes AS eq1 ON eq1.equipe_id = match_eq1
		LEFT JOIN equipes AS eq2 ON eq2.equipe_id = match_eq2
		LEFT JOIN participations ON eq1.equipe_participation = p_id -- On vérifie seulement un sport
		WHERE p_sport = ?
		ORDER BY match_id DESC';
		$query = $this->db->query($requete, array($sport));
		return $query->result();
	}
 
	// Listes des écoles ayant participé à un sport (sub query)
	public function getParticipationsByPart($participation)
	{
		$requete = 'SELECT p_id, sport_id, sport_nom, ecole_id, ecole_nom, ecole_couleur
		FROM participations
		LEFT JOIN sports ON sport_id = p_sport
		LEFT JOIN ecoles ON ecole_id = p_ecole
		WHERE p_sport = (SELECT p_sport FROM participations WHERE p_id = ?)';
		$query = $this->db->query($requete, array($participation));
		return $query->result();
	}

	// Listes des écoles ayant participé à un sport
	public function getParticipationsBySport($sport)
	{
		$requete = 'SELECT p_id, p_classement, sport_id, sport_nom, ecole_id, ecole_nom, ecole_couleur
		FROM participations
		LEFT JOIN sports ON sport_id = p_sport
		LEFT JOIN ecoles ON ecole_id = p_ecole
		WHERE p_sport = ?
		ORDER BY p_classement';
		$query = $this->db->query($requete, array($sport));
		return $query->result();
	}

	// Obtenir une participation en fonction d'un sport et d'une école
	public function getIdParticipation($sport, $ecole)
	{
		$requete = 'SELECT p_id
		FROM participations
		WHERE p_sport = ? AND p_ecole = ?';
		$query = $this->db->query($requete, array($sport, $ecole));
		return $query->result()[0]->p_id;
	}

	// Retourne toutes les écoles participant à un sport
	public function getEcolesByParticipation($sport)
	{
		$requete = 'SELECT ecole_id, ecole_nom
		FROM ecoles
		LEFT JOIN participations ON p_ecole = ecole_id
		WHERE p_sport = ?';
		$query = $this->db->query($requete, array($sport));
		return $query->result();		
	}

	// Ajouter plusieurs participations à la fois
	public function ajouterPlusieurs($ecole, $sports)
	{
		$values = array();
		foreach ($sports as $sport)
			$values[] = '('.intval($ecole).', '.intval($sport).')';
		$value = implode(',', $values);

		$req = 'INSERT INTO participations (p_ecole, p_sport) VALUES '.$value;
		return $this->db->query($req);
	}

	// Modifier les scores
	public function majClassement($assocClassement)
	{
		foreach ($assocClassement as $id => $classement)
		{
			$req = 'UPDATE participations SET p_classement = ? WHERE p_id = ?';
			$this->db->query($req, array($classement, $id));
		}
	}

	// Supprimer une participation
	public function supprimer($ecole, $sport)
	{
		$req = 'DELETE FROM participations WHERE p_sport = ? AND p_ecole = ?';
		return $this->db->query($req, array($sport, $ecole));
	}
}