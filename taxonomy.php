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
	case "tipi_evento":
		get_template_part("archive-tipi_evento");
		break;
	case "tipi_notizia":
		get_template_part("archive-tipi_notizia");
		break;
	default:
		get_template_part("archive");
		break;
}
