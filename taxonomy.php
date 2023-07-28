<?php
global $obj;
$obj = get_queried_object();
switch ($obj->taxonomy) {
	case "categorie_servizio":
		get_template_part("archive-servizio");
		break;
	case "argomenti":
		get_template_part("archive-argomento");
		break;
	case "tipi_luogo":
		get_template_part("archive-tipi_luogo");
		break;
	default:
		get_template_part("archive");
		break;
}
