﻿window.SINGLE_TAB = "  ";
window.QuoteKeys = true; //是否添加引号
function IsArray(obj) {
    return obj && typeof obj === 'object' && typeof obj.length === 'number' && !(obj.propertyIsEnumerable('length'));
}

function jsonFormat() {
    SetTab();
    var jsonData = $(".json-data").text();
    var jsonBox = $(".json-box");
    var html = "";

    try {

        if(jsonData){
            var obj = eval("[" + jsonData + "]");
            html = ProcessObject(obj[0], 0, false, false, false);
            jsonBox.html("<PRE class='CodeContainer'>" + html + "</PRE>");
        }else{

            jsonBox.html('');

        }

    } catch(e) {
        console.log("JSON数据格式不正确:\n" + e.message);
        //jsonBox.html('');
    }
}

window._dateObj = new Date();
window._regexpObj = new RegExp();

function ProcessObject(obj, indent, addComma, isArray, isPropertyContent) {
    var html = "";
    var comma = (addComma) ? "<span class='Comma'>,</span> ": "";
    var type = typeof obj;
    if (IsArray(obj)) {
        if (obj.length == 0) {
            html += GetRow(indent, "<span class='ArrayBrace'>[ ]</span>" + comma, isPropertyContent);
        } else {
            html += GetRow(indent, "<span class='ArrayBrace'>[</span>", isPropertyContent);
            for (var i = 0; i < obj.length; i++) {
                html += ProcessObject(obj[i], indent + 1, i < (obj.length - 1), true, false);
            }
            html += GetRow(indent, "<span class='ArrayBrace'>]</span>" + comma);
        }
    } else if (type == 'object') {
        if (obj == null) {
            html += FormatLiteral("null", "", comma, indent, isArray, "Null");
        } else if (obj.constructor == window._dateObj.constructor) {
            html += FormatLiteral("new Date(" + obj.getTime() + ") /*" + obj.toLocaleString() + "*/", "", comma, indent, isArray, "Date");
        } else if (obj.constructor == window._regexpObj.constructor) {
            html += FormatLiteral("new RegExp(" + obj + ")", "", comma, indent, isArray, "RegExp");
        } else {
            var numProps = 0;
            for (var prop in obj) numProps++;
            if (numProps == 0) {
                html += GetRow(indent, "<span class='ObjectBrace'>{ }</span>" + comma, isPropertyContent);
            } else {
                html += GetRow(indent, "<span class='ObjectBrace'>{</span>", isPropertyContent);

                var j = 0;

                for (var prop in obj) {

                    var quote = window.QuoteKeys ? "\"": "";

                    html += GetRow(indent + 1, "<span class='PropertyName'>" + quote + prop + quote + "</span>: " + ProcessObject(obj[prop], indent + 1, ++j < numProps, false, true));

                }

                html += GetRow(indent, "<span class='ObjectBrace'>}</span>" + comma);

            }

        }

    } else if (type == 'number') {

        html += FormatLiteral(obj, "", comma, indent, isArray, "Number");

    } else if (type == 'boolean') {

        html += FormatLiteral(obj, "", comma, indent, isArray, "Boolean");

    } else if (type == 'function') {

        if (obj.constructor == window._regexpObj.constructor) {

            html += FormatLiteral("new RegExp(" + obj + ")", "", comma, indent, isArray, "RegExp");

        } else {

            obj = FormatFunction(indent, obj);

            html += FormatLiteral(obj, "", comma, indent, isArray, "Function");

        }

    } else if (type == 'undefined') {

        html += FormatLiteral("undefined", "", comma, indent, isArray, "Null");

    } else {

        html += FormatLiteral(obj.toString().split("\\").join("\\\\").split('"').join('\\"'), "\"", comma, indent, isArray, "String");

    }

    return html;

}

function FormatLiteral(literal, quote, comma, indent, isArray, style) {

    if (typeof literal == 'string')

        literal = literal.split("<").join("&lt;").split(">").join("&gt;");

    var str = "<span class='" + style + "'>" + quote + literal + quote + comma + "</span>";

    if (isArray) str = GetRow(indent, str);

    return str;

}

function FormatFunction(indent, obj) {

    var tabs = "";

    for (var i = 0; i < indent; i++) tabs += window.TAB;

    var funcStrArray = obj.toString().split("\n");

    var str = "";

    for (var i = 0; i < funcStrArray.length; i++) {

        str += ((i == 0) ? "": tabs) + funcStrArray[i] + "\n";

    }

    return str;

}

function GetRow(indent, data, isPropertyContent) {

    var tabs = "";

    for (var i = 0; i < indent && !isPropertyContent; i++) tabs += window.TAB;

    if (data != null && data.length > 0 && data.charAt(data.length - 1) != "\n")

        data = data + "\n";

    return tabs + data;

}

function SetTab() {

    window.TAB = MultiplyString(2, window.SINGLE_TAB);

}

function MultiplyString(num, str) {

    var sb = [];

    for (var i = 0; i < num; i++) {

        sb.push(str);

    }

    return sb.join("");

}