<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_model extends CI_Model
{
	protected $all;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->all = -1;
	}
	
	private function getContact($id)
	{
		$where = ($id != $this->all) ? 'WHERE contact_id = '.intval($id) : '';
		
		$requete = '
		SELECT contact_id, contact_nom, contact_role, contact_numero
		FROM contacts
		'.$where.' ORDER BY contact_nom';
		$query = $this->db->query($requete);

		if ($id != $this->all)
			return $query->result()[0];
		else
			return $query->result();
	}

	// Retourne la liste de tous les lieux référencés
	public function getContacts()
	{
		return $this->getContact($this->all);
	}

	// Ajoute un contact
	public function ajouter($nom, $role, $numero)
	{
		$req = 'INSERT INTO contacts (contact_nom,contact_role,contact_numero) VALUES (?,?,?)';
		return $this->db->query($req, array($nom,$role,$numero));
	}

	// Modifie un contact
	public function modifier($id, $nom, $role, $numero)
	{
		$req = 'UPDATE contacts SET contact_nom = ?, contact_role = ?, contact_numero = ? WHERE contact_id = ?';
		return $this->db->query($req, array($nom,$role,$numero, $id));
	}

	public function supprimer($id)
	{
		$req = 'DELETE FROM contacts WHERE contact_id = ?';
		return $this->db->query($req, array($id));
	}
}