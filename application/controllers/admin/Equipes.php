<?php defined('BASEPATH') OR exit('No direct script access allowed');
ini_set("auto_detect_line_endings", "1");


class Equipes extends MY_Controller {

	public function index()
	{
		$this->load->model('Sports_model', 'sports');

		$this->layout->setTitle('Gestion des équipes et des sportifs');
		$this->layout->view('admin/equipes/index', array('sports' => $this->sports->getSports()));
	}

	public function sport($sport=0, $inutile='')
	{
		$this->load->model('Sports_model', 'sports');
		$this->load->model('Equipes_model', 'equipes');
		$this->load->model('Participations_model', 'participations');

		$message = '';
		if ($this->input->post('add'))
		{
			$part = $this->participations->getIdParticipation(
					$sport,
					$this->input->post('ecole'));
				$this->equipes->add($part, $this->input->post('nom'));
			$message = '<p class="alert alert-success">Équipe ajoutée !</a>';
		}

		if ($this->input->post('edit'))
		{
			$part = $this->participations->getIdParticipation(
				$sport,
				$this->input->post('ecole'));
			$this->equipes->modifier($this->input->post('edit'), $part, $this->input->post('nom'));
			$message = '<p class="alert alert-success">Équipe modifiée !</a>';
		}

		if ($this->input->post('del'))
		{
			if ($this->equipes->supprimer($this->input->post('del')))
				$message = '<p class="alert alert-info">Équipe supprimée !</a>';
			else
				$message = '<p class="alert alert-danger">Impossible de supprimer cette équipe : cette équipe a déjà réalisé des matchs !</a>';
		}

		$equipes = $this->equipes->getEquipesPratiquant($sport);

		if ($this->input->post('multiple'))
		{
			$part = $this->participations->getIdParticipation(
					$sport,
					$this->input->post('ecole'));


			// Construction d'un tableau des noms des équipes
			$equipesPratiquant = array();
			foreach ($equipes as $e)
				$equipesPratiquant[] = $e->equipe_nom;

			$separateurs = array(';', ',', "\t");
			$sep = 0;

			$nouveaux = array();
			$nbImports = 0;
			if (($handle = fopen($_FILES['fichier']['tmp_name'], "r")) === FALSE)
				echo '<p class="alert alert-warning">Impossible d\'ouvrir le fichier.</p>';
			while (($cols = fgetcsv($handle, 0, $separateurs[$sep])) !== FALSE) // TODO: à reprendre si plusieurs personnes (un espace sur deux remplacé par un "-")
			{
				if (count($cols) == 1) // Dans ce cas là, mauvaise détection du format
				{	
					$sep++;
					if ($sep == count($separateurs))
					{
						echo 'Warning! CSV file wasn\'t explicit about his structure !';
						break;
					}
					else
					{
						// On replace notre curseur au début du fichier
						fseek($handle, 0);
						// Le prochain tour de boucle reprendra son traitement avec un autre séparateur
					}
				}
				else
				{	
					$nomEquipe = implode(' ', $cols);
					if (!empty($nomEquipe))
					{
						$nouveaux[] = $nomEquipe;
						$nbImports++;
					}
				}
			}

			// Suppression des espaces inutiles
			$nouveaux = array_map('trim', $nouveaux);

			// Analyse des doublons
			foreach ($nouveaux as $k => $equipe)
				// Si l'élément que l'on veut ajouter est dans le tableau, on le supprime
				if (in_array($equipe, $equipesPratiquant))
					unset($nouveaux[$k]);
				else
					$this->equipes->add($part, $equipe);

			$message = '<p class="alert alert-success">'.count($nouveaux).' équipes importées ('.($nbImports-count($nouveaux)).' doublons évités) !</p>';
		}

		$this->layout->setTitle('Gestion des équipes et des sportifs');
		$this->layout->view('admin/equipes/sport', array(
			'sport' => $this->sports->getSport($sport),
			'ecoles' => $this->participations->getEcolesByParticipation($sport),
			'equipes' => $this->equipes->getEquipesPratiquant($sport),
			'message' => $message));
	}
}
