<?php

// The name of this module
define("_MI_PCDB_NAME","PC ir jo komponentų duomenų bazė");

// A brief description of this module
define("_MI_PCDB_DESC","PC ir jo komponentų duomenų bazė.");

//Menu strings
define("_MI_PCDB_SOFTWARE", "Programinė įranga");
define("_MI_PCDB_COMPUTERS", "Kompiuteriai");
define("_MI_PCDB_COMPONENTS", "Kompiuterių komponentai");
define("_MI_PCDB_GROUPS", "Komponentų grupės");
define("_MI_PCDB_OWNERS", "Seniunijos");
define("_MI_PCDB_SUBOWNERS", "Skyriai");
define("_MI_PCDB_LOG", "Logas");

//Other strings
define('_MI_PCDB_NORESULTS', 'Nėra duomenų');
define('_MI_PCDB_ADDNEW', 'Pridėti naują');
define('_MI_PCDB_NOCHOICE','Nėra pasirinkimo');
define('_MI_PCDB_ADDCOMPONENT','Pridėti komponentą');

define('_MI_PCDB_ADDSOFTWARE', 'Pridėti naują');
define('_MI_PCDB_EDITSOFTWARE', 'Redaguoti');
define('_MI_PCDB_ADDGROUP', 'Pridėti naują grupę');
define('_MI_PCDB_EDITGROUP', 'Redaguoti');
define('_MI_PCDB_ADDCOMPONENT','Pridėti naują komponentą');
define('_MI_PCDB_EDITCOMPONENT','Redaguoti komponentą');
define('_MI_PCDB_ADDOWNER','Pridėti naują seniuniją');
define('_MI_PCDB_EDITOWNER','Redaguoti seniuniją');
define('_MI_PCDB_ADDSUBOWNER','Pridėti naują skyrių');
define('_MI_PCDB_EDITSUBOWNER','Redaguoti skyrių');
define('_MI_PCDB_ADDCOMPUTER','Pridėti naują kompiuterį');
define('_MI_PCDB_EDITCOMPUTER','Redaguoti kompiuterį');

define('_MI_PCDB_FIELD_NAME','Pavadinimas');
define('_MI_PCDB_FIELD_LICENSES','Licenzijų skaičius');
define('_MI_PCDB_FIELD_GOTDATE','Įsigijimo data');
define('_MI_PCDB_FIELD_UNTILDATE','Galioja iki');
define('_MI_PCDB_FIELD_ID','ID');
define('_MI_PCDB_FIELD_DESCRIPTION','Apibūdinimas');
define('_MI_PCDB_FIELD_SERIALNR','Serijinis Nr.');
define('_MI_PCDB_FIELD_REMOVEDATE','Nurašymo data');
define('_MI_PCDB_FIELD_GROUPID','Komponentų grupė:');
define('_MI_PCDB_FIELD_OWNERID','Savivaldybė:');
define('_MI_PCDB_FIELD_SUBOWNERID','Skyrius:');
define('_MI_PCDB_FIELD_OWNERINFO','Vartotojas:');
define('_MI_PCDB_FIELD_DATE','Data');
define('_MI_PCDB_FIELD_TEXT','Tekstas');

define('_MI_PCDB_ADDED','Pridėta');
define('_MI_PCDB_SAVED','Išsaugota');
define('_MI_PCDB_DELETED','Ištrinta');
define('_MI_PCDB_CANTCOMPLETE','Nepavyko įvykdyti operacijos');

define('_MI_PCDB_VIEW','Peržiūra');
define('_MI_PCDB_COMMENTS','Komentarai');

define('_MI_PCDB_ICON_VIEW','Žiūrėti');
define('_MI_PCDB_ICON_EDIT','Redaguoti');
define('_MI_PCDB_ICON_DELETE','Ištrinti');
define('_MI_PCDB_ICON_COMPONENTS','Komponentai');

define('_MI_PCDB_COMMENT_WRITED','Parašė');

define('_MI_PCDB_ADDGROUPFIRST','Pridėkite pirma bent vieną prekių grupę');
define('_MI_PCDB_ADDOWNERFIRST','Pridėkite pirma bent vieną savininką');

define('_MI_PCDB_LOG_ADDED', 'Pridėtas naujas(-a) %s: <a href="%s">%s</a>.');
define('_MI_PCDB_LOG_DELETED', 'Ištrintas %s <b>%s</b>');
define('_MI_PCDB_LOG_UPDATED', 'Atnaujinti duomenys %s: <a href="%s">%s</a>.');
define('_MI_PCDB_LOG_COMMENT', 'Pridėtas naujas komentaras: <a href="%s">%s</a>');
define('_MI_PCDB_LOG_ASSIGNED', 'Priskirtas komponentas <a href="%s">%s</a> kompiuteriui <a href="%s">%s</a>');
define('_MI_PCDB_LOG_UNASSIGNED', 'Atskirtas komponentas <a href="%s">%s</a> nuo kompiuterio <a href="%s">%s</a>');

define('_MI_PCDB_SHOWFROM','Rodyti nuo:');
define('_MI_PCDB_COUNT','Iš viso įrašų: %s');

define('_MI_PCDB_LOG_WHAT_COMPUTER', 'kompiuteris');
define('_MI_PCDB_LOG_WHAT_SOFTWARE', 'programa');
define('_MI_PCDB_LOG_WHAT_COMPONENT', 'kompiuterio komponentas');
define('_MI_PCDB_LOG_WHAT_OWNER', 'seniunija');
define('_MI_PCDB_LOG_WHAT_SUBOWNER', 'skyrius');