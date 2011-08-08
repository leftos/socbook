<script type="text/javascript" language="javascript">
	function trim(s) {
		s = s.replace(/(^\s*)|(\s*$)/gi,"");
		s = s.replace(/[ ]{2,}/gi," ");
		s = s.replace(/\n /,"\n");
		return s;
	};
	
	$(function() {
		var availableTags = [" <?php 
			/* $arr = fetchAllTags();
			$i=0;
			foreach ($arr as $item)
			{
				$item = split(',', $item);
				$myarr[$i++] = $item[0];
			} */
			echo join("\", \"", fetchAllTags(false, 15)); 
		?> "];
		function split( val ) {
			return val.split( / \s*/ );
		}
		function splitpar( val ) {
			return val.split( /\s\(/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}
	
		$( ".tags" )
			// don't navigate away from the field on tab when selecting an item
			.bind( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
						$( this ).data( "autocomplete" ).menu.active ) {
					event.preventDefault();
				}
			})
			
			.autocomplete({
				minLength: 0,
				source: function( request, response ) {
					// delegate back to autocomplete, but extract the last term
					response( $.ui.autocomplete.filter(
						availableTags, extractLast( request.term ) ) );
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					this.value = trim(this.value);
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					
					var item = splitpar( ui.item.value );
					item.pop();
					var temp = item.pop()
					
					// add the selected item
					terms.push( temp );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					var temp2 = terms.join( " " );
					if (temp2.charAt(0) == " ") {
						this.value = temp2.substring(1);
					}
					else
					{
						this.value = temp2;
					}
					this.value = trim(this.value);
					this.value = this.value + " ";
					// alert(this);	
					
					setCaretToPos(this, this.value.length);
					
					return false;
				}
			});
	});
	
	function setSelectionRange(input, selectionStart, selectionEnd) {
	  if (input.setSelectionRange) {
	    input.focus();
	    input.setSelectionRange(selectionStart, selectionEnd);
	  }
	  else if (input.createTextRange) {
	    var range = input.createTextRange();
	    range.collapse(true);
	    range.moveEnd('character', selectionEnd);
	    range.moveStart('character', selectionStart);
	    range.select();
	  }
	}
	
	function setCaretToPos (input, pos) {
	  setSelectionRange(input, pos, pos);
	}

	
</script>