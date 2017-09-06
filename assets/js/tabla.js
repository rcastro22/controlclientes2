/*!
 * tabla.js v1.0 por Departamento de Informatica
 * 2013 Universidad Galileo
 */

// :Contains sin distinguir entre mayusculas y minusculas
/*JVELASQUEZ - 01/08/2013: Se añadió la posibilidad de ocultar columnas, que las tablas se llenen de manera no asincrónica,
un data-tipo para poder mostrar html en las columnas y que 1 y 0 también puedan interpretarse como  booleans para mayor
correspondencia con la base de datos.

JVELASQUEZ - 02/09/2013: Se añadieron los campos autonumerico para mostrar correlativos de la tabla y checkbox para
insertar un checkbox en cada fila de la tabla. A la fecha se le da formato manualmente para ser mostrada tal y
como es recibida en todos los navegadores.

07/09/2013: Adaptar a lenguaje PHP*/
jQuery.expr[":"].Contains = jQuery.expr.createPseudo(function (arg)
{
    return function (elem)
    {
        return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});

// Dar formato a una fecha

Date.prototype.formato = function (Formato)
{

    var segmento = "";
    var resultado = "";

    for (var i = 0; i <= (Formato.length - 1) ; i++)
    {

        if ((segmento == "" || segmento.indexOf(Formato[i]) > -1)
            && (i + 1) < Formato.length)
        {

            // Agrupar
            segmento += Formato[i];
        }
        else
        {

            if ((i + 1) == Formato.length)
            {

                segmento += Formato[i];
            }

            // Mostrar
            switch (segmento)
            {

                case "dd":
                    segmento = this.getDate();

                    while (segmento.toString().length < 2)
                    {

                        segmento = "0" + segmento;
                    }

                    break;
                case "ddd":
                    segmento = Date.nombres.dias[this.getDay()].substring(0, 3);

                    break;
                case "dddd":
                    segmento = Date.nombres.dias[this.getDay()];

                    break;
                case "MM":
                    segmento = this.getMonth() + 1;

                    while (segmento.toString().length < 2)
                    {

                        segmento = "0" + segmento;
                    }

                    break;
                case "MMM":
                    segmento = Date.nombres.meses[this.getMonth()].substring(0, 3);

                    break;
                case "MMMM":
                    segmento = Date.nombres.meses[this.getMonth()];

                    break;
                case "yyyy":
                    segmento = this.getFullYear();

                    while (segmento.toString().length < 4)
                    {

                        segmento = "0" + segmento;
                    }

                    break;
                case "HH":
                    segmento = this.getHours();

                    while (segmento.toString().length < 2)
                    {

                        segmento = "0" + segmento;
                    }

                    break;
                case "mm":
                    segmento = this.getMinutes();

                    while (segmento.toString().length < 2)
                    {

                        segmento = "0" + segmento;
                    }

                    break;
                case "ss":
                    segmento = this.getSeconds();

                    while (segmento.toString().length < 2)
                    {

                        segmento = "0" + segmento;
                    }

                    break;
            }

            resultado += segmento;

            segmento = Formato[i];
        }
    }

    return resultado;
}

Date.nombres = {
    meses: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'],
    dias: ['DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO']
};

// Dar formato a un decimal

Number.prototype.formato = function (Formato)
{
    var val = this;
    var resultado = "";

    // Decimales

    var IndiceDecimal = Formato.lastIndexOf(".");
    var Indice = val.toString().indexOf(".");

    if (IndiceDecimal > -1)
    {
        /* JVELASQUEZ: 17/09/2013 - Resultado inicia con punto y si el valor no
        tiene punto decimal todos los dígitos decimales de resultado serán 0*/
        resultado = ".";
        for (var i = IndiceDecimal + 1; i < Formato.length; i++)
        {
            var digito = Indice != -1 ? val.toString().charAt(Indice + (i - IndiceDecimal)) : "0";

            // Mostrar
            switch (Formato[i])
            {
                case "#":
                    resultado += digito;
                    break;
                case "0":
                    resultado += (digito == "") ? "0" : digito;
                    break;
                default:
                    resultado += Formato[i];
            }
        }
    }
    else
    {
        // Aproximar a enteros
        val = Math.round(val);
        IndiceDecimal = Formato.length;
        Indice = val.toString().length;
    }

    /* JVELASQUEZ: 17/09/2013 - Si el valor no tiene punto decimal todos los dígitos son enteros.*/
    if (Indice == -1)
    {
        Indice = val.toString().length;
    }

    // Enteros
    var ModoExtra = false;

    for (var i = (IndiceDecimal - 1) ; i >= 0; i--)
    {
        Indice--;

        var digito = val.toString().charAt(Indice);

        if (ModoExtra == false)
        {
            if (Formato[i] == "0")
            {
                resultado = (digito == "" ? "0" : digito) + resultado;
            }
            else if (Formato[i] == "#" && digito != "")
            {
                resultado = digito + resultado;
            }
            else if (Formato[i] == "#" && digito == "")
            {
                break;
            }
            else if (Formato[i] == ",")
            {
                if (Formato[i - 1] == "0")
                {
                    resultado = "," + resultado;
                    Indice++;
                }
                else if (Formato[i - 1] == "#" && digito != "")
                {
                    resultado = "," + resultado;
                    ModoExtra = true;
                    i = IndiceDecimal;
                    Indice++;
                }
                else
                {
                    break;
                }
            }
            else
            {
                resultado = Formato[i] + resultado;
            }
        }
        else
        {
            if (Formato[i] == ",")
            {
                if (digito != "")
                {
                    resultado = "," + resultado;
                    i = IndiceDecimal;
                    Indice++;
                }
                else
                {
                    break;
                }
            }
            else
            {
                // El simbolo es #
                if (digito != "")
                {
                    resultado = digito + resultado;
                }
                else
                {
                    break;
                }
            }
        }
    }

    return resultado;
};
// Mostrar informacion extra

$("table[data-filtro=true] > tbody > tr").hover(

	function ()
	{
	    $(this).popover("show");
	},
	function ()
	{
	    $(this).popover("hide");
	}
);

// Mostrar cursor en el encabezado para ordenar

$("table[data-orden=true] > thead > tr > th").css("cursor", "pointer");

// Funcion - Agregar una tabla

//JVELASQUEZ - 05/07/2013: Se sobrecargó el método recibiendo el parámetro Async y
//mandando a llamar a la función llenarTablaAsync para poder deshabilitar la propiedad Async
//del método Ajax, para evitar problemas al llenar varias tablas u ocultar columnas simultaneamente

$.fn.tabla = function (MetodoWeb, Parametros)
{
    Nombre = $(this).attr('id');
    llenarTablaAsync(Nombre, MetodoWeb, Parametros, true);
};

$.fn.tabla = function (MetodoWeb, Parametros, Async) {
    Nombre = $(this).attr('id');
    llenarTablaAsync(Nombre, MetodoWeb, Parametros, Async);
};

//JVELASQUEZ - 05/07/2013: La función ejecuta el ajax para llenar la tabla, recibiendo los
//distintos parámetros de la función sobrecargada TABLA.
function llenarTablaAsync(Nombre, MetodoWeb, Parametros, Async){

	var codigo = $('input[name=csrf_test_name]').val();

	Parametros = {'csrf_test_name': codigo};

    $.ajax({
        type: "POST",
        url: MetodoWeb,
		  data: Parametros,
        async: Async,
        success: function (msg)
        {
            var Fuente = $("#" + Nombre).attr("data-fuente");

            window[Fuente] = msg;

            // Filtrar, ordenar, calcular y generar

            var Datos = FiltrarFilas("", Fuente);

            OrdenarFilas(Datos, null, null, true);
            CalcularPaginas(Nombre, Datos);

            GenerarFilas(Nombre, Datos);
        },
        error: function (msg)
        {
            var Columnas = $("#" + Nombre + " > thead > th").size();
            var tr = $(document.createElement('tr'));
            var td = $(document.createElement('td'));

            td.attr("colspan", Columnas);
            td.text("Ha ocurrido un problema al cargar la tabla.");
            tr.append(td);

            $("#" + Nombre + " > tbody").append(tr);

            $("div.pagination > ul[data-tabla=" + Nombre + "]").parent().hide();
        }
    });
};

// Filtrar JSON

function FiltrarFilas(Buscar, Datos)
{

    if (Buscar != "")
    {

        var filtrado = $(window[Datos]).filter(function (index)
        {

            var Respuesta = false;

            $.each(this, function ()
            {

                if (this.toString().toUpperCase().indexOf(Buscar.toUpperCase()) !== -1)
                {
                    Respuesta = true;
                }
            });

            return Respuesta;
        });

        return filtrado;
    }
    else
    {
        return window[Datos];
    }
}

// Ordenar JSON

function OrdenarFilas(datos, columna, tipo, asc)
{
    if (columna != null)
    {

        if (asc)
        {
            datos.sort(function (a, b)
            {
                if (tipo == "string")
                {
                    return a[columna].localeCompare(b[columna]);
                }
                else
                {
                    if (a[columna] < b[columna]) return -1;
                    if (a[columna] > b[columna]) return 1;
                    return 0;
                }
            });
        }
        else
        {
            datos.sort(function (a, b)
            {
                if (tipo == "string")
                {
                    return b[columna].localeCompare(a[columna]);
                }
                else
                {
                    if (a[columna] < b[columna]) return 1;
                    if (a[columna] > b[columna]) return -1;
                    return 0;
                }
            });
        }

    }
}

// Calcular las paginas

function CalcularPaginas(Tabla, Datos)
{

    // Datos

    var n = $(Datos).size();
    var q = $("ul[data-tabla=" + Tabla + "]").attr("data-cantidad");

    var pq = Math.ceil(n / q);

    if (pq > 0)
    {

        $("div.pagination > ul[data-tabla=" + Tabla + "]").parent().show();

        // Elementos

        var li = $(document.createElement('li'));
        var a = $(document.createElement('a'));

        a.attr("href", "#");
        a.html("&laquo;");
        li.append(a);

        // Filtrar los botones de paginacion

        var pa = $("ul[data-tabla=" + Tabla + "] > li.active");
        var qa = $("ul[data-tabla=" + Tabla + "]").attr("data-grupo");

        var numero = Number(pa.text());

        if (numero > 0)
        {

            // Es un numero
            var ga = Math.ceil(pa.text() / qa);

            var gp1 = ga * qa;
            var gp0 = (gp1 - qa) + 1;
        }
        else if (pa.text() == "..." && pa.prev().text() == String.fromCharCode(171))
        {

            // Retroceder un grupo
            numero = Number(pa.next().text());

            var gp1 = numero - 1;
            var gp0 = (gp1 - qa) + 1;

            numero = gp1;
        }
        else if (pa.text() == "..." && pa.next().text() == String.fromCharCode(187))
        {

            // Avanzar un grupo
            numero = Number(pa.prev().text());

            var gp1 = numero + Number(qa);
            var gp0 = (gp1 - qa) + 1;

            numero = gp0;
        }
        else
        {

            numero = 1;

            // No es numero
            var gp1 = qa;
            var gp0 = 1;
        }

        gp1 = (pq > gp1) ? gp1 : pq;

        $("ul[data-tabla=" + Tabla + "] > li").remove();

        // Boton anterior

        $("ul[data-tabla=" + Tabla + "]").append(li);

        // Hay mas paginas a la izquierda

        if (gp0 > 1)
        {

            li = $(document.createElement('li'));
            a = $(document.createElement('a'));

            a.attr("href", "#");
            a.text("...");
            li.append(a);

            $("ul[data-tabla=" + Tabla + "]").append(li);
        }

        // Numeros del centro

        for (var i = gp0; i <= gp1; i++)
        {

            li = $(document.createElement('li'));
            a = $(document.createElement('a'));

            a.attr("href", "#");
            a.text(i);
            li.append(a);

            if (numero == i)
            {

                li.addClass("active");
            }

            $("ul[data-tabla=" + Tabla + "]").append(li);
        }

        // Hay mas paginas a la derecha

        if (pq > gp1)
        {

            li = $(document.createElement('li'));
            a = $(document.createElement('a'));

            a.attr("href", "#");
            a.text("...");
            li.append(a);

            $("ul[data-tabla=" + Tabla + "]").append(li);
        }

        // Boton siguiente

        li = $(document.createElement('li'));
        a = $(document.createElement('a'));

        a.attr("href", "#");
        a.html("&raquo;");
        li.append(a);

        $("ul[data-tabla=" + Tabla + "]").append(li);

        if ($("ul[data-tabla=" + Tabla + "] > li.active").index() == 1)
        {

            // Inhabilitar el boton anterior
            $("ul[data-tabla=" + Tabla + "] > li:eq(0)").addClass("disabled");
        }

        if ($("ul[data-tabla=" + Tabla + "] > li.active").index() == ($("ul[data-tabla=" + Tabla + "] > li").size() - 2))
        {

            // Inhabilitar el boton siguiente
            $("ul[data-tabla=" + Tabla + "] > li:eq(" + ($("ul[data-tabla=" + Tabla + "] > li").size() - 1) + ")").addClass("disabled");
        }
    }
    else
    {

        $("div.pagination > ul[data-tabla=" + Tabla + "]").parent().hide();
    }
}

// Generar las filas en pantallas
// JVELASQUEZ - 05/07/2013: Si a alguna celda del thead tiene una clase, se le asigna dicha clase
// a toda la columna si dicha celda tiene un data-campo asignado

function GenerarFilas(Tabla, Datos)
{
    var n = $(Datos).size();
    var q = $("ul[data-tabla=" + Tabla + "]").attr("data-cantidad");
    var p = $("ul[data-tabla=" + Tabla + "] > li.active").text();

    if (p == "")
    {

        p = 1;
    }

    var tr1 = p * q;
    var tr0 = tr1 - q;

    var datos = $(Datos).slice(tr0, tr1);

    $("#" + Tabla + " > tbody > tr").remove();

    datos.each(function (indice, fila)
    {

        // Crear la fila

        var tr = $(document.createElement('tr'));
        // Barrer las columnas

        $("#" + Tabla + " > thead > tr > th").each(function (key)
        {

            var Campo = $(this).attr("data-campo");
            var Tipo = $(this).attr("data-tipo");
            var Alineacion = $(this).attr("data-alineacion");            
            
            if (Campo == undefined)
            {
                // JVELASQUEZ - 05/07/2013: Se obtiene la clase del header
                var Oculto = $(this).attr("class");

                var td = $(document.createElement('td'));

                // JVELASQUEZ - 05/07/2013: Se añade la clase a las casillas de la columna
                if (Oculto != undefined) {
                    td.addClass(Oculto);
                }


                if (Tipo == "icono") {
                    
                    var Formato = $(this).attr("data-formato");

                    var i = $(document.createElement('i'));
                    i.addClass("glyphicon glyphicon-" + Formato);
                    i.css("cursor", "pointer");
                    i.attr("data-toggle", "tooltip");
                    if (Formato == "edit") {
                        i.attr("title", "Editar");
                    }

                    td.append(i);
                // JVELASQUEZ - 02/09/2013: Se añade el tipo autonumérico para generar los correlativos en cada fila de la tabla
                } else if (Tipo == "autonumerico") {
                    td.text($("#" + Tabla + " tr").length);
                }
                else
                {
                    // Determinar si es boton
                    var Boton = $(this).attr("data-boton");

                    

                    switch (Boton) {

                        case "editar":
                            var i = $(document.createElement('i'));
                            i.addClass("glyphicon glyphicon-edit");
                            i.css("cursor", "pointer");
                            i.attr("data-toggle", "tooltip");
                            i.attr("title", "Editar");

                            td.append(i);

                            break;
                        case "borrar":
                            var i = $(document.createElement('i'));
                            var a = $(document.createElement('a'));

                            i.addClass("glyphicon glyphicon-trash");
                            i.css("cursor", "pointer");
                            i.attr("data-toggle", "tooltip");
                            i.attr("title", "Eliminar");
                            a.attr("href", "#" + Tabla + "_borrar");
                            a.attr("data-toggle", "modal");

                            a.append(i);
                            td.append(a);

                            break;
                        default:
                            var button = $(document.createElement('button'));

                            button.addClass("btn btn-default");
                            button.text(Boton);
                            td.append(button);
                    }
                }
               

                td.css("text-align", "center");
                tr.append(td);
            }
            else
            {
                // JVELASQUEZ - 05/07/2013: Se obtiene la clase del header
                var Oculto = $(this).attr("class");

                var td = $(document.createElement('td'));

                // JVELASQUEZ - 05/07/2013: Se añade la clase a las casillas de la columna
                if (Oculto != undefined) {
                    td.addClass(Oculto);
                }

                switch (Tipo)
                {
                    // JVELASQUEZ - 20/07/2013: Si el campo viene null, se inserta un string vacío y no la palabra null
                    case "string":
                        if (fila[Campo] != null) {
                            td.text(fila[Campo]);
                        } else {
                            td.text("");
                        }

                        break;
                    case "int":
                        var x = Number(fila[Campo]);
                        var Formato = $(this).attr("data-formato");

                        if (Formato != undefined && Formato != "")
                        {
                            td.text(x.formato(Formato));
                        }
                        else
                        {
                            td.text(x);
                        }

                        break;
                    case "decimal":
                        var x = Number(fila[Campo]);
                        var Formato = $(this).attr("data-formato");

                        if (Formato != undefined && Formato != "")
                        {
                            td.text(x.formato(Formato));
                        }
                        else
                        {
                            td.text(x);
                        }

                        break;
                    case "datetime":
                        // JVELASQUEZ - 02/09/2013: Se le da formato manualmente a la fecha para que sea mostrada tal y como es recibida.
                        var arr = fila[Campo].split("T");
                        var re = new RegExp("-", "g"); // Creamos expresión regular para remplazar “-” por “/”
                        var fecha_barra = arr[0].replace(re, "/"); // reemplazamos

                        fecha = new Date(fecha_barra);
                        var Formato = $(this).attr("data-formato");

                        if (Formato != undefined && Formato != "")
                        {
                            td.text(fecha.formato(Formato));
                        }
                        else
                        {
                            td.text(fecha.toLocaleString());
                        }

                        break;
                    case "bool":

                        //JVELASQUEZ - 25/07/2013: Los campos boolean interpretan 0 como false y cualquier otro número como
                        //true para mayor correspondencia con la base de datos.
                        var icono = $(document.createElement('i'));

                        if (fila[Campo] == false || fila[Campo] == 0)
                        {
                            icono.addClass("glyphicon glyphicon-remove-sign");
                        }
                        else
                        {
                            icono.addClass("glyphicon glyphicon-ok-sign");
                        }

                        td.html(icono);

                        break;
                    case "checkbox":

                        //JVELASQUEZ - 02/09/2013: Se añadió el tipo checkbox para que sea más intuitiva la forma de cambiarlo que el campo boolean.
                        var checkbox = $(document.createElement('input'));
                        checkbox.attr("type", "checkbox");
                        checkbox.addClass("info");

                        td.html(checkbox);

                        if (fila[Campo] != false && fila[Campo] != 0) {
                            checkbox.prop("checked", true);
                        }

                        break;
                    case "foto":
                        var img = $(document.createElement('img'));

                        img.addClass("img-polaroid");
                        img.css("height", "80px");
                        img.css("width", "60px");
                        img.attr("src", fila[Campo]);

                        td.html(img);

                        break;
                    //JVELASQUEZ - 25/07/2013: Se agrego el data-tipo html para insertar html en la tabla.
                    case "html":
                        if (fila[Campo] != null) {
                            td.html(fila[Campo]);
                        } else {
                            td.html("");
                        }

                        break;
                }

                if (Alineacion == "centro")
                {

                    td.css("text-align", "center");
                }
                else if (Alineacion == "derecha")
                {

                    td.css("text-align", "right");
                }

               tr.append(td);
            }
        });

        $("#" + Tabla + " > tbody").append(tr);
    });

    // Mostrar la manita sobre cada fila

    $("#" + Tabla + "[data-seleccion=true] > tbody").css("cursor", "pointer");

    // Mostrar mensaje cuando no hay filas

    if (datos.size() == 0)
    {

        var Columnas = $("#" + Tabla + " > thead > tr > th").size();
        var tr = $(document.createElement('tr'));
        var td = $(document.createElement('td'));

        td.attr("colspan", Columnas);
        td.text("No hay filas para mostrar.");
        tr.append(td);

        $("#" + Tabla + " > tbody").append(tr);
    }
}

// Evento - Filtrar la tabla

$("div.form-search > input.search-query").keydown(function (event)
{
    if (event.which == 13)
    {
        event.preventDefault();
    }
});

$("div.form-search > input.search-query").keyup(function (event)
{
    var tabla = $(this).parent().attr("data-tabla");
    var Buscar = $(this).val();
    var Fuente = $("#" + tabla).attr("data-fuente");

    // Determinar el orden

    var asc = $("#" + tabla + " > thead > tr > th > i.glyphicon-chevron-up").parent();
    var desc = $("#" + tabla + " > thead > tr > th > i.glyphicon-chevron-down").parent();
    var Columna = null;
    var tipo = null;
    var orden;

    if (asc.size() > 0)
    {

        Columna = asc.attr("data-campo");
        tipo = asc.attr("data-tipo");
        orden = true;
    }
    else if (desc.size() > 0)
    {

        Columna = desc.attr("data-campo");
        tipo = desc.attr("data-tipo");
        orden = false;
    }

    // Reiniciar la paginacion

    $("div.pagination > ul[data-tabla=" + tabla + "] > li.active").removeClass("active");

    var Datos = FiltrarFilas(Buscar, Fuente);
    OrdenarFilas(Datos, Columna, tipo, orden);
    CalcularPaginas(tabla, Datos);
    GenerarFilas(tabla, Datos);
});

// Evento - Ordenar la tabla

$("table[data-orden=true] > thead > tr > th").click(function ()
{

    if ($(this).text() != "")
    {
        var tabla = $(this).parent().parent().parent().attr("id");
        var tipo = $(this).attr("data-tipo");
        var campo = $(this).attr("data-campo");
        var orden = $(this).children("i").hasClass("icon-chevron-up");
        var Fuente = $("#" + tabla).attr("data-fuente");

        $(this).siblings().children("i").removeClass("icon-chevron-up");
        $(this).siblings().children("i").removeClass("icon-chevron-down");

        if (orden == true)
        {
            $(this).children("i").removeClass("icon-chevron-up");
            $(this).children("i").addClass("icon-chevron-down");
            orden = false;
        }
        else
        {
            $(this).children("i").removeClass("icon-chevron-down");
            $(this).children("i").addClass("icon-chevron-up");
            orden = true;
        }

        // Filtrar, ordenar, calcular y generar

        var Buscar = $("div.form-search[data-tabla=" + tabla + "] > input").val();

        var Datos = FiltrarFilas(Buscar, Fuente);
        OrdenarFilas(Datos, campo, tipo, orden);
        CalcularPaginas(tabla, Datos);
        GenerarFilas(tabla, Datos);
    }
});

// Evento - Calcular las paginas de la tabla

$(document).on("click", "div.pagination > ul > li", function ()
{

    if ($(this).hasClass("disabled") == false && $(this).hasClass("active") == false)
    {

        var p = Number($(this).text());

        if (isNaN(p) == false)
        {

            $(this).siblings().removeClass("active");
            $(this).addClass("active");
        }
        else
        {

            var html = $("a", this).html();

            if (html == String.fromCharCode(171))
            {

                p = $(this).siblings("li.active");

                p.removeClass("active");
                p.prev().addClass("active");
            }
            else if (html == String.fromCharCode(187))
            {

                p = $(this).siblings("li.active");

                p.removeClass("active");
                p.next().addClass("active");
            }
            else
            {

                $(this).siblings().removeClass("active");
                $(this).addClass("active");
            }
        }

        // Valores para actualizar la tabla

        var tabla = $(this).parent().attr("data-tabla");
        var Buscar = $("div.form-search[data-tabla=" + tabla + "] > input").val();
        var Fuente = $("#" + tabla).attr("data-fuente");

        var asc = $("#" + tabla + " > thead > tr > th > i.icon-chevron-up");
        var desc = $("#" + tabla + " > thead > tr > th > i.icon-chevron-down");
        var Columna = null;
        var tipo = null;
        var orden;

        if (asc.size() > 0)
        {

            Columna = asc.parent().attr("data-campo");
            tipo = asc.parent().attr("data-tipo");
            orden = true;
        }
        else if (desc.size() > 0)
        {

            Columna = desc.parent().attr("data-campo");
            tipo = desc.parent().attr("data-tipo");
            orden = false;
        }

        // Filtrar, ordenar, calcular y generar

        var Datos = FiltrarFilas(Buscar, Fuente);
        OrdenarFilas(Datos, Columna, tipo, orden);
        CalcularPaginas(tabla, Datos);
        GenerarFilas(tabla, Datos);
    }

    return false;
});

// Agregar iconos al encabezado

$("table[data-orden=true] > thead > tr > th").append('<i class="pull-right"></i>');

// Agregar evento a la fila

$("table[data-orden=true] > tbody > tr > td > ").append('<i class="pull-right"></i>');
