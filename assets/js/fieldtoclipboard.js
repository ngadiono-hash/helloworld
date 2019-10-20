var fieldtoclipboard = {
	tooltipobj: null,
	hidetooltiptimer: null,
	hidetooltiptimers: null,
	createtooltip:function(){
		var tooltip = document.createElement('span')
		tooltip.style.cssText = 
			'position:absolute; background: #f1f1f1; border: 2px solid gray; font-family: Monda; color: #808080; padding:4px ;'
			+ 'border-radius:3px; font-size:12px; box-shadow:3px 3px 3px rgba(0,0,0,.4);'
			+ 'z-index: 0; opacity: 0; transition: opacity 0.3s; left: 270px; top: 4px;'
		tooltip.innerHTML = 'Copied!'
		this.tooltipobj = tooltip
		document.body.prepend(tooltip)
	},

	showtooltip:function(e){
		var evt = e || event
		clearTimeout(this.hidetooltiptimer)
		clearTimeout(this.hidetooltiptimers)
		// this.tooltipobj.style.left = evt.pageX + 150 + 'px'
		// this.tooltipobj.style.top = evt.pageY - 7 + 'px'
		this.tooltipobj.style.opacity = 1
		this.tooltipobj.style.zIndex = 10
		this.hidetooltiptimer = setTimeout(function(){
			fieldtoclipboard.tooltipobj.style.opacity = 0
		}, 1500);
		this.hidetooltiptimers = setTimeout(function(){
			fieldtoclipboard.tooltipobj.style.zIndex = 0
		}, 1500)
	},

	selectelement:function(el){
		jkcodeeditor.richeditor.selection.selectAll()
		jkcodeeditor.richeditor.focus()
	},
	
	copyfield:function(e, fieldref, callback){
		var field = (typeof fieldref == 'string')? document.getElementById(fieldref) : fieldref
		callbackref = callback || function(){}
		if (/(textarea)|(input)/i.test(field) && field.setSelectionRange){
			field.focus()
			field.setSelectionRange(0, field.value.length) // for iOS sake
		}
		else if (field && document.createRange){
			this.selectelement(field)
		}
		else if (field == null){ // copy currently selected text on document
			field = {value:null}
		}
		var copysuccess // var to check whether execCommand successfully executed
		try{
			copysuccess = document.execCommand("copy")
		}catch(e){
			copysuccess = false
		}
		if (copysuccess){ // execute desired code whenever text has been successfully copied
			if (e){
				this.showtooltip(e)
			}
			callbackref(field.value || window.getSelection().toString())
		}
		return false
	},


	init:function(){
		this.createtooltip()
	}
}

fieldtoclipboard.init();