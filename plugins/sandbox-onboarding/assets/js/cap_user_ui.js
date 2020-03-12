/**
 * JS code for user consent prior allowing sandbox account request
 */
window.onload = (event) => {
  const cb = document.getElementById('user_consent');
  if (cb !== 'undefined') {
    cb.addEventListener('change', event => {
      consentClicked();
    });
  }

  function consentClicked() {
    const button = document.getElementById('request_account');
    cb.checked ? button.removeAttribute('disabled') : button.setAttribute('disabled', true);
  }
}