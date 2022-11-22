$(document).ready(function() {

    // Creamos el array de cada tipo de delito que contiene sus diferentes subtipos de delitos
    var sustraccion_de_motocicleta = [
        { display: "VIA PUBLICA", value: "VIA PUBLICA" },
        { display: "USO DE ARMA BLANCA O DE FUEGO", value: "USO DE ARMA BLANCA O DE FUEGO" },
        { display: "INTERIOR DEL DOMICILIO", value: "INTERIOR DEL DOMICILIO" },
        { display: "INTENTO", value: "INTENTO" }
    ];

    var sustraccion_de_automovil = [
        { display: "SUSTRACCION DEL RODADO", value: "SUSTRACCION DEL RODADO" },
        { display: "ELEMENTOS DEL INTERIOR", value: "ELEMENTOS DEL INTERIOR" },
        { display: "SUSTRACCION DE RUEDAS.", value: "SUSTRACCION DE RUEDAS" }
    ];

    var ilicito_contra_la_propiedad = [
        { display: "COMERCIO", value: "COMERCIO" },
        { display: "CASA PARTICULAR", value: "CASA PARTICULAR" },
        { display: "ENTIDAD PUBLICA", value: "ENTIDAD PUBLICA" },
        { display: "ASALTO CON ARMA BLANCA/ ELEMENTO CONTUNDENTE", value: "ASALTO CON ARMA BLANCA/ ELEMENTO CONTUNDENTE" },
        { display: "ASALTO CON ARMA DE FUEGO", value: "ASALTO CON ARMA DE FUEGO" },
        { display: "OBRA EN CONSTRUCCION", value: "OBRA EN CONSTRUCCION" },
        { display: "TOMA DE REHENES", value: "TOMA DE REHENES" }
    ];

    var arrebato = [
        { display: "INTENTO", value: "INTENTO" },
        { display: "CONSUMADO", value: "CONSUMADO" },
    ];

    var ilicito_en_la_via_publica = [
        { display: "SUMINISTRO ELECTRICO/SEÑAL DE TELEFONIA/OTROS", value: "SUMINISTRO ELECTRICO/SEÑAL DE TELEFONIA/OTROS" },
        { display: "ASALTO CON ARMA BLANCA/ ELEMENTO CONTUNDENTE", value: "ASALTO CON ARMA BLANCA/ ELEMENTO CONTUNDENTE" },
        { display: "ASALTO CON ARMA DE FUEGO", value: "ASALTO CON ARMA DE FUEGO" },
        { display: "SUSTRACCION DE BICICLETA", value: "SUSTRACCION DE BICICLETA" }
    ];

    var desorden = [
        { display: "VIVIENDA", value: "VIVIENDA" },
        { display: "VIA PUBLICA", value: "VIA PUBLICA" },
        { display: "CON ARMAS DE FUEGO", value: "CON ARMAS DE FUEGO" },
        { display: "ARMAS BLANCAS", value: "ARMAS BLANCAS" },
        { display: "PELEA DE GRUPOS ANTAGONICOS", value: "PELEA DE GRUPOS ANTAGONICOS" },
        { display: "DISCUSION ENTRE VECINOS", value: "DISCUSION ENTRE VECINOS" },
    ];

    var abuso_sexual = [
        { display: "ABUSO SEXUAL", value: "ABUSO SEXUAL" },
        { display: "TENTATIVA DE ABUSO", value: "TENTATIVA DE ABUSO" },
    ];

    var acoso_sexual = [
        { display: "ACOSO EN LA VIA PUBLICA", value: "ACOSO EN LA VIA PUBLICA" },
    ];

    var amenazas = [
        { display: "AMENAZA DE BOMBA", value: "AMENAZA DE BOMBA" },
        { display: "AMENAZA VERBAL", value: "AMENAZA VERBAL" },
        { display: "AMENAZAS CON ARMA BLANCA", value: "AMENAZAS CON ARMA BLANCA" },
        { display: "AMENAZAS CON ARMA DE FUEGO", value: "AMENAZAS CON ARMA DE FUEGO" }
    ];

    var armas = [
        { display: "DETONACIONES", value: "DETONACIONES" },
        { display: "PORTACION DE ARMA BLANCA", value: "PORTACION DE ARMA BLANCA" },
        { display: "PORTACION DE ARMA DE FUEGO", value: "PORTACION DE ARMA DE FUEGO" },
        { display: "USO INDEBIDO HONDA/AIRECOMPRIMIDO", value: "USO INDEBIDO HONDA/AIRECOMPRIMIDO" }
    ];

    var exhibiciones_obsenas = [
        { display: "EXHIBICION OBSENA EN LA VIA PUBLICA", value: "EXHIBICION OBSENA EN LA VIA PUBLICA" },
    ];

    var violencia_familiar_y_de_genero = [
        { display: "VIOLENCIA DE GENERO EN DOMICILIO", value: "VIOLENCIA DE GENERO EN DOMICILIO" },
        { display: "VIOLENCIA DE GENERO EN LA VIA PUBLICA", value: "VIOLENCIA DE GENERO EN LA VIA PUBLICA" },
        { display: "VIOLENCIA INTRAFAMILIAR", value: "VIOLENCIA INTRAFAMILIAR" }
    ];

    // Array de Elemento Utilizado -> Tipo Motocicleta

    var tipo_de_motocicleta = [
        { display: "110cc", value: "110cc" },
        { display: "125/150cc", value: "125/150cc" },
        { display: "Enduro", value: "Enduro" },
        { display: "No especifica", value: "No especifica" }
    ];

    // Array de Denuncia -> Unidad Judicial

    var unidad_judicial = [
        { display: "U.J. N° 1", value: "U.J. N° 1" },
        { display: "U.J. N° 2", value: "U.J. N° 2" },
        { display: "U.J. N° 3", value: "U.J. N° 3" },
        { display: "U.J. N° 4", value: "U.J. N° 4" },
        { display: "U.J. N° 5", value: "U.J. N° 5" },
        { display: "U.J. N° 6", value: "U.J. N° 6" },
        { display: "U.J. N° 7", value: "U.J. N° 7" },
        { display: "U.J. N° 8", value: "U.J. N° 8" },
        { display: "U.J. N° 9", value: "U.J. N° 9" },
        { display: "U.J. N° 10", value: "U.J. N° 10" },
        { display: "U.J. N° 11", value: "U.J. N° 11" },
        { display: "Fiscalia de instroduccion", value: "Fiscalia de instroduccion" },
        { display: "Unid. Violencia de genero", value: "Unid. Violencia de genero" }
    ];

    // Aqui creamos verificamos cual opciones apareceran dependiendo de la seleccion@superservicios

    $("#tipo").change(function() {
        var parent = $(this).val();

        switch (parent) {
            case 'SUSTRACCION DE MOTOCICLETA':
                list(sustraccion_de_motocicleta);
                break;
            case 'SUSTRACCION DE AUTOMOVIL':
                list(sustraccion_de_automovil);
                break;
            case 'ILICITO CONTRA LA PROPIEDAD':
                list(ilicito_contra_la_propiedad);
                break;
            case 'ARREBATO':
                list(arrebato);
                break;
            case 'ILICITO EN LA VIA PUBLICA':
                list(ilicito_en_la_via_publica);
                break;
            case 'DESORDEN':
                list(desorden);
                break;
            case 'ABUSO SEXUAL':
                list(abuso_sexual);
                break;
            case 'ACOSO SEXUAL':
                list(acoso_sexual);
                break;
            case 'AMENAZAS':
                list(amenazas);
                break;
            case 'ARMAS':
                list(armas);
                break;
            case 'EXHIBICIONES OBSENAS':
                list(exhibiciones_obsenas);
                break;
            case 'VIOLENCIA FAMILIAR Y DE GENERO':
                list(violencia_familiar_y_de_genero);
                break;
            default: //default child option is blank
                $("#subtipo").html('');
                $('#subtipo').prop('disabled', true);
                break;
        }
    });

    $("#ElementoUtilizado").change(function() {
        var parent = $(this).val();

        switch (parent) {
            case 'Motocicleta':
                list2(tipo_de_motocicleta);
                break;
            default: //default child option is blank
                $("#txtColor").val('');
                $("#TipoMotocicleta").html('');
                $('#txtColor').prop('disabled', true);
                $('#TipoMotocicleta').prop('disabled', true);
                break;
        }
    });

    $("#Denuncia").change(function() {
        var parent = $(this).val();

        switch (parent) {
            case 'Si':
                list3(unidad_judicial);
                break;
            default: //default child option is blank
                $("#txtDenunciante").val('');
                $("#UnidadJudicial").html('');
                $('#txtDenunciante').prop('disabled', true);
                $('#UnidadJudicial').prop('disabled', true);
                break;
        }
    });

    //function to populate child select box
    function list(array_list) {
        $("#subtipo").html(""); //reset child options
        $(array_list).each(function(i) { //populate child options
            $("#subtipo").append("<option value=\"" + array_list[i].value + "\">" + array_list[i].display + "</option>");
        });
        $('#subtipo').prop('disabled', false);
    }

    function list2(array_list2) {
        $("#TipoMotocicleta").html(""); //reset child options
        $(array_list2).each(function(i) { //populate child options
            $("#TipoMotocicleta").append("<option value=\"" + array_list2[i].value + "\">" + array_list2[i].display + "</option>");
        });
        $('#txtColor').prop('disabled', false);
        $('#TipoMotocicleta').prop('disabled', false);
    }

    function list3(array_list3) {
        $("#txtDenunciante").html(""); //reset child options
        $(array_list3).each(function(i) { //populate child options
            $("#UnidadJudicial").append("<option value=\"" + array_list3[i].value + "\">" + array_list3[i].display + "</option>");
        });
        $('#txtDenunciante').prop('disabled', false);
        $('#UnidadJudicial').prop('disabled', false);
    }
});