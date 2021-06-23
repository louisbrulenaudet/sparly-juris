<?php

$statut = array();
$form_data = array();
$result_data = array();

$qa = strip_tags($_REQUEST['qa']); // Votre société est-elle en situation de cessation de paiement ?
$qb = strip_tags($_REQUEST['qb']); // Si oui, votre entreprise est-elle dans cette situation depuis plus de 45 jours ?
$qc = strip_tags($_REQUEST['qc']); // Disposez-vous de l’ensemble des droits sur votre patrimoine ?
$qd = strip_tags($_REQUEST['qd']); // Accordez-vous votre consentement à ce que votre rémunération ainsi que le contenu de votre mission soit fixée par le tribunal de commerce ?
$qe = strip_tags($_REQUEST['qe']); // Accordez-vous votre consentement à ce que le contenu de votre mission soit fixée par le tribunal de commerce ?
$qf = strip_tags($_REQUEST['qf']); // Votre société possède-elle plus de 150 salariés et réalise un chiffre d’affaires inférieur à 20 millions d’euros ?
$qg = strip_tags($_REQUEST['qg']); // Si oui, avez-vous constitué des comités de créanciers ?

$mandatadhoctxt = "Le mandat ad hoc vise à aider le chef d'entreprise à trouver un accord avec ses principaux créanciers et partenaires. Le mandataire sera désigné par le président du Tribunal de commerce territorialement compétent, à la demande du seul chef d'entreprise.</br><br>Le mandat ad hoc est une procédure ne nécessitant pas de mesure de publicité et reste une méthode préventive et confidentielle de règlement amiable des difficultés.<br><br>Le but étant de rétablir la situation de l'entreprise avant la cessation des paiements.<br><br>La demande de désignation d'un mandataire est directement possible via le site du Service public. Le président du tribunal décidera librement du mandataire, de ses missions ainsi que de sa rémunération.<br><br>En principe, le mandat est établi pour quelques mois. La décision nommant le mandataire ad hoc est communiquée pour information au commissaire aux comptes. Pendant la durée du mandat, le dirigeant continue à diriger et gérer seul son entreprise.";

$sauvegardetxt = "Le dirigeant se place sous la protection du Tribunal de commerce, de manière anticipée et commence à élaborer un plan de restructuration à un moment où il n’a pas encore perdu le crédit de ses partenaires.<br><br>Il y a ouverture d’une période d’observation, accompagnée d’une mesure de suspension provisoire des poursuites.<br><br>La procédure de sauvegarde est une procédure collective qui protège les entreprises en difficulté en suspendant le paiement de dettes à l'ouverture de la procédure. Elle est mise en oeuvre à la demande du seul chef d'entreprise auprès du Tribunal de commerce, et est soumise à deux mesures de publicité. De leurs cotés, les créanciers sont circularisés, et le tribunal publie le jugement arrêtant le plan de sauvegarde.";

$conciliationtxt = "Elle permet au chef d’entreprise de bénéficier de l’aide d’un professionnel appelé « conciliateur » pour favoriser la conclusion entre le débiteur et ses principaux créanciers ou ses cocontractants, d’un accord amiable destiné à mettre fin aux difficultés de l’entreprise.<br><br>Elle est mise en oeuvre à la demande du seul chef d'entreprise et ne nécessite pas de publicité si l'accord n'est pas homologué.<br><br>Toutefois, si l'accord est homologué, le jugement sera publié mais conservé comme confidentiel.";

$reglementjudiciairetxt = "Le dirigeant de l'entreprise en cessation de paiement déclare au Tribunal de commerce son état de cessation des paiements, et ce dernier prononcera un jugement d'ouverture, ouvrant une période d'observation destinée à choisir la procédure applicable entre:<br>- Le redressement judiciaire par continuation ou cession ;<br>- la liquidation judiciaire.<br><br>Ces mesures seront prononcées par le Tribunal de commerce compétent.<br><br>La demande de règlement judiciaire émane soit :<br>- du chef d'entreprise ;<br>- du président du tribunal de commerce ;<br>- du procureur de la République ;<br>sur l'assignation d'un créancier.<br><br>La déclaration sera à faire dans les 45 jours suivant la constatation de la cessation de paiements, et le jugement d’ouverture devra nommer le juge commissaire, l’administrateur judiciaire et le mandataire judiciaire. Un représentant des salariés est élu pour la procédure. Concernant les mesures de publicité, le règlement judiciaire est soumis à publication des différentes étapes de son déroulement, avec une nécessaire circularisation du plan.";

if ($qa == 0) { // Votre société est-elle en situation de cessation de paiement ?
	$form_data['qa'] = 0;
	if ($qd == 0) {
		$form_data['qd'] = 0;
	} else {
		$form_data['qd'] = 1;

		if ($qe == 0) {
			$form_data['qe'] = 0;
		} else {
			$form_data['qe'] = 1;
			$result_data["Le mandat ad hoc"] = $mandatadhoctxt;
		};
	};

	if ($qf == 0) {
		$form_data['qf'] = 0;
		$result_data["La sauvegarde"] = $sauvegardetxt;
	} else {
		$form_data['qf'] = 1;

		if ($qg == 0) {
			$form_data['qg'] = 0;
		} else {
			$form_data['qg'] = 1;
			$result_data["La sauvegarde"] = $sauvegardetxt;
		};
	};
} else {
	$form_data['qa'] = 1;

	if ($qb == 0) { // Si oui, votre entreprise est-elle dans cette situation depuis plus de 45 jours ?
		$form_data['qb'] = 0;
		$result_data["Le règlement judiciaire"] = $reglementjudiciairetxt;
	} else {
		$form_data['qb'] = 1;

		if ($qc == 0) { // Disposez-vous de l’ensemble des droits sur votre patrimoine ?
			$form_data['qc'] = 0;
		} else {
			$form_data['qc'] = 1;
			$result_data["La conciliation"] = $conciliationtxt;
		};
	};
};

echo json_encode($result_data);
?>
