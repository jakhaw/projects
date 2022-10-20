var slownik = new Array(15);
slownik[0] = "Bez pracy nie ma kołaczy";
slownik[1] = "Gdyby kózka nie skakała to by nóżki nie złamala";
slownik[2] = "I dobrze mu tak";
slownik[3] = "cała mądrość nie mieści się w jednej głowie";
slownik[4] = "cel uświęca środki";
slownik[5] = "każda pliszka swój ogonek chwali";
slownik[6] = "kłamstwo ma krótkie nogi";
slownik[7] = "siedzieć jak na tureckim kazaniu";
slownik[8] = "w marcu jak w garncu";
slownik[9] = "wpaść jak śliwka w kompot";
slownik[10] = "ani mnie to ziębi, ani grzeje";
slownik[11] = "daj mu palec, a on całą rękę chwyta";
slownik[12] = "gadał dziad do obrazu, a obraz ni razu";
slownik[13] = "gdy się człowiek spieszy, to się diabeł cieszy";
slownik[14] = "uderz w stół, a nożyce się odezwą";
los = Math.floor(Math.random()*14+0);
var haslo = slownik[los];
haslo = haslo.toUpperCase();
var skucha= 0;
var haslo1 = "";

var dlugosc = haslo.length;

for (i=0; i<dlugosc; i++)
{
	if (haslo.charAt(i)==" ") haslo1 += " ";
	else if (haslo.charAt(i)==",") haslo1 += ",";
	else haslo1 += "-";
}

function wypiszhaslo()
{
	document.getElementById("plansza").innerHTML = haslo1;
}
window.onload = start;

var litery = new Array(35);

litery[0] = "A";
litery[1] = "Ą";
litery[2] = "B";
litery[3] = "C";
litery[4] = "Ć";
litery[5] = "D";
litery[6] = "E";
litery[7] = "Ę";
litery[8] = "F";
litery[9] = "G";
litery[10] = "H";
litery[11] = "I";
litery[12] = "J";
litery[13] = "K";
litery[14] = "L";
litery[15] = "Ł";
litery[16] = "M";
litery[17] = "N";
litery[18] = "Ń";
litery[19] = "O";
litery[20] = "Ó";
litery[21] = "P";
litery[22] = "Q";
litery[23] = "R";
litery[24] = "S";
litery[25] = "Ś";
litery[26] = "T";
litery[27] = "U";
litery[28] = "V";
litery[29] = "W";
litery[30] = "X";
litery[31] = "Y";
litery[32] = "Z";
litery[33] = "Ź";
litery[34] = "Ż";

function start()
{
	var trescdiva = "";
	
	for (i=0; i<35; i++)
	{
		var element = "lit" + i;
		trescdiva += '<div class="litera" onclick="sprawdz('+i+')" id="'+element+'">'+litery[i]+'</div>';
		if ((i+1) % 7 == 0) trescdiva += '<div style="clear: both;"></div>'
	}
	
	document.getElementById("alfabet").innerHTML = trescdiva;
	wypiszhaslo();
}

String.prototype.ustawznak = function(miejsce, znak)
{
	if (miejsce > this.lenght - 1) return this.toString();
	else return this.substr(0, miejsce) + znak + this.substr(miejsce + 1);
}

function sprawdz(nr)
{
	var trafiona = false;
	
	for (i=0; i<dlugosc; i++)
	{
		if (haslo.charAt(i) == litery[nr])
		{
			haslo1 = haslo1.ustawznak(i, litery[nr]);
			trafiona = true;
		}
	}
	
	if(trafiona==true)
	{
		var element = "lit" + nr;
		document.getElementById(element).style.background = "#003300";
		document.getElementById(element).style.color = "#00c000";
		document.getElementById(element).style.border = "3px solid #00c000";
		document.getElementById(element).style.cursor = "default";
		wypiszhaslo();
	}
	else
	{
		var element = "lit" + nr;
		document.getElementById(element).style.background = "#330000";
		document.getElementById(element).style.color = "#c00000";
		document.getElementById(element).style.border = "3px solid #c00000";
		document.getElementById(element).style.cursor = "default";
		document.getElementById(element).setAttribute("onclick",";");
		
		skucha++;
		var obraz = "img/s" + skucha + ".jpg";
		document.getElementById("szubienica").innerHTML = '<img src="'+obraz+'"alt=""/>';
	}
	
	if (haslo == haslo1)
	{
		document.getElementById("alfabet").innerHTML = 'Tak jest, <span class="wygrana">WYGRANA!</span>, </br> hasło: '+haslo+'<br/><br/><br/><br/><span class="reset" onclick="location.reload()">JESZCZE RAZ?</span>';
	}
	else if (skucha >= 9)
	{
		document.getElementById("alfabet").innerHTML = 'Niestety <span class="porazka">PORAŻKA!</span> </br> Hasło to: '+haslo+'<br/><br/><br/><br/><span class="reset" onclick="location.reload()">JESZCZE RAZ?</span>';
	}
	
}