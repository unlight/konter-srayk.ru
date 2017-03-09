function phpRequest(){
	this.params = [];
	this.paramsIndex = 0;
	this.responseType = "var";
	this.async = true;
	this.method = "GET";
	this.preExec = function(s){
		return s;
	}
	this.setResponseType = function(type){
		this.responseType = type;
	}
	this.add = function(_name, _value){
		this.params[this.paramsIndex] = { name: _name, value: _value };
		this.paramsIndex++;
	}
	this.options = function(method, url){
		this.method = method;
		this.url = url;
	}
	this.execute = function(bRandom){
		var txt = (bRandom) ? '?' + Math.random() : '?';
		if (this.method == "POST") this.preExec = function(s){ return encodeURIComponent(s); }
		for (var i = 0; i < this.params.length; i++) txt = txt + '&' + this.params[i].name + '=' + this.preExec(this.params[i].value);
		var R = (window.XMLHttpRequest) ? new XMLHttpRequest() : createXMLHttp();
		if (!R) return alert("Your browser does not support AJAX!");
		R.callback = this.callback;
		var ResponseType = this.responseType;
		R.onreadystatechange = function(){
			if (R.readyState != 4) return;
			if (ResponseType == "var"){
				try{ eval("var v = " + R.responseText); }
				catch(e){ return R.callback(false, R.responseText); }
				if(typeof(v) == "string") return R.callback(false, v);
				return R.callback(v);
			} else if(ResponseType == "xml") return R.callback(R.responseXML);
			else if (ResponseType == "text") return R.callback(R.responseText);
		}
		if (this.method == "POST"){
			R.open(this.method, this.url, this.async);
			R.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			R.send(txt);
		} else {
			this.url += txt;
			R.open(this.method, this.url, this.async);
			R.send(null);
		}
	}
	var callback = arguments[0];
	switch(typeof(callback)){
		case "string":
			//_callback += " = arguments[0]";
			callback = new Function(callback); break;
		case "function": this.callback = callback; break;
		default: this.callback = new Function();
	}
}

function createXMLHttp(){
	var httprequest = false;
	try{ httprequest = new ActiveXObject("Msxml2.XMLHTTP");	} 
	catch (e){
		try{ httprequest = new ActiveXObject("Microsoft.XMLHTTP"); }
		catch (e){}
	}
	return httprequest;
}