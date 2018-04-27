//<![CDATA[ 
(function(){
NTES("span.photo-search input[type=text]").addEvent("focus", function(){ this.value == this.defaultValue && (this.value = ""); }).addEvent("blur", function(){ this.value == "" && (this.value = this.defaultValue); });
	NTES("div.pnav-box div.box-title a.btn-fold").addEvent("click", function(e){
		e.preventDefault();
		var eleTitle = NTES(this.parentNode);
		NTES(this).addCss("hidden");
		eleTitle.$("a.btn-unfold").removeCss("hidden");
		NTES(eleTitle.parentNode).$("ul.box-list").removeCss("hidden");
	});
	NTES("div.pnav-box div.box-title a.btn-unfold").addEvent("click", function(e){
		e.preventDefault();
		var eleTitle = NTES(this.parentNode);
		NTES(this).addCss("hidden");
		eleTitle.$("a.btn-fold").removeCss("hidden");
		NTES(eleTitle.parentNode).$("ul.box-list").addCss("hidden");
	});
	NTES("div.pnav-box ul.box-list a.btn-fold").addEvent("click", function(e){
		e.preventDefault();
		var eleTitle = NTES(this.parentNode);
		NTES(this).addCss("hidden");
		eleTitle.$("a.btn-unfold").removeCss("hidden");
		eleTitle.$("h2").removeCss("hidden");
	});
	NTES("div.pnav-box ul.box-list a.btn-unfold").addEvent("click", function(e){
		e.preventDefault();
		var eleTitle = NTES(this.parentNode);
		NTES(this).addCss("hidden");
		eleTitle.$("a.btn-fold").removeCss("hidden");
		eleTitle.$("h2").addCss("hidden");
	});
	new NTES.ui.Slide(NTES("ul.photo-snav li"), NTES("div.photo-scnt"), "active", "mouseover", 6000);
})();
//]]> 