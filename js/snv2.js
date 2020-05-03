/*To show and hide any element that you choose.*/
function ShowHide(divId)    {

if (document.getElementById(divId).style.display == 'none')
    {document.getElementById(divId).style.display='block'; }
else
    { document.getElementById(divId).style.display = 'none';}

};

/*Function to resize the text area to the height of the text.*/
function resizeIt(textareaID) {
    var textarea = document.getElementById(textareaID);
   	textarea.style.height = 0;
    textarea.style.height = Math.max((textarea.scrollHeight), 50) + 'px';
	};

/* Expand input feild */
function input_size(element_id)
	{
	this_element = document.getElementById(element_id);
	this_element.size=Math.max(Math.min(this_element.value.length+2, 25), 5);
	}

/* Auto Enter the text in the feild*/
function auto_enter(CheckID, EntryWord, EntryID)
{
	var c = document.getElementById(CheckID).checked;
	if (c==true)
	{
	v = document.getElementById(EntryID).value = EntryWord;
	document.getElementById(EntryID).size = Math.max(Math.min(EntryWord.length+2, 25), 5) ;
	}
	else
	{
	v = document.getElementById(EntryID).value = '';
	document.getElementById(EntryID).size = 8;
	}
}


/* Confirm On Exit */
var needToConfirm = true;

  window.onbeforeunload = confirmExit;
  function confirmExit()
  {
    if (needToConfirm)
      return  "You have attempted to leave this page.  If you have made any changes to the fields without clicking the submit button, your changes will be lost.  Are you sure you want to exit this page?";
  };

//Choose email or download function for checkboxes
function submit_type(ChoiceID) 
{
    var ChoiceType = document.getElementById(ChoiceID).value;

	if (ChoiceType == 'download')
	{
		document.getElementById('EmailSection').style.display = 'none';
		document.getElementById('SubmitButton').value = 'Download Notes. . .';
		}
		else
		{
		document.getElementById('EmailSection').style.display = 'block';
		document.getElementById('SubmitButton').value = 'Email the notes to me. . .';	
		}
	};
