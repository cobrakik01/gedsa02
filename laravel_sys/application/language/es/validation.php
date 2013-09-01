<?php 

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used
	| by the validator class. Some of the rules contain multiple versions,
	| such as the size (max, min, between) rules. These versions are used
	| for different input types such as strings and files.
	|
	| These language lines may be easily changed to provide custom error
	| messages in your application. Error messages for custom validation
	| rules may also be added to this file.
	|
	*/

	"accepted"       => "El :attribute debe ser aceptada.",
	"active_url"     => "El :attribute no es una URL válida.",
	"after"          => "La :attribute debe ser una fecha posterior a :date.",
	"alpha"          => "El :attribute sólo puede contener letras.",
	"alpha_dash"     => "El :attribute sólo puede contener letras, números y guiones.",
	"alpha_num"      => "El :attribute sólo puede contener letras y números.",
	"array"          => "El :attribute debe haber seleccionado los elementos.",
	"before"         => "El :attribute debe ser una fecha anterior de :date.",
	"between"        => array(
		"numeric" => "El :attribute debe estar entre :min - :max.",
		"file"    => "El :attribute debe estar entre :min - :max kilobytes.",
		"string"  => "El :attribute debe estar entre :min - :max caracteres.",
	),
	"confirmed"      => "La confirmacion de :attribute no coincide.",
	"count"          => "El :attribute debe tener exactamente :count elementos seleccionados.",
	"countbetween"   => "El :attribute debe tener entre :min y :max elementos seleccionados.",
	"countmax"       => "El :attribute debe tener menos de :max elementos seleccionados.",
	"countmin"       => "El :attribute debe tener por lo menos :min elementos seleccionados.",
	"date_format"	 => "El :attribute debe tener un formato valido.",
	"different"      => "El :attribute y :other deben ser diferentes.",
	"email"          => "El :attribute tiene formato no valido.",
	"exists"         => "El :attribute seleccionado no es valido.",
	"image"          => "El :attribute debe ser una imagen.",
	"in"             => "El :attribute seleccionado no es valido.",
	"integer"        => "El :attribute debe ser un numero entero.",
	"ip"             => "El :attribute debe tener una direccion IP valida.",
	"match"          => "El :attribute tiene formato no valido.",
	"max"            => array(
		"numeric" => ":attribute no puede ser superior a :max.",
		"file"    => ":attribute no puede ser superior a :max kilobytes.",
		"string"  => ":attribute no puede ser superior a :max caracteres.",
	),
	"mimes"          => "El :attribute debe ser un archivo de type: :values.",
	"min"            => array(
		"numeric" => "El :attribute debe ser por lo menos de :min.",
		"file"    => "El :attribute debe ser por lo menos de :min kilobytes.",
		"string"  => "El :attribute debe ser por lo menos de :min caracteres.",
	),
	"not_in"         => "El  :attribute seleccionado no es valido.",
	"numeric"        => "El :attribute debe ser numerico.",
	"required"       => "El campo :attribute es obligatorio.",
    "required_with"  => "El campo :attribute es obligatorio con :field",
	"same"           => "El :attribute y :other debe coincidir.",
	"size"           => array(
		"numeric" => "El :attribute debe ser de :size.",
		"file"    => "El :attribute debe ser de :size kilobyte.",
		"string"  => "El :attribute debe ser de :size caracteres.",
	),
	"unique"         => "El :attribute ya existe.",
	"url"            => "El formato de :attribute no es valido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute_rule" to name the lines. This helps keep your
	| custom validation clean and tidy.
	|
	| So, say you want to use a custom validation message when validating that
	| the "email" attribute is unique. Just add "email_unique" to this array
	| with your custom message. The Validator will handle the rest!
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as "E-Mail Address" instead
	| of "email". Your users will thank you.
	|
	| The Validator class will automatically search this array of lines it
	| is attempting to replace the :attribute place-holder in messages.
	| It's pretty slick. We think you'll like it.
	|
	*/

	'attributes' => array(),

);
