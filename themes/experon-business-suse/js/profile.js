/**
 * Add options in the country list
 */
window.onload = (event) => {
  var countries = document.querySelector("div.field-country select");

  if (typeof countries !== 'undefined' && countries != null) {
    var af = countries.querySelector("option[value='AF']");
    var item = '';
    var content = '';

    var addons = {
      'US': 'United States', 
      'DE': 'Germany', 
      'IN': 'India',
      '--': '------------------'
    };

    for (key in addons) {
      item = document.createElement('option');
      item.value = key;
      if (key == '--') {
        item.value = '';
        item.setAttribute('disabled', true);
      }
      content = document.createTextNode(addons[key]); 
      item.appendChild(content);
      countries.insertBefore(item, af);
    }
  }
}