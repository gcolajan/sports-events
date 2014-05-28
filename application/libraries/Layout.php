<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Position {
    const START = 1;
    const END = 2;
}

class Inclusion {
	const CALLED = 1;
	const WRITTEN = 2;
}

class Layout
{
	private $CI;
	private $var = array();
	private $decoupe = array();
	// private $minify = True;
	private $template = 'default';
	private $theme = 'default';



	public function __construct()
	{
		$this->CI = &get_instance();
		$this->CI->load->helper('htmlheader');

		// Contenu de chaque page
		$this->var['output'] = '';

		//	Le titre est composé du nom de la méthode et du nom du contrôleur
		$this->var['titre'] = '';

		// Initialisation des variables $css et $js pour les fichiers optionnels
		$this->var['CSS'] = '';
		$this->var['endJS'] = '';
		$this->var['startJS'] = '';

		// Appel au contrôleur du thème
		require_once('application/themes/'.$this->theme.'/controleur.php');
		$nom_controleur = 'Theme'.ucfirst($this->theme);
		$this->controleurTheme = new $nom_controleur($this);

		// Récupération des zones existantes d'après le contrôleur du thème
		$this->decoupe = $this->controleurTheme->getZones();

		$this->sizeTitle = SizeTitle::FULL;
	}


	public function useTemplate($tpl) {
		$this->template = $tpl;
	}


	public function shortTitle() {
		$this->sizeTitle = SizeTitle::SHORT;
	}

	public function veryShortTitle() {
		$this->sizeTitle = SizeTitle::TINY;
	}


	public function ajouterCSS($nom, $media='', $inclusion=Inclusion::CALLED)
	{
		if (empty($nom) OR !is_string($nom))
			return false;
			
		$file = 'assets/design/'.$this->theme.'/css/'.$nom.'.css';
		
		if (!file_exists($file))
		{
			log_message('error', 'CSS '.$file.' missing');
			return false;
		}

		if (!empty($media))
			$media = 'media="'.$media.'"';

		if ($inclusion == Inclusion::CALLED) // Appel classique
			$this->var['CSS'] .= '<link rel="stylesheet" type="text/css" href="'.substr(base_url($file), 0, -4).'.'.filemtime($file).'.css" '.$media.'/>'."\n";
		else // Inclusion ligne à ligne dans le fichier HTML
			$this->var['CSS'] .= '<style '.$media.' type="text/css">'."\n".file_get_contents($file).'</style>'."\n";

		return true;
	}


	public function ajouterJS($nom, $pos=Position::END, $inclusion=Inclusion::CALLED)
	{
		if (empty($nom) OR !is_string($nom))
			return false;
			
		$file = 'assets/javascript/'.$nom.'.js';
		
		if (!file_exists($file))
		{
			log_message('error', 'JS '.$file.' missing');
			return false;
		}

		if ($pos == Position::END)
			$dest = 'endJS';
		else
			$dest = 'startJS';

		if ($inclusion == Inclusion::CALLED) // Appel classique
			$this->var[$dest] .= '<script type="text/javascript" src="'.base_url($file).'"></script>'."\n";
		else // Inclusion ligne à ligne dans le fichier HTML
			$this->var[$dest] .= '<script type="text/javascript">'."\n".file_get_contents($file).'</script>'."\n";

		return true;
	}


	// Méthode pour agir sur les vues du découpage actif à partir des contrôleurs
	public function fillZone($nomZone, $tab=array())
	{
		if (is_array($tab) && !empty($tab))
		{
			$this->decoupe[$nomZone] = $tab;
			return true;
		}
		return false;
	}


	// Chargement des découpes présentes
	public function chargerDecoupes()
	{
		if ($dir = opendir('application/themes/'.$this->theme.'/zones/'))
		{
			while($file = readdir($dir))
			{
				if ($file != '..' AND $file != '.')
				{
					$explode = explode('.', $file);
					$nom = $explode[0];

					$this->controleurTheme->setZone($nom, $this->decoupe[$nom]); // Compilation avec les éléments externes et prédéfinis (controleur)
					$this->var[$nom] = $this->CI->load->view('../themes/'.$this->theme.'/zones/'.$nom, $this->controleurTheme->getZone($nom), true);
				}
			}
			closedir($dir);
		}
	}


	// Définition du titre
	public function setTitle($titre='')
	{
		if (empty($titre))
			$this->var['titre'] = config_item('header_nom_site');
		else
			$this->var['titre'] = $titre.' - '.config_item('header_nom_site');
	}
	// Permet d'afficher une vue dans un layout
	public function view($name, $data = array(), $tpl='')
	{
		if (!empty($tpl)) $this->useTemplate($tpl);

		$this->chargerDecoupes();
		
		$this->var['output'] .= $this->CI->load->view($name, $data, true);

		$this->CI->load->view('../themes/'.$this->theme.'/'.$this->template.'_tpl', $this->var);
	}
	

	// Permet de sauvegarder le contenu d'une ou plusieurs vues dans une variable, sans l'afficher immédiatement
	// Pour l'affichage, il faudra utiliser la méthode view
	public function views($name, $data = array()) 
	{
		$this->var['output'] .= $this->CI->load->view($name, $data, true);
		return $this;
	}
}