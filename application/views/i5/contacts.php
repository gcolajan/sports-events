<h1>Contacts</h1>

<ul>
<?php
foreach ($contacts as $contact)
	echo '<li>'.$contact->contact_nom.' ('.$contact->contact_role.') : <a href="tel:+33'.$contact->contact_numero.'">'.chunk_split('0'.$contact->contact_numero, 2, ' ').'</a></li>';
?>
</ul>