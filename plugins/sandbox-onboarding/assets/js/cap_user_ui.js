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
        // consent prior allowing sandbox account request
        const cb = document.getElementById('user_consent');
        
        // callback for the consent read checkbox
        function consentClicked() {
          const button = document.getElementById('request_account');
          cb.checked ? button.removeAttribute('disabled') : button.setAttribute('disabled', true);
        }
        // init callback for the consent read checkbox
        if (typeof cb != 'undefined' && cb != null) {
          cb.addEventListener('change', event => {
            consentClicked();
          });
        }
        // init callback for the Request sandbox account button
        // todo
      },
      activate: function( event, ui ) {
        // check active tab
        if (ui.newTab.context.hash === '#newacct') {
          // we already did everything for the 1st tab in 'create'. See above ^
        }
        if (ui.newTab.context.hash === '#accounts') {
          // request sandbox accounts via ajax
          var data = {
            'action': 'get_sandbox_accounts'
          };

          // ajax_object is passed from php via localization; see cap.php
          jQuery.post(ajax_object.ajax_url, data, function(response) {
            try {
              let rows = JSON.parse(response);
              console.log('from server: ', rows);

              if (typeof rows === 'undefined' || rows.length == 0) {
                jQuery('#accounts div.nodata').show();
                jQuery('#accounts ul.header').hide();
                jQuery('#accounts ul.data').hide();
              } else {
                jQuery('#accounts div.nodata').hide();
                if (ajax_object.show_passive_accounts == true) {
                  jQuery('#accounts div.passiveinfo').show();
                } else {
                  jQuery('#accounts div.passiveinfo').hide();
                }
                jQuery('#accounts ul.header').show();
                jQuery('#accounts ul.data').show();
                listAccounts(rows);
                initActions();
              }

              jQuery('#accounts div.wait').hide();
            } catch (err) {
              console.log('Could not parse server response:', response);
            }
          });
        }
      }
    });
  });

  /** 
   * Populates the list of accounts form the JSON object
   */
  function listAccounts(rows, show_passive) {
    // copy the template row and reuse it while looping through the json
    const template = jQuery("div#accounts ul.data li:first").clone();
    jQuery("div#accounts ul.data li").remove();

    for (const account of rows) {

      if (show_passive == false && account.active == false) {
        continue;
      }

      let item = jQuery(template).clone();

      if (account.active === true) {
        item.addClass('active');
      }

      item.children('div.account').text(account.userName)

      let time = new Date(account.lastLogonTime);      
      item.children('div.lastaccess').text(time.toISOString());
      item.children('div.lastpasschange').text(account.passwordLastModified);

      jQuery("div#accounts ul.data").append(item);

      item = null;
      newacct = null;
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
        changePassword(account);
      });
  }

  /** 
   * Callback for the delete account action
   */
  function deleteAccount(account) {
    console.log('delete account: ', account);
    // 1. get confirmation
    // 2. call backend via ajax
    // 3a remove row from ul.data if success
    // 3b display error if removal failed
  }

  /** 
   * Callback for the change password action
   */
  function changePassword(account) {
    console.log('change password: ', account);    
    // 1. enable password change dialog
    //    * verify password and password_confirmation are the same values
    // 2. send password to backend via ajax
    // 3a show success message or
    // 3b display error if pass change failed
  }
}
