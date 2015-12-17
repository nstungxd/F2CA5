/**
 * Convert a single file-input element into a 'multiple' input list
 *
 * Usage:
 *
 *   1. Create a file input element (no name)
 *      eg. <input type="file" id="first_file_element">
 *
 *   2. Create a DIV for the output to be written to
 *      eg. <div id="files_list"></div>
 *
 *   3. Instantiate a MultiSelector object, passing in the DIV and an (optional) maximum number of files
 *      eg. var multi_selector = new MultiSelector( document.getElementById( 'files_list' ), 3 );
 *
 *   4. Add the first element
 *      eg. multi_selector.addElement( document.getElementById( 'first_file_element' ) );
 *
 *   5. That's it.
 *
 *   You might (will) want to play around with the addListRow() method to make the output prettier.
 *
 *   You might also want to change the line
 *       element.name = 'file_' + this.count;
 *   ...to a naming convention that makes more sense to you.
 *
 * Licence:
 *   Use this however/wherever you like, just don't blame me if it breaks anything.
 *
 * Credit:
 *   If you're nice, you'll leave this bit:
 *
 *   Class by Stickman -- http://www.the-stickman.com
 *      with thanks to:
 *      [for Safari fixes]
 *         Luis Torrefranca -- http://www.law.pitt.edu
 *         and
 *         Shawn Parker & John Pennypacker -- http://www.fuzzycoconut.com
 *      [for duplicate name bug]
 *         'neal'
 */
function MultiSelector( list_target, max )
{
	// Where to write the list
	this.list_target = list_target;
	// How many elements?
	this.count = 0;
	// How many elements?
	this.id = 0;
	// Is there a maximum?
	if( max ){
		this.max = max;
	} else {
		this.max = -1;
	};

	/**
	 * Add a new file input element
	 */
	this.addElement = function( element )
	{
		// Make sure it's a file input element
		if( element.tagName == 'INPUT' && element.type == 'file' )
		{
			// Element name -- what number am I?
			//element.name = 'file_' + this.id++;
         element.name = 'files[]';
			element.style.height = '23px';
			// Add reference to this object
			element.multi_selector = this;

			// What to do when a file is selected
			element.onchange = function()
			{
				//alert(this.value);
				var selval = this.value;

				var ext = selval.split('.');
				//alert(ext[1]);
				ext = ext[1];
				ext = ext.toLowerCase()
            if(ext == "jpg" || ext == "jpeg" || ext == "gif" || ext == "png" || ext == "ttf" || ext == "bmp" || ext == "pdf" || ext == "doc" || ext == "rtf" || ext == "docx" || ext == "csv" || ext == "xml" || ext == "txt")
				{
               // New file input
    				var new_element = document.createElement( 'input' );
    				new_element.type = 'file';

    				// Add new element
    				this.parentNode.insertBefore( new_element, this );

    				// Apply 'update' to element
    				this.multi_selector.addElement( new_element );

    				// Update list
    				this.multi_selector.addListRow( this );

    				// Hide this: we can't use display:none because Safari doesn't like it
    				this.style.position = 'absolute';
    				this.style.left = '-1000px';
            } else {
					alert( 'Error: not a valid file.' );
					this.value = '';
					return false;
            }
			};
			// If we've reached maximum number, disable input element
			if( this.max != -1 && this.count >= this.max ){
				element.disabled = true;
			};

			// File element counter
			this.count++;
			// Most recent element
			this.current_element = element;
		} else {
			// This can only be applied to file input elements!
			alert( 'Error: not a file input element' );
		};
	};

	/**
	 * Add a new row to the list of files
	 */
	this.addListRow = function(element)
	{
        // Row div
		var new_row = document.createElement('div');

		// Delete button
		var new_row_button = document.createElement('input');
		new_row_button.type = 'button';
		new_row_button.value = 'Delete';

		// References
		new_row.element = element;

		// Delete function
		new_row_button.onclick= function()
		{
			// Remove element from form
			this.parentNode.element.parentNode.removeChild( this.parentNode.element );

			// Remove this row from the list
			this.parentNode.parentNode.removeChild( this.parentNode );

			// Decrement counter
			this.parentNode.element.multi_selector.count--;

			// Re-enable input element (if it's disabled)
			this.parentNode.element.multi_selector.current_element.disabled = false;

			// Appease Safari
			//    without it Safari wants to reload the browser window
			//    which nixes your already queued uploads
			return false;
		};
		var new_title = document.createElement('input');
		new_title.type = 'text';

		// Set row value
		// new_row.innerHTML = "<small>Title </small>: <input type='text' name='titles[]' value='' >" + element.value+"<br><small>Descrpt</small><textarea cols=15 rows=1 name='descriptions[]' value=''>";
		// var cnt = this.count-1;
		//element.value.replace("fakepath","filepath");
        var newval =  element.value;
        //alert(document.getElementById('uplad_file_span').innerHTML);
        newvalArr = newval.split("fakepath");
        if(newvalArr.length > 1){
            newval = newvalArr[1];
            newval = newval.substr(1);
        } else {
            newval = newval;
        }

        //alert(newval)
        new_row.innerHTML = "" + newval + " &nbsp; ";
		// Add button
		new_row.appendChild(new_row_button);

		// Add it to the list
		this.list_target.appendChild( new_row );
		$(function() {
			var ead=10;
			$('#pane2').jScrollPane({showArrows:true, scrollbarWidth: 15, arrowSize: 15, el:'div.middle-container', eladd:ead});
		});
	};
};