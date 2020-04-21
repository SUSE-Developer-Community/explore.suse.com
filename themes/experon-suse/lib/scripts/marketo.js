/**
 * Simple Marketo helper JS
 */
let marketo = {
  // Called with a config object that can be adjusted in the page itself
  loadForm: function(config) {
    var element = null;
    var elements = null;
    // todo: check and sanitize config

    // load form
    MktoForms2.loadForm(config.rootUrl, config.munchkinId, config.formId, function(form) {
      // update FirstName
      element = document.getElementById('FirstName');
      console.log('fname', element);
      if (typeof element != 'undefined' && element != null && config.firstName != '') {
        element.value = config.firstName;
      }
      // update LastName
      element = document.getElementById('LastName');
      if (typeof element != 'undefined' && element != null && config.lastName != '') {
        element.value = config.lastName;
      }
      // update Email
      element = document.getElementById('Email');
      if (typeof element != 'undefined' && element != null && config.email != '') {
        element.value = config.email;
      }
      // update hidden customCampaignInput
      elements = document.getElementsByName('customCampaignInput');
      if (typeof elements != 'undefined') {
        console.log(elements[0]);
        element = elements.item(0);
        console.log(element);
        if (typeof element != 'undefined' && element != null) {
          console.log('set customCampaignInput');
          element.setAttribute('value', config.campaignId);
        }
      }
      // update hidden formSubmitURL
      elements = document.getElementsByName('formSubmitURL');
      if (typeof elements != 'undefined') {
        element = elements[0];
        if (typeof element != 'undefined' && element != null) {
          element.setAttribute('value', config.formSubmitUrl);
        }
      }
      // update hidden landingPageURL
      elements = document.getElementsByName('landingPageURL');
      if (typeof elements != 'undefined') {
        element = elements[0];
        if (typeof element != 'undefined' && element != null) {
          element.setAttribute('value', config.landingPageUrl);
        }
      }
      //update hidden followUpURL
      elements = document.getElementsByName('followUpURL');
      if (typeof elements != 'undefined') {
        element = elements[0];
        if (typeof element != 'undefined' && element != null) {
          element.setAttribute('value', config.followUpUrl);
        }
      }
    });
    
    // adjust classes of some ugly looking elements
    MktoForms2.whenRendered(function (form) {
      var element = document.getElementById('Email');
      var grandpa = element.parentNode.parentNode;
      grandpa.setAttribute('class', grandpa.getAttribute('class') + ' fullWidth');

      element = document.getElementById('customPersonNotes');
      grandpa = element.parentNode.parentNode;
      grandpa.setAttribute('class', grandpa.getAttribute('class') + ' fullWidth');

      var elements = document.getElementsByName('optin');
      if (typeof elements != 'undefined') {
        element = elements[0];
        if (typeof element != 'undefined' && element != null) {
          var greatgrandpa = element.parentNode.parentNode.parentNode;
          greatgrandpa.setAttribute('class', greatgrandpa.getAttribute('class') + ' fullWidth');        
        }
      }
    });
  }
}

window.onload = (event) => {
  console.log(config);
  marketo.loadForm(config);
}
