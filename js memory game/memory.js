var cardslist = ["ciri.png", "geralt.png", "jaskier.png", "jaskier.png", "iorweth.png", "triss.png", "geralt.png", "yen.png", "ciri.png", "triss.png", "yen.png", "iorweth.png", "eredin.png", "eredin.png", "imleritch.png", "imleritch.png", "letho.png", "letho.png", "radovid.png", "radovid.png", "zoltan.png", "zoltan.png", "regis.png", "regis.png"];
var cards = [];
var div = "";
for (i=0; i<cardslist.length; i++)
{
	div += '<div class="card" id="c'+i+'"></div>';
}
div += '<div class="score">Turn counter: 0</div>'
$('.board').html(div);

for (i=cardslist.length; i>0; i--)
{
	var rand = Math.floor(Math.random()*i);
	cards.push(cardslist[rand]);
	cardslist.splice(rand, 1);
}

cardsbyjq = $('.card');
function addlisteners(index)
{
	cardsbyjq.eq(index).on('click', function() { revealcard(index) });
}
for (i=0; i<cards.length; i++)
{
	addlisteners(i);
}


var onevisible = false;
var visiblenr;
var turncounter = 0;
var lock = false;
var pairsleft = 12;
isValid = new Boolean();

function revealcard(nr)
{
	var opacityvalue = cardsbyjq.eq(nr).css("opacity");
	isValid = opacityvalue != 0 && lock == false && nr != visiblenr
	if (!isValid)
	{
		return;
	}
	lock = true;
	var obraz = "url(img/" + cards[nr] + ")";
	cardsbyjq.eq(nr).css("background-image", obraz);
	cardsbyjq.eq(nr).addClass("cardA");
	cardsbyjq.eq(nr).removeClass("card");
	
	if (onevisible != false)
	{
		if (cards[visiblenr]==cards[nr])
		{
			setTimeout(function() { hide2cards(nr, visiblenr) }, 750);
		}
		else
		{
			setTimeout(function() { restore2cards(nr, visiblenr) }, 1000);
		}
		onevisible = false;
		turncounter++;
		$(".score").html("Turn counter: "+turncounter);
		return;
	}
	onevisible = true;
	visiblenr = nr;
	lock = false;
}

function hide2cards(nr1, nr2)
{
	cardsbyjq.eq(nr1).css("opacity", "0");
	cardsbyjq.eq(nr2).css("opacity", "0");
	lock = false;
	pairsleft--;
	if(pairsleft == 0)
	{
		$('.board').html('<br/><br/><h2>YOU WIN!</h2><h1>Done in '+turncounter+' turns</h1><br/><h3><span onclick="location.reload()"><i class="icon-right-big"></i>Play again<i class="icon-left-big"></i></span></h3>');
	}
}
function restore2cards(nr1, nr2)
{
	cardsbyjq.eq(nr1).css("background-image", 'url(img/karta.png)');
	cardsbyjq.eq(nr1).addClass("card");
	cardsbyjq.eq(nr1).removeClass("cardA");
	cardsbyjq.eq(nr2).css("background-image", 'url(img/karta.png)');
	cardsbyjq.eq(nr2).addClass("card");
	cardsbyjq.eq(nr2).removeClass("cardA");
	lock = false;
}

