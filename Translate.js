var WaitString = "/7ogo>|<guTe... ugEm /7epeBog!";
var LastLamakWord = "";

function LamakSays() {
	var LW = document.getElementById("LamakWord").value;
	if (LastLamakWord == LW) return;
	LastLamakWord = document.getElementById("LamakWord").value;
	document.getElementById("Translated").value = WaitString;
	var R = new phpRequest(function(LamakPhrase){
		document.getElementById("Translated").value = LamakPhrase;
		var Chat = document.getElementById("Chat");
		var Message = document.createTextNode("- " + LamakPhrase);
		var P = document.createElement("P");
		P.appendChild(Message);
		Chat.insertBefore(P, Chat.firstChild);
	});
	R.setResponseType("text");
	R.options("POST", "BackendSay.php");
	R.add("NormalWord", LW);
	R.execute(true);
}