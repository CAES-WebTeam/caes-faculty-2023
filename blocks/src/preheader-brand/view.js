// JS for preheader menu toggle

function togglePreheaderSearch() {
  var preheaderSearchContainer = document.getElementById('preheaderSearchContainer');
  var containerAttr = preheaderSearchContainer.attributes;
  
  if (containerAttr['aria-hidden'].value == "true") {
    document.getElementById('preheaderSearchContainer').setAttribute("aria-hidden", "false");
    document.getElementById('preheaderSearchToggle').setAttribute("aria-expanded","true");
  } else {
    document.getElementById('preheaderSearchContainer').setAttribute("aria-hidden", "true");
    document.getElementById('preheaderSearchToggle').setAttribute("aria-expanded","false");
  }
}

document.getElementById('preheaderSearchToggle').addEventListener('click', function(event){
  togglePreheaderSearch();
})