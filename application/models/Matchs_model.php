<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matchs_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function ajouter($eq1, $score1, $eq2, $score2)
	{
		$req = 'INSERT INTO matchs (match_eq1, match_eq2, match_res1, match_res2) VALUES (?,?,?,?)';
		$this->db->query($req, array($eq1, $eq2, $score1, $score2));
		return $this->db->insert_id();
	}

	public function modifier($id, $score1, $score2)
	{
		$req = 'UPDATE matchs SET match_res1 = ?, match_res2 = ? WHERE match_id = ?';
		return 	$this->db->query($req, array($score1, $score2, $id));
	}

	public function supprimer($id)
	{
		$req = 'DELETE FROM matchs WHERE match_id = ?';
		return 	$this->db->query($req, array($id));
	}

}