<?php
class ajaxValidate {
        function formValidate() {
                //Put form elements into post variables (this is where you would sanitize your data)
                $nom_client = @$_POST['nom_client'];
				$nom_entreprise = @$_POST['nom_entreprise'];
				$adresse_numero_rue = @$_POST['adresse_numero_rue'];
				$adresse_nom_rue = @$_POST['adresse_nom_rue'];
				$adresse_nom_rue = @$_POST['adresse_nom_rue'];
				$adresse_code_postal = @$_POST['adresse_code_postal'];
				$adresse_ville = @$_POST['adresse_ville'];
				$email_client = @$_POST['email_client'];
                //Establish values that will be returned via ajax
                $return = array();
                $return['msg'] = '';
                $return['error'] = false;
                //Begin form validation functionality
                if (!isset($nom_client) || empty($nom_client)){
                        $return['error'] = true;
                        $return['msg'] .= '<li>Nom du client pas renseigné.</li>';
                }
                //Begin form success functionality
                if ($return['error'] === false){
						$mysqli = new mysqli("data.martibis.com", "user", "pwd", "database");
						if ($mysqli->connect_errno) {
							$return['error'] = true;
							$return['msg'] .= '<li>Echec lors de la connexion à MySQL</li>';
						}
                }
				if ($return['error'] === false){
						
						$sql = "INSERT INTO client(nom_client, nom_entreprise, adresse_numero_rue,adresse_nom_rue,adresse_code_postal,adresse_ville,email_client) 
						VALUES('$nom_client', '$nom_entreprise', '$adresse_numero_rue', '$adresse_nom_rue', '$adresse_code_postal', '$adresse_ville', '$email_client')";
						if(!$mysqli->query($sql))
							{
								//die('Error : ' . mysql_error());
								$return['error'] = true;
								$return['msg'] .= '<li>Echec lors de la requete  MySQL:' . mysql_error() . '</li>';
							}
				}
				if ($return['error'] === false){
                        $return['msg'] = '<li>Enregistrement terminée</li>';
                }
                //Return json encoded results
                return json_encode($return);
        }
}
$ajaxValidate = new ajaxValidate;
echo $ajaxValidate->formValidate();
?>