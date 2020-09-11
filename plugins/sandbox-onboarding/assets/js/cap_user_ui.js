/**
 * JS code for user UI 
 */
window.onload = (event) => {

  // init the tabs UI
  jQuery( function() {
    jQuery("#tabs").tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html("Couldn't load information for this tab.");
        });
      },
      create: function( event, ui ) {        
        // init callback for inputs 
        jQuery('div#newacct input').on('change', validateNewAccount);
      },
      activate: function( event, ui ) {
        // check active tab
        if (ui.newTab.context.hash === '#newacct') {
          // this is the 1st tab and it gets prepared in 'create'. See above ^
          jQuery("div#accounts ul").hide();
          jQuery('div#accounts div.changepass').hide();
        }
        if (ui.newTab.context.hash === '#accounts') {
          jQuery('#accounts div.notice').show();
          jQuery('div#accounts div.notice div.wait').fadeIn(300);

          // request sandbox accounts via ajax
          var data = {
            'action': 'get_sandbox_accounts'
          };

          // ajax_object is passed from php via localization; see cap.php
          jQuery.post(ajax_object.ajax_url, data, function(response) {
            try {
              let json = JSON.parse(response);

              if (json.code == 1 || json.rows.length == 0) {
                jQuery('#accounts div.notice, #accounts div.notice div.wait, #accounts div.notice div.nodata').show();
                jQuery('#accounts ul.header').hide();
                jQuery('#accounts ul.data').hide();
              } else {
                jQuery('#accounts div.notice, #accounts div.notice div.wait, #accounts div.notice div.nodata').fadeOut(200);
                listAccounts(json.rows);
                initActions();
                jQuery('#accounts ul').fadeIn(300);
              }

              jQuery('#accounts div.notice div.wait').fadeOut(200);
            } catch (e) {
              console.log('Could not parse server response:', err);
            }
          });
        }
      }
    });
  });

  /** 
   * Validate inputs for new account
   * Quite lame.. 
   */
  function validateNewAccount(event) {
    const button = document.getElementById('request_account');
    const cb = document.getElementById('user_consent');

    let account = document.querySelector('div#newacct input#username').value;
    let password = document.querySelector('div#newacct input#password').value;

    if (account != '' && cb.checked && 
          password != '' && password.length >= 8) {
      button.removeAttribute('disabled');
      button.addEventListener('click', createAccount);
    } else {
      button.setAttribute('disabled', true);
      button.removeEventListener('click', createAccount);
    }
  }

  /** 
   * Callback for the create sandbox account
   */
  function createAccount(event) {
    let account = document.querySelector('div#newacct input#username').value;
    let password = document.querySelector('div#newacct input#password').value;

    // activate the spinner
    jQuery('div#newacct div.loader').css('display', 'inline-block');

    // create new account
    var data = {
      'action': 'create_sandbox_account',
      'account': account,
      'password': password
    };

    // ajax_object is passed from php via localization; see cap.php
    jQuery.post(ajax_object.ajax_url, data, function(response) {
      try {
        let result = JSON.parse(response); 
        
        // deactivate the spinner
        jQuery('div#newacct div.loader').css('display', 'none');

        if (result.code == 204) {
          jQuery('div#newacct div.response')
            .text(result.response)
            .show()
            .delay(3000)
            .fadeOut(200);
        }
      } catch (e) {
        console.log('error during password change:', e);
      }
    });
  }

  /** 
   * Populates the list of accounts form the JSON object
   */
  function listAccounts(rows) {
    // copy the template row and reuse it while looping through the json
    const template = jQuery("div#accounts ul.data li:first").clone();
    jQuery("div#accounts ul.data li").remove();
  
    let i = 0;

    for (let account of rows) {
      i++;

      let item = jQuery(template).clone();
      item.attr('data-account', account.userName);

      if (account.active === true) {
        item.addClass('active');        
      }
    
      (i % 2 == 0) ? item.addClass('even') : item.addClass('odd');

      item.children('div.account').text(account.userName)
      item.children('div.lastaccess').text(account.lastLogonTime);
      item.children('div.lastpasschange').text(account.passwordLastModified);

      jQuery("div#accounts ul.data").append(item);

      item = null;
    }
  }

  /** 
   * Initializes the action buttons in each row of the accounts
   */
  function initActions() {    
    jQuery('div#accounts ul.data li.active div.actions span.delete')
      .on('click', function() {
        let account = jQuery(this).parent().siblings('div.account').text();
        deleteAccount(account);
      });

    jQuery('div#accounts ul.data li.active div.actions span.changepass')
      .on('click', function() {
        let account = jQuery(this).parent().siblings('div.account').text();
        jQuery('div#accounts div.changepass input[type=password]')
          .on('change', validatePassword);

        changePassword(account);
      });
  }

  /** 
   * Callback for the delete account action
   */
  function deleteAccount(account) {
    // populated from cap.php via localization of this JS
    let question = ajax_object.account_delete_question || 'Deleting an account is irreversible. Are you sure you want to delete the account?';
    let confirmed = window.confirm(question);    

    if (confirmed) {
      // delete account
      var data = {
        'action': 'delete_sandbox_account',
        'account': account
      };

      // ajax_object is passed from php via localization; see cap.php
      jQuery.post(ajax_object.ajax_url, data, function(response) {
        try {
          let result = JSON.parse(response); 

          if (result.code == 204) {
            jQuery("div#accounts ul.data li[data-account='" + account + "']")
              .fadeOut(300)
              .remove();
            jQuery('div#accounts div.notice')
              .show()
              .text(result.response);
            jQuery('div#accounts div.notice')
              .delay(3000)
              .fadeOut(200);
          }
        } catch (e) {
          console.log('error during deleting account:', e);
        }
      });
    }
  }

  /** 
   * Callback for the change password action
   */
  function changePassword(account) {
    let visible = jQuery('div#accounts div.changepass').is(":visible");
    if (! visible) {
      jQuery('div#accounts div.changepass').show();
    }

    jQuery('div#accounts div.changepass .account').text(account);

    jQuery('div#accounts div.changepass div.content').fadeIn(200);
    jQuery('div#accounts div.changepass div.response')
      .text('')
      .hide();

    jQuery('div#accounts div.changepass span.close').on('click', function(e, t) {
      jQuery('div#accounts div.changepass').fadeOut(200);
    });
  }

  /**
   * Callback for validating password values 
   * Quite lame..
   */
  function validatePassword(event) {    
    let pass1 = document.getElementById('password1');
    let pass2 = document.getElementById('password2');
    let button = document.getElementById('change_password');
    
    let disabled = true;

    if (pass1.value.length >= 8 && pass2.value.length >= 8) {
      if (pass1.value == pass2.value) {
        disabled = false;
      }
    }

    if (disabled) {
      button.setAttribute('disabled', true);
      button.removeEventListener('click', submitPassword);
    } else {
      button.removeAttribute('disabled');
      button.addEventListener('click', submitPassword);
    }

    return false;
  }

  /**
   * Sends new password via ajax and parses the response
   */
  function submitPassword(event) { 
    let pass1 = document.getElementById('password1');    
    let account = document.querySelector('div#accounts div.changepass .account');    

    // submit new password
    var data = {
      'action': 'change_sandbox_password',
      'account': account.innerText,
      'password': pass1.value
    };

    // ajax_object is passed from php via localization; see cap.php
    jQuery.post(ajax_object.ajax_url, data, function(response) {
      try {
        let result = JSON.parse(response); 
        jQuery('div#accounts div.changepass div.content').fadeOut(200);
        jQuery('div#accounts div.changepass div.response').
          show().
          text(result.response);
        jQuery('div#accounts div.changepass')
          .delay(3000)
          .fadeOut(200);
      } catch (e) {
        jQuery('div#accounts div.changepass div.response').text('');
        jQuery('div#accounts div.changepass').hide();

        console.log('error during password change:', e);
      }
    });
  }
}
