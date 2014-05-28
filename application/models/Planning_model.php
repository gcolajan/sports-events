<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Planning_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function all() {
		return $this->getEvents(false, false);
	}


	public function currentlyAndAfter() {
		return $this->getEvents(true, false);
	}

	public function currently() {
		return $this->getEvents(true, true);
	}


	private function getEvents($min, $max) {

		$where = array('sports' => [], 'animations' => []);
		if ($max)
		{
			$where['sports'][] = 'ps_horaire <= NOW()';
			$where['animations'][] = 'pa_horaire <= NOW()';
		}

		if ($min)
		{
			$where['sports'][] = 'ADDTIME(ps_horaire, ps_duree) >= NOW()';
			$where['animations'][] = 'ADDTIME(pa_horaire, pa_duree) >= NOW()';
		}

		$conditions = array('sports' => '', 'animations' => '');
		foreach($where as $k => $cond)
			$conditions[$k] = implode(' AND ', $cond);

		foreach($conditions as $k => $v)
			$conditions[$k] = !empty($v) ? 'WHERE '.$v : '';

		$requete = '
		SELECT id, type, nom, lieu_id, lieu_nom, horaire, duree, description
		FROM
			((SELECT
				ps_id AS id,
				"sport" AS type,
				sport_nom AS nom,
				ps_lieu AS lieu,
				ps_horaire AS horaire,
				ps_duree AS duree,
				ps_description AS description
			FROM planning_sports
			LEFT JOIN sports ON sport_id = ps_sport
			'.$conditions['sports'].')
			
			UNION ALL

			(SELECT
				pa_id AS id,
				"animation" AS type,
				pa_nom AS nom,
				pa_lieu AS lieu,
				pa_horaire AS horaire,
				pa_duree AS duree,
				pa_description AS description
			FROM planning_animations
			'.$conditions['animations'].')
			) AS events

		LEFT JOIN lieux ON lieu = lieu_id
		ORDER BY horaire';
		$query = $this->db->query($requete);

		return $query->result();
	}
}