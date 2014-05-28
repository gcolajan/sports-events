<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Retourne la liste de toutes les news référencées
	public function getNews()
	{
		$requete = 'SELECT news_id, news_date, news_public, news_contenu FROM news ORDER BY news_date DESC';
		$res = $this->db->query($requete);
		return $res->result();
	}

	// Retourne la liste de toutes les news référencées et publiques
	public function getPublicNews()
	{
		$requete = 'SELECT news_date, news_contenu FROM news WHERE news_public = 1 ORDER BY news_date DESC';
		$res = $this->db->query($requete);
		return $res->result();
	}

	// Ajoute une news
	public function ajouter($message, $public)
	{
		$req = 'INSERT INTO news (news_date, news_public, news_contenu) VALUES (NOW(),?,?)';
		return $this->db->query($req, array($public, $message));
	}

	// Modifie une news
	public function modifier($id, $message, $public)
	{
		$req = 'UPDATE news SET news_contenu = ?, news_public = ? WHERE news_id = ?';
		return $this->db->query($req, array($message,$public,$id));
	}

	// Supprime une news
	public function supprimer($id)
	{
		$req = 'DELETE FROM news WHERE news_id = ?';
		return $this->db->query($req, array($id));
	}
}